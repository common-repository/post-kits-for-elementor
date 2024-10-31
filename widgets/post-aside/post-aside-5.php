<?php
//for while
$length = (empty($atts['alith_block_post_post_show']) ? 5 : $atts['alith_block_post_post_show']);
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

    $output .= '<div class="alith-layout alith-aside-layout-5 alith-block-'.esc_attr($rand) .esc_attr((empty($atts['alith_block_post_custom_class']) ? '' : $atts['alith_block_post_custom_class'])).'">
                <div class="alith-epk-row row">';
    if ($the_query->have_posts()  && $all_count_post >= $posts_capacity) {
        $post_count = 1;
        while ($the_query->have_posts() && $post_count <= $length) {
            $the_query->the_post();
            $image_src = get_the_post_thumbnail_url(get_the_ID(), $atts['alith_block_post_image_size']);

            $output .= '<article class="col-sm-12 item-space-bottom">
                            <div class="alith-epk-row row">                                
                                <div class="col-md-9">                                    
                                    <h5 class="alith_epk_title alith-second-font-size">
                                        <a ' . alith_bp_title_link_effect($atts) . ' href="'.esc_url(get_permalink()).'">'.esc_html(get_the_title()).'</a>
                                    </h5>';
                                    $output .= alith_meta_output($atts);
                                    if ($atts['alith_block_post_read_more_text'] != '') {
                                        $output .= ' <a class="alith-epk-read-more mt-sm-15 d-md-none d-sm-inline-block d-lg-inline-block" href="' . esc_url(get_permalink()) . '">' . esc_html($atts['alith_block_post_read_more_text'],'alith_epk') . '</a>';
                                    }                                    
            $output .=          '</div>
                                <div class="col-md-3 pl-0">
                                    <figure class="alith_epk_thumbs hover-opacity position-relative mb-lg-0 mb-sm-15 zoom custom-rounded">
                                        <a ' . alith_bp_title_link_effect($atts) . ' href="'.esc_url(get_permalink()).'">
                                            <img clas="custom-rounded" src="'.$image_src.'">
                                        </a>                               
                                    </figure>
                                </div>
                            </div>
                            <div class="alith_epk_divider_line_2 item-space-top"></div>
                        </article>'; 
            $post_count++;             
        }
            
    } else {
        $output .= '<div class="more-than-post-error"><span>'. esc_html__('the query posts number is less than the layout posts capacity','alith_epk') .'</span></div>';
        break;
    }
    $output .= '</div>
        </div> ';

    if ($atts['alith_block_post_slider_checker'] == 'true' && $all_count_post >= $posts_capacity) {
        $output .= '<div class="swiper-scrollbar"></div>';//end swiper-slide
        $output .= '</div>';//end swiper-slide
    }

}//END FOR

//TODO::FOOTER FUNCTION
$output .= alith_layout_footer($atts, $all_count_post, $posts_capacity);
$output .= '</div>';