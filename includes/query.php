<?php
//include post id
if (!function_exists('alith_get_posts_include')) {
    function alith_get_posts_include()
    {
        $args = array(
            'posts_per_page' => -1,
            'post_type'     => 'post',
        );
        $get_all_posts = get_posts($args);
        foreach ($get_all_posts as $object){
           $post_id_include[$object->ID] = $object->post_name;
        }
        return $post_id_include;
    }
}

//include & Exclude Page id
if (!function_exists('alith_get_pages_include')) {
    function alith_get_pages_include()
    {
        $args = array(
            'posts_per_page' => -1,
            'post_type'     => 'page',
        );
        $get_all_posts = get_pages($args);
        foreach ($get_all_posts as $object){
           $page_id_include[$object->ID] = $object->post_name;
        }
        return $page_id_include;
    }
}
//include category
if (!function_exists('alith_get_category_include')) {
    function alith_get_category_include(){
        $args = array(
            'taxonomy'     => 'category',
            'orderby'      => 'name',
            'order'        => 'ASC',
            'hide_empty'   => 0,
            'depth'        => 1,
            'hierarchical' => 1,
            'exclude'      => '',
            'include'      => '',
            'child_of'     => 0,
            'number'       => '',
            'pad_counts'   => false
        );

        $inc_categories = get_categories($args);
        foreach ($inc_categories as $categor) {
            $inc_category_array[$categor->term_id] = $categor->cat_name. ' (' . $categor->count . ')';
        }
        return $inc_category_array;
    }
}

//include tags
if (!function_exists('alith_get_tag_include')) {
    function alith_get_tag_include(){
        $args = array(
            'taxonomy'     => 'post_tag',
            'orderby'      => 'name',
            'order'        => 'ASC',
            'hide_empty'   => 0,
            'depth'        => 1,
            'hierarchical' => 1,
            'exclude'      => '',
            'include'      => '',
            'child_of'     => 0,
            'number'       => '',
            'pad_counts'   => false
        );

        $posttags = get_tags($args);
        if ($posttags) {
            foreach($posttags as $tag) {
                $inc_tags_array[$tag->term_id] =  $tag->name. ' (' . $tag->count . ')';
            }
        }

        return $inc_tags_array;

    }
}

//get all post author
if (!function_exists('alith_get_all_author')) {
    function alith_get_all_author()
    {
        $users = get_users(array(
            'orderby' => 'display_name',
            'order' => 'DESC',
            'posts_per_page' => -1,
            'fields' => array('ID', 'user_nicename'),
            'post_type'     => 'post',
        ));

        if ($users) {
            $author_array = array();
            foreach ($users as $user) {
                $author_array[$user->ID] = $user->user_nicename;
            }
            return $author_array;
        }

    }
}

//get all page author
if (!function_exists('alith_get_all_page_author')) {
    function alith_get_all_page_author()
    {
        $users = get_users(array(
            'orderby' => 'display_name',
            'order' => 'DESC',
            'posts_per_page' => -1,
            'fields' => array('ID', 'user_nicename'),
            'post_type'     => 'page',
        ));

        if ($users) {
            $author_array_page = array();
            foreach ($users as $user) {
                $author_array_page[$user->ID] = $user->user_nicename;
            }
            return $author_array_page;
        }

    }
}