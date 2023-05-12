<?PHP
// error_reporting(E_ERROR | E_WARNING | E_PARSE);
// error_reporting(E_ALL);
/**
 * @package MhTestimonial
 */
/*
Plugin Name: Mahbub Testimonial
Plugin URI: https://wordpress.org/mh-testimonial
Description: this is Simple Testimonial Slider Plugin
Version: 1.0
Requires at least: 5.5
Requires PHP: 7.00
Author: Mahbub Hussain
Author URI: https://mahbub.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: mh-testimonial
Domain Path :/languages
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2023 Mahbub Hussain.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}


if(!class_exists('Mh_Testimonial')){
	/**
	 * Summary of MH_Slider
	 */
	class Mh_Testimonial{
		/**
		 * Summary of __construct
		 */
		function __construct()
        {
			$this->define_constants();
            
            // call cpt
            require_once(MH_TESTIMONIAL_PATH . './classess/custom-cpt/Mh-Testimonial-Cpt.php');
            $mh_cpt = new Mh_Testimonial_Cpt(); 
            
            //metaboxes call 

            require_once(MH_TESTIMONIAL_PATH . '/classess/metaboxes/Mh-Metaboxes.php');
            $mh_metaboxes = new Mh_Testimonial_cpt_metaboxex();

			// widget call 
			require_once(MH_TESTIMONIAL_PATH . './widgets/Mh-Testimonial-Widget.php');
			$mh_widget_obj = new Mh_Testimonial_Widgets();

			// template files 
			require_once(MH_TESTIMONIAL_PATH . '/functions/Testimonials-templates.php');
			$mh_tes_tem = new Testimonials_Templates_Files();
		}

		/**
		 * Summary of define_constants
		 * @return void
		 */
		public function define_constants():void
		{
			define('MH_TESTIMONIAL_PATH', plugin_dir_path(__FILE__));
			define('MH_TESTIMONIAL_URL', plugin_dir_url(__FILE__));
			define('MH_TESTIMONIAL_VERSION', '1.00');
			define ( 'MH_TESTIMONIAL_OVERRIDE_PATH_DIR', get_stylesheet_directory() . '/mh-testimonials/' );

		}

		 public function load_textdomain()
		{
			load_plugin_textdomain(
				'mh-testimonial',
				false,
				dirname(plugin_basename(__FILE__)).'/languages/'
			);
		}
		
		// public function register_script():void
		// {
		// 	wp_register_script('mh-slider-min-js', MH_SLIDER_URL . './vendor/flexslider/jquery.flexslider-min.js', array('jquery'), MH_SLIDER_VERSION, true);
		// 	wp_register_style('mh-slider-main-css', MH_SLIDER_URL .'./vendor/flexslider/flexslider.css',array(),MH_SLIDER_VERSION,'all');
		// 	wp_register_style('mh-slider-custom-css', MH_SLIDER_URL .'./assets/css/custom.css',array(),MH_SLIDER_VERSION,'all');
		// }
		// public function admin_register_scripts():void
		// {
		// 	global $typenow;
		// 	if($typenow == 'mh-slider'){
        //       wp_enqueue_style('mh-slider-admin-css', MH_SLIDER_URL .'./assets/css/admin.css',array(),MH_SLIDER_VERSION,'all');
		// 	}
			
		// }

		public static function activate():void
		{
			update_option('rewrite_rules','');
		}

		public static function deactivate():void 
		{
			flush_rewrite_rules();
			unregister_post_type('mh-testimonial');
		}
		
	}
}


if(class_exists('MH_Slider')){
	register_activation_hook(__FILE__, array('Mh_Testimonial','activate'));
	register_deactivation_hook(__FILE__, array('Mh_Testimonial','deactivate'));
	//register_uninstall_hook(__FILE__, array('MH_Slider','unistall'));
	$mv_slider = new Mh_Testimonial();
}


