<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines a taxonomy and other related functionality.
 *
 * @link 		https://www.mervis.com
 * @since 		1.0.0
 *
 * @package 	Mervis_CPTS
 * @subpackage 	Mervis_CPTS/classes
 * @author		DCC Marketing <web@dccmarketing.com>
 */
class Mervis_CPTS_Tax_LocationCategory {

	/**
	 * Constructor
	 */
	public function __construct() {} // __construct()

	/**
	 * Creates a new taxonomy for a custom post type
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_taxonomy()
	 */
	public static function new_taxonomy_locationcategory() {

		$opts['description'] 							= '';
		$opts['hierarchical']							= TRUE;
		//$opts['meta_box_cb'] 							= '';
		$opts['public']									= TRUE;
		$opts['publicly_queryable']						= TRUE;
		$opts['query_var']								= TRUE;
		$opts['show_admin_column'] 						= FALSE;
		$opts['show_in_menu']							= TRUE;
		$opts['show_in_nav_menus']						= TRUE;
		$opts['show_in_quick_edit']						= TRUE;
		$opts['show_tag_cloud'] 						= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['sort'] 									= '';
		//$opts['update_count_callback'] 					= '';

		$opts['capabilities']['assign_terms'] 			= 'edit_posts';
		$opts['capabilities']['delete_terms'] 			= 'manage_categories';
		$opts['capabilities']['edit_terms'] 			= 'manage_categories';
		$opts['capabilities']['manage_terms'] 			= 'manage_categories';

		$opts['labels']['add_new_item'] 				= esc_html__( 'Add New Category', 'mervis-cpts' );
		$opts['labels']['add_or_remove_items'] 			= esc_html__( 'Add or remove Categories', 'mervis-cpts' );
		$opts['labels']['all_items'] 					= esc_html__( 'Categories', 'mervis-cpts' );
		$opts['labels']['choose_from_most_used'] 		= esc_html__( 'Choose from most used Categories', 'mervis-cpts' );
		$opts['labels']['edit_item'] 					= esc_html__( 'Edit Category', 'mervis-cpts');
		$opts['labels']['items_list'] 					= esc_html__( 'Categories', 'mervis-cpts');
		$opts['labels']['items_list_navigation'] 		= esc_html__( 'Categories', 'mervis-cpts');
		$opts['labels']['menu_name'] 					= esc_html__( 'Categories', 'mervis-cpts' );
		$opts['labels']['name'] 						= esc_html__( 'Categories', 'mervis-cpts' );
		$opts['labels']['new_item_name'] 				= esc_html__( 'New Category Name', 'mervis-cpts' );
		$opts['labels']['no_terms'] 					= esc_html__( 'No Categories', 'mervis-cpts' );
		$opts['labels']['not_found'] 					= esc_html__( 'No Categories Found', 'mervis-cpts' );
		$opts['labels']['parent_item'] 					= esc_html__( 'Parent Category', 'mervis-cpts' );
		$opts['labels']['parent_item_colon'] 			= esc_html__( 'Parent Category:', 'mervis-cpts' );
		$opts['labels']['popular_items'] 				= esc_html__( 'Popular Categories', 'mervis-cpts' );
		$opts['labels']['search_items'] 				= esc_html__( 'Search Categories', 'mervis-cpts' );
		$opts['labels']['separate_items_with_commas'] 	= esc_html__( 'Separate Categories with commas', 'mervis-cpts' );
		$opts['labels']['singular_name'] 				= esc_html__( 'Category', 'mervis-cpts' );
		$opts['labels']['update_item'] 					= esc_html__( 'Update Category', 'mervis-cpts' );
		$opts['labels']['view_item'] 					= esc_html__( 'View Category', 'mervis-cpts' );

		$opts['rewrite']['ep_mask']						= EP_NONE;
		$opts['rewrite']['hierarchical']				= FALSE;
		$opts['rewrite']['slug']						= esc_html__( 'category', 'mervis-cpts' );
		$opts['rewrite']['with_front']					= FALSE;

		$opts = apply_filters( 'mervis-cpts-taxonomy-locationcategory-options', $opts );

		register_taxonomy( 'location-category', 'locations', $opts );

	} // new_taxonomy_locationcategory()

} // class
