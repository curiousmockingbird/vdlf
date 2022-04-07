<?php
use function Roots\asset;

function mapping_posts($post)
{
    $image = get_the_post_thumbnail_url($post->ID) ? get_the_post_thumbnail_url($post->ID, 'original') : null;
    $thumbnail = get_the_post_thumbnail_url($post->ID) ? get_the_post_thumbnail_url($post->ID, 'thumbnail') : null;
    $data = [
        "post_id"     => $post->ID,
        "link"        => get_permalink($post->ID),
        "thumbnail"   => $thumbnail,
        "image"       => $image,
        "title"       => $post->post_title,
        "slug"        => $post->post_name,
        "date"        => get_the_date(null, $post->ID),
        "content"     => apply_filters("the_content", get_the_content("", false, $post->ID)),
        "excerpt"     => get_the_excerpt($post->ID) ?? substr(strip_tags($post->post_content), 0, 120),
        "author_name" => get_the_author_meta('display_name', $post->post_author),
        "categories"  => array_map(function($item){
            return [
                "name"    => $item->name,
                "es_name" => get_field('es_name', $item->taxonomy . '_' . $item->term_id),
                "en_name" => get_field('en_name', $item->taxonomy . '_' . $item->term_id) ?? $item->name,
                "slug"    => $item->slug
            ];
        },wp_get_post_terms($post->ID, 'category')),
        "type"        => get_post_type($post->ID),
    ];
    if (get_post_type($post->ID) == "take_actions") {
        $data["link"]  = get_field("link",$post->ID);
        $data["icon"]  = get_field("icon",$post->ID);
        $data["label"] = get_field("label",$post->ID);
    }
    if (get_post_type($post->ID) == "media_mentions") {
        $data["link"]       = get_field("link",$post->ID);
        $data["categories"] = wp_get_post_terms($post->ID, 'media_source');
    }
    return $data;
}

function get_cpt_data($params, $type = array("post"))
{
    $paged = $params["page"] ?? 1;
    $perpage = $params["perpage"] ?? "6";
    $categories = $params["categories"] ?? null;
    $taxonomy = $params["taxonomy"] ?? "category";
    $is_featured = $params["featured"] ?? null;
    $orderby = $params["orderby"] ?? "date";
    $sortby = $params["sortby"] ?? "latest";
    $types = $params["post_type"] ?? $type;
    $keywords = $params["keywords"] ?? null;
    $exclude = $params["exclude"] ?? null;
    $language = $params["language"] ?? null;
    $custom_lang = $params["lang"] ?? null;
    $month = $params["month"] ?? null;
    $year = $params["year"] ?? null;

    $args = array(
        'post_type' => $types,
        'paged' => $paged,
        'posts_per_page' => $perpage,
        'post_status' => 'publish',
    );

    if ($exclude) {
        $args["post__not_in"] = explode(",", $exclude);
    }

    if ($language) {
        $args['lang'] = $language;
    }
    
    if ($sortby == "latest") {
        $args['orderby'] = $orderby;
        $args['order'] = "desc";
    } else if ($sortby == "oldest") {
        $args['orderby'] = $orderby;
        $args['order'] = "ASC";
    } else if ($sortby == "random") {
        $args['orderby'] = "rand";
        $args['order'] = "ASC";
    }

    if ($is_featured || $sortby == "featured") {
        $args["meta_query"] = array("featured" => array('key' => 'featured', 'value' => true));
    }
    $tax_query = array();

    if ($categories && $categories != "all") {
        $mappingCategory = [
            "news"          => ["news","noticias"],
            "press-release" => ["press-release","comunicado-de-prensa"],
            "blog-post"     => ["blog-post","blog"],
        ];
        $categories = explode(",", $categories);
        foreach ($categories as $category) {
            if (array_key_exists($category, $mappingCategory)) {
                $categoryAll = $mappingCategory[$category];
                foreach ($categoryAll as $new_category) {
                    $tax_query[] = array('taxonomy' => $taxonomy, 'field' => 'slug', 'terms' => array($new_category));
                }
            }else{
                $tax_query[] = array('taxonomy' => $taxonomy, 'field' => 'slug', 'terms' => array($category));
            }
        }
    }

    if ($custom_lang) {
        $custom_lang = explode(",", $custom_lang);
        foreach ($custom_lang as $lang) {
            $tax_query[] = array('taxonomy' => "post_lang", 'field' => 'slug', 'terms' => array($lang));
        }
    }

    if ($keywords && $keywords != "") {
        $args['s'] = $keywords;
    }
    if (count($tax_query) > 1) {
        $tax_query['relation'] = 'OR';
    }
    if ($month || $year) {
        if ($year) {
            $date_query["year"] = $year;
        }

        if ($month) {
            $date_query["month"] = $month;
        }

        $args["date_query"] = $date_query;
    }

    $args['tax_query'] = $tax_query;

    $query = new \WP_Query($args);
    $max_num_pages = $query->max_num_pages;
    wp_reset_postdata();
    $datas = array_map("mapping_posts", get_posts($args));
    return [
        "posts"     => $datas,
        "reload"    => $params["reload"] ?? false,
        "nextPage"  => $max_num_pages > $paged,
        "totalpage" => $max_num_pages,
    ];
}

