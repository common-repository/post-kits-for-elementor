<?php
/**
	Plugin Name: Post Kits for Elementor
	Description: News, Magazine, Blog Kits for Elementor plugin.
	Plugin URI: https://alithemes.com
	Version: 3.2
	Author: AliThemes
	Author URI: alithemes.com
	Text Domain: post-kits-for-elementor
*/

//Declare some constant
define( 'ALITH_ELEMENTOR_POST_KITS_PREFIX', 'alith_' );
define( 'ALITH_ELEMENTOR_POST_KITS_PATH', plugin_dir_path( __FILE__ ) );
define( 'ALITH_ELEMENTOR_POST_KITS_INC_PATH', trailingslashit(ALITH_ELEMENTOR_POST_KITS_PATH.'includes' ));
define( 'ALITH_ELEMENTOR_POST_KITS_WIDGETS_PATH', trailingslashit(ALITH_ELEMENTOR_POST_KITS_PATH.'widgets' ));
define( 'ALITH_ELEMENTOR_POST_KITS_URL', plugin_dir_url( __FILE__ ) );
define( 'ALITH_ELEMENTOR_POST_KITS_CSS', plugins_url( 'assets/css/', __FILE__ ) );
define( 'ALITH_ELEMENTOR_POST_KITS_JS', plugins_url( 'assets/js/', __FILE__ ) );
define( 'ALITH_ELEMENTOR_POST_KITS_IMG', trailingslashit(plugins_url( 'assets/images/', __FILE__ ) ));

// No direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if( ! class_exists('Alith_Post_Kits_For_Elementor') ) {
    class Alith_Post_Kits_For_Elementor  {

        private static $instance = null;
        public $action  = 'alith_theme_init';

        const  MINIMUM_ELEMENTOR_VERSION = '1.7.0' ;

        public function __construct() {
            add_action( 'plugins_loaded', [ $this, 'init' ] );
             // Add new Elementor Categories
            add_action( 'elementor/init', [ $this, 'add_elementor_category' ] );

             // Register Widget Scripts
            add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_widget_scripts' ] );

             // Register Widget Styles
            add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'register_widget_styles' ] );

             // Register Elementor Backend Styles
            add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'register_elementor_backend_styles' ) );

             // Register New Widgets
            add_action( 'after_setup_theme', array( $this, 'elementor_widgets' ) );
            
        }
        public function init() {
            // Load text domain
            load_plugin_textdomain( 'alith_epk', false, ALITH_ELEMENTOR_POST_KITS_PATH . '/languages/' );

         	// Check for required Elementor plugin
            if ( !did_action( 'elementor/loaded' ) ) {
                add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
                return;
            }

            // Check for required Elementor version
            if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
                add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
                return;
            }

            //Add Colorpicker Custom Field
            require_once ( ALITH_ELEMENTOR_POST_KITS_INC_PATH . 'colorpicker.php');
        }

        public function elementor_widgets(){            
            require_once ( ALITH_ELEMENTOR_POST_KITS_INC_PATH . 'widget-register.php');
        }

        public function register_widget_styles() {
             wp_enqueue_style('elementor-post-kits-bootstrap',ALITH_ELEMENTOR_POST_KITS_CSS . 'bootstrap.min.css',array(),'1.0.0');
             wp_enqueue_style('elementor-post-kits-swiper',ALITH_ELEMENTOR_POST_KITS_CSS . 'swiper.css',array(),'1.0.0');
             wp_enqueue_style('elementor-post-kits-themify-icons',ALITH_ELEMENTOR_POST_KITS_CSS . 'themify-icons.css',array(),'1.0.0');
             wp_enqueue_style('elementor-post-kits-frontend-style',ALITH_ELEMENTOR_POST_KITS_CSS . 'frontend-style.css',array(),'1.0.0');
             wp_enqueue_style('elementor-post-kits-responsive',ALITH_ELEMENTOR_POST_KITS_CSS . 'responsive.css',array(),'1.0.0');
             
             wp_enqueue_style('elementor-post-kits-widget-porfolio',ALITH_ELEMENTOR_POST_KITS_CSS . 'widget-porfolio.css',array(),'1.0.0');
        }

        public function register_elementor_backend_styles() {           
            wp_enqueue_style('elementor-post-kits-backend-style',ALITH_ELEMENTOR_POST_KITS_CSS . 'backend-style.css',array(),'1.0.0');
        }

        public function register_widget_scripts() {
             wp_enqueue_script('elementor_post_kits_main_script', ALITH_ELEMENTOR_POST_KITS_JS . 'main-script.js' ,array(),'1.0.0',true);
             wp_enqueue_script('swiper_js', ALITH_ELEMENTOR_POST_KITS_JS . 'swiper.js' ,array(),'1.0.0',true);
             wp_enqueue_script('jquery_filterizr_js', ALITH_ELEMENTOR_POST_KITS_JS . 'jquery.filterizr.min.js' ,array(),'1.0.0',true);
             wp_enqueue_script('alith_filterizr', ALITH_ELEMENTOR_POST_KITS_JS . 'alith-filterizr.js' ,array(),'1.0.0',true);
             
        }

         public function add_elementor_category()  {

            $categories = array (
                'Alith_Elementor_Post_Modules'  => esc_html__( 'EPK Post Modules', 'alith_epk' ),
                'Alith_Elementor_Post_Grid'     => esc_html__( 'EPK Post Grid', 'alith_epk' ),
                'Alith_Elementor_Post_Aside'    => esc_html__( 'EPK Post Aside', 'alith_epk' ),
                'Alith_Elementor_Elements'      => esc_html__( 'EPK Post Elements', 'alith_epk' ),
            );

            foreach ( $categories as $id => $title ) {
                \Elementor\Plugin::instance()->elements_manager->add_category( $id, ['title' => $title], 1 );
            }
         }

         public function admin_notice_missing_main_plugin()
         {
             $message = sprintf(
             /* translators: 1: ithemelandco Elements 2: Elementor */
                 esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'alith_epk' ),
                 '<strong>' . esc_html__( 'Elementor Post Kits', 'alith_epk' ) . '</strong>',
                 '<strong>' . esc_html__( 'Elementor plugin', 'alith_epk' ) . '</strong>'
             );
             printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
         }

         public function admin_notice_minimum_elementor_version()
         {
             $message = sprintf(
             /* translators: 1: Press Elements 2: Elementor 3: Required Elementor version */
                 esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'alith_epk' ),
                 '<strong>' . esc_html__( 'Elementor Post Kits', 'alith_epk' ) . '</strong>',
                 '<strong>' . esc_html__( 'Elementor', 'alith_epk' ) . '</strong>',
                 self::MINIMUM_ELEMENTOR_VERSION
             );
             printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
        }

        public static function get_instance() {
            if( self::$instance == null ) {
                self::$instance = new self;
            }
            return self::$instance;
        }

    }
}

if ( ! function_exists( 'elementor_post_kits' ) ) {    
    function elementor_post_kits() {
        return Alith_Post_Kits_For_Elementor::get_instance();
    }
}

elementor_post_kits();