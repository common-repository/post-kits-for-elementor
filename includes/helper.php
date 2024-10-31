<?php
/*display reading time*/
if ( !function_exists('alith_epk_counting_reading_time') ) {
  function alith_epk_counting_reading_time() {
      $content = get_the_content();
      $word_count = str_word_count( strip_tags( $content ) );
      $readingtime = ceil($word_count / 200);

      if ($readingtime == 1) {
        $timer = esc_html__( ' min read', 'alith_epk' );
      } else {
         $timer = esc_html__( ' mins read', 'alith_epk' );
      }
      $totalreadingtime = $readingtime . $timer;

      return $totalreadingtime;
  }
}
/* Function which displays your post date in time ago format */
if (!function_exists('alith_time_ago')) {
    function alith_time_ago()
    {
        return human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ' . __('ago');
    }
}

//Get Post View Number
if (!function_exists('alith_pb_getPostViews')) {
    function alith_pb_getPostViews($atts,$postID)
    {
        $count_key = empty($atts["alith_block_post_view_meta_key"]) ? 'pl_view_post' : $atts["alith_block_post_view_meta_key"] ;
        $count = get_post_meta($postID, $count_key, true);
        if ($count == '') {
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0";
        }
        return $count;
    }
}

//Overlay effect
if (!function_exists('alith_pb_overlay_effect')) {
    function alith_pb_overlay_effect($atts)
    {
        $overlay_effect = '';
        if ($atts['alith_block_post_overlay_effect'] == 'gradient') {
            $overlay_effect = 'alith-bg-dark-' . esc_attr($atts['alith_block_post_overlay_effect']);
        } else {
            $overlay_effect = 'alith-anim-bgdark-' . esc_attr($atts['alith_block_post_overlay_effect']);
        }
        return $overlay_effect;
    }
}

//title link effect
if (!function_exists('alith_bp_title_link_effect')) {
    function alith_bp_title_link_effect($atts)
    {
        $title_effect = '';
        if ($atts['alith_block_post_title_link_effect'] != 'normal') {
            $title_effect = 'class="link-' . esc_attr($atts['alith_block_post_title_link_effect']) . '"';
        }
        return $title_effect;
    }
}

//Author Link
if (!function_exists('alith_TheAuthorLink')) {
    function alith_TheAuthorLink($postid)
    {
        $output = '';
        $output = '<a class="alith-color-red" href="' . get_author_posts_url($postid) . '">' . get_the_author_meta('display_name',$postid) . '</a>';
        return $output;
    }
}

//title class link effect
if (!function_exists('alith_pb_class_title_effect')) {
    function alith_pb_class_title_effect($atts)
    {
        $class_title_effect = '';
        if ($atts['alith_block_post_title_link_effect'] == 'go-top') {
            $class_title_effect = 'alith-main-contents-' . esc_attr($atts['alith_block_post_title_link_effect']);
        }
        return $class_title_effect;
    }
}

//image effect
if (!function_exists('alith_pb_image_effect')) {
    function alith_pb_image_effect($atts)
    {
        $image_effect = '';
        if ($atts['alith_block_post_image_effect'] != 'none') {
            $image_effect = 'alith-anim-scale-' . esc_attr($atts['alith_block_post_image_effect']);
        }
        return $image_effect;
    }
}

//Time Icon
if (!function_exists('alith_bp_time_icon')) {
    function alith_bp_time_icon($atts)
    {
        if ($atts['alith_block_post_time_icon_select_type'] == 'icon') {
            $time_icon = '<i class="ti-' . esc_attr($atts['alith_block_post_icon_select']) . '"></i> ';
        } elseif (($atts['alith_block_post_time_icon_select_type'] == 'dot')) {
            $time_icon = '<i class="dot-divider"></i> ';
        } else {
            $time_icon = '';
        }
        return $time_icon;
    }
}

//View Icon
if (!function_exists('alith_view_icon')) {
    function alith_view_icon($atts)
    {
        if ($atts['alith_block_post_view_icon_select_type'] == 'icon') {
            $view_icon = '<i class="ti-' . esc_attr($atts['alith_block_post_icon_view_select']) . '"></i> ';
        } elseif (($atts['alith_block_post_view_icon_select_type'] == 'dot')) {
            $view_icon = '<i class="dot-divider"></i> ';
        } else {
            $view_icon = '';
        }
        return $view_icon;
    }
}

