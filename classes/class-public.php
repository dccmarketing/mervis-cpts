<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link 		http://example.com
 * @since 		1.0.0
 *
 * @package 	DocBlock
 * @subpackage 	DocBlock/classes
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package 	DocBlock
 * @subpackage 	DocBlock/classes
 * @author 		Your Name <email@example.com>
 */
class Class_Name_Public {

	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$meta    			The post meta data.
	 */
	private $meta;

	/**
	 * The plugin options.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$options 		The plugin options.
	 */
	private $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->set_options();
		$this->set_meta();

	} // __construct()

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( MERVIS_CPTS_SLUG, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/plugin-name-public.css', array(), MERVIS_CPTS_VERSION, 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( MERVIS_CPTS_SLUG, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/plugin-name-public.min.js', array( 'jquery' ), MERVIS_CPTS_VERSION, true );

	} // enqueue_scripts()

	/**
	 * Sets the class variable $options
	 */
	public function set_meta() {

		global $post;

		if ( empty( $post ) ) { return; }
		if ( 'posttypename' !== $post->post_type ) { return; }

		$this->meta = get_post_custom( $post->ID );

	} // set_meta()

	/**
	 * Sets the class variable $options
	 */
	private function set_options() {

		$this->options = get_option( MERVIS_CPTS_SLUG . '-options' );

	} // set_options()

	/**
	 * Processes shortcode shortcodename
	 *
	 * @param 	array 	$atts 		Shortcode attributes
	 *
	 * @return	mixed	$output		Output of the buffer
	 */
	public function shortcode_shortcodename( $atts = array() ) {

		ob_start();

		$defaults['taxonomyname'] 	= '';
		$defaults['loop-template'] 	= MERVIS_CPTS_SLUG . '-loop';
		$defaults['order'] 			= 'ASC';
		$defaults['quantity'] 		= 100;
		$defaults['show'] 			= '';
		$args						= shortcode_atts( $defaults, $atts, 'shortcodename' );
		$shared 					= new Class_Name_Shared( MERVIS_CPTS_SLUG, MERVIS_CPTS_VERSION );
		$items 						= $shared->query( $args );

		if ( is_array( $items ) || is_object( $items ) ) {

			include MERVIS_CPTS_et_template( $args['loop-template'], 'loop' );

		} else {

			echo $items;

		}

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // shortcode_shortcodename()

} // class
