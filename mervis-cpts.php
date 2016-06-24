<?php

/**
 * The plugin bootstrap file
 *
 * @link 				https://www.mervis.com
 * @since 				1.0.0
 * @package 			Mervis_CPTS
 *
 * @wordpress-plugin
 * Plugin Name: 		Mervis CPTS
 * Plugin URI: 			https://www.mervis.com
 * Description: 		Custom post types for Mervis site.
 * Version: 			1.0.0
 * Author: 				DCC Marketing
 * Author URI: 			http://www.dccmarketing.com/
 * License: 			GPL-2.0+
 * License URI: 		http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: 		mervis-cpts
 * Domain Path: 		/assets/languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

/**
 * Define constants
 */
define( 'MERVIS_CPTS_VERSION', '1.0.0' );
define( 'MERVIS_CPTS_SLUG', 'mervis-cpts' );
define( 'MERVIS_CPTS_FILE', plugin_basename( __FILE__ ) );

/**
 * Activation/Deactivation Hooks
 */
register_activation_hook( __FILE__, array( 'Mervis_CPTS_Activator', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Mervis_CPTS_Deactivator', 'deactivate' ) );

/**
 * Autoloader function
 *
 * Will search both plugin root and includes folder for class
 *
 * @param string $class_name
 */
if ( ! function_exists( 'MERVIS_CPTS_autoloader' ) ) :

	function MERVIS_CPTS_autoloader( $class_name ) {

		$class_name = str_replace( 'Mervis_CPTS_', '', $class_name );
		$lower 		= strtolower( $class_name );
		$file      	= 'class-' . str_replace( '_', '-', $lower ) . '.php';
		$base_path 	= plugin_dir_path( __FILE__ );
		$paths[] 	= $base_path . $file;
		$paths[] 	= $base_path . 'classes/' . $file;

		/**
		 * MERVIS_CPTS_autoloader_paths filter
		 */
		$paths = apply_filters( 'mervis-cpts-autoloader-paths', $paths );

		foreach ( $paths as $path ) :

			if ( is_readable( $path ) && file_exists( $path ) ) {

				require_once( $path );
				return;

			}

		endforeach;

	} // MERVIS_CPTS_autoloader()

endif;

spl_autoload_register( 'MERVIS_CPTS_autoloader' );

if ( ! function_exists( 'MERVIS_CPTS_init' ) ) :

	/**
	 * Function to initialize plugin
	 */
	function MERVIS_CPTS_init() {

		plugin_name()->run();

	}

	add_action( 'plugins_loaded', 'MERVIS_CPTS_init' );

endif;

if ( ! function_exists( 'plugin_name' ) ) :

	/**
	 * Function wrapper to get instance of plugin
	 *
	 * @return Plugin_Name
	 */
	function plugin_name() {

		return Mervis_CPTS_Mervis_CPTS::get_instance();

	}

endif;
