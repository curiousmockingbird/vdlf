<?php
function insertArrayAtPosition($array, $insert, $position)
{
    return array_slice($array, 0, $position, true) + $insert + array_slice($array, $position, null, true);
}

function label_args($label, $plural = true)
{
    if ($plural) {
        return array(
            "name" => __("{$label}s", "sage"),
            "singular_name" => __("{$label}", "sage"),
            "add_new" => __("Add New {$label}s", "sage"),
            "add_new_item" => __("Add New {$label}s", "sage"),
            "edit_item" => __("Edit {$label}s", "sage"),
            "new_item" => __("New {$label}s", "sage"),
            "all_items" => __("{$label}s", "sage"),
            "view_item" => __("View {$label}s", "sage"),
            "search_items" => __("Search {$label}s", "sage"),
            "not_found" => __("No {$label}s found", "sage"),
            "not_found_in_trash" => __("No {$label}s found in the Trash", "sage"),
            "parent_item_colon" => "",
        );
    } else {
        return array(
            "name" => __("{$label}", "sage"),
            "singular_name" => __("{$label}", "sage"),
            "add_new" => __("Add New {$label}", "sage"),
            "add_new_item" => __("Add New {$label}", "sage"),
            "edit_item" => __("Edit {$label}", "sage"),
            "new_item" => __("New {$label}", "sage"),
            "all_items" => __("{$label}", "sage"),
            "view_item" => __("View {$label}", "sage"),
            "search_items" => __("Search {$label}", "sage"),
            "not_found" => __("No {$label} found", "sage"),
            "not_found_in_trash" => __("No {$label} found in the Trash", "sage"),
            "parent_item_colon" => "",
        );
    }
}

function generate_CPT($name, $label, $args = array(), $plural = false)
{
    $labels = label_args($label, $plural);
    $final_args = array(
        "labels" => $labels,
        "public" => array_key_exists("public", $args) ? $args["public"] : true,
        "publicly_queryable" => array_key_exists("publicly_queryable", $args) ? $args["publicly_queryable"] : true,
        "has_archive" => array_key_exists("has_archive", $args) ? $args["has_archive"] : true,
        "show_in_admin_bar" => array_key_exists("show_in_admin_bar", $args) ? $args["show_in_admin_bar"] : true,
        "menu_icon" => array_key_exists("menu_icon", $args) ? $args["menu_icon"] : "dashicons-admin-post",
        "supports" => array_key_exists("supports", $args) ? $args["supports"] :
        array("title", "excerpt", "editor", "revisions", "thumbnail", "excerpt"),
    );
    if (array_key_exists("taxonomies", $args)) {
        $final_args["taxonomies"] = $args["taxonomies"];
    }
    if (array_key_exists("rewrite", $args)) {
        $final_args["rewrite"] = $args["rewrite"];
    }
    register_post_type($name, $final_args);
}

/*
 **
 ** CUSTOM POST GOES HERE
 **
 */

function custom_post_init()
{
    generate_CPT("take_actions", "Take Action", [
        "menu_icon"          => "dashicons-format-aside",
        "supports"           => array("title", "excerpt", "editor", "revisions"),
        "has_archive"        => false,
        "publicly_queryable" => false,
    ], false);

    $labels = label_args("Action Name", false);
    $args = array(
        "rewrite"   => ['slug' => 'action-category', 'with_front' => true],
        "hierarchical" => true,
        "labels" => $labels,
        "show_ui" => true,
        "show_admin_column" => true,
        "query_var" => true,
    );

    register_taxonomy("action_name", array("take_actions"), $args);

    generate_CPT("staff", "Staff", [
        'menu_icon'          => 'dashicons-networking',
        'supports'           => array( 'title','revisions'),
        "publicly_queryable" => false,
        "has_archive"        => false,
        'exclude_from_search'=> true,
    ],false);

    $labels = label_args("Staff Category", false);
    $args = array(
        "rewrite"           => ['slug' => 'staff-category', 'with_front' => true],
        "hierarchical"      => true,
        "labels"            => $labels,
        "show_ui"           => true,
        "show_admin_column" => true,
        "query_var"         => true,
    );
    register_taxonomy("staff_category", array("staff"), $args);

    generate_CPT("media_mentions", "Media Mentions", [
        "menu_icon"          => "dashicons-format-aside",
        "supports"           => array("title", "excerpt", "revisions"),
        "has_archive"        => false,
        "publicly_queryable" => false,
    ], false);

    $labels = label_args("Media Source", false);
    $args = array(
        "rewrite"   => ['slug' => 'source', 'with_front' => true],
        "hierarchical" => true,
        "labels" => $labels,
        "show_ui" => true,
        "show_admin_column" => true,
        "query_var" => true,
    );

    register_taxonomy("media_source", array("media_mentions"), $args);

    $labels = label_args("Topic", false);
    $args = array(
        "rewrite"   => ['slug' => 'topic', 'with_front' => true],
        "hierarchical" => true,
        "labels" => $labels,
        "show_ui" => true,
        "show_admin_column" => true,
        "query_var" => true,
    );

    register_taxonomy("topic", array("media_mentions"), $args);

    $labels = label_args("Language", false);
    $args = array(
        "hierarchical" => true,
        "labels" => $labels,
        "show_ui" => true,
        "show_admin_column" => true,
        "query_var" => true,
    );

    register_taxonomy("post_lang", array("post"), $args);
}

add_action('init', 'custom_post_init', 0);