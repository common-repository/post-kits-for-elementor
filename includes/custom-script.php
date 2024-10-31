<?php
$custom_script .= '<script>';
if ($atts['alith_block_post_slider_checker'] == 'true') {
    $custom_script .= '
    jQuery(document).ready(function(){
    setTimeout(function(){  
     var mySwiper = new Swiper (\'.swiper-container-'.esc_attr($rand).'\', {
                    slidesPerView: 1,
                    loopedSlides: 3,
                    spaceBetween: 10,
                    centeredSlides: false,';
    if ($atts['alith_block_post_autoplay_checker'] == 'true') {
    $custom_script .= '
                    autoplay: {    
                                 delay: ' . (!empty($atts['alith_block_post_autoplay_speed']) ? $atts['alith_block_post_autoplay_speed'] : '3000') . ',
                              },';
    }
    $custom_script .='
                    loop: '.(($atts['alith_block_post_loop_checker'] == 'true') ? $atts['alith_block_post_loop_checker'] : 'false').',
                    autoHeight: true,';
    if ($atts['alith_block_post_pagination_show'] == 'true') {
        $custom_script .= '
        pagination: {
            el:
            \'.swiper-pagination\',
                        clickable: true,
                    },';
    }
    if ($atts['alith_block_post_navigation_show'] == 'true') {
        $custom_script .= '
        navigation: {
                        nextEl: \'.alith-swiper-button-next\',
                        prevEl: \'.alith-swiper-button-prev\',
                    },';
    }
    $custom_script .='

                    breakpoints: {
                        768: {
                          slidesPerView: 1,
                        },
                    },
                });
    }, 500);
  });
    ';
}

$custom_script .= '</script>';