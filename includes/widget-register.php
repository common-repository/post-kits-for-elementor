<?php
/**
 * @author  AliThemes
 */

namespace PostKitsForElementor\Widgets;

use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('Alith_Custom_Widget_Init') ) {
	class Alith_Custom_Widget_Init {
		public function __construct() {
			add_action( 'elementor/widgets/widgets_registered', array( $this, 'post_grid' ) );
			add_action( 'elementor/widgets/widgets_registered', array( $this, 'post_aside' ) );
			add_action( 'elementor/widgets/widgets_registered', array( $this, 'post_modules' ) );
			add_action( 'elementor/widgets/widgets_registered', array( $this, 'pke_elements' ) );
		}
		public function post_aside() {			
			require_once ( ALITH_ELEMENTOR_POST_KITS_WIDGETS_PATH . 'post-aside/post-aside-base.php');			
			require_once ( ALITH_ELEMENTOR_POST_KITS_WIDGETS_PATH . 'post-aside/post-aside-class.php');			
			$widgets = array(
				'post-aside-1'		=> 'Elementor_Post_Aside_Widgets_1',
				'post-aside-2'		=> 'Elementor_Post_Aside_Widgets_2',
				'post-aside-3'		=> 'Elementor_Post_Aside_Widgets_3',
				'post-aside-4'		=> 'Elementor_Post_Aside_Widgets_4',
				'post-aside-5'		=> 'Elementor_Post_Aside_Widgets_5',
				'post-aside-6'		=> 'Elementor_Post_Aside_Widgets_6',
			);
			foreach ( $widgets as $widget => $class ) {
				$classname = __NAMESPACE__ . '\\' . $class;
				Plugin::instance()->widgets_manager->register_widget_type( new $classname );
			}
		}

		public function post_grid() {			
			require_once ( ALITH_ELEMENTOR_POST_KITS_WIDGETS_PATH . 'post-grid/post-grid-base.php');			
			require_once ( ALITH_ELEMENTOR_POST_KITS_WIDGETS_PATH . 'post-grid/post-grid-class.php');			
			$widgets = array(
				'post-grid-1'		=> 'Elementor_Post_Grid_Widgets_1',
				'post-grid-2'		=> 'Elementor_Post_Grid_Widgets_2',
				'post-grid-3'		=> 'Elementor_Post_Grid_Widgets_3',
				'post-grid-4'		=> 'Elementor_Post_Grid_Widgets_4',
				'post-grid-5'		=> 'Elementor_Post_Grid_Widgets_5',
				'post-grid-6'		=> 'Elementor_Post_Grid_Widgets_6',
				'post-grid-7'		=> 'Elementor_Post_Grid_Widgets_7',
				'post-grid-8'		=> 'Elementor_Post_Grid_Widgets_8',
				'post-grid-9'		=> 'Elementor_Post_Grid_Widgets_9',
				'post-grid-10'		=> 'Elementor_Post_Grid_Widgets_10',
				'post-grid-11'		=> 'Elementor_Post_Grid_Widgets_11',
				'post-grid-12'		=> 'Elementor_Post_Grid_Widgets_12',
			);
			foreach ( $widgets as $widget => $class ) {
				$classname = __NAMESPACE__ . '\\' . $class;
				Plugin::instance()->widgets_manager->register_widget_type( new $classname );
			}
		}

		public function post_modules() {			
			require_once ( ALITH_ELEMENTOR_POST_KITS_WIDGETS_PATH . 'post-modules/post-modules-base.php');			
			require_once ( ALITH_ELEMENTOR_POST_KITS_WIDGETS_PATH . 'post-modules/post-modules-class.php');			
			$widgets = array(
				'post-module-1'		=> 'Elementor_Post_Module_Widgets_1',
				'post-module-2'		=> 'Elementor_Post_Module_Widgets_2',
				'post-module-3'		=> 'Elementor_Post_Module_Widgets_3',
				'post-module-4'		=> 'Elementor_Post_Module_Widgets_4',
				'post-module-5'		=> 'Elementor_Post_Module_Widgets_5',
				'post-module-6'		=> 'Elementor_Post_Module_Widgets_6',
				'post-module-7'		=> 'Elementor_Post_Module_Widgets_7',
				'post-module-8'		=> 'Elementor_Post_Module_Widgets_8',
				'post-module-9'		=> 'Elementor_Post_Module_Widgets_9',
				'post-module-10'	=> 'Elementor_Post_Module_Widgets_10',
				'post-module-11'	=> 'Elementor_Post_Module_Widgets_11',
				'post-module-12'	=> 'Elementor_Post_Module_Widgets_12',
				'post-module-13'	=> 'Elementor_Post_Module_Widgets_13',
				'post-module-14'	=> 'Elementor_Post_Module_Widgets_14',
				'post-module-15'	=> 'Elementor_Post_Module_Widgets_15',
				'post-module-16'	=> 'Elementor_Post_Module_Widgets_16',
				'post-module-17'	=> 'Elementor_Post_Module_Widgets_17',
				'post-module-18'	=> 'Elementor_Post_Module_Widgets_18',
			);
			foreach ( $widgets as $widget => $class ) {
				$classname = __NAMESPACE__ . '\\' . $class;
				Plugin::instance()->widgets_manager->register_widget_type( new $classname );
			}
		}
		public function pke_elements() {
        	
			require_once ( ALITH_ELEMENTOR_POST_KITS_WIDGETS_PATH . 'elements/pke-elements-portfolio-gallery.php');			

			$widgets = array(
				'pke-elements-portfolio-gallery'	=> 'Pke_Elements_Porfolio_Gallery',
			);
			foreach ( $widgets as $widget => $class ) {
				$classname = __NAMESPACE__ . '\\' . $class;
				Plugin::instance()->widgets_manager->register_widget_type( new $classname );
			}
		}
	}
}

new Alith_Custom_Widget_Init();