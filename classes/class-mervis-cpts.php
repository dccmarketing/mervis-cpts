<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link 		https://www.mervis.com
 * @since 		1.0.0
 *
 * @package 	Mervis_CPTS
 * @subpackage 	Mervis_CPTS/classes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since 		1.0.0
 * @package 	Mervis_CPTS
 * @subpackage 	Mervis_CPTS/classes
 * @author 		DCC Marketing <web@dccmarketing.com>
 * https://www.mervis.com
 */
class Mervis_CPTS_Mervis_CPTS {

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Plugin_Name 	$_instance 		Instance singleton.
	 */
	protected static $_instance;

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Mervis_CPTS_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		//$this->define_public_hooks();
		//$this->define_template_hooks();
		//$this->define_metabox_hooks();
		$this->define_cpt_and_tax_hooks();

	} // __construct()

	/**
	 * Creates an instance of the sanitizer and the loader, which will be used to
	 * register the hooks with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		$this->loader 		= new Mervis_CPTS_Loader();
		$this->sanitizer 	= new Mervis_CPTS_Sanitize();

	} // load_dependencies()

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Mervis_CPTS_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Mervis_CPTS_i18n();

		$this->loader->action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	} // set_locale()

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Mervis_CPTS_Admin();

		$this->loader->action( 'init', $plugin_admin, 'change_post_object_to_news' );
		$this->loader->filter( 'soliloquy_post_type_labels', $plugin_admin, 'relabel_soliloquy_to_sliders' );

	} // define_admin_hooks()

	/**
	 * Register all of the hooks related to metaboxes
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_cpt_and_tax_hooks() {

		$plugin_cpt_locations 		= new Mervis_CPTS_CPT_Locations();
		$plugin_cpt_notifications 	= new Mervis_CPTS_CPT_Notifications();
		$plugin_cpt_offers 			= new Mervis_CPTS_CPT_Offers();
		$plugin_cpt_pricing 		= new Mervis_CPTS_CPT_Pricing();

		$this->loader->action( 'init', $plugin_cpt_locations, 'new_cpt_locations' );
		$this->loader->action( 'init', $plugin_cpt_notifications, 'new_cpt_notifications' );
		$this->loader->action( 'init', $plugin_cpt_offers, 'new_cpt_offers' );
		$this->loader->action( 'init', $plugin_cpt_pricing, 'new_cpt_pricing' );



		$plugin_tax_projectcat = new Mervis_CPTS_Tax_ProjectCat();

		$this->loader->action( 'init', $plugin_tax_projectcat, 'new_taxonomy_projectcat' );



		$plugin_tax_loccat = new Mervis_CPTS_Tax_LocationCategory();

		$this->loader->action( 'init', $plugin_tax_loccat, 'new_taxonomy_locationcategory' );

	} // define_cpt_and_tax_hooks()

	/**
	 * Register all of the hooks related to metaboxes
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_metabox_hooks() {

		$plugin_metaboxes = new Mervis_CPTS_Metaboxes();

		$this->loader->action( 'add_meta_boxes_posttypename', $plugin_metaboxes, 'add_metaboxes' );
		$this->loader->action( 'save_post_posttypename', $plugin_metaboxes, 'validate_meta', 10, 2 );
		//$this->loader->action( 'edit_form_after_title', $plugin_metaboxes, 'metabox_subtitle', 10, 2 );
		$this->loader->action( 'add_meta_boxes_posttypename', $plugin_metaboxes, 'set_meta' );
		$this->loader->filter( 'post_type_labels_posttypename', $plugin_metaboxes, 'change_featured_image_labels', 10, 1 );

	} // define_metabox_hooks()

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Mervis_CPTS_Public();

		$this->loader->action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->filter( 'single_template', $plugin_public, 'single_cpt_template', 11 );
		$this->loader->shortcode( 'shortcodename', $plugin_public, 'shortcode_shortcodename' );

		/**
		 * Action instead of template tag.
		 *
		 * do_action( 'actionname' );
		 * 		or
		 * echo apply_filters( 'actionname' );
		 *
		 * @link 	http://nacin.com/2010/05/18/rethinking-template-tags-in-plugins/
		 */
		$this->loader->action( 'actionname', $plugin_public, 'shortcode_shortcodename' );

	} // define_public_hooks()

	/**
	 * Register all of the hooks related to the templates.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_template_hooks() {

		$plugin_templates = new Mervis_CPTS_Templates();

		// Loop
		$this->loader->action( 'mervis-cpts-before-loop', 			$plugin_templates, 'loop_wrap_begin', 10, 1 );

		$this->loader->action( 'mervis-cpts-before-loop-content', 	$plugin_templates, 'loop_content_wrap_begin', 10, 2 );
		$this->loader->action( 'mervis-cpts-before-loop-content', 	$plugin_templates, 'loop_content_link_begin', 15, 2 );

		$this->loader->action( 'mervis-cpts-loop-content', 			$plugin_templates, 'loop_content_image', 10, 2 );
		$this->loader->action( 'mervis-cpts-loop-content', 			$plugin_templates, 'loop_content_title', 15, 2 );
		$this->loader->action( 'mervis-cpts-loop-content', 			$plugin_templates, 'loop_content_subtitle', 20, 2 );

		$this->loader->action( 'mervis-cpts-after-loop-content', 	$plugin_templates, 'loop_content_link_end', 10, 2 );
		$this->loader->action( 'mervis-cpts-after-loop-content', 	$plugin_templates, 'loop_content_wrap_end', 90, 2 );

		$this->loader->action( 'mervis-cpts-after-loop', 			$plugin_templates, 'loop_wrap_end', 10, 1 );

		// Single
		$this->loader->action( 'mervis-cpts-single-content', 		$plugin_templates, 'single_posttypename_thumbnail', 10 );
		$this->loader->action( 'mervis-cpts-single-content', 		$plugin_templates, 'single_posttypename_posttitle', 15 );
		$this->loader->action( 'mervis-cpts-single-content', 		$plugin_templates, 'single_posttypename_subtitle', 20, 1 );
		$this->loader->action( 'mervis-cpts-single-content', 		$plugin_templates, 'single_posttypename_content', 25 );
		$this->loader->action( 'mervis-cpts-single-content', 		$plugin_templates, 'single_posttypename_meta_field', 30, 1 );

	} // define_template_hooks()

	/**
	 * Get instance of main class
	 *
	 * @since 		1.0.0
	 * @return 		Plugin_Name
	 */
	public static function get_instance() {

		if ( empty( self::$_instance ) ) {

			self::$_instance = new self;

		}

		return self::$_instance;

	} // get_instance()

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->loader->run();

	} // run()

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 *
	 * @return    Mervis_CPTS_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {

		return $this->loader;

	} // get_loader()

} // class
