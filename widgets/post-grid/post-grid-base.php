<?php
/**
 * @author  AliThemes
 * @since   1.0
 * @version 1.0
 */

namespace PostKitsForElementor\Widgets;

use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

// No direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Elementor_Post_Grid_Base_Widgets extends Widget_Base {
    public $alith_title;
    public $alith_name;
    public $alith_icon;
    public $alith_grid_layout;

    public function get_name() {
        return $this->alith_name;
    }

    public function get_title() {
        return $this->alith_title;
    }

    public function get_icon() {
        return $this->alith_icon;
    }

    public function get_categories() {
        return ['Alith_Elementor_Post_Grid'];
    }

    protected function _register_controls() {
        include ALITH_ELEMENTOR_POST_KITS_PATH.'includes/query.php';

        //Add Controls
        $this->alith_tab_control_query();
        $this->alith_tab_control_block_style();
        $this->alith_tab_control_styling();
        $this->alith_tab_control_slider();
    }

    /**
     * Query Tab.
     */
    private function alith_tab_control_query() {
        //Query Tab//
        //Query
        $this->start_controls_section(
            'alith_section_query',
            [
                'label' => esc_html__('Query', 'alith_epk'),
                'tab'   => 'alith_block_post_query_tab',
            ]
        );

        $this->add_control(
            'alith_block_post_post_type',
            [
                'label' => esc_html__('Post Type', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'post' => esc_html__('Posts', 'alith_epk'),
                    'page' => esc_html__('Pages', 'alith_epk'),
                ],
                'default' => 'post',
            ]
        );

        $this->add_control(
            'alith_block_post_post_show',
            [
                'label' => esc_html__( 'Max Posts', 'alith_epk' ),
                'description'   =>  'Max number of posts show on frontpage',
                'type' => Controls_Manager::NUMBER,
                'separator' => 'after',
                'default' => 5
            ]
        );

        $this->add_control(
            'alith_block_post_post_number',
            [
                'label' => esc_html__( 'Post Number', 'alith_epk' ),
                'type' => Controls_Manager::NUMBER,
            ]
        );

        $this->add_control(
            'alith_block_post_post_offset',
            [
                'label' => esc_html__( 'Post Offset', 'alith_epk' ),
                'type' => Controls_Manager::NUMBER,
            ]
        );

        $this->add_control(
            'alith_block_post_include_post_id',
            [
                'label' => esc_html__( 'Include Post ID', 'alith_epk' ),
                'type' => Controls_Manager::SELECT2,
                'return_value' => 'true',
                'multiple' => true,
                'options' => alith_get_posts_include(),
                'condition' => [
                    'alith_block_post_post_type' => 'post',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_page_include_id',
            [
                'label' => esc_html__( 'Include Page ID', 'alith_epk' ),
                'type' => Controls_Manager::SELECT2,
                'return_value' => 'true',
                'multiple' => true,
                'options' => alith_get_pages_include(),
                'condition' => [
                    'alith_block_post_post_type' => 'page',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_exclude_post_id',
            [
                'label' => esc_html__( 'Exclude Post ID', 'alith_epk' ),
                'type' => Controls_Manager::SELECT2,
                'return_value' => 'true',
                'multiple' => true,
                'options' => alith_get_posts_include(),
                'condition' => [
                    'alith_block_post_post_type' => 'post',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_page_exclude_id',
            [
                'label' => esc_html__( 'Exclude Page ID', 'alith_epk' ),
                'type' => Controls_Manager::SELECT2,
                'return_value' => 'true',
                'multiple' => true,
                'options' => alith_get_pages_include(),
                'condition' => [
                    'alith_block_post_post_type' => 'page',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_include_category',
            [
                'label' => esc_html__( 'Include Category', 'alith_epk' ),
                'type' => Controls_Manager::SELECT2,
                'return_value' => 'true',
                'multiple' => true,
                'options' => alith_get_category_include(),
            ]
        );

        $this->add_control(
            'alith_block_post_exclude_category',
            [
                'label' => esc_html__( 'Exclude Category', 'alith_epk' ),
                'type' => Controls_Manager::SELECT2,
                'return_value' => 'true',
                'multiple' => true,
                'options' => alith_get_category_include(),
            ]
        );

        $this->add_control(
            'alith_block_post_include_tag',
            [
                'label' => esc_html__( 'Include Tag', 'alith_epk' ),
                'type' => Controls_Manager::SELECT2,
                'return_value' => 'true',
                'multiple' => true,
                'options' => alith_get_tag_include(),
            ]
        );

        $this->add_control(
            'alith_block_post_exclude_tag',
            [
                'label' => esc_html__( 'Exclude Tag', 'alith_epk' ),
                'type' => Controls_Manager::SELECT2,
                'return_value' => 'true',
                'multiple' => true,
                'options' => alith_get_tag_include(),
            ]
        );

        $this->add_control(
            'alith_block_post_author_select',
            [
                'label' => esc_html__('Post Author', 'alith_epk'),
                'type' => Controls_Manager::SELECT2,
                'return_value' => 'true',
                'multiple' => true,
                'options' => alith_get_all_author(),
                'condition' => [
                    'alith_block_post_post_type' => 'post',
                ],
            ]
        );

        $this->add_control(
            'alith_block_page_author_select',
            [
                'label' => esc_html__('Page Author', 'alith_epk'),
                'type' => Controls_Manager::SELECT2,
                'return_value' => 'true',
                'multiple' => true,
                'options' => alith_get_all_page_author(),
                'condition' => [
                    'alith_block_post_post_type' => 'page',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_sort_by',
            [
                'label' => esc_html__('Sort By', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'modified' => esc_html__('Latest Post', 'alith_epk'),
                    'oldest_post' => esc_html__('Oldest Post', 'alith_epk'),
                    'title' => esc_html__('Alphabet', 'alith_epk'),
                    'ID' => esc_html__('ID', 'alith_epk'),
                    'rand' => esc_html__('Random Post', 'alith_epk'),
                    '1 week' => esc_html__('Random Post(7 days)', 'alith_epk'),
                    '1 month' => esc_html__('Random Post(30 days)', 'alith_epk'),
                    'comment_count' => esc_html__('Most Comment', 'alith_epk'),
                ],
                'default' => 'modified',
            ]
        );

        $this->add_control(
            'alith_block_post_order',
            [
                'label' => esc_html__('Order', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__('ASC', 'alith_epk'),
                    'DESC' => esc_html__('DESC', 'alith_epk'),
                ],
                'default' => 'DESC',
            ]
        );


        $this->add_control(
            'alith_block_post_custom_class',
            [
                'label' => esc_html__('Custom Class', 'alith_epk'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'manual',
            ]
        );
        $this->end_controls_section();
    }

    private function alith_tab_control_block_style() {
        \Elementor\Controls_Manager::add_tab(
            'alith_block_post_block_style_tab',
            esc_html__('Layout', 'alith_epk')
        );

        $this->start_controls_section(
            'alith_block_style_section',
            [
                'label' => esc_html__('Style Setting', 'alith_epk'),
                'tab' => 'alith_block_post_block_style_tab',
            ]
        );
        $this->add_control(
            'alith_block_post_margin',
            [
                'label' => esc_html__( 'Item Margin', 'alith_epk' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_items_height',
            [
                'label' => esc_html__( 'Items Height', 'alith_epk' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' , 'px' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                    'px' => [
                        'min' => 200,
                        'max' => 1600,
                        'step' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 520,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label' => esc_html__('Border', 'alith_epk'),
                'name' => 'alith_block_post_border_group',
                'show_label' => true,
                'selector' => '{{WRAPPER}} .alith-image-bg, .alith-image-radius .alith-image-main img',
            ]
        );

        $this->add_control(
            'alith_block_post_border_radius',
            [
                'label' => esc_html__('Image Border Radius', 'alith_epk'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'   =>[
                    'unit'  => 'px',
                    'top'   => 0,
                    'right'   => 0,
                    'bottom'   => 0,
                    'left'   => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-image-bg, .alith-image-radius .alith-image-main img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .alith-bg-dark:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .custom-rounded' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_data_format',
            [
                'label' => esc_html__('Data Format', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'WP_default' => esc_html__('WP Default', 'alith_epk'),
                    'relative' => esc_html__('Relative', 'alith_epk'),
                    'custom' => esc_html__('Custom', 'alith_epk'),
                ],
                'default' => 'relative',
            ]
        );

        $this->add_control(
            'alith_block_post_custom_data',
            [
                'label' => esc_html__('Custom Data Format', 'alith_epk'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'alith_block_post_data_format' => 'custom',
                ],
                'placeholder'   => 'Y-m-d',
                'separator' =>'after',
            ]
        );

        $this->add_control(
            'alith_block_post_image_size',
            [
                'label' => esc_html__('Image Size', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'thumbnail' => esc_html__('Thumbnail', 'alith_epk'),
                    'medium' => esc_html__('Medium', 'alith_epk'),
                    'large' => esc_html__('Large', 'alith_epk'),
                    'full' => esc_html__('full', 'alith_epk'),
                ],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'alith_block_post_image_effect',
            [
                'label' => esc_html__('Image Effect', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__('None', 'alith_epk'),
                    'up' => esc_html__('Zoom In', 'alith_epk'),
                    'down' => esc_html__('Zoom Out', 'alith_epk'),
                ],
                'default' => 'up',
            ]
        );

        $this->add_control(
            'alith_block_post_title_link_effect',
            [
                'label' => esc_html__('Title Link Effect', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'normal' => esc_html__('Normal', 'alith_epk'),
                    'underline' => esc_html__('Underline', 'alith_epk'),
                    'link-hover hover-1' => esc_html__('hover-1', 'alith_epk'),
                    'link-hover hover-2' => esc_html__('hover-2', 'alith_epk'),
                    'link-hover hover-3' => esc_html__('hover-3', 'alith_epk'),
                    'link-hover hover-4' => esc_html__('hover-4', 'alith_epk'),
                ],
                'default' => 'normal',
            ]
        );

        $this->add_control(
            'alith_block_post_overlay_effect',
            [
                'label' => esc_html__('Overlay Effect', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__('Fade', 'alith_epk'),
                    'rotate' => esc_html__('Rotate', 'alith_epk'),
                    'scaleup' => esc_html__('Scale Up', 'alith_epk'),
                    'scaledown' => esc_html__('Scale Down', 'alith_epk'),
                    'bottomtop' => esc_html__('Bottom Top', 'alith_epk'),
                    'skew-y' => esc_html__('Skew y', 'alith_epk'),
                    'skew-x' => esc_html__('Skew x', 'alith_epk'),
                    'gradient' => esc_html__('Gradient', 'alith_epk'),
                ],
                'default' => 'gradient',
            ]
        );

        $this->add_control(
            'alith_block_post_overlay_bg',
            [
                'label' => esc_html__( 'Overlay Background', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => 'rgba(58,58,58,0.77)',
                'selectors' => [
                    '{{WRAPPER}} .alith-bg-dark:hover:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .alith-layout-35 .alith-bg-dark:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .alith-bg-dark-gradient:before' => ' top: 50%;
                                                                     background: -moz-linear-gradient(top,  rgba(0,0,0,0) 0%, rgba(0,0,0,0.8) 100%);
                                                                     background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.8) 100%);
                                                                     background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,{{VALUE}} 100%);',
                    '{{WRAPPER}} .alith-bg-dark-gradient:hover:before' => '  top: 0%;
                                                                            background: -moz-linear-gradient(top, rgba(0,0,0,0) 0%, rgba(0,0,0,0.8) 100%);
                                                                            background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.8) 100%);
                                                                            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,{{VALUE}} 100%);',
                ],
            ]
        );

        $this->add_control(
            'alith_block_second_overlay_bg',
            [
                'label' => esc_html__( 'Second Overlay Background', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-anim-bgdark-scaledown:after, .alith-anim-bgdark-bottomtop:after, .alith-anim-bgdark-skew-y:after,
                                 .alith-anim-bgdark-skew-x:after, .alith-anim-bgdark-scaleup:after, .alith-anim-bgdark-rotate:after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .alith-anim-bgdark-scaleup:after, .alith-anim-bgdark-rotate:after' => 'background-color: {{VALUE}}',
                ],
                'default' => 'rgba(19,134,165,0.23)'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'alith_block_content_layout_section',
            [
                'label' => esc_html__('Content layout', 'alith_epk'),
                'tab' => 'alith_block_post_block_style_tab',
            ]
        );
        $this->add_control(
            'alith_block_post_bg_content',
            [
                'label' => esc_html__( 'Content Background', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .itpl-main-bg-cont' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_content_position',
            [
                'label' => esc_html__('Content Position', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top10 itpl-absolute-left10' => esc_html__('Top Left', 'alith_epk'),
                    'top-center' => esc_html__('Top Center', 'alith_epk'),
                    'top-right' => esc_html__('Top Right', 'alith_epk'),
                    'center-left' => esc_html__('Center Left', 'alith_epk'),
                    'center itpl-text-center' => esc_html__('Center', 'alith_epk'),
                    'center-right' => esc_html__('Center Right', 'alith_epk'),
                    'bottom-left' => esc_html__('Bottom Left', 'alith_epk'),
                    'center-bottom' => esc_html__('Bottom Center', 'alith_epk'),
                    'bottom-right' => esc_html__('Bottom Right', 'alith_epk'),
                ],
                'default' => 'bottom-left',
            ]
        );

        $this->end_controls_section();
    }

    private function alith_tab_control_styling() {
        \Elementor\Controls_Manager::add_tab(
            'alith_block_post_styling_tab',
            esc_html__( 'Options','alith_epk' )
        );

        //Title
        $this->start_controls_section(
            'alith_block_post_widget_title',
            [
                'label' => esc_html__( 'Header', 'alith_epk' ),
                'tab' => 'alith_block_post_styling_tab',
            ]
        );

        $this->add_control(
            'alith_block_post_widget_title_show_title',
            [
                'label' => __( 'Show Title', 'alith_epk' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'alith_epk' ),
                'label_off' => __( 'Hide', 'alith_epk' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'alith_block_post_widget_header_layout',
            [
                'label' => esc_html__('Header layout', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'header_layout_1' => esc_html__('Header Layout 1', 'alith_epk'),
                    'header_layout_2' => esc_html__('Header Layout 2', 'alith_epk'),
                    'header_layout_3' => esc_html__('Header Layout 3', 'alith_epk'),
                    'header_layout_4' => esc_html__('Header Layout 4', 'alith_epk'),
                    'header_layout_5' => esc_html__('Header Layout 5', 'alith_epk'),
                    'header_layout_6' => esc_html__('Header Layout 6', 'alith_epk'),
                    'header_layout_7' => esc_html__('Header Layout 7', 'alith_epk'),
                    'header_layout_8' => esc_html__('Header Layout 8', 'alith_epk'),
                ],
                'default' => 'header_layout_1',
                'condition' => [
                    'alith_block_post_widget_title_show_title' => 'yes',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'alith_block_post_widget_header_icon',
            [
                'label' => __( 'Header Icon', 'alith_epk' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'alith_block_post_widget_title_show_title' => 'yes',
                ],
                'default' => [
                    'value' => 'fa fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_widget_header_icon_size',
            [
                'label' => esc_html__( 'Icon Title Size', 'alith_epk' ),
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} .alith_block_title i' => 'font-size: {{VALUE}}px !important',
                ],
                'condition' => [
                    'alith_block_post_widget_title_show_title' => 'yes',
                ],
                'default'   => '16',
            ]
        );

        $this->add_control(
            'alith_block_post_widget_header_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [
                    'alith_block_post_widget_title_show_title' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith_block_title i' => 'color: {{VALUE}} !important',
                ],
                'default' => '#f90248',
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'alith_block_post_widget_title_text',
            [
                'label' => __( 'Title', 'alith_epk' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'alith_block_post_widget_title_show_title' => 'yes',
                ],
            ]            
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' =>  'alith_block_post_widget_title_typography',
                'label' => esc_html__( 'Title Setting', 'alith_epk' ),
                'selector' => '{{WRAPPER}} .alith_block_title span',
                'condition' => [
                    'alith_block_post_widget_title_show_title' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'alith_block_post_widget_second_title_text',
            [
                'label' => __( 'Second Title', 'alith_epk' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'alith_block_post_widget_title_show_title' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' =>  'alith_block_post_widget_second_title_typography',
                'label' => esc_html__( 'Second Title Setting', 'alith_epk' ),
                'selector' => '{{WRAPPER}} .alith_block_title span strong',
                'condition' => [
                    'alith_block_post_widget_title_show_title' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'alith_block_heading_background_color',
            [
                'label' => esc_html__( 'Header Background', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [
                    'alith_block_post_widget_title_show_title' => 'yes',
                    'alith_block_post_widget_header_layout' => [
                            'header_layout_2',
                            'header_layout_4',
                            'header_layout_5',
                        ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith_block_heading.header_layout_2 .alith_block_title span' => 'background-color: {{VALUE}} !important',
                    '{{WRAPPER}} .alith_block_heading.header_layout_4' => 'background-color: {{VALUE}} !important',
                    '{{WRAPPER}} .alith_block_heading.header_layout_5' => 'background-color: {{VALUE}} !important',
                ],
                'default' => '#f90248',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'alith_block_heading_title_color',
            [
                'label' => esc_html__( 'Title Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [
                    'alith_block_post_widget_title_show_title' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith_block_title' => 'color: {{VALUE}} !important',
                ],
                'default' => '#1a1a1a',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'alith_block_heading_second_title_color',
            [
                'label' => esc_html__( 'Second Title Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [
                    'alith_block_post_widget_title_show_title' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith_block_title span strong' => 'color: {{VALUE}} !important',
                ],
                'default' => '#f90248'
            ]
        );

        $this->add_control(
            'alith_block_heading_line_color',
            [
                'label' => esc_html__( 'Header Title Color Line', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [
                    'alith_block_post_widget_title_show_title' => 'yes',
                    'alith_block_post_widget_header_layout' => [
                            'header_layout_1',
                            'header_layout_7',
                            'header_layout_8',
                        ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith_block_heading.header_layout_1 .alith_block_title::after' => 'background-color: {{VALUE}} !important',
                    '{{WRAPPER}} .alith_block_heading.header_layout_7 .alith_block_title span::before' => 'background-color: {{VALUE}} !important',
                    '{{WRAPPER}} .alith_block_heading.header_layout_8 .alith_block_title span::before' => 'background-color: {{VALUE}} !important',
                    '{{WRAPPER}} .alith_block_heading.header_layout_8 .alith_block_title span::after' => 'background-color: {{VALUE}} !important',
                ],
                'default' => '#f90248'
            ]
        );
        $this->add_control(
            'alith_block_heading_line_width',
            [
                'label' => esc_html__( 'Header title line width', 'alith_epk' ),
                'type' => Controls_Manager::NUMBER,
                'condition' => [
                    'alith_block_post_widget_title_show_title' => 'yes',
                    'alith_block_post_widget_header_layout' => [
                            'header_layout_1',
                            'header_layout_7',
                            'header_layout_8',
                        ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith_block_title::after' => 'width: {{VALUE}}px !important',
                ],
                'default'   => '30',
            ]
        );
        $this->add_control(
                'alith_block_heading_line_divider_color',
                [
                    'label' => esc_html__( 'Line Title Color', 'alith_epk' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'condition' => [
                        'alith_block_post_widget_title_show_title' => 'yes',
                        'alith_block_post_widget_header_layout' => [
                            'header_layout_1',
                            'header_layout_2',
                            'header_layout_3',
                            'header_layout_5',
                            'header_layout_6',
                        ],               
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .alith_block_heading.header_layout_1' => 'border-bottom-color: {{VALUE}} !important',
                        '{{WRAPPER}} .alith_block_heading.header_layout_2' => 'border-bottom-color: {{VALUE}} !important',
                        '{{WRAPPER}} .alith_block_heading.header_layout_3' => 'border-bottom-color: {{VALUE}} !important',
                        '{{WRAPPER}} .alith_block_heading.header_layout_5' => 'border-bottom-color: {{VALUE}} !important',
                        '{{WRAPPER}} .alith_block_heading.header_layout_6' => 'border-top-color: {{VALUE}} !important',
                        '{{WRAPPER}} .alith_block_heading.header_layout_3 .alith_block_title::after' => 'background-color: {{VALUE}} !important',
                    ],
                    'separator' => 'after',
                    'default' => '#eee'
                ]
            );
        $this->add_control(
            'alith_block_post_header_block_margin',
            [
                'label' => esc_html__( 'Header Margin', 'alith_epk' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'condition' => [
                        'alith_block_post_widget_title_show_title' => 'yes',                     
                    ],
                'default' => [
                    'unit'  => 'px',
                    'top' => 0,
                    'right' => 0,
                    'bottom' => '15',
                    'left' => 0,
                    'isLinked' => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith_block_heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); 

        $this->start_controls_section(
            'alith_block_post_title_typo_section',
            [
                'label' => esc_html__( 'Post Title', 'alith_epk' ),
                'tab' => 'alith_block_post_styling_tab',
            ]
        );
        $this->start_controls_tabs(
            'alith_block_post_title_typo_tabs'
        );

        $this->start_controls_tab(
            'alith_block_post_title_typo_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'alith_epk' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' =>  'alith_block_post_title_typography',
                'label' => esc_html__( 'Title Setting', 'alith_epk' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .alith_epk_title a',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' =>  'alith_block_post_second_title_typography',
                'label' => esc_html__( 'Second Title Setting', 'alith_epk' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .alith_epk_title.alith-second-font-size a',
            ]
        );

        $this->add_control(
            'alith_block_post_title_color',
            [
                'label' => esc_html__( 'Text Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith_epk_title a' => 'color: {{VALUE}} !important',
                ],
                'default' => '#ffffff'
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'alith_block_posts_title_typo_hover_tab',
            [
                'label' => esc_html__( 'Hover','alith_epk' ),
            ]
        );

        $this->add_control(
            'alith_block_post_title_color_text',
            [
                'label' => esc_html__( 'Text Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith_epk_title:hover a' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .hover-2:hover' => 'background-image: linear-gradient(120deg,{{VALUE}} 0%,{{VALUE}} 100%);',
                ],
                'default' => '#a0a0a0'
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'alith_block_post_title_margin',
            [
                'label' => esc_html__( 'Margin', 'alith_epk' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith_epk_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
                'separator' =>'before',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'alith_block_post_desc_typo_section',
            [
                'label' => esc_html__( 'Excerpt', 'alith_epk' ),
                'tab' => 'alith_block_post_styling_tab',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' =>  'alith_block_post_desc_typography',
                'label' => esc_html__( 'Text Setting', 'alith_epk' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} p.alith-epk-excerpt',
                'fields_options' => array(
                    'font_weight' => array(
                        'default' =>'300'
                    )
                )
            ]
        );

        $this->add_control(
            'alith_block_post_desc_color_text',
            [
                'label' => esc_html__( 'Text Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} p.alith-epk-excerpt' => 'color: {{VALUE}}',
                ],
                'default' => '#686868'
            ]
        );

        $this->add_control(
            'alith_block_post_desc_length_size',
            [
                'label' => esc_html__( 'Excerpt Length', 'alith_epk' ),
                'type' => Controls_Manager::NUMBER,
                'separator' => 'after',
                'default'   => 50,
                'description'   =>  'set your word length number',
                'min'   =>  2,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'alith_block_post_category_typo_section',
            [
                'label' => esc_html__( 'Category', 'alith_epk' ),
                'tab' => 'alith_block_post_styling_tab',
            ]
        );

        $this->add_control(
            'alith_block_post_cat_layout',
            [
                'label' => esc_html__('Category Layout', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'normal' => esc_html__('Normal', 'alith_epk'),
                    'cornered' => esc_html__('Cornered', 'alith_epk'),
                    'rounded' => esc_html__('Rounded', 'alith_epk'),
                ],
                'default' => 'rounded',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' =>  'alith_block_post_category_typography',
                'label' => esc_html__( 'Text Setting', 'alith_epk' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .alith-tags a',
                'default'   =>[
                    'transform'  => 'uppercase',
                    'size'   => 11,
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'label' => esc_html__('Border', 'alith_epk'),
                'name' => 'alith_alert_main_border_group',
                'show_label' => true,
                'selector' => '{{WRAPPER}} .alith-tags a',
            ]
        );

        $this->add_control(
            'alith_block_post_category_tags_border_radius',
            [
                'label' => esc_html__('Border Radius', 'alith_epk'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .alith-tags a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'   =>[
                    'unit'  => 'px',
                    'top'   => 0,
                    'right'   => 0,
                    'bottom'   => 0,
                    'left'   => 0,
                ]
            ]
        );

        $this->add_control(
            'alith_block_post_cat_padding',
            [
                'label' => esc_html__( 'Padding', 'alith_epk' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 5,
                    'right' => 10,
                    'bottom' => 5,
                    'left' => 10,
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}}  .alith-tags a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_category_bg_checker',
            [
                'label' => esc_html__( 'Custom Color', 'alith_epk' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default'  =>'true',
                'description'   => 'if you want to change category text color Individually you should go to the category in wordpress and change each category color individually',
            ]
        );

        $this->start_controls_tabs(
            'alith_block_post_cat_bg_tabs'
        );

        $this->start_controls_tab(
            'alith_block_post_cat_bg_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'alith_epk' ),
                'condition' => [
                    'alith_block_post_category_bg_checker' => 'true',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_cat_bg_color',
            [
                'label' => esc_html__( 'Category Background', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [
                    'alith_block_post_category_bg_checker' => 'true',
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-tags a' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .alith-tags .alith-tag-arrow:after' => 'border-left-color: {{VALUE}}',
                ],
                'default'   => '#ffffff',
            ]
        );

        $this->add_control(
            'alith_block_post_font_color_bg',
            [
                'label' => esc_html__( 'Text Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-tags a' => 'color: {{VALUE}} !important',
                ],
                'condition' => [
                    'alith_block_post_category_bg_checker' => 'true',
                ],
                'default' => '#212121'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'alith_block_post_cat_bg_hover_tab',
            [
                'label' => esc_html__( 'Hover','alith_epk' ),
                'condition' => [
                    'alith_block_post_category_bg_checker' => 'true',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_cat_hover_bg',
            [
                'label' => esc_html__( 'Category Background', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-tags a:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .alith-tags .alith-tag-arrow:hover:after' => 'border-left-color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_hover_font_color_bg',
            [
                'label' => esc_html__( 'Text Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-tags a:hover' => 'color: {{VALUE}} !important',
                ],
                'default' => '#e5e5e5'
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'alith_block_post_meta_typo_section',
            [
                'label' => esc_html__( 'Meta', 'alith_epk' ),
                'tab' => 'alith_block_post_styling_tab',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' =>  'alith_block_post_metas_typography',
                'label' => esc_html__( 'Text Setting', 'alith_epk' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,

                'selector' => '{{WRAPPER}} .alith-epk-meta span',


            ]
        );

        $this->add_control(
            'alith_block_post_meta_icon_color_text',
            [
                'label' => esc_html__( 'Icon Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-text-muted i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .alith-epk-meta i' => 'color: {{VALUE}}',
                ],
                'default' => '#ffffff',
                'separator' => 'after',
            ]
        );

        $this->start_controls_tabs(
            'alith_info_banner_box_shadaow_tabs'
        );

        $this->start_controls_tab(
            'alith_info_banners_box_shadaow_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'alith_epk' ),
            ]
        );

        $this->add_control(
            'alith_block_post_meta_color_text',
            [
                'label' => esc_html__( 'Text Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-epk-meta span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .alith-epk-meta a' => 'color: {{VALUE}}',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'alith_block_post_meta_hover_color_tab',
            [
                'label' => esc_html__( 'Hover','alith_epk' ),
            ]
        );

        $this->add_control(
            'alith_block_post_meta_hover_color_text',
            [
                'label' => esc_html__( 'Text Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-epk-meta a:hover' => 'color: {{VALUE}}',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'alith_block_post_post_meta_author_show',
            [
                'label' => __( 'Show Author', 'alith_epk' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'alith_epk' ),
                'label_off' => __( 'Hide', 'alith_epk' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',               
            ]
        );

        $this->add_control(
            'alith_block_post_author_icon_type',
            [
                'label' => esc_html__('Author Icon', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'avatar' => esc_html__('Avatar', 'alith_epk'),
                    'icon' => esc_html__('Icon', 'alith_epk'),
                    'none' => esc_html__('None', 'alith_epk'),
                ],
                'default' => 'avatar',                
                'condition' => [
                    'alith_block_post_post_meta_author_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_icon_author_select',
            [
                'label' => esc_html__('Icon', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'user'          => esc_html__('User', 'alith_epk'),
                    'pencil'        => esc_html__('Pencil', 'alith_epk'),
                    'pencil-alt'    => esc_html__('Pencil 2', 'alith_epk'),
                    'pencil-alt2'   => esc_html__('Pencil 3', 'alith_epk'),
                    'id-badge'      => esc_html__('Id badge', 'alith_epk'),
                    'write'         => esc_html__('Writer', 'alith_epk'),                    
                    'ink-pen'       => esc_html__('Pen', 'alith_epk'),
                ],
                'default' => 'user',
                'condition' => [
                    'alith_block_post_post_meta_author_show' => 'yes',
                    'alith_block_post_author_icon_type' => 'icon',                    
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_author_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'alith_epk' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 11,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-author i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'after',
                'condition' => [
                    'alith_block_post_post_meta_author_show' => 'yes',
                    'alith_block_post_author_icon_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_author_avatar_size',
            [
                'label' => esc_html__( 'Avatar Size', 'alith_epk' ),
                'type' => Controls_Manager::NUMBER,
                'separator' => 'after',
                'condition' => [
                    'alith_block_post_post_meta_author_show' => 'yes',
                    'alith_block_post_author_icon_type' => 'avatar',
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-author img' => 'width: {{VALUE}}px; height: {{VALUE}}px',
                ],
                'default'   => '30',
            ]
        );

        $this->add_control(
            'alith_block_post_post_meta_date_time_show',
            [
                'label' => __( 'Show Date', 'alith_epk' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'alith_epk' ),
                'label_off' => __( 'Hide', 'alith_epk' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'alith_block_post_time_icon_select_type',
            [
                'label' => esc_html__('Time Icon', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'icon' => esc_html__('Icon', 'alith_epk'),
                    'dot' => esc_html__('Dot', 'alith_epk'),
                    'none' => esc_html__('None', 'alith_epk'),
                ],
                'default' => 'icon',                
                'condition' => [
                    'alith_block_post_post_meta_date_time_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_icon_select',
            [
                'label' => esc_html__('Icon', 'alith_epk'),
                'type'  => Controls_Manager::SELECT,
                'options' => [
                    'time'          => esc_html__('Time', 'alith_epk'),
                    'timer'         => esc_html__('Timer', 'alith_epk'),
                    'alarm-clock'   => esc_html__('Alarm clock', 'alith_epk'),
                    'pencil'        => esc_html__('Pencil', 'alith_epk'),
                    'pencil-alt'    => esc_html__('Pencil 2', 'alith_epk'),
                    'marker-alt'    => esc_html__('Pen', 'alith_epk'),
                                        
                ],
                'default'   => 'time',
                'condition' => [
                    'alith_block_post_post_meta_date_time_show' => 'yes',
                    'alith_block_post_time_icon_select_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_time_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'alith_epk' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 11,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-date i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'after',
                'condition' => [
                    'alith_block_post_post_meta_date_time_show' => 'yes',
                    'alith_block_post_time_icon_select_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_post_meta_reading_time_show',
            [
                'label' => __( 'Show Reading time', 'alith_epk' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'alith_epk' ),
                'label_off' => __( 'Hide', 'alith_epk' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',             
            ]
        );

        $this->add_control(
            'alith_block_post_view_icon_select_type',
            [
                'label' => esc_html__('View Icon', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'icon' => esc_html__('Icon', 'alith_epk'),
                    'dot' => esc_html__('Dot', 'alith_epk'),
                    'none' => esc_html__('None', 'alith_epk'),
                ],                
                'default' => 'icon',
                'condition' => [
                    'alith_block_post_post_meta_reading_time_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_icon_view_select',
            [
                'label' => esc_html__('Icon', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'eye'           => esc_html__('Eye', 'alith_epk'),
                    'time'          => esc_html__('Time', 'alith_epk'),
                    'timer'         => esc_html__('Timer', 'alith_epk'),
                    'alarm-clock'   => esc_html__('Alarm clock', 'alith_epk'),
                ],
                'default' => 'eye',
                'condition' => [
                    'alith_block_post_post_meta_reading_time_show' => 'yes',
                    'alith_block_post_view_icon_select_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_view_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'alith_epk' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 11,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-time-reading i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'alith_block_post_post_meta_reading_time_show' => 'yes',
                    'alith_block_post_view_icon_select_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_post_meta_comment_show',
            [
                'label' => __( 'Show Comments', 'alith_epk' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'alith_epk' ),
                'label_off' => __( 'Hide', 'alith_epk' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',           
            ]
        );
       
        $this->add_control(
            'alith_block_post_comment_icon_select_type',
            [
                'label' => esc_html__('Comment Icon', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'icon' => esc_html__('Icon', 'alith_epk'),
                    'dot'  => esc_html__('Dot', 'alith_epk'),
                    'none' => esc_html__('None', 'alith_epk'),
                ],                
                'default' => 'icon',
                'condition' => [
                    'alith_block_post_post_meta_comment_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_icon_comment_select',
            [
                'label' => esc_html__('Icon', 'alith_epk'),
                'type'  => Controls_Manager::SELECT,
                'options' => [
                    'comment'           => esc_html__('Comment', 'alith_epk'),
                    'comment-alt'       => esc_html__('Comment 2', 'alith_epk'),
                    'comments'          => esc_html__('Comments', 'alith_epk'),
                    'thought'           => esc_html__('Thought', 'alith_epk'),                    
                    'comments-smiley'   => esc_html__('Comments smiley', 'alith_epk'),
                    'face-smile'        => esc_html__('Face smile', 'alith_epk'),
                ],
                'default'   => 'comment',
                'condition' => [
                    'alith_block_post_comment_icon_select_type' => 'icon',
                    'alith_block_post_post_meta_comment_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_comment_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'alith_epk' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 11,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-meta-comment i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'after',
                'condition' => [
                    'alith_block_post_comment_icon_select_type' => 'icon',
                    'alith_block_post_post_meta_comment_show' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'alith_block_post_read_more_section',
            [
                'label' => esc_html__( 'Read more', 'alith_epk' ),
                'tab' => 'alith_block_post_styling_tab',
            ]
        );

        $this->add_control(
            'alith_block_post_read_more_text',
            [
                'label' => __( 'Read More text', 'alith_epk' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Read More', 'alith_epk' ),
            ]            
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' =>  'alith_block_post_read_more_text_typography',
                'label' => esc_html__( 'Read More Text', 'alith_epk' ),
                'selector' => '{{WRAPPER}} .alith-epk-read-more',
            ]
        );

        $this->add_control(
            'alith_block_post_read_more_text_color',
            [
                'label' => esc_html__( 'Read More Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-epk-read-more' => 'color: {{VALUE}} !important',
                ],
                'default' => '#53585c',
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'alith_block_post_read_more_text_hover_color',
            [
                'label' => esc_html__( 'Read More Hover Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-epk-read-more:hover' => 'color: {{VALUE}} !important',
                ],
                'default' => '#ffffff',
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'alith_block_post_read_more_background',
            [
                'label' => esc_html__( 'Read More Background', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .alith-epk-read-more' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_read_more_hover_background',
            [
                'label' => esc_html__( 'Read More Hover Background', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#f90248',
                'selectors' => [
                    '{{WRAPPER}} .alith-epk-read-more:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_read_more_margin',
            [
                'label' => esc_html__( 'Read More Margin', 'alith_epk' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-epk-read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_read_more_padding',
            [
                'label' => esc_html__( 'Read More Padding', 'alith_epk' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => 6,
                    'right' => 18,
                    'bottom' => 6,
                    'left' => 18,
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}}  a.alith-epk-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'alith_block_post_read_more_border_style',
            [
                'label' => esc_html__('Border style', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('None', 'alith_epk'),
                    'solid' => esc_html__('Solid', 'alith_epk'),
                    'double' => esc_html__('Double', 'alith_epk'),
                    'dotted' => esc_html__('Dotted', 'alith_epk'),
                    'dashed' => esc_html__('Dashed', 'alith_epk'),
                    'groove' => esc_html__('Groove', 'alith_epk'),
                ],
                'default' => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .alith-epk-read-more' => 'border-style: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'alith_block_post_read_more_border_color',
            [
                'label' => esc_html__( 'Border color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#e0e0e0',
                'selectors' => [
                    '{{WRAPPER}} .alith-epk-read-more' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'alith_block_post_read_more_border_width',
            [
                'label' => esc_html__( 'Border width', 'alith_epk' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-epk-read-more' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_control(
            'alith_block_post_read_more_border_radius',
            [
                'label' => esc_html__('Button Border Radius', 'alith_epk'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'   =>[
                    'unit'  => 'px',
                    'top'   => 0,
                    'right'   => 0,
                    'bottom'   => 0,
                    'left'   => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-epk-read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'alith_block_post_post_format_section',
            [
                'label' => esc_html__( 'Post Format', 'alith_epk' ),
                'tab' => 'alith_block_post_styling_tab',
            ]
        );

        $this->add_control(
            'alith_block_post_post_format_show',
            [
                'label' => esc_html__( 'Post Format Show', 'alith_epk' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => 'true',
            ]
        );

        $this->add_control(
            'alith_block_post_post_format_background',
            [
                'label' => esc_html__( 'Post Format Background', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-epk-format-icon .format-icon' => 'background-color: {{VALUE}} !important',
                ],
                'default' => '#f90248',
                'condition' => [
                    'alith_block_post_post_format_show' => 'true',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_post_format_color',
            [
                'label' => esc_html__( 'Post Format Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-epk-format-icon .format-icon' => 'color: {{VALUE}} !important',
                ],
                'default' => '#ffffff',
                'condition' => [
                    'alith_block_post_post_format_show' => 'true',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'alith_block_post_post_share_section',
            [
                'label' => esc_html__( 'Post Share', 'alith_epk' ),
                'tab' => 'alith_block_post_styling_tab',
            ]
        );

        $this->add_control(
            'alith_block_post_post_share_show',
            [
                'label' => esc_html__( 'Post Share Show', 'alith_epk' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => 'true',
            ]
        );

        $this->add_control(
            'alith_block_post_post_share_background',
            [
                'label' => esc_html__( 'Post Share Icon Background', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .epk-social-share li a' => 'background-color: {{VALUE}} !important',
                ],
                'default' => '#ffffff',
                'condition' => [
                    'alith_block_post_post_share_show' => 'true',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_post_share_color',
            [
                'label' => esc_html__( 'Post Share Icon Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .epk-social-share li a' => 'color: {{VALUE}} !important',
                ],
                'default' => '#F90248',
                'condition' => [
                    'alith_block_post_post_share_show' => 'true',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function alith_tab_control_slider() {
        \Elementor\Controls_Manager::add_tab(
            'alith_block_post_slider_tab',
            esc_html__( 'Slider','alith_epk' )
        );
        $this->start_controls_section(
            'alith_block_post_slider_section',
            [
                'label' => esc_html__( 'Setting', 'alith_epk' ),
                'tab' => 'alith_block_post_slider_tab',
            ]
        );

        $this->add_control(
            'alith_block_post_slider_checker',
            [
                'label' => esc_html__( 'Active Slider', 'alith_epk' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'alith_block_post_slider_items',
            [
                'label' => esc_html__( 'Slider Items', 'alith_epk' ),
                'type' => Controls_Manager::NUMBER,
                'condition' => [
                    'alith_block_post_slider_checker' => 'true',
                ],
                'min'   => 1,
                'default'   => 2,
            ]
        );

        $this->add_control(
            'alith_block_post_autoplay_checker',
            [
                'label' => esc_html__( 'Autoplay', 'alith_epk' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'condition' => [
                    'alith_block_post_slider_checker' => 'true',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_autoplay_speed',
            [
                'label' => esc_html__( 'Autoplay Speed', 'alith_epk' ),
                'type' => Controls_Manager::NUMBER,
                'default'   => 3000,
                'condition' => [
                    'alith_block_post_autoplay_checker' => 'true',
                    'alith_block_post_slider_checker' => 'true',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'alith_block_post_loop_checker',
            [
                'label' => esc_html__( 'Loop', 'alith_epk' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'condition' => [
                    'alith_block_post_slider_checker' => 'true',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_navigation_show',
            [
                'label' => esc_html__( 'Navigation Show', 'alith_epk' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [
                    'alith_block_post_slider_checker' => 'true',
                ],
                'separator' => 'before',
                'return_value' => 'true',
            ]
        );

        $this->add_control(
            'alith_block_post_icon_navigation_select',
            [
                'label' => esc_html__('Icon', 'alith_epk'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'arrow-right'           => esc_html__('Arrow', 'alith_epk'),
                    'angle-right'           => esc_html__('Angle', 'alith_epk'),
                    'angle-double-right'    => esc_html__('Angle Double', 'alith_epk'),
                    'arrow-circle-right'    => esc_html__('Angle Circle', 'alith_epk'),
                    'hand-point-right'      => esc_html__('Hand Point', 'alith_epk'),
                    'back-right'            => esc_html__('Back', 'alith_epk'),
                    'shift-right'           => esc_html__('Shift', 'alith_epk'),
                    'shift-right-alt'       => esc_html__('Shift alt', 'alith_epk'),
                ],
                'default' => 'arrow-right',
                'condition' => [
                    'alith_block_post_slider_checker' => 'true',
                    'alith_block_post_navigation_show' => 'true',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_pagination_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [
                    'alith_block_post_slider_checker' => 'true',
                    'alith_block_post_navigation_show' => 'true',
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-nav-icon i' => 'color: {{VALUE}}',
                ],
                'default' => '#222'
            ]
        );

        $this->add_control(
            'alith_block_post_pagination_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [
                    'alith_block_post_slider_checker' => 'true',
                    'alith_block_post_navigation_show' => 'true',
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-swiper-button-prev' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .alith-swiper-button-next' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'after',
                'default' => '#c1c1c1'
            ]
        );

        $this->add_control(
            'alith_block_post_pagination_show',
            [
                'label' => esc_html__( 'Pagination Show', 'alith_epk' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'condition' => [
                    'alith_block_post_slider_checker' => 'true',
                ],
            ]
        );

        $this->add_control(
            'alith_block_post_pagination_navigation_bg_color',
            [
                'label' => esc_html__( 'Pagination Color', 'alith_epk' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [
                    'alith_block_post_slider_checker' => 'true',
                    'alith_block_post_pagination_show' => 'true',
                ],
                'selectors' => [
                    '{{WRAPPER}} .alith-pagination-circle span' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .alith-pagination-circle span:before' => 'border-color: {{VALUE}}',
                ],
                'default' => '#f90248'
            ]
        );

        $this->end_controls_section();
    }

    public function render()
    {
        $title = get_bloginfo('name');

        if (empty($title))
            return;
        $atts = $this->get_settings();

        // Define output and styles
        $output = '';
        $custom_style = '';
        $custom_script ='';
        global $rand;
        $rand = rand(1, 9999);

        //ADITIONAL FUNCTION
        include ALITH_ELEMENTOR_POST_KITS_PATH.'includes/helper.php';

        // INCLUDE CUSTOM CSS & SCRIPT        
        include ALITH_ELEMENTOR_POST_KITS_PATH.'includes/custom-css.php';
        include ALITH_ELEMENTOR_POST_KITS_PATH.'includes/custom-script.php';

        // FRONTEND-RENDER
        include ALITH_ELEMENTOR_POST_KITS_PATH.'widgets/post-grid/post-grid-frontend.php';

        $output .= $custom_style.$custom_script;
        printf('%s' , $output );
    }
}