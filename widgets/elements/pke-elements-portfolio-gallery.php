<?php
/**
 * @author  AliThemes
 * @since   1.0
 * @version 1.0
 */

namespace PostKitsForElementor\Widgets;

use ElegantAddons\Helper_Functions;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Control_Select;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Utils;

// No direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Pke_Elements_Porfolio_Gallery extends Widget_Base {

    public function get_name() {
        return 'pke-portfolio-gallery';
    }

    public function get_title() {
        return __( 'EPK Porfolio', 'alith_epk');
    }

    public function get_icon() {
        return 'alith_block_elements_porfolio';
    }

    public function get_categories() {
        return [ 'Alith_Elementor_Elements' ];
    }

    public function get_script_depends() {
        return [ 'jquery_filterizr_js', 'alith_filterizr' ];
    }

    public function get_style_depends() {
        return [
            'elementor-post-kits-widget-porfolio'
        ];
    }

    protected function _register_controls() {

        include ALITH_ELEMENTOR_POST_KITS_PATH.'includes/query.php';
        include ALITH_ELEMENTOR_POST_KITS_PATH.'includes/helper.php';

        $this->start_controls_section(
            'alith_section_portfolio',
            [
                'label' => __( 'Layout', 'alith_epk' ),
            ]
        );

        $this->add_control(
            'alith_portfolio_skin',
            [
                'label' => __( 'Layouts', 'alith_epk' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                    'style-1'     => __( 'Stype 1', 'alith_epk' ),
                    'style-2'     => __( 'Style 2', 'alith_epk' ),
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_columns',
            [
                'label' => __( 'Columns', 'alith_epk' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'column3',
                'options' => [
                    'column1' => __( '1', 'alith_epk' ),
                    'column2' => __( '2', 'alith_epk' ),
                    'column3' => __( '3', 'alith_epk' ),
                    'column4' => __( '4', 'alith_epk' ),
                    'column6' => __( '6', 'alith_epk' ),
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_post_per_page',
            [
                'label' => __( 'Post Per Page', 'alith_epk' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'no' ],
                'range' => [
                    'no' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 6,
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_pagination',
            [
                'label'         => __( 'Pagination', 'alith_epk' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'alith_epk' ),
                'label_off'     => __( 'Hide', 'alith_epk' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'label' => __( 'Image Size', 'alith_epk' ),
                'exclude' => [ 'custom' ],
                'default' => 'medium',
            ]
        );

        $this->add_control(
            'alith_portfolio_masonry',
            [
                'label'         => __( 'Masonry', 'alith_epk' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'alith_epk' ),
                'label_off'     => __( 'Hide', 'alith_epk' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'alith_portfolio_item_ratio',
            [
                'label'   => esc_html__( 'Item Height', 'alith_epk' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 250,
                ],
                'range' => [
                    'px' => [
                        'min'  => 50,
                        'max'  => 500,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-filterizr .filtr-item img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'alith_portfolio_section_query',
            [
                'label' => esc_html__( 'Query', 'alith_epk' ),
            ]
        );

        $this->add_control(
            'alith_portfolio_show_filter_bar',
            [
                'label'         => __( 'Category/Tag', 'alith_epk' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'alith_epk' ),
                'label_off'     => __( 'Hide', 'alith_epk' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'alith_portfolio_source',
            [
                'label' => __( 'Source', 'alith_epk' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'post',
                'options' => get_post_types(),
                'condition' => [
                    'alith_portfolio_show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_order_by',
            [
                'label'     => __( 'Order By', 'alith_epk' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'date',
                'options'   => [
                    'date'  => __( 'Date', 'alith_epk' ),
                    'title' => __( 'Title', 'alith_epk' ),
                    'rand'  => __( 'Random', 'alith_epk' ),
                ],
                'condition' => [
                    'alith_portfolio_show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_order',
            [
                'label'     => __( 'Order', 'alith_epk' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'desc',
                'options'   => [
                    'desc'  => __( 'DESC', 'alith_epk' ),
                    'asc'   => __( 'ASC', 'alith_epk' ),
                ],
                'condition' => [
                    'alith_portfolio_show_filter_bar' => 'yes',
                ],
            ]
        );

         $this->add_control(
            'alith_taxonomy',
            [
                'label'     => __( 'Taxonomy', 'alith_epk' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'category',
                'options'   => [
                    'category'  => __( 'Category', 'alith_epk' ),
                    'tags'   => __( 'Tags', 'alith_epk' ),
                ],
                'condition' => [
                    'alith_portfolio_show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_categories',
            [
                'label'         => __( 'Filter By Category', 'alith_epk' ),
                'type'          => Controls_Manager::SELECT2,
                'description'   => __( 'Get posts for specific category(s)', 'alith_epk' ),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => alith_get_category_include(),
                'condition'     => [
                    'alith_taxonomy' => 'category',
                ],
                'condition' => [
                    'alith_portfolio_show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_tags',
            [
                'label'         => __( 'Filter By Tag', 'alith_epk' ),
                'type'          => Controls_Manager::SELECT2,
                'description'   => __( 'Get posts for specific tag(s)', 'alith_epk' ),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => alith_get_tag_include(),
                'condition'     => [
                    'alith_taxonomy' => 'tags',
                ],
                'condition' => [
                    'alith_portfolio_show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'alith_portfolio_advanceed_section',
            [
                'label' => esc_html__( 'Advanced Options', 'alith_epk' ),
            ]
        );

        $this->add_control(
            'alith_portfolio_animation',
            [
                'label'     => esc_html__( 'Overlay Animation', 'alith_epk' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'fade',
                'options'   => alith_elementor_transition_options(),
            ]
        );

        $this->add_control(
            'alith_portfolio_show_title',
            [
                'label'         => __( 'Title', 'alith_epk' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'alith_epk' ),
                'label_off'     => __( 'Hide', 'alith_epk' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->add_control(
            'alith_portfolio_title_html_tag',
            [
                'label'     => esc_html__( 'Title HTML Tag', 'alith_epk' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => alith_elementor_title_tags(),
                'default'   => 'h5',
                'condition' => [
                    'alith_portfolio_show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_excerpt',
            [
                'label'         => __( 'Excerpt', 'alith_epk' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'alith_epk' ),
                'label_off'     => __( 'Hide', 'alith_epk' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'alith_portfolio_excerpt_limit',
            [
                'label'     => esc_html__( 'Excerpt Limit', 'alith_epk' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 10,
                'condition' => [
                    'alith_portfolio_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_show_category',
            [
                'label'         => __( 'Category/Tag', 'alith_epk' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Show', 'alith_epk' ),
                'label_off'     => __( 'Hide', 'alith_epk' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'alith_portfolio_show_link',
            [
                'label'     => __( 'Show Link', 'alith_epk' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'both',
                'options'   => [
                    'post-link'     => __( 'Post link', 'alith_epk' ),
                    'light-box'     => __( 'Light Box', 'alith_epk' ),
                    'both'          => __( 'Both', 'alith_epk' ),
                    'none'          => __( 'None', 'alith_epk' ),
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_link_type',
            [
                'label'   => esc_html__( 'Link Type', 'alith_epk' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => esc_html__('Icon', 'alith_epk'),
                ],
                'condition' => [
                    'alith_portfolio_show_link!' => 'none',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'alith_portfolio_items_section',
            [
                'label' => esc_html__( 'Items', 'alith_epk' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'alith_portfolio_item_gap',
            [
                'label'   => esc_html__( 'Column Gap', 'alith_epk' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .filtr-item'    => 'padding-right: {{SIZE}}{{UNIT}}; padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'alith_portfolio_row_gap',
            [
                'label'   => esc_html__( 'Row Gap', 'alith_epk' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 5,
                    ],
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'alith_epk' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .item-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

                'separator' => 'after',
            ]
        );

        $this->add_control(
            'alith_portfolio_overlay_color',
            [
                'label'     => __( 'Overlay Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .bg-overlay' => 'background-color: {{VALUE}}'
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_overlay_gap',
            [
                'label'   => esc_html__( 'Overlay Gap', 'alith_epk' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .bg-overlay' => 'margin: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_overlay_content_alignment',
            [
                'label'   => __( 'Content Alignment', 'alith_epk' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'alith_epk' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'alith_epk' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'alith_epk' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'      => 'center',
                'selectors'    => [
                    '{{WRAPPER}} .post-gallery-content-inner' => 'text-align: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'overlay_content_position',
            [
                'label'   => __( 'Content Vertical', 'alith_epk' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => __( 'Top', 'alith_epk' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __( 'Middle', 'alith_epk' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'alith_epk' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors_dictionary' => [
                    'top'    => 'flex-start',
                    'middle' => 'center',
                    'bottom' => 'flex-end',
                ],
                'default'   => 'middle',
                'selectors' => [
                    '{{WRAPPER}} .cte-divider' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'alith_portfolio_title_color',
            [
                'label'     => __( 'Title Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
                ],
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .gallery-content-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'alith_portfolio_title_color_typography',
                'label' => __( 'Title Typography', 'alith_epk' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector'  => '{{WRAPPER}} .filtr-item .gallery-content-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'alith_portfolio_section_style_excerpt',
            [
                'label'     => esc_html__( 'Excerpt', 'alith_epk' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'alith_portfolio_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_excerpt_color',
            [
                'label'     => esc_html__( 'Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .post-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'alith_portfolio__excerpt_margin',
            [
                'label'     => esc_html__( 'Margin', 'alith_epk' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .post-excerpt' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'alith_portfolio_excerpt_typography',
                'label'    => esc_html__( 'Typography', 'alith_epk' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .filtr-item .post-excerpt',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'alith_portfolio_section_style_button',
            [
                'label'     => esc_html__( 'Buttons', 'alith_epk' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'alith_portfolio_show_link!' => 'none',
                ],
            ]
        );

        $this->start_controls_tabs( 'alith_portfolio_tabs_button_style' );

        $this->start_controls_tab(
            'alith_portfolio_tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'alith_epk' ),
            ]
        );

        $this->add_control(
            'alith_portfolio_button_text_color',
            [
                'label'     => esc_html__( 'Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .ti-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .circle-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'alith_portfolio_button_box_shadow',
                'selector' => '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .ti-icon ',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'alith_portfolio_border',
                'label'       => esc_html__( 'Border', 'alith_epk' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .circle-icon',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'alith_portfolio_button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'alith_epk' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .circle-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_button_padding',
            [
                'label'      => esc_html__( 'Padding', 'alith_epk' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .circle-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'alith_portfolio_tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'alith_epk' ),
            ]
        );

        $this->add_control(
            'alith_portfolio_hover_color',
            [
                'label'     => esc_html__( 'Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner:hover .post-link .ti-icon'  => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_background_hover_color',
            [
                'label'     => esc_html__( 'Background Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .circle-icon:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_button_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filtr-item .overlay .post-gallery-content .post-gallery-content-inner .post-link .circle-icon:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'alith_portfolio_section_style_pagination',
            [
                'label'     => esc_html__( 'Pagination', 'alith_epk' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'alith_portfolio_pagination' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs( 'alith_portfolio_tabs_pagination_style' );

        $this->start_controls_tab(
            'alith_portfolio_tab_pagination_normal',
            [
                'label' => esc_html__( 'Normal', 'alith_epk' ),
            ]
        );

        $this->add_control(
            'alith_portfolio_pagination_color',
            [
                'label'     => esc_html__( 'Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .alith-pagination .page-numbers, {{WRAPPER}} .alith-pagination .page-numbers a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'alith_portfolio_pagination_background',
                'selector'  => '{{WRAPPER}} .alith-pagination .page-numbers',
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'alith_portfolio_pagination_border',
                'label'    => esc_html__( 'Border', 'alith_epk' ),
                'selector' => '{{WRAPPER}} .alith-pagination .page-numbers',
            ]
        );

        $this->add_responsive_control(
            'alith_portfolio_pagination_offset',
            [
                'label'     => esc_html__( 'Offset', 'alith_epk' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .alith-pagination' => 'margin-top: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'alith_portfolio_pagination_space',
            [
                'label'     => esc_html__( 'Spacing', 'alith_epk' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .alith-pagination .page-numbers'     => 'margin-left: {{SIZE}}px;',
                    '{{WRAPPER}} .alith-pagination .page-numbers> *' => 'padding-left: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'alith_portfolio_pagination_padding',
            [
                'label'     => esc_html__( 'Padding', 'alith_epk' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .alith-pagination .page-numbers' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'alith_portfolio_pagination_radius',
            [
                'label'     => esc_html__( 'Radius', 'alith_epk' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .alith-pagination .page-numbers' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'alith_portfolio_pagination_arrow_size',
            [
                'label'     => esc_html__( 'Arrow Size', 'alith_epk' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .alith-pagination .page-numbers .ti-icon' => 'font-size: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'alith_portfolio_pagination_typography',
                'label'    => esc_html__( 'Typography', 'alith_epk' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .alith-pagination a, {{WRAPPER}} .pagination span',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'alith_portfolio_tab_pagination_hover',
            [
                'label' => esc_html__( 'Hover', 'alith_epk' ),
            ]
        );

        $this->add_control(
            'alith_portfolio_pagination_hover_color',
            [
                'label'     => esc_html__( 'Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .alith-pagination a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_pagination_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .alith-pagination .page-numbers:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'alith_portfolio_pagination_hover_background',
                'selector' => '{{WRAPPER}} .alith-pagination .page-numbers:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'alith_portfolio_tab_pagination_active',
            [
                'label' => esc_html__( 'Active', 'alith_epk' ),
            ]
        );

        $this->add_control(
            'alith_portfolio_pagination_active_color',
            [
                'label'     => esc_html__( 'Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .alith-pagination .current' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_pagination_active_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .alith-pagination .current' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'alith_portfolio_pagination_active_background',
                'selector' => '{{WRAPPER}} .alith-pagination .current',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'alith_portfolio_section_design_filter',
            [
                'label'     => esc_html__( 'Filter Bar', 'alith_epk' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'alith_portfolio_show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_filter_alignment',
            [
                'label'   => esc_html__( 'Alignment', 'alith_epk' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'alith_epk' ),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'alith_epk' ),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'alith_epk' ),
                        'icon'  => 'fas fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .filter-controls' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'alith_portfolio_typography_filter',
                'label'    => esc_html__( 'Typography', 'alith_epk' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .filter-controls .controls span',
            ]
        );

        $this->add_control(
            'alith_portfolio_filter_spacing',
            [
                'label'     => esc_html__( 'Bottom Space', 'alith_epk' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .filter-controls .controls' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->start_controls_tabs( 'alith_portfolio_tabs_style_desktop' );

        $this->start_controls_tab(
            'alith_portfolio_filter_tab_desktop',
            [
                'label' => __( 'Desktop', 'alith_epk' )
            ]
        );

        $this->add_control(
            'alith_portfolio_desktop_filter_normal',
            [
                'label' => esc_html__( 'Normal', 'alith_epk' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'alith_portfolio_color_filter',
            [
                'label'     => esc_html__( 'Text Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .filter-controls .portfolio-controls-button span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_desktop_filter_background',
            [
                'label'     => esc_html__( 'Background', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filter-controls .portfolio-controls-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'alith_portfolio_desktop_filter_padding',
            [
                'label'      => __('Padding', 'alith_epk'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .filter-controls .portfolio-controls-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'alith_portfolio_desktop_filter_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .filter-controls .portfolio-controls-button'
            ]
        );

        $this->add_control(
            'alith_portfolio_desktop_filter_radius',
            [
                'label'      => __('Radius', 'alith_epk'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .filter-controls .portfolio-controls-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'alith_portfolio_desktop_filter_shadow',
                'selector' => '{{WRAPPER}} .filter-controls .portfolio-controls-button'
            ]
        );

        $this->add_control(
            'alith_portfolio_filter_item_spacing',
            [
                'label'     => esc_html__( 'Space Between', 'alith_epk' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .filter-controls .portfolio-controls-button .filter'  => 'padding-right: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_desktop_filter_active',
            [
                'label' => esc_html__( 'Active', 'alith_epk' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'alith_portfolio_color_filter_active',
            [
                'label'     => esc_html__( 'Text Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .filter-controls .portfolio-controls-button .active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'alith_portfolio_section_style_category',
            [
                'label'      => esc_html__( 'Category', 'alith_epk' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'alith_portfolio_show_category' => 'yes',
                ],

            ]
        );

        $this->add_control(
            'alith_portfolio_category_color',
            [
                'label'     => esc_html__( 'Category Color', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-category' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'alith_portfolio_category_background',
            [
                'label'     => esc_html__( 'Background', 'alith_epk' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-category' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'alith_portfolio_category_typography',
                'label'    => esc_html__( 'Typography', 'alith_epk' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .portfolio-category',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render() {

        $settings   = $this->get_settings_for_display();

        $layout     =esc_html($settings['alith_portfolio_skin']);
        $pagination = esc_html( $settings[ 'alith_portfolio_pagination' ] );

        $post_type  = esc_html( $settings[ 'alith_portfolio_source' ] );
        $post_per   = esc_html( $settings[ 'alith_portfolio_post_per_page' ][ 'size' ] );
        $order_by   = esc_html( $settings[ 'alith_portfolio_order_by' ] );
        $order      = esc_html( $settings[ 'alith_portfolio_order' ] );
        $cat        = ( !empty( $settings['alith_portfolio_categories'] ) ) ? esc_html( implode( ',', $settings['alith_portfolio_categories'] ) ) : '';
        $tag        = ( !empty( $settings['alith_portfolio_tags'] ) ) ? esc_html( implode( ',', $settings['alith_portfolio_tags'] ) ) : '';

        $paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $query_args = array(
            'post_type'         =>  $post_type,
            'posts_per_page'    =>  $post_per,
            'orderby'           =>  $order_by,
            'order'             =>  $order,
            'cat'               =>  $cat,
            'tag_id'            =>  $tag,
            'paged'             =>  $paged
        );

        $portfolio_gallery  = new \WP_Query( $query_args );
       
        if ( $settings[ 'alith_portfolio_show_filter_bar' ] == 'yes' ) {
    ?>
        <div class="filter-controls inner-section">
            <div class="controls portfolio-controls-button">
                <span class="button-title filter active" data-filter="all"><?php _e( 'All', 'alith_epk' ); ?></span>
                    <?php if ( $settings[ 'alith_taxonomy' ] == 'category' ) { 
                        if( is_array( $settings[ 'alith_portfolio_categories' ] ) ) {
                            foreach ( $settings[ 'alith_portfolio_categories' ] as $value) { ?>
                            <span class="button-title filter" data-filter="<?php echo esc_attr( get_the_category_by_ID( $value ) ); ?>"><?php echo esc_html( get_the_category_by_ID( $value ) ); ?></span>
                    <?php
                            } //foreach
                        }
                    } elseif ( $settings[ 'alith_taxonomy' ] == 'tags' ) {
                        if( is_array( $settings[ 'alith_portfolio_tags' ] ) ) {
                            foreach ( $settings[ 'alith_portfolio_tags' ] as $value) { ?>
                                <?php $alith_tag_loop = get_tag( $value ); ?>
                                <span class="button-title filter" data-filter="<?php echo esc_attr( $alith_tag_loop->name ); ?>"><?php echo esc_html( $alith_tag_loop->name ); ?></span>
                    <?php
                            } //foreach
                        }
                    } ?>
            </div><!-- /.controls -->
        </div><!-- /.filtr-controls -->
        <?php } //endif alith_portfolio_show_filter_bar ?>

        <?php if ( $portfolio_gallery->have_posts() ) : ?>
            <?php $masonry = ( esc_attr( $settings[ 'alith_portfolio_masonry' ] ) ) ? 'sameWidth' : 'packed' ; ?>               
                <div class="filter-container alith-filterizr" data-layout='<?php echo esc_attr($masonry); ?>'>
                    <div class="row">
                    <?php                       
                        switch ( $settings[ 'alith_portfolio_columns' ] ) {
                            case 'column1':
                                $grid = 'col-md-12';
                                break;

                            case 'column2':
                                $grid = 'col-md-6';
                                break;

                            case 'column3':
                                $grid = 'col-md-4';
                                break;

                            case 'column4':
                                $grid = 'col-md-3';
                                break;

                            case 'column6':
                                $grid = 'col-md-2';
                                break;

                            default:
                                $grid = 'col-md-4';
                                break;
                        }

                        while ( $portfolio_gallery->have_posts() ) : $portfolio_gallery->the_post();
                            $settings['thumbnail_size'] = [
                                'id' => get_post_thumbnail_id(),
                            ];

                            $placeholder_image = Utils::get_placeholder_image_src();
                            $thumbnail_html    = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_size' );

                            if ( ! $thumbnail_html ) {
                                $thumbnail_html = '<img src="' . esc_url( $placeholder_image ) . '" alt="' . get_the_title() . '">';
                            }

                            if( has_post_thumbnail() ) {
                                $placeholder_image = esc_url( get_the_post_thumbnail_url() );
                            }

                            // Get all the categories
                            $alith_categories = [];
                            if ( get_the_category() ) {
                                foreach( get_the_category() as $category ) {
                                    $alith_categories[] = $category->cat_name;
                                }

                                $alith_categories = implode( ', ', $alith_categories );
                            }

                            // Get all the Tags
                            $alith_posttags = [];
                            if ( get_the_tags() ) {
                                foreach( get_the_tags() as $alith_tag ) {
                                    $alith_posttags[] = $alith_tag->name . ', ';
                                }

                                $alith_posttags = implode( ', ' , $alith_posttags );
                            }

                            if ( $settings[ 'alith_taxonomy' ] == 'category' ) {
                                $alith_taxonomy_filter =   ( !is_array( $alith_categories ) ) ? $alith_categories : '';
                            } elseif ( $settings[ 'alith_taxonomy' ] == 'tags' ) {
                                $alith_taxonomy_filter =   ( !is_array( $alith_posttags ) ) ? $alith_posttags : '';
                            }

                            switch ( $settings[ 'alith_portfolio_show_link' ] ) {
                                case 'post-link':
                                    $alith_portfolio_links = "<a href='" . esc_url( get_the_permalink() ) . "'><i class='ti-icon ti-link circle-icon' aria-hidden='true'></i></a>";
                                    break;

                                case 'light-box':
                                    $alith_portfolio_links = "<a href='$placeholder_image' data-lightbox='port-lightbox'><i class='ti-icon ti-zoom-in circle-icon' aria-hidden='true'></i></a>";
                                    break;

                                case 'both':
                                    $alith_portfolio_links = "<a href='" . esc_url( get_the_permalink() ) . "' class='post-link'><i class='ti-icon ti-link circle-icon' aria-hidden='true'></i></a><a href='$placeholder_image' class='post-link' data-lightbox='port-lightbox'><i class='ti-icon ti-zoom-in circle-icon' aria-hidden='true'></i></a>";
                                    break;

                                case 'none':
                                    $alith_portfolio_links = '';
                                    break;

                                default:
                                    $alith_portfolio_links = "<a href='" . esc_url( get_the_permalink() ) . "' class='post-link'><i class='ti-icon ti-link circle-icon' aria-hidden='true'></i></a><a href='$placeholder_image' class='post-link' data-lightbox='port-lightbox'><i class='ti-icon ti-zoom-in circle-icon' aria-hidden='true'></i></a>";
                                    break;
                            }
                    ?>
                   
                    <div class="filtr-item <?php echo esc_attr($grid); ?> col-sm-12" data-category="<?php echo esc_attr( $alith_taxonomy_filter ); ?>">
                        <?php if ($layout == 'style-1') : ?>
                        <div class="item-container post-gallery-inner" style="margin-top: <?php echo esc_attr( $settings['alith_portfolio_row_gap']['size'] ); ?>px; margin-bottom: <?php echo esc_attr( $settings['alith_portfolio_row_gap']['size'] ); ?>px;">
                            <div class="gallery-thumbnail">
                                <?php echo $thumbnail_html; ?>
                            </div>
                            <div class="position-cover overlay bg-overlay animated <?php echo esc_attr( $settings[ 'alith_portfolio_animation' ] ) ?>">
                                <div class="post-gallery-content">
                                    <div class="post-gallery-content-inner">
                                        <?php
                                            if ( $settings[ 'alith_portfolio_show_category' ] == 'yes' ) {
                                                echo "<p class='portfolio-category'>" . esc_html( $alith_taxonomy_filter ) . '</p>';
                                            }
                                            if ( $settings[ 'alith_portfolio_show_title' ] == 'yes' ) {
                                                $alith_header_start = '<' . esc_html( $settings[ 'alith_portfolio_title_html_tag' ] ) . ' class="gallery-content-title">';
                                                $alith_header_end   = '</' . esc_html( $settings[ 'alith_portfolio_title_html_tag' ] ) . '>';

                                                the_title( $alith_header_start, $alith_header_end );
                                            }
                                            if ( $settings[ 'alith_portfolio_excerpt' ] == 'yes' ) {
                                                $alith_trim_excerpt       = get_the_excerpt();
                                                $alith_excerpt_limit      = $settings[ 'alith_portfolio_excerpt_limit' ];
                                                $alith_short_excerpt      = wp_trim_words( $alith_trim_excerpt, $alith_excerpt_limit, $more = '... ' );

                                                echo "<p class='post-excerpt'>" . esc_html( $alith_short_excerpt ) . "</p>";
                                            }                                        
                                            echo $alith_portfolio_links; 
                                        ?>
                                    </div>
                                </div><!-- /.absolute-center -->
                            </div><!-- /.overlay-content -->
                        </div><!-- /.item-container -->

                        <?php elseif ($layout == 'style-2') : ?>
                        <div class="item-container post-gallery-inner style-2" style="margin-top: <?php echo esc_attr( $settings['alith_portfolio_row_gap']['size'] ); ?>px; margin-bottom: <?php echo esc_attr( $settings['alith_portfolio_row_gap']['size'] ); ?>px;">
                            <div class="gallery-thumbnail">
                                <?php echo $thumbnail_html; ?>                            
                                <div class="position-cover overlay bg-overlay animated <?php echo esc_attr( $settings[ 'alith_portfolio_animation' ] ) ?>">
                                    <div class="post-gallery-content">
                                        <div class="post-gallery-content-inner">
                                            <?php                                                                                   
                                                echo $alith_portfolio_links; 
                                            ?>
                                        </div>
                                    </div><!-- /.absolute-center -->
                                </div><!-- /.overlay-content -->
                            </div>
                            <div class="portfolio_gallery_content">
                                <?php 
                                    if ( $settings[ 'alith_portfolio_show_category' ] == 'yes' ) {
                                        echo "<p class='portfolio-category'>" . esc_html( $alith_taxonomy_filter ) . '</p>';
                                    }
                                    if ( $settings[ 'alith_portfolio_show_title' ] == 'yes' ) {
                                        $alith_header_start = '<' . esc_html( $settings[ 'alith_portfolio_title_html_tag' ] ) . ' class="gallery-content-title">';
                                        $alith_header_end   = '</' . esc_html( $settings[ 'alith_portfolio_title_html_tag' ] ) . '>';

                                        the_title( $alith_header_start, $alith_header_end );
                                    }
                                    if ( $settings[ 'alith_portfolio_excerpt' ] == 'yes' ) {
                                        $alith_trim_excerpt       = get_the_excerpt();
                                        $alith_excerpt_limit      = $settings[ 'alith_portfolio_excerpt_limit' ];
                                        $alith_short_excerpt      = wp_trim_words( $alith_trim_excerpt, $alith_excerpt_limit, $more = '... ' );

                                        echo "<p class='post-excerpt'>" . esc_html( $alith_short_excerpt ) . "</p>";
                                    } 
                                ?>
                            </div>                          
                        </div><!-- /.item-container -->

                        <?php endif; ?>
                    </div><!-- /.filtr-item -->
                   

                    <?php endwhile; ?>
                     </div><!-- /.row -->
                </div><!-- /.filter-container -->
        <?php endif; ?>

        <?php if ( $pagination == 'yes' ) { ?>
            <div class="alith-pagination">
                <?php
                    echo paginate_links( array(
                        'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                        'total'        => $portfolio_gallery->max_num_pages,
                        'current'      => max( 1, get_query_var( 'paged' ) ),
                        'format'       => '?paged=%#%',
                        'show_all'     => false,
                        'type'         => 'plain',
                        'end_size'     => 2,
                        'mid_size'     => 1,
                        'prev_next'    => true,
                        'prev_text'    => sprintf( '<i></i> %1$s', __( '<i class="ti-icon ti-arrow-left"></i>', 'alith_epk' ) ),
                        'next_text'    => sprintf( '%1$s <i></i>', __( '<i class="ti-icon ti-arrow-right"></i>', 'alith_epk' ) ),
                        'add_args'     => false,
                        'add_fragment' => '',
                    ) );
                ?>
            </div>
        <?php } // pagination
    } //render()
} //end class