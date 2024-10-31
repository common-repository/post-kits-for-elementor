<?php
//Order By Data Query
$order_by = $atts['alith_block_post_sort_by'];
if ($atts['alith_block_post_sort_by'] == '1 week' ||  $atts['alith_block_post_sort_by'] == '1 month'){
    $data_query = array(
            array(
                    'after' =>  $atts['alith_block_post_sort_by'].' ago',
                 ),
                       );
    $order_by = 'rand';
}else{
    $data_query = '';
}
//Dynamic Post Or Page Type
$post_in = ($atts['alith_block_post_post_type'] == 'post') ? $atts['alith_block_post_include_post_id'] : $atts['alith_block_post_page_include_id'];
$post_not_in = ($atts['alith_block_post_post_type'] == 'post') ? $atts['alith_block_post_exclude_post_id'] : $atts['alith_block_post_page_exclude_id'];
$author = ($atts['alith_block_post_post_type'] == 'post') ? $atts['alith_block_post_author_select'] : $atts['alith_block_page_author_select'];
//Dynamic Query => main query
$args = array(
    'posts_per_page'    =>  (empty($atts['alith_block_post_post_number']) ? '20' : $atts['alith_block_post_post_number']),
    'post_type' => $atts['alith_block_post_post_type'],
    'author__in' => $author,
    'offset' => (empty($atts['alith_block_post_post_offset']) ? '0' : $atts['alith_block_post_post_offset']),
    'post__in' => $post_in,
    'post__not_in' => $post_not_in,
    'orderby' => $order_by,
    'date_query' => $data_query,
    'order' => (empty($atts['alith_block_post_order']) ? '0' : str_replace(',', ' ', $atts['alith_block_post_order'])),
    'category__in' => (empty($atts['alith_block_post_include_category']) ? '0' : $atts['alith_block_post_include_category']),
    'category__not_in' => (empty($atts['alith_block_post_exclude_category']) ? '0' : $atts['alith_block_post_exclude_category']),
    'tag__in' => (empty($atts['alith_block_post_include_tag']) ? '0' : $atts['alith_block_post_include_tag']),
    'tag__not_in' => (empty($atts['alith_block_post_exclude_tag']) ? '0' : $atts['alith_block_post_exclude_tag']),
);
// The Query
$the_query = new WP_Query($args);

echo '<div class="alith-epk-block-container alith-epk-grid-container '.$atts['alith_block_post_widget_header_layout'].'">';
//Widget Title
if ($atts['alith_block_post_widget_title_show_title'] =='yes') {
    echo '<div class="alith_block_heading '.$atts['alith_block_post_widget_header_layout'].'"><h4 class="alith_block_title"><span>';
    if ($atts['alith_block_post_widget_header_icon']['value'] !='') {
        echo '<i class="'.$atts['alith_block_post_widget_header_icon']['value'].'"></i>';
    }
    echo  $atts['alith_block_post_widget_title_text'] . '<strong>' .$atts['alith_block_post_widget_second_title_text']. '</strong></span></h4></div>';
}

//Select Layout
include ALITH_ELEMENTOR_POST_KITS_PATH . 'widgets/post-grid/' . $this->alith_grid_layout . '.php' ;
