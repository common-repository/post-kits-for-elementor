<?php
$item_space_value       = $atts['alith_block_post_margin']['size'];
$item_space_value_2     = $atts['alith_block_post_margin']['size'] / 2;
$item_space_unit        = $atts['alith_block_post_margin']['unit'];

$item_height_value      = $atts['alith_block_post_items_height']['size'];
$item_height_value_2    = ( $atts['alith_block_post_items_height']['size'] - $atts['alith_block_post_margin']['size'] ) / 2;
$item_height_unit       = $atts['alith_block_post_items_height']['unit'];



$custom_style.='<style>';

$custom_style .=' .alith-block-'.esc_attr($rand).' .more-than-post-error{display:block;padding:15px 35px;background: #c51b2b;border:2px solid #c40000;text-transform:capitalize;color:#fff;font-weight: 600;}';

if ($atts['alith_block_post_category_bg_checker'] != 'true') {
$custom_style .= '
    .alith-block-' . esc_attr($rand).' .alith-tags .alith-tag-arrow:after{
        border-left-color:#;
    }';
}

$custom_style .=' .alith-block-'.esc_attr($rand).' .alith-margin-right-1, .alith-block-'.esc_attr($rand).' .alith-margin-right-10{
    margin-right: '.(!empty($atts['alith_block_post_margin']['size']) ? $atts['alith_block_post_margin']['size'] : '1').$atts['alith_block_post_margin']['unit'].';
}';

$custom_style .=' .alith-block-'.esc_attr($rand).' .alith-margin-bottom-1, .alith-block-'.esc_attr($rand).' .alith-margin-bottom-10{
    margin-bottom: '.(!empty($atts['alith_block_post_margin']['size']) ? $atts['alith_block_post_margin']['size'] : '1').$atts['alith_block_post_margin']['unit'].';
}';

$custom_style .=' .alith-block-'.esc_attr($rand).' .alith-custom-padding-right{
    padding-right: '.(!empty($atts['alith_block_post_margin']['size']) ? $atts['alith_block_post_margin']['size'] : '1').$atts['alith_block_post_margin']['unit'].';
}';

$custom_style .='.alith-block-'.esc_attr($rand).' .alith-custom-padding-bottom{
    padding-bottom: '.(!empty($atts['alith_block_post_margin']['size']) ? $atts['alith_block_post_margin']['size'] : '1').$atts['alith_block_post_margin']['unit'].';
}';

$custom_style .='.alith-block-'.esc_attr($rand).' .alith-grid-custom-height{
    height: ' . $item_height_value . $item_height_unit . ';
}';

$custom_style .='@media (max-width:480px){
    .alith-block-'.esc_attr($rand).' .alith-grid-custom-height{
        height: ' . $item_height_value_2 . $item_height_unit . ';
    }
}';

$custom_style .='.alith-block-'.esc_attr($rand).' .alith-grid-custom-height-2{
    height: ' . $item_height_value_2 . $item_height_unit . ';
}';

$custom_style .='.alith-block-'.esc_attr($rand).' .item-space-right{
    margin-right: ' . $item_space_value . $item_space_unit . ';
}';

$custom_style .='.alith-block-'.esc_attr($rand).' .item-space-left{
    margin-left: ' . $item_space_value . $item_space_unit . ';
}';

$custom_style .='.alith-block-'.esc_attr($rand).' .item-space-bottom{
    margin-bottom: ' . $item_space_value . $item_space_unit . ';
}';

$custom_style .='.alith-block-'.esc_attr($rand).' .item-space-right-2{
    margin-right: ' . $item_space_value_2 . $item_space_unit . ';
}';

$custom_style .='.alith-block-'.esc_attr($rand).' .item-space-left-2{
    margin-left: ' . $item_space_value_2 . $item_space_unit . ';
}';

$custom_style .='.alith-block-'.esc_attr($rand).' .item-space-bottom-2{
    margin-bottom: ' . $item_space_value_2 . $item_space_unit . ';
}';

$custom_style .='.alith-block-'.esc_attr($rand).' .item-space-top-2{
    margin-top: ' . $item_space_value_2 . $item_space_unit . ';
}';

$custom_style .='.alith-block-'.esc_attr($rand).' .item-space-bottom{
    margin-bottom: ' . $item_space_value . $item_space_unit . ';
}';

$custom_style .='.alith-block-'.esc_attr($rand).' .item-space-top{
    margin-top: ' . $item_space_value . $item_space_unit . ';
}';

$custom_style .='</style>';