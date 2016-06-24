<?php

/**
 * Displays a metabox
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    DocBlock
 * @subpackage DocBlock/classes/views
 */

wp_nonce_field( MERVIS_CPTS_SLUG, 'nonce_MERVIS_CPTS_metabox_name' );

$atts 					= array();
$atts['class'] 			= '';
$atts['description'] 	= esc_html__( 'Checkbox Field', 'plugin-name' );
$atts['id'] 			= 'checkbox-field';
$atts['label'] 			= esc_html__( 'Checkbox Field', 'plugin-name' );
$atts['name'] 			= 'checkbox-field';
$atts['value'] 			= 0;

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( MERVIS_CPTS_SLUG . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/checkbox.php' );

?></p><?php



$atts 					= array();
$atts['description'] 	= '';
$atts['id'] 			= 'editor-field';
$atts['settings'] 		= array();
$atts['value']			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( MERVIS_CPTS_SLUG . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/editor.php' );

?></p><?php



$atts 					= array();
$atts['class'] 			= 'text widefat';
$atts['description'] 	= esc_html__( '', 'plugin-name' );
$atts['id'] 			= 'file-uploader-field';
$atts['label'] 			= esc_html__( '', 'plugin-name' );
$atts['label-remove'] 	= esc_html__( 'Remove File', 'plugin-name' );
$atts['label-upload'] 	= esc_html__( 'Upload/Choose File', 'plugin-name' );
$atts['name'] 			= 'file-uploader-field';
$atts['placeholder'] 	= esc_html__( '', 'plugin-name' );
$atts['type'] 			= 'url';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( MERVIS_CPTS_SLUG . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/file-upload.php' );

?></p><?php



$atts 					= array();
$atts['aria'] 			= esc_html__( 'Radio Field', 'plugin-name' );
$atts['class'] 			= 'widefat';
$atts['description'] 	= esc_html__( 'Radio Field Description', 'plugin-name' );
$atts['id'] 			= 'radios-field';
$atts['label'] 			= esc_html__( 'Radios Field', 'plugin-name' );
$atts['name'] 			= 'radios-field';
$atts['selections'][] 	= array( 'value' => 'example1', 'label' => esc_html__( 'Example 1', 'plugin-name' ) );
$atts['selections'][] 	= array( 'value' => 'example2', 'label' => esc_html__( 'Example 2', 'plugin-name' ) );
$atts['selections'][] 	= array( 'value' => 'example3', 'label' => esc_html__( 'Example 3', 'plugin-name' ) );
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( MERVIS_CPTS_SLUG . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/radios.php' );

?></p><?php



$atts 					= array();
$atts['aria'] 			= esc_html__( 'Select an option', 'plugin-name' );
$atts['blank'] 			= esc_html__( 'Select an option', 'plugin-name' );
$atts['class'] 			= 'widefat';
$atts['description'] 	= esc_html__( 'Select Field Description', 'plugin-name' );
$atts['id'] 			= 'select-field';
$atts['label'] 			= esc_html__( 'Select Field', 'plugin-name' );
$atts['name'] 			= 'select-field';
$atts['selections'][] 	= array( 'value' => 'example1', 'label' => esc_html__( 'Example 1', 'plugin-name' ) );
$atts['selections'][] 	= array( 'value' => 'example2', 'label' => esc_html__( 'Example 2', 'plugin-name' ) );
$atts['selections'][] 	= array( 'value' => 'example3', 'label' => esc_html__( 'Example 3', 'plugin-name' ) );
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( MERVIS_CPTS_SLUG . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/select.php' );

?></p><?php



$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= esc_html__( 'Text Field Description', 'plugin-name' );
$atts['id'] 			= 'text-field';
$atts['label'] 			= esc_html__( 'Text Field', 'plugin-name' );
$atts['name'] 			= 'text-field';
$atts['placeholder'] 	= esc_html__( '', 'plugin-name' );
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( MERVIS_CPTS_SLUG . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/text.php' );

?></p><?php



$atts 					= array();
$atts['class'] 			= 'large-text';
$atts['cols'] 			= 50;
$atts['description'] 	= esc_html__( 'Textarea Field Description', 'plugin-name' );
$atts['id'] 			= 'textarea-field';
$atts['label'] 			= esc_html__( 'Textarea Field', 'plugin-name' );
$atts['name'] 			= 'textarea-field';
$atts['rows'] 			= 10;
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( MERVIS_CPTS_SLUG . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/textarea.php' );

?></p>
