<?php
//for while
$length = 4;
$all_count_post = $the_query->found_posts;
$posts_capacity = $length;
$slider_items = 1;
$excerpt_length = (empty($atts['alith_block_post_desc_length_size']) ? '90' : $atts['alith_block_post_desc_length_size']);
if ($atts['alith_block_post_slider_checker'] == 'true') {
    $slider_items = $atts['alith_block_post_slider_items'];
    $posts_capacity = $slider_items * $length;
}
//TODO::HEADRE FUNCTION
$output .= alith_layout_header($atts);

for ($i = 0; $i < $slider_items; $i++) {

    //TODO::START SLIDER ACTIVE
    if ($atts['alith_block_post_slider_checker'] == 'true' && $all_count_post >= $posts_capacity) {
        $output .= '<div class="swiper-slide">';
    }//TODO:: START SLIDER ACTIVE

    $output .= '<div class="alith-layout alith-grid-layout-11 alith-block-'.esc_attr($rand) .esc_attr((empty($atts['alith_block_post_custom_class']) ? '' : $atts['alith_block_post_custom_class'])).'">
                <div class="alith-epk-row alith-grid">';
    if ($the_query->have_posts()  && $all_count_post >= $posts_capacity) {
        $post_count = 1;
        while ($the_query->have_posts() && $post_count <= $length) {
            $the_query->the_post();
            $image_src = get_the_post_thumbnail_url(get_the_ID(), $atts['alith_block_post_image_size']);

            switch ($post_count) {
                case 1:
                    $output .='<div class="alith-width-1-3">';
                    $output .=      alith_grid_big_post_render($atts, 'item-space-right', $image_src);
                    $output .='</div>';
                    $output .='<div class="alith-width-2-3">';
                    break;
                case 2:
                    $output .=      '<div class="alith-width-1">';
                    $output .=          alith_grid_small_post_render($atts, 'item-space-bottom-2', $image_src);
                    $output .=      '</div>';              
                    break;
                case 3:
                    $output .=      '<div class="alith-width-1-2">';                   
                    $output .=          alith_grid_small_post_render($atts, 'item-space-right-2 item-space-top-2', $image_src);
                    $output .=      '</div>';
                    break;
                case 4:
                    $output .=      '<div class="alith-width-1-2">';                   
                    $output .=          alith_grid_small_post_render($atts, 'item-space-left-2 item-space-top-2', $image_src);
                    $output .=      '</div>';
                    $output .='</div>';
                    break;
                default:
                    $output .='';
                    break;
            }                       
            $post_count++;             
        }            
    } else {
        $output .= '<div class="more-than-post-error"><span>'. esc_html__('the query posts number is less than the layout posts capacity','alith_epk') .'</span></div>';
        break;
    }
    $output .= '</div>
        </div> ';

    if ($atts['alith_block_post_slider_checker'] == 'true' && $all_count_post >= $posts_capacity) {
        $output .= '</div>';//end swiper-slide
    }

}//END FOR

//TODO::FOOTER FUNCTION
$output .= alith_layout_footer($atts, $all_count_post, $posts_capacity);
$output .= '</div>';