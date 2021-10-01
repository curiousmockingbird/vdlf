<?php
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
        "categories"  => wp_get_post_terms($post->ID, 'category'),
        "type"        => get_post_type($post->ID),
    ];
    if (get_post_type($post->ID) == "take_actions") {
        $data["link"] = get_field("link",$post->ID);
        $data["icon"] = get_field("icon",$post->ID);
        $data["label"] = get_field("label",$post->ID);
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
        $categories = explode(",", $categories);
        foreach ($categories as $category) {
            if ($taxonomy == "category" && $language != "en") {
                $category = $category."-".$language;
            }
            $tax_query[] = array('taxonomy' => $taxonomy, 'field' => 'slug', 'terms' => array($category));
        }
    }

    if ($keywords && $keywords != "") {
        $args['s'] = $keywords;
    }
    if (count($tax_query) > 1) {
        $tax_query['relation'] = 'OR';
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
    $posts = json_decode(file_get_contents(get_template_directory_uri() . "/data/posts.json"));
    foreach($posts as $post) {
        if ($post->status == "DELETE") {
            echo $post->ID." Deleted\n";
            wp_delete_post($post->ID);
        }else{
            wp_set_object_terms($post->ID, $post->categories, 'category',true);
            $default = get_cat_name(get_option('default_category'));
            wp_remove_object_terms( $post->ID, $default, 'category' );
        }
    }
    echo "Categories updates";
}

function get_actions($request) {
    return get_cpt_data($request->get_params(),array("take_actions"));
}

function get_updates($request) {
    return get_cpt_data($request->get_params(),array("post"));
}

function get_post_categories($request) {
    $params = $request->get_params();
    $language = $params["language"] ?? null;
    $args = [
        'hide_empty' => true,
        'orderby'    => 'count',
    ];
    if ($language) {
        $args['lang'] = $language;
    }
    $categories = get_terms('category', $args);
    $result = array();
    foreach ($categories as $cat) {
        $result[] = [
            "label" => $cat->name,
            "key"   => $cat->slug
        ];
    }

    return $result;
}

add_action('rest_api_init', function () {
    register_rest_route('categories', 'mapping', array(
        'methods' => 'GET',
        'callback' => 'update_categories_taxonomy',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('action', 'all', array(
        'methods' => 'POST',
        'callback' => 'get_actions',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('updates', 'all', array(
        'methods' => 'POST',
        'callback' => 'get_updates',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('categories', 'all', array(
        'methods' => 'POST',
        'callback' => 'get_post_categories',
        'permission_callback' => '__return_true',
    ));
});
