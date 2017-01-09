<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link 		https://www.mervis.com
 * @since 		1.0.0
 *
 * @package 	Mervis_CPTS
 * @subpackage 	Mervis_CPTS/classes
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package 	Mervis_CPTS
 * @subpackage 	Mervis_CPTS/classes
 * @author 		DCC Marketing <web@dccmarketing.com>
 */
class Mervis_CPTS_Admin {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {} // __construct()

	/**
	 * Relabels the Soliloquy menu item to "Sliders"
	 *
	 * @param 		array 		$cpt_labels 		The Soliloquy post type labels
	 * @return 		array 							The modified Soliloquy post type labels
	 */
	public function relabel_soliloquy_to_sliders( $cpt_labels ) {

		if ( empty( $cpt_labels ) ) { return $cpt_labels; }

		$cpt_labels['menu_name'] = __( 'Sliders', 'mervis-cpts' );

		return $cpt_labels;

	} // relabel_soliloquy_to_sliders()

	/**
	 * Relabels the Soliloquy menu item to "Sliders"
	 *
	 * @param 		array 		$cpt_labels 		The Soliloquy post type labels
	 * @return 		array 							The modified Soliloquy post type labels
	 */
	public function change_post_object_to_news() {

		global $wp_post_types;

		$labels 					= &$wp_post_types['post']->labels;
		$labels->name 				= 'News';
		$labels->singular_name 		= 'News';
		$labels->add_new 			= 'Add News';
		$labels->add_new_item 		= 'Add News';
		$labels->edit_item 			= 'Edit News';
		$labels->new_item 			= 'News';
		$labels->view_item 			= 'View News';
		$labels->search_items 		= 'Search News';
		$labels->not_found 			= 'No News found';
		$labels->not_found_in_trash = 'No News found in Trash';
		$labels->all_items 			= 'All News';
		$labels->menu_name 			= 'News';
		$labels->name_admin_bar 	= 'News';

	} // change_post_object_to_news

} // class