//Comment Icon
if (!function_exists('alith_comment_icon')) {
    function alith_comment_icon($atts)
    {
        if ($atts['alith_block_post_comment_icon_select_type'] == 'icon') {
            $comment_icon = '<i class="ti-' . esc_attr($atts['alith_block_post_icon_comment_select']) . '"></i> ';
        } elseif (($atts['alith_block_post_comment_icon_select_type'] == 'dot')) {
            $comment_icon = '<i class="dot-divider"></i> ';
        } else {
            $comment_icon = '';
        }
        return $comment_icon;
    }
}

//Author Icon
if (!function_exists('alith_author_icon')) {
    function alith_author_icon($atts,$avtar_id)
    {
        if ($atts['alith_block_post_author_icon_type'] == 'avatar') {
            $author_icon = get_avatar( get_the_author_meta('user_email'), '30');
        } elseif (($atts['alith_block_post_author_icon_type'] == 'icon')) {
            $author_icon = '<i class="ti-' . esc_attr($atts['alith_block_post_icon_author_select']). '"></i> ';
        } else {
            $author_icon = '';
        }
        return $author_icon;
    }
}

//HEADER OUTPUT
if (!function_exists('alith_layout_header')) {
    function alith_layout_header($atts)
    {
        global $rand;
        $swiper_pagination = '';
        if ($atts['alith_block_post_pagination_show'] == 'true'){
            $swiper_pagination = 'swipper-active-paging';
        }
        $output = '';
        if ($atts['alith_block_post_slider_checker'] == 'true') {
            $output .= '  <div class="swiper-container '.esc_attr($swiper_pagination).' swiper-container-'.esc_attr($rand).'">
                          <div class="swiper-wrapper">';
        }
        return $output;
    }
}

//FOOTER OUTPUT
if (!function_exists('alith_layout_footer')) {
    function alith_layout_footer($atts, $all_count_post, $posts_capacity)
    {
        $output = '';
        if ($atts['alith_block_post_slider_checker'] == 'true' && $all_count_post >= $posts_capacity) {
            $output .= '</div><div class="swiper-pagination alith-pagination-circle"></div>';
            if ($atts['alith_block_post_navigation_show'] == 'true') {
                $output .= '<div class="alith-swipper-navigation">                                
                                <div class="alith-swiper-button-prev alith-nav-icon"><i class="ti-'. esc_attr($atts['alith_block_post_icon_navigation_select']).'"></i></div>
                                <div class="alith-swiper-button-next alith-nav-icon"><i class="ti-'. esc_attr($atts['alith_block_post_icon_navigation_select']).'"></i></div>
                            </div>';
            }
        }
        return $output;
    }
}

//Extra class for second title size
$extra_class = 'alith-second-font-size';


//set category name color and background
if (!function_exists('alith_category_color')) {
    function alith_category_color($get_the_ID, $atts)
    {
        $terms = get_the_terms($get_the_ID, 'category');
        $cats = '';
        if ($terms) {
            $cornered_category = '';
            if ($atts['alith_block_post_cat_layout'] == 'cornered') {
                $cornered_category = 'class="alith-tag-arrow alith-bg-red"';
            }
            if ($atts['alith_block_post_cat_layout'] == 'rounded') {
                $cornered_category = 'class="alith-tag-rounded"';
            }
            foreach ($terms as $term) {
                $color = '';
                $bgcolor = '';
                if ($atts['alith_block_post_category_bg_checker'] != 'true'){
                    $color = get_term_meta($term->term_id, '_category_color', true);
                    $bgcolor = get_term_meta($term->term_id, '_bg_category_color', true);
                }
                $important = ($atts['alith_block_post_category_bg_checker'] == 'true') ? '' : ' !important';
	            $cats .= '<a ' ;
	            $cats .= $cornered_category ;
	            $cats .= ' style="color:#' . esc_attr($color) . '' . esc_attr($important) . '; background-color:#'.esc_attr($bgcolor).'' . esc_attr($important) . '" href="' . esc_url(get_term_link($term->slug, 'category')) . '">' . esc_html($term->name) . '</a>';
            }
        }
        return $cats;
    }
}

if (!function_exists('alith_get_first_category_color')) {
    function alith_get_first_category_color($get_the_ID, $atts) {

    }
}