function update_categories_taxonomy() {
    if ($_GET["token"] != "60195446176DRT65ff6bed6b6d2f") {
        return "failed token";
    }
    $posts = json_decode(file_get_contents(get_template_directory_uri() . "/data/posts-update.json"));
    foreach($posts as $post) {
        if ($post->status == "DELETE") {
            echo $post->ID." Deleted\n";
            wp_delete_post($post->ID);
        }else{
            wp_set_object_terms($post->ID, $post->categories, 'category',true);
            $default = get_cat_name(get_option('default_category'));
            wp_remove_object_terms( $post->ID, $default, 'category' );
            wp_set_object_terms($post->ID, $post->languages,"post_lang", true);
        }
    }
    echo "Categories updates";
}

function update_language() {
    if ($_GET["token"] != "60195446176DRT65ff6bed6b6d2f") {
        return "failed token";
    }
    $posts = json_decode(file_get_contents(get_template_directory_uri() . "/data/posts-lang.json"));
    foreach($posts as $post) {
        if ($post->status == "DELETE") {
            echo $post->ID." Deleted\n";
            wp_delete_post($post->ID);
        }else{
            wp_set_object_terms($post->ID, $post->language,"post_lang", true);
        }
    }
    echo "Language updates";
}

function import_media_mention() {
    if ($_GET["token"] != "60195446176DRT65ff6bed6b6d2f") {
        return "failed token";
    }

    $posts = json_decode(file_get_contents(get_template_directory_uri() . "/data/media_mentions_new.json"));
    
    foreach($posts as $post) {
        if ($post->Status == "Yes") {
            if ($post->Language == "English") {
                $lang = "en";
            }else{
                $lang = "es";
            }
            $postData = array(
                'post_title' => $post->Title,
                'post_excerpt' => $post->Excerpt,
                'post_date' => $post->Date,
                'post_status' => "publish",
                'post_type' => "media_mentions",
                'post_author' => get_current_user_id() ?? 1,
            );
            kses_remove_filters();
            $post_id = wp_insert_post($postData);

            $attrs = array(
                'title' => $post->Title,
                'url' => $post->Link,
                'target' => "_blank",
            );

            update_field('link', $attrs,  $post_id);
            update_field("reporter", $post->Reporter_Author,$post_id);
            update_field("media_market", $post->Media_Market,$post_id);
            update_field("quoted", $post->Quoted,$post_id);
            update_field("connected_to_event", $post->Connected_to_event,$post_id);
            kses_init_filters();
            wp_set_object_terms($post_id, $post->Topic,"topic", true);
            wp_set_object_terms($post_id, $post->Source, "media_source", true);
            pll_set_post_language($post_id, $lang);
        }
    }

    echo "Media content imported";
}

function import_update_topic() {
    if ($_GET["token"] != "60195446176DRT65ff6bed6b6d2f") {
        return "failed token";
    }

    $posts = json_decode(file_get_contents(get_template_directory_uri() . "/data/update-topics.json"));
    $x=1;
    foreach($posts as $post) {;
        if ($post->On_website == "No") {
            continue;
        }
        $data = get_page_by_title($post->Title, OBJECT, 'media_mentions');
        if ($data) {
            $post_id = $data->ID;
            wp_set_object_terms($post_id, $post->Topic, "topic", false);
            $x++;
        }else{
            if ($post->Language == "English") {
                $lang = "en";
            }else{
                $lang = "es";
            }
            $postData = array(
                'post_title' => $post->Title,
                'post_date' => $post->Date,
                'post_status' => "publish",
                'post_type' => "media_mentions",
                'post_author' => get_current_user_id() ?? 1,
            );
            kses_remove_filters();
            $post_id = wp_insert_post($postData);
    
            $attrs = array(
                'title' => $post->Title,
                'url' => $post->Link,
                'target' => "_blank",
            );
    
            update_field('link', $attrs,  $post_id);
            update_field("reporter", $post->Reporter_Author,$post_id);
            update_field("media_market", $post->Media,$post_id);
            update_field("quoted", $post->Quoted,$post_id);
            update_field("connected_to_event", $post->Connected_to_event,$post_id);
            kses_init_filters();
            wp_set_object_terms($post_id, $post->Topic,"topic", true);
            wp_set_object_terms($post_id, $post->Media_Source,"media_source", true);
            pll_set_post_language($post_id, $lang);
            $x++;
        }
    }
    echo $x." updated";
}

function get_actions($request) {
    return get_cpt_data($request->get_params(),array("take_actions"));
}

function get_updates($request) {
    return get_cpt_data($request->get_params(),array("post"));
}

function get_mentions($request) {
    return get_cpt_data($request->get_params(),array("media_mentions"));
}

