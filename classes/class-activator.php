<?php

/**
 * Fired during plugin activation
 *
 * @link 		https://www.mervis.com
 * @since 		1.0.0
 *
 * @package 	Mervis_CPTS
 * @subpackage 	Mervis_CPTS/classes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since 		1.0.0
 * @package 	Mervis_CPTS
 * @subpackage 	Mervis_CPTS/classes
 * @author 		DCC Marketing <web@dccmarketing.com>
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-cpt-locations.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-cpt-notifications.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-cpt-offers.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-cpt-pricing.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-tax-projectcat.php';

		Mervis_CPTS_CPT_Locations::new_cpt_locations();
		Mervis_CPTS_CPT_Notifications::new_cpt_notifications();
		Mervis_CPTS_CPT_Offers::new_cpt_offers();
		Mervis_CPTS_CPT_Pricing::new_cpt_pricing();
		Mervis_CPTS_Tax_ProjectCat::new_taxonomy_projectcat();

		flush_rewrite_rules();

		$opts 		= array();
		$options 	= Mervis_CPTS_Admin::get_options_list();

		foreach ( $options as $option ) {

			$opts[ $option[0] ] = $option[2];

		}

		update_option( 'mervis-cpts-options', $opts );

	} // activate()

} // class
