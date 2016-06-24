<?php

/**
 * Fired during plugin activation
 *
 * @link 		http://example.com
 * @since 		1.0.0
 *
 * @package 	DocBlock
 * @subpackage 	DocBlock/classes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since 		1.0.0
 * @package 	DocBlock
 * @subpackage 	DocBlock/classes
 * @author 		Your Name <email@example.com>
 */
class Mervis_CPTS_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-cpt-posttypename.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-tax-taxonomyname.php';

		Mervis_CPTS_CPT_PostTypeName::new_cpt_posttypename();
		Mervis_CPTS_Tax_TaxonomyName::new_taxonomy_taxonomyname();

		flush_rewrite_rules();

		$opts 		= array();
		$options 	= Mervis_CPTS_Admin::get_options_list();

		foreach ( $options as $option ) {

			$opts[ $option[0] ] = $option[2];

		}

		update_option( 'mervis-cpts-options', $opts );

	} // activate()

} // class