//Custom excerpt with length
if (!function_exists('alith_epk_custom_excerpt')) {
    function alith_epk_custom_excerpt($limit = 100)
    {
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($excerpt) >= $limit) {
            array_pop($excerpt);
            $excerpt = implode(" ", $excerpt) . '...';
        } else {
            $excerpt = implode(" ", $excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
        return $excerpt;
    }
}

/*single post share icons*/
if ( !function_exists( 'alith_epk_share_icons' ) ) {
    function alith_epk_share_icons($atts) {
        $str = '';
        if ($atts['alith_block_post_post_share_show']) {
            $str .= '<ul class="epk-social-share">';
            $str .='
              <li><a href="javascript:void(0);"><i class="ti-sharethis"></i></a></li>      
              <li><a class="fb" href="https://www.facebook.com/sharer.php?u='.urlencode(get_permalink()).'%2F&t=" title="Share on Facebook" target="_blank"><i class="ti-facebook"></i></a></li>
              <li><a class="tw" href="https://twitter.com/intent/tweet?source='.urlencode(get_permalink()).'%2F&text='.urlencode(get_permalink()).'%2F" target="_blank" title="Tweet"><i class="ti-twitter"></i></a></li>
              <li><a class="pt" href="http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink()).'%2F&description=" target="_blank" title="Pin it"><i class="ti-pinterest"></i></a></li>
            ';
            $str .= '</ul>';
        }
        return $str;
    }
}

/*single post share icons*/
if ( !function_exists( 'alith_epk_post_format_icons' ) ) {
    function alith_epk_post_format_icons($atts) {
        $postFormat = get_post_format();
        $str = '';
        if ($atts['alith_block_post_post_format_show']) {
            $str .= '<div class="alith-epk-format-icon">';
            switch ( $postFormat ) {
                case 'audio':       $str  .= '<div class="format-icon"><i class="ti-music"></i></div>'; break;
                case 'gallery':     $str  .= '<div class="format-icon"><i class="ti-gallery"></i></div>';break;
                case 'image':       $str  .= '<div class="format-icon"><i class="ti-image"></i></div>';break;
                case 'video':       $str  .= '<div class="format-icon"><i class="ti-video-clapper"></i></div>';break;
                case 'quote':       $str  .= '<div class="format-icon"><i class="ti-quote-right"></i></div>';break;
                default:            $str  .= '';break;
            }
            $str .= '</div>';
        }
        return $str;
    }
}

//META OUTPUT
if (!function_exists('alith_meta_output')) {
    function alith_meta_output($atts, $author=true, $date=true, $time=true, $comment=true)
    {
        $meta_output = '<div class="alith-epk-meta">';
        if ($author) {
            if ($atts['alith_block_post_post_meta_author_show']) {
                $meta_output .= '<span class="alith-author alith-text-muted">' . alith_author_icon($atts,get_the_ID()) .alith_TheAuthorLink(get_the_author_meta('ID')).'</span>';
            }
        }
        
        if ($date) {
            if ($atts['alith_block_post_post_meta_date_time_show']) {
                $meta_output .= '<span class="alith-date alith-text-muted">'.alith_bp_time_icon($atts).'';
                    if ($atts['alith_block_post_data_format'] == 'WP_default') {
                        $meta_output .= get_the_date();
                    } elseif ($atts['alith_block_post_data_format'] == 'relative') {
                        $meta_output .= alith_time_ago();
                    } else {
                        $meta_output .= get_the_date('' . (!empty($atts['alith_block_post_custom_data']) ? $atts['alith_block_post_custom_data'] : 'Y-m-d') . '');
                    }
                $meta_output .= '</span>';
            }
        }

        if ($time) {
            if ($atts['alith_block_post_post_meta_reading_time_show']) {
                $meta_output .= '<span class="alith-time-reading">' . alith_view_icon($atts,get_the_ID()) . alith_epk_counting_reading_time().'</span>';
            }
        }
        
        if ($comment) {
            if ($atts['alith_block_post_post_meta_comment_show']) {
                $meta_output .= '<span class="alith-meta-comment">' . alith_comment_icon($atts,get_the_ID()) . get_comments_number() . esc_html__(' comments','alith_epk') . '</span>';
            }
        }

        $meta_output .= '</div>';

        return $meta_output;
    }
}

if (!function_exists('alith_grid_big_post_render')) {
    function alith_grid_big_post_render($atts, $div_class='', $image_src='') {
        $str = '';
        $str .= '<article class="mb-sm-15 mb-md-0 alith_epk_grid_post">
                    <div class="alith_epk_grid_post_grid_cover position-relative alith-grid-custom-height custom-rounded '.$div_class.'">
                        <div class="alith_epk_grid_post_grid_background position-relative" style="background-image: url('.$image_src.')"></div> 
                        '. alith_epk_share_icons($atts) . alith_epk_post_format_icons($atts) .'
                        <div class="alith_epk_grid_caption">
                            <div class="alith-tags mb-15">' . alith_category_color(get_the_ID(),$atts) . '</div>
                            <h3 class="alith_epk_title">
                                <a ' . alith_bp_title_link_effect($atts) . ' href="'.esc_url(get_permalink()).'">'.esc_html(get_the_title()).'</a>
                            </h3>'
                            .alith_meta_output($atts).
                        '</div>
                    </div>
                </article>';
        return $str;
    }
}

if (!function_exists('alith_grid_small_post_render')) {
    function alith_grid_small_post_render($atts, $div_class='', $image_src='') {
        $str = '';
        $str .= '<article class="mb-sm-15 mb-md-0 alith_epk_grid_post">
                    <div class="alith_epk_grid_post_grid_cover position-relative alith-grid-custom-height-2 custom-rounded '.$div_class.'">
                        <div class="alith_epk_grid_post_grid_background position-relative" style="background-image: url('.$image_src.')"></div> 
                        '. alith_epk_share_icons($atts) .'
                        <div class="alith_epk_grid_caption">
                            <h4 class="alith_epk_title alith-second-font-size">
                                <a ' . alith_bp_title_link_effect($atts) . ' href="'.esc_url(get_permalink()).'">'.esc_html(get_the_title()).'</a>
                            </h4>'
                            .alith_meta_output($atts, false, true, false, false).                                            
                        '</div>
                    </div>
                </article>';
        return $str;
    }
}


//Transition
if (!function_exists('alith_elementor_transition_options')) {
    function alith_elementor_transition_options() {
        $transition_options = [
            ''                    => esc_html__('None', 'alith_epk'),
            'fade'                => esc_html__('Fade', 'alith_epk'),
            'scale-up'            => esc_html__('Scale Up', 'alith_epk'),
            'scale-down'          => esc_html__('Scale Down', 'alith_epk'),
            'slide-top'           => esc_html__('Slide Top', 'alith_epk'),
            'slide-bottom'        => esc_html__('Slide Bottom', 'alith_epk'),
            'slide-left'          => esc_html__('Slide Left', 'alith_epk'),
            'slide-right'         => esc_html__('Slide Right', 'alith_epk'),
            'slide-top-small'     => esc_html__('Slide Top Small', 'alith_epk'),
            'slide-bottom-small'  => esc_html__('Slide Bottom Small', 'alith_epk'),
            'slide-left-small'    => esc_html__('Slide Left Small', 'alith_epk'),
            'slide-right-small'   => esc_html__('Slide Right Small', 'alith_epk'),
            'slide-top-medium'    => esc_html__('Slide Top Medium', 'alith_epk'),
            'slide-bottom-medium' => esc_html__('Slide Bottom Medium', 'alith_epk'),
            'slide-left-medium'   => esc_html__('Slide Left Medium', 'alith_epk'),
            'slide-right-medium'  => esc_html__('Slide Right Medium', 'alith_epk'),
        ];

        return $transition_options;
    }
}

// heading Tag
if (!function_exists('alith_elementor_title_tags')) {
    function alith_elementor_title_tags() {
        $title_tags = [
            'h1' => esc_html__( 'H1', 'alith_epk' ),
            'h2' => esc_html__( 'H2', 'alith_epk' ),
            'h3' => esc_html__( 'H3', 'alith_epk' ),
            'h4' => esc_html__( 'H4', 'alith_epk' ),
            'h5' => esc_html__( 'H5', 'alith_epk' ),
            'h6' => esc_html__( 'H6', 'alith_epk' ),
            'div'  => esc_html__( 'div', 'alith_epk' ),
            'span' => esc_html__( 'span', 'alith_epk' ),
            'p'    => esc_html__( 'p', 'alith_epk' ),
        ];

        return $title_tags;
    }
}