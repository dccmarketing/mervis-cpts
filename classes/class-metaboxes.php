<?php
/**
 * The metabox-specific functionality of the plugin.
 *
 * @link 		http://example.com
 * @since 		1.0.0
 *
 * @package 	DocBlock
 * @subpackage 	DocBlock/classes
 */

/**
 * The metabox-specific functionality of the plugin.
 *
 * @package 	DocBlock
 * @subpackage 	DocBlock/classes
 * @author 		Your Name <email@example.com>
 */
class Class_Name_Metaboxes {

	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$meta    			The post meta data.
	 */
	private $meta;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_meta();

	} // __construct()

	/**
	 * Registers metaboxes with WordPress
	 *
	 * @since 	1.0.0
	 * @access 	public
	 */
	public function add_metaboxes() {

		//remove_meta_box( 'postimagediv', 'employee', 'side' );

		// add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );

		add_meta_box(
			'MERVIS_CPTS_metabox_name',
			apply_filters( MERVIS_CPTS_SLUG . '-metabox-name-title', esc_html__( 'Metabox Name', 'plugin-name' ) ),
			array( $this, 'metabox' ),
			'posttypename',
			'normal',
			'default',
			array(
				'file' => 'metabox-name'
			)
		);

	} // add_metaboxes()

	/**
	 * Changes strings referencing Featured Images
	 *
	 * @see 		https://developer.wordpress.org/reference/hooks/post_type_labels_post_type/
	 *
	 * @param 		object 		$labels 		Current post type labels
	 * @return 		object 						Modified post type labels
	 */
	public function change_featured_image_labels( $labels ) {

		$labels->featured_image 		= esc_html__( 'Featured Image', 'plugin-name' );
		$labels->set_featured_image 	= esc_html__( 'Set featured image', 'plugin-name' );
		$labels->remove_featured_image 	= esc_html__( 'Remove featured image', 'plugin-name' );
		$labels->use_featured_image 	= esc_html__( 'Use as featured image', 'plugin-name' );

		return $labels;

	} // change_featured_image_labels()

	/**
	 * Check each nonce. If any don't verify, $nonce_check is increased.
	 * If all nonces verify, returns 0.
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		int 		The value of $nonce_check
	 */
	private function check_nonces( $posted ) {

		$nonces 		= array();
		$nonce_check 	= 0;

		$nonces[] 	= 'nonce_MERVIS_CPTS_metabox_name';

		foreach ( $nonces as $nonce ) {

			if ( ! isset( $posted[$nonce] ) ) { $nonce_check++; }
			if ( isset( $posted[$nonce] ) && ! wp_verify_nonce( $posted[$nonce], MERVIS_CPTS_SLUG ) ) { $nonce_check++; }

		}

		return $nonce_check;

	} // check_nonces()

	/**
	 * Returns an array of the all the metabox fields and their respective types
	 *
	 * $fields[] 	= array( 'field-name', 'field-type', 'Field Label' );
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		array 		Metabox fields and types
	 */
	private function get_metabox_fields() {

		$fields = array();

		$fields[] = array( 'checkbox-field', 'checkbox', '' );
		$fields[] = array( 'editor-field', 'editor', '' );
		$fields[] = array( 'file-upload-field', 'file', '' );
		$fields[] = array( 'radios-field', 'radio', '' );
		$fields[] = array( 'select-field', 'select', '' );
		$fields[] = array( 'text-field', 'text', '' );
		$fields[] = array( 'textarea-field', 'textarea', '' );

		return $fields;

	} // get_metabox_fields()

	/**
	 * Calls a metabox file specified in the add_meta_box args.
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @return 	void
	 */
	public function metabox( $post, $params ) {

		if ( ! is_admin() ) { return; }
		if ( 'posttypename' != $post->post_type ) { return; }

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/metaboxes/' . $params['args']['file'] . '.php' );

	} // metabox()

	/**
	 * Add subtitle field to post editor
	 */
	public function metabox_subtitle( $post ) {

		if ( ! is_admin() ) { return; }
		if ( 'posttypename' !== $post->post_type ) { return; }

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/metaboxes/subtitle.php' );

	} // metabox_subtitle()

	/**
	 * Sets the class variable $options
	 */
	public function set_meta() {

		global $post;

		if ( empty( $post ) ) { return; }
		if ( 'posttypename' != $post->post_type ) { return; }

		$this->meta = get_post_custom( $post->ID );

	} // set_meta()

	/**
	 * Saves metabox data
	 *
	 * @since 		1.0.0
	 * @access 		public
	 *
	 * @param 		int 		$post_id 		The post ID
	 * @param 		object 		$post 			The post object
	 */
	public function validate_meta( $post_id, $post ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
		if ( 'posttypename' != $post->post_type ) { return $post_id; }

		$nonce_check = $this->check_nonces( $_POST );

		if ( 0 < $nonce_check ) { return $post_id; }

		$metas = $this->get_metabox_fields();

		foreach ( $metas as $meta ) {

			$value 		= ( empty( $this->meta[$meta[0]][0] ) ? '' : $this->meta[$meta[0]][0] );
			$sanitizer 	= new Class_Name_Sanitize();
			$new_value 	= $sanitizer->clean( $_POST[$meta[0]], $meta[1] );

			update_post_meta( $post_id, $meta[0], $new_value );

			unset( $value );
			unset( $sanitizer );
			unset( $new_value );

		} // foreach

	} // validate_meta()

} // class
