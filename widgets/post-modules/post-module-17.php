<?php
//for while
$length = (empty($atts['alith_block_post_post_show']) ? 5 : $atts['alith_block_post_post_show']);
$all_count_post = $the_query->found_posts;
$posts_capacity = $length;
$slider_items = 1;
$excerpt_length = (empty($atts['alith_block_post_desc_length_size']) ? 90 : $atts['alith_block_post_desc_length_size']);
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

    $output .= '<div class="alith-layout alith-module-layout-17 alith-block-'.esc_attr($rand) .esc_attr((empty($atts['alith_block_post_custom_class']) ? '' : $atts['alith_block_post_custom_class'])).'">
                <div class="alith-epk-row">';
    if ($the_query->have_posts()  && $all_count_post >= $posts_capacity) {
        $post_count = 1;
        while ($the_query->have_posts() && $post_count <= $length) {
            $the_query->the_post();
            $image_src = get_the_post_thumbnail_url(get_the_ID(), $atts['alith_block_post_image_size']);
            if ($post_count <= 2) {
                if ($post_count == 1) {
                    $output .= '<div class="row">
                        <div class="col-lg-8 col-md-12 col-sm-12 mb-sm-30 mb-md-0 alith-custom-padding-right">';
                }
                $output .= '<article class="alith-epk-row row alith-custom-padding-right alith-epk-mb-15">
                                <div class="alith-epk-mb-15 col-sm-6">
                                    <div class="custom-rounded">
                                        <figure class="alith_epk_thumbs zoom">
                                            <a ' . alith_bp_title_link_effect($atts) . ' href="'.esc_url(get_permalink()).'">
                                                <img src="'.$image_src.'">
                                            </a> '
                                            . alith_epk_share_icons($atts) . alith_epk_post_format_icons($atts) .
                                            '<div class="alith-tags">' . alith_category_color(get_the_ID(),$atts) . '</div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                <h3 class="alith_epk_title alith-epk-mb-15">
                                    <a ' . alith_bp_title_link_effect($atts) . ' href="'.esc_url(get_permalink()).'">'.esc_html(get_the_title()).'</a>
                                </h3>';

                                $output .= alith_meta_output($atts, true, true, true, false);

                                $output .= '<p class="alith-epk-excerpt mb-lg-15 mt-lg-15 d-none d-lg-block">
                                     '.esc_html(alith_epk_custom_excerpt(esc_attr($excerpt_length))).'
                                </p>';
                                if ($atts['alith_block_post_read_more_text'] != '') {
                                    $output .= ' <a class="alith-epk-read-more mt-15" href="' . esc_url(get_permalink()) . '">' . esc_html($atts['alith_block_post_read_more_text'],'alith_epk') . '</a>';
                                }
                    $output .= '</div>
                            </article>';
                if ($post_count == 2) {
                     $output .= '</div>
                     <div class="col-lg-4 col-md-12 col-sm-12">';
                }                       
            } else {
                $output .= '<article class="alith-epk-row row mb-lg-15 mb-sm-15 alith-custom-padding-bottom">
                                <div class="col-md-4 col-sm-6 mb-sm-15 mb-lg-0">
                                    <figure class="alith_epk_thumbs hover-opacity position-relative mb-lg-0 zoom custom-rounded">
                                        <a href="'.esc_url(get_permalink()).'">
                                            <img clas="custom-rounded" src="'.$image_src.'">
                                        </a>                               
                                    </figure>
                                </div>
                                <div class="col-md-8 col-sm-6 pl-md-0">
                                    <h5 class="alith_epk_title alith_epk_second_title alith-second-font-size">
                                        <a ' . alith_bp_title_link_effect($atts) . ' href="'.esc_url(get_permalink()).'">'.esc_html(get_the_title()).'</a>
                                    </h5>';
                                $output .= alith_meta_output($atts, false, true, true, false);
                $output .='     </div>
                            </article>';              
            }            
            $post_count++;        
        }
    } else {
        $output .= '<div class="more-than-post-error"><span>'. esc_html__('the query posts number is less than the layout posts capacity','alith_epk') .'</span></div>';
        break;
    }
    $output .= '</div> <!-- End .col-sm-6 -->
            </div> <!-- End .row -->
            </div> <!-- End .alith-epk-row -->
        </div> <!-- End .alith-layout -->';

    if ($atts['alith_block_post_slider_checker'] == 'true' && $all_count_post >= $posts_capacity) {
        $output .= '</div>';//end swiper-slide
    }

}//END FOR

//TODO::FOOTER FUNCTION
$output .= alith_layout_footer($atts, $all_count_post, $posts_capacity);
$output .= '</div>';