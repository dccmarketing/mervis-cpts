<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link 		http://example.com
 * @since 		1.0.0
 *
 * @package 	DocBlock
 * @subpackage 	DocBlock/classes
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package 	DocBlock
 * @subpackage 	DocBlock/classes
 * @author 		Your Name <email@example.com>
 */
class Mervis_CPTS_Admin {

	/**
	 * The settings fields.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		array 			$fields 		The settings fields
	 */
	private $fields;

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
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->set_options();

	} // __construct()

	/**
	 * Adds a settings page link to a menu
	 *
	 * @link 		https://codex.wordpress.org/classesistration_Menus
	 * @since 		1.0.0
	 */
	public function add_menu() {

		// Top-level page
		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );

		// Submenu Page
		// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);

		add_submenu_page(
			'edit.php?post_type=posttypename',
			esc_html__( 'Plugin Name Settings', 'plugin-name' ),
			esc_html__( 'Settings', 'plugin-name' ),
			'manage_options',
			MERVIS_CPTS_SLUG . '-settings',
			array( $this, 'page_options' )
		);

		add_submenu_page(
			'edit.php?post_type=posttypename',
			esc_html__( 'Plugin Name Help', 'plugin-name' ),
			esc_html__( 'Help', 'plugin-name' ),
			'manage_options',
			MERVIS_CPTS_SLUG . '-help',
			array( $this, 'page_help' )
		);

	} // add_menu()

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( MERVIS_CPTS_SLUG, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/plugin-name-admin.css', array(), MERVIS_CPTS_VERSION, 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook_suffix ) {

		global $post;
		$screen = get_current_screen();

		wp_enqueue_media();

		wp_enqueue_script( MERVIS_CPTS_SLUG, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/plugin-name-admin.min.js', array( 'jquery' ), MERVIS_CPTS_VERSION, true );

	} // enqueue_scripts()

	/**
	 * Creates a checkbox field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 *
	 * @return 	string 						The HTML field
	 */
	public function field_checkbox( $args ) {

		$defaults['class'] 			= '';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= MERVIS_CPTS_SLUG . '-options[' . $args['id'] . ']';
		$defaults['value'] 			= 0;

		/**
		 * plugin-name-field-checkbox-options-defaults filter
		 *
		 * @param 	array 	$defaults 		The default settings for the field
		 */
		$defaults 	= apply_filters( MERVIS_CPTS_SLUG . '-field-checkbox-options-defaults', $defaults );
		$atts 		= wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/checkbox.php' );

	} // field_checkbox()

	/**
	 * Creates a text field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 *
	 * @return 	string 						The HTML field
	 */
	public function field_editor( $args ) {

		$defaults['description'] 	= '';
		$defaults['settings'] 		= array();
		$defaults['value']			= '';

		/**
		 * plugin-name-field-text-options-defaults filter
		 *
		 * @param 	array 	$defaults 		The default settings for the field
		 */
		$defaults 	= apply_filters( MERVIS_CPTS_SLUG . '-field-editor-options-defaults', $defaults );
		$atts 		= wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/editor.php' );

	} // field_editor()

	/**
	 * Creates a file uploader field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 *
	 * @return 	string 						The HTML field
	 */
	public function field_file_uploader( $args ) {

		$defaults['class'] 			= 'text widefat';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['label-remove'] 	= esc_html__( 'Remove File', 'plugin-name' );
		$defaults['label-upload'] 	= esc_html__( 'Upload/Choose File', 'plugin-name' );
		$defaults['name'] 			= MERVIS_CPTS_SLUG . '-options[' . $args['id'] . ']';
		$defaults['placeholder'] 	= '';
		$defaults['type'] 			= 'text';
		$defaults['value'] 			= '';

		/**
		 * plugin-name-field-text-options-defaults filter
		 *
		 * @param 	array 	$defaults 		The default settings for the field
		 */
		$defaults 	= apply_filters( MERVIS_CPTS_SLUG . '-field-file-upload-options-defaults', $defaults );
		$atts 		= wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/file-upload.php' );

	} // field_file_uploader()

	/**
	 * Creates a set of radios field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 *
	 * @return 	string 						The HTML field
	 */
	public function field_radios( $args ) {

		$defaults['class'] 			= '';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= MERVIS_CPTS_SLUG . '-options[' . $args['id'] . ']';
		$defaults['value'] 			= 0;

		/**
		 * plugin-name-field-radios-options-defaults filter
		 *
		 * @param 	array 	$defaults 		The default settings for the field
		 */
		$defaults 	= apply_filters( MERVIS_CPTS_SLUG . '-field-radios-options-defaults', $defaults );
		$atts 		= wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/radios.php' );

	} // field_radios()

	/**
	 * Creates a select field
	 *
	 * Note: label is blank since its created in the Settings API
	 *
	 * @param 	array 		$args 			The arguments for the field
	 *
	 * @return 	string 						The HTML field
	 */
	public function field_select( $args ) {

		$defaults['aria'] 			= '';
		$defaults['blank'] 			= '';
		$defaults['class'] 			= '';
		$defaults['context'] 		= '';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= MERVIS_CPTS_SLUG . '-options[' . $args['id'] . ']';
		$defaults['selections'] 	= array();
		$defaults['value'] 			= '';

		/**
		 * plugin-name-field-select-options-defaults filter
		 *
		 * @param 	array 	$defaults 		The default settings for the field
		 */
		$defaults 	= apply_filters( MERVIS_CPTS_SLUG . '-field-select-options-defaults', $defaults );
		$atts 		= wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		if ( empty( $atts['aria'] ) && ! empty( $atts['description'] ) ) {

			$atts['aria'] = $atts['description'];

		} elseif ( empty( $atts['aria'] ) && ! empty( $atts['label'] ) ) {

			$atts['aria'] = $atts['label'];

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/select.php' );

	} // field_select()

	/**
	 * Creates a text field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 *
	 * @return 	string 						The HTML field
	 */
	public function field_text( $args ) {

		$defaults['class'] 			= 'text widefat';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= MERVIS_CPTS_SLUG . '-options[' . $args['id'] . ']';
		$defaults['placeholder'] 	= '';
		$defaults['type'] 			= 'text';
		$defaults['value'] 			= '';

		/**
		 * plugin-name-field-text-options-defaults filter
		 *
		 * @param 	array 	$defaults 		The default settings for the field
		 */
		$defaults 	= apply_filters( MERVIS_CPTS_SLUG . '-field-text-options-defaults', $defaults );
		$atts 		= wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/text.php' );

	} // field_text()

	/**
	 * Creates a textarea field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 *
	 * @return 	string 						The HTML field
	 */
	public function field_textarea( $args ) {

		$defaults['class'] 			= 'large-text';
		$defaults['cols'] 			= 50;
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= MERVIS_CPTS_SLUG . '-options[' . $args['id'] . ']';
		$defaults['rows'] 			= 10;
		$defaults['value'] 			= '';

		/**
		 * plugin-name-field-textarea-options-defaults filter
		 *
		 * @param 	array 	$defaults 		The default settings for the field
		 */
		$defaults 	= apply_filters( MERVIS_CPTS_SLUG . '-field-textarea-options-defaults', $defaults );
		$atts 		= wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/textarea.php' );

	} // field_textarea()

	/**
	 * Returns an array of options names, fields types, and default values
	 *
	 * @return 		array 			An array of options
	 */
	public static function get_options_list() {

		$options = array();

		$options[] = array( 'checkbox-field', 'checkbox', '' );
		$options[] = array( 'editor-field', 'editor', '' );
		$options[] = array( 'file-upload-field', 'file', '' );
		$options[] = array( 'radios-field', 'radio', '' );
		$options[] = array( 'select-field', 'select', '' );
		$options[] = array( 'text-field', 'text', '' );
		$options[] = array( 'textarea-field', 'textarea', '' );

		return $options;

	} // get_options_list()

	/**
	 * Adds a link to the plugin settings page
	 *
	 * @since 		1.0.0
	 *
	 * @param 		array 		$links 		The current array of links
	 *
	 * @return 		array 					The modified array of links
	 */
	public function link_settings( $links ) {

		$links[] = sprintf( '<a href="%s">%s</a>', admin_url( 'edit.php?post_type=posttypename&page=plugin-name-settings' ), esc_html__( 'Settings', 'plugin-name' ) );

		return $links;

	} // link_settings()

	/**
	 * Adds links to the plugin links row
	 *
	 * @since 		1.0.0
	 *
	 * @param 		array 		$links 		The current array of row links
	 * @param 		string 		$file 		The name of the file
	 *
	 * @return 		array 					The modified array of row links
	 */
	public function link_row_meta( $links, $file ) {

		if ( $file == MERVIS_CPTS_FILE ) {

			$links[] = '<a href="http://twitter.com/slushman">Twitter</a>';

		}

		return $links;

	} // link_row_meta()

	/**
	 * Includes the help page view
	 *
	 * @since 		1.0.0
	 *
	 * @return 		void
	 */
	public function page_help() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/pages/help.php' );

	} // page_help()

	/**
	 * Includes the options page view
	 *
	 * @since 		1.0.0
	 *
	 * @return 		void
	 */
	public function page_options() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/pages/settings.php' );

	} // page_options()

	/**
	 * Registers settings fields with WordPress
	 */
	public function register_fields() {

		// add_settings_field( $id, $title, $callback, $menu_slug, $section, $args );

		add_settings_field(
			'text-field',
			apply_filters( MERVIS_CPTS_SLUG . '-label-text-field', esc_html__( 'Text Field', 'plugin-name' ) ),
			array( $this, 'field_text' ),
			MERVIS_CPTS_SLUG,
			MERVIS_CPTS_SLUG . '-settingssection',
			array(
				'description' 	=> esc_html__( 'Text field description.', 'plugin-name' ),
				'id' 			=> 'text-field',
				'value' 		=> '',
			)
		);

		add_settings_field(
			'select-field',
			apply_filters( MERVIS_CPTS_SLUG . '-label-select-field', esc_html__( 'Select Field', 'plugin-name' ) ),
			array( $this, 'field_select' ),
			MERVIS_CPTS_SLUG,
			MERVIS_CPTS_SLUG . '-settingssection',
			array(
				'description' 	=> esc_html__( 'Select description.', 'plugin-name' ),
				'id' 			=> 'select-field',
				'selections'	=> array(
					array( 'label' => esc_html__( 'Label', 'plugin-name' ), 'value' => 'value' ),
				),
				'value' 		=> ''
			)
		);

		add_settings_field(
			'editor-field',
			apply_filters( MERVIS_CPTS_SLUG . 'label-editor-field', esc_html__( 'Editor Field', 'plugin-name' ) ),
			array( $this, 'field_editor' ),
			MERVIS_CPTS_SLUG,
			MERVIS_CPTS_SLUG . '-settingssection',
			array(
				'description' 	=> esc_html__( 'Editor field description.', 'plugin-name' ),
				'id' 			=> 'howtoapply'
			)
		);

		add_settings_field(
			'checkbox-field',
			apply_filters( MERVIS_CPTS_SLUG . '-label-checkbox-field', esc_html__( 'Checkbox Field', 'plugin-name' ) ),
			array( $this, 'field_checkbox' ),
			MERVIS_CPTS_SLUG,
			MERVIS_CPTS_SLUG . '-settingssection',
			array(
				'description' 	=> esc_html__( 'Checkbox description.', 'plugin-name' ),
				'id' 			=> 'checkbox-field',
				'value' 		=> '',
			)
		);

		add_settings_field(
			'radios-field',
			apply_filters( MERVIS_CPTS_SLUG . '-label-radios-field', esc_html__( 'Radios Field', 'plugin-name' ) ),
			array( $this, 'field_radios' ),
			MERVIS_CPTS_SLUG,
			MERVIS_CPTS_SLUG . '-settingssection',
			array(
				'description' 	=> esc_html__( 'Radio fields description.', 'plugin-name' ),
				'id' 			=> 'radios-field',
				'selections' 	=> array(
					array( 'label' => esc_html__( 'Label 1', 'plugin-name' ), 'value' => 'value1' ),
					array( 'label' => esc_html__( 'Label 2', 'plugin-name' ), 'value' => 'value2' ),
					array( 'label' => esc_html__( 'Label 3', 'plugin-name' ), 'value' => 'value3' ),
				),
				'value' 		=> '',
			)
		);

		add_settings_field(
			'textarea-field',
			apply_filters( MERVIS_CPTS_SLUG . '-label-textarea-field', esc_html__( 'Textarea Field', 'plugin-name' ) ),
			array( $this, 'field_textarea' ),
			MERVIS_CPTS_SLUG,
			MERVIS_CPTS_SLUG . '-settingssection',
			array(
				'description' 	=> esc_html__( 'Textarea description.', 'plugin-name' ),
				'id' 			=> 'textarea-field',
				'value' 		=> '',
			)
		);

		add_settings_field(
			'file-upload-field',
			apply_filters( MERVIS_CPTS_SLUG . '-label-file-upload-field', esc_html__( 'File Upload Field', 'plugin-name' ) ),
			array( $this, 'field_file_uploader' ),
			MERVIS_CPTS_SLUG,
			MERVIS_CPTS_SLUG . '-settingssection',
			array(
				'description' 	=> esc_html__( 'File uploader description.', 'plugin-name' ),
				'id' 			=> 'file-upload-field',
				'value' 		=> '',
			)
		);

	} // register_fields()

	/**
	 * Registers settings sections with WordPress
	 */
	public function register_sections() {

		// add_settings_section( $id, $title, $callback, $menu_slug );

		add_settings_section(
			MERVIS_CPTS_SLUG . '-settingssection',
			apply_filters( MERVIS_CPTS_SLUG . '-section-settingssection-title', esc_html__( 'Settings Section', 'plugin-name' ) ),
			array( $this, 'section_settingssection' ),
			MERVIS_CPTS_SLUG
		);

	} // register_sections()

	/**
	 * Registers plugin settings
	 *
	 * @since 		1.0.0
	 */
	public function register_settings() {

		// register_setting( $option_group, $option_name, $sanitize_callback );

		register_setting(
			MERVIS_CPTS_SLUG . '-options',
			MERVIS_CPTS_SLUG . '-options',
			array( $this, 'validate_options' )
		);

	} // register_settings()

	/**
	 * Displays a settings section
	 *
	 * @since 		1.0.0
	 *
	 * @param 		array 		$params 		Array of parameters for the section
	 *
	 * @return 		mixed 						The settings section
	 */
	public function section_settingssection( $params ) {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/sections/settingssection.php' );

	} // section_settingssection()

	/**
	 * Sets the class variable $options
	 */
	private function set_options() {

		$this->options = get_option( MERVIS_CPTS_SLUG . '-options' );

	} // set_options()

	/**
	 * Validates saved options
	 *
	 * @since 		1.0.0
	 *
	 * @param 		array 		$input 			array of submitted plugin options
	 *
	 * @return 		array 						array of validated plugin options
	 */
	public function validate_options( $input ) {

		$valid 		= array();
		$options 	= $this->get_options_list();

		foreach ( $options as $option ) {

			$sanitizer 			= new Mervis_CPTS_Sanitize();
			$valid[$option[0]] 	= $sanitizer->clean( $input[$option[0]], $option[1] );

			if ( $valid[$option[0]] != $input[$option[0]] ) {

				add_settings_error( $option[0], $option[0] . '_error', esc_html__( $option[0] . ' error.', 'plugin-name' ), 'error' );

			}

			unset( $sanitizer );

		}

		return $valid;

	} // validate_options()

} // class
