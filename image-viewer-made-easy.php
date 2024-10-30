<?php
/*
  Plugin Name: Image Viewer Made Easy
  Plugin URI: http://www.wpexpertdeveloper.com/image-viewer-made-easy/
  Description: Create aweosome Image Viewer for WordPress with image sliding, gallery, zooimng, rotating and sclaing features. 
  Version: 1.0
  Author: Rakhitha Nimesh
  Author URI: http://www.innovativephp.com
 */


// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

/* Main Class for Image Viewer Made Easy */
if( !class_exists( 'WIVME_Image_Viewer' ) ) {
    
    class WIVME_Image_Viewer{
    
        private static $instance;

        /* Create instances of plugin classes and initializing the features  */
        public static function instance() {
            
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WIVME_Image_Viewer ) ) {
                self::$instance = new WIVME_Image_Viewer();
                self::$instance->setup_constants();

                //add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
                self::$instance->includes();

                add_action('wp_enqueue_scripts',array(self::$instance,'load_scripts'),9);
                add_action('admin_enqueue_scripts', array(self::$instance,'load_admin_scripts'));
                 
                self::$instance->template_loader    = new WIVME_Template_Loader();
                self::$instance->image_viewer       = new WIVME_Viewer_Manager();
            }
            return self::$instance;
        }

        /* Setup constants for the plugin */
        private function setup_constants() {
            
            // Plugin version
            if ( ! defined( 'WIVME_VERSION' ) ) {
                define( 'WIVME_VERSION', '1.0' );
            }

            // Plugin Folder Path
            if ( ! defined( 'WIVME_PLUGIN_DIR' ) ) {
                define( 'WIVME_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
            }

            // Plugin Folder URL
            if ( ! defined( 'WIVME_PLUGIN_URL' ) ) {
                define( 'WIVME_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
            }

            if ( ! defined( 'WIVME_IMAGE_VIEWER_POST_TYPE' ) ) {
                define( 'WIVME_IMAGE_VIEWER_POST_TYPE', 'wivme_image_viewer');
            }
        }

        /* Load scripts and styles for frontend */
        public function load_scripts(){
          
            wp_register_style('wivme-front-style', WIVME_PLUGIN_URL . 'css/wivme-front.css');
            wp_enqueue_style('wivme-front-style');

            wp_register_script('wivme-front', WIVME_PLUGIN_URL.'js/wivme-front.js', array('jquery'));
            wp_enqueue_script('wivme-front');

            wp_register_style('wivme-image-viewer-style', WIVME_PLUGIN_URL . 'lib/viewer-master/viewer.css');
            wp_register_script('wivme-image-viewer-script', WIVME_PLUGIN_URL.'lib/viewer-master/viewer.js', array('jquery'));
         
        }

        public function load_admin_scripts(){
            wp_register_script('wivme-admin', WIVME_PLUGIN_URL.'js/wivme-admin.js', array('jquery','media-upload','thickbox'));
            wp_enqueue_script('wivme-admin');

            $wivme_admin = array(
                'AdminAjax' => admin_url('admin-ajax.php'),
                'images_path' =>  WIVME_PLUGIN_URL . 'images/',
                'addToViewer' => __('Add to Viewer','wivme'), 
                'insertToViewer' => __('Insert Images to Viewer','wivme'),      
            );
            wp_localize_script('wivme-admin', 'WIVMEAdmin', $wivme_admin);


            wp_register_style('wivme-admin-style', WIVME_PLUGIN_URL . 'css/wivme-admin.css');
            wp_enqueue_style('wivme-admin-style');
        }
        
        /* Include class files */
        private function includes() {

            require_once WIVME_PLUGIN_DIR . 'classes/class-wivme-template-loader.php';
            require_once WIVME_PLUGIN_DIR . 'classes/class-wivme-viewer-manager.php';
            require_once WIVME_PLUGIN_DIR . 'functions.php';

            if ( is_admin() ) {}
        }
    
    }
}

/* Intialize WIVME_Image_Viewer  instance */
function WIVME_Image_Viewer() {
    global $wivme;    
	$wivme = WIVME_Image_Viewer::instance();
}

WIVME_Image_Viewer();


