function get_post_categories($request) {
    $params = $request->get_params();
    $language = $params["language"] ?? null;
    $args = [
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'asc',
    ];
    $categories = get_terms('category', $args);
    $result = array();
    foreach ($categories as $cat) {
        $name = $language ? get_field($language.'_name', $cat->taxonomy . '_' . $cat->term_id) : $cat->name;
        $result[] = [
            "label" =>$name ?? $cat->name,
            "key"   => $cat->slug
        ];
    }

    return $result;
}


function get_custom_language($request) {
    $params = $request->get_params();
    $language = $params["language"] ?? null;
    $args = [
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'asc',
        'fields'     => 'all', 
    ];
    $categories = get_terms('post_lang', $args);
    $result = array();
    foreach ($categories as $cat) {
        $name = $language ? get_field($language.'_name', $cat->taxonomy . '_' . $cat->term_id) : $cat->name;
        $result[] = [
            "label" => $name ?? $cat->name,
            "key"   => $cat->slug
        ];
    }
    return $result;
}

function get_topic($request) {
    $params = $request->get_params();
    $language = $params["language"] ?? null;
    $args = [
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'asc',
        'fields'     => 'all', 
    ];
    $categories = get_terms('topic', $args);
    usort($categories, function($a, $b){
        return strcmp($a->name, $b->name);
    });
    $result = array();
    foreach ($categories as $cat) {
        $name = $language ? get_field($language.'_name', $cat->taxonomy . '_' . $cat->term_id) : $cat->name;
        $result[] = [
            "label" => $name ?? $cat->name,
            "key"   => $cat->slug
        ];
    }
    return $result;
}

function get_all_staff($request) {
    $params = $request->get_params() ?? array();
    $perpage = $params["perpage"] ?? -1;
    $paged = $params["page"] ?? 1;
    $language = $params["language"] ?? "en";
    $args = array('taxonomy' => "staff_category", 'orderby' => "name", 'show_count' => 0, 'pad_counts' => 0, 'hierarchical' => 0, 'hide_empty' => 1);
    $all_categories = get_categories($args);
    
    foreach ($all_categories as $categories) {
        $args = array('post_type' => 'staff', 'posts_per_page' => $perpage, 'paged' => $paged, 'order' => 'DESC');
        $args["tax_query"] = array(
            array(
                'taxonomy' => 'staff_category',
                'field' => 'slug',
                'terms' => $categories->slug,
            ),
        );
        $staff = array();
        
        $posts = get_posts($args);
        foreach ($posts as $key => $post) {
            $post_categories = get_the_terms($post->ID, "staff_category");
            $post = [
                "profession"     => $language == "es" && get_field("profession_es", $post->ID) != ""? get_field("profession_es", $post->ID) : get_field("profession", $post->ID),
                "avatar"         => get_field("avatar", $post->ID) && get_field("avatar", $post->ID) != "" ? get_field("avatar", $post->ID): asset("images/logo.png")->uri(),
                "image_position" => get_field("image_position", $post->ID) ?? "center",
                "email"          => get_field("email", $post->ID),
                "phone"          => get_field("phone", $post->ID),
                "year"           => get_field("year", $post->ID),     
                "title"          => $post->post_title,
                "content"        => apply_filters("the_content", get_the_content("", false, $post->ID)),
                "categories"     => $post_categories,
                "permalinks"     => get_permalink($post->ID),
                "excerpt"        => get_the_excerpt($post->ID),
                "featured_image" => get_the_post_thumbnail_url($post->ID),
            ];
            $staff[] = $post;
        }
        $name = $language ? get_field($language.'_name', $categories->taxonomy . '_' . $categories->term_id) : $categories->name;
        $data[] = [
            "category_name" => $name ?? $categories->name,
            "staff" => $staff,
        ];
    }
    return $data;
}

add_action('rest_api_init', function () {
    register_rest_route('medias', 'update', array(
        'methods'             => 'GET',
        'callback'            => 'import_update_topic',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('medias', 'import', array(
        'methods'             => 'GET',
        'callback'            => 'import_media_mention',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('language', 'update', array(
        'methods'             => 'GET',
        'callback'            => 'update_language',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('categories', 'mapping', array(
        'methods'             => 'GET',
        'callback'            => 'update_categories_taxonomy',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('action', 'all', array(
        'methods'             => 'POST',
        'callback'            => 'get_actions',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('updates', 'all', array(
        'methods'             => 'POST',
        'callback'            => 'get_updates',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('mentions', 'all', array(
        'methods'             => 'POST',
        'callback'            => 'get_mentions',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('categories', 'all', array(
        'methods'             => 'POST',
        'callback'            => 'get_post_categories',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('topic', 'all', array(
        'methods'             => 'POST',
        'callback'            => 'get_topic',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('language', 'all', array(
        'methods'             => 'POST',
        'callback'            => 'get_custom_language',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('staff', 'all', array(
        'methods'             => 'POST',
        'callback'            => 'get_all_staff',
        'permission_callback' => '__return_true'
    ));
});
