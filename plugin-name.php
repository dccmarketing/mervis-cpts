<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link 				http://example.com
 * @since 				1.0.0
 * @package 			DocBlock
 *
 * @wordpress-plugin
 * Plugin Name: 		WordPress Plugin Boilerplate
 * Plugin URI: 			http://example.com/mervis-cpts-uri/
 * Description: 		This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version: 			1.0.0
 * Author: 				Your Name or Your Company
 * Author URI: 			http://example.com/
 * License: 			GPL-2.0+
 * License URI: 		http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: 		plugin-name
 * Domain Path: 		/assets/languages
 *
 * Replacements (case sensitive):
 *
 * mervis-cpts- 					Files Refs, Actions, Filters, CSS classes, and script names
 * 'plugin-name' 					Text domain
 * DocBlock 						DocBlocks
 * Your Name <email@example.com> 	DockBlocks
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

/**
 * Define constants
 */
define( 'MERVIS_CPTS_VERSION', '1.0.0' );
define( 'MERVIS_CPTS_SLUG', 'plugin-name' );
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
		$paths = apply_filters( 'function-names-autoloader-paths', $paths );

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

		return Mervis_CPTS_Plugin_Name::get_instance();

	}

endif;
