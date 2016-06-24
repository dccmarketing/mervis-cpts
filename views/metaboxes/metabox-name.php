<?php

/**
 * Displays a metabox
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Mervis_CPTS
 * @subpackage Mervis_CPTS/classes/views
 */

wp_nonce_field( MERVIS_CPTS_SLUG, 'nonce_MERVIS_CPTS_metabox_name' );

$atts 					= array();
$atts['class'] 			= '';
$atts['description'] 	= esc_html__( 'Checkbox Field', 'mervis-cpts' );
$atts['id'] 			= 'checkbox-field';
$atts['label'] 			= esc_html__( 'Checkbox Field', 'mervis-cpts' );
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
$atts['description'] 	= esc_html__( '', 'mervis-cpts' );
$atts['id'] 			= 'file-uploader-field';
$atts['label'] 			= esc_html__( '', 'mervis-cpts' );
$atts['label-remove'] 	= esc_html__( 'Remove File', 'mervis-cpts' );
$atts['label-upload'] 	= esc_html__( 'Upload/Choose File', 'mervis-cpts' );
$atts['name'] 			= 'file-uploader-field';
$atts['placeholder'] 	= esc_html__( '', 'mervis-cpts' );
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
$atts['aria'] 			= esc_html__( 'Radio Field', 'mervis-cpts' );
$atts['class'] 			= 'widefat';
$atts['description'] 	= esc_html__( 'Radio Field Description', 'mervis-cpts' );
$atts['id'] 			= 'radios-field';
$atts['label'] 			= esc_html__( 'Radios Field', 'mervis-cpts' );
$atts['name'] 			= 'radios-field';
$atts['selections'][] 	= array( 'value' => 'example1', 'label' => esc_html__( 'Example 1', 'mervis-cpts' ) );
$atts['selections'][] 	= array( 'value' => 'example2', 'label' => esc_html__( 'Example 2', 'mervis-cpts' ) );
$atts['selections'][] 	= array( 'value' => 'example3', 'label' => esc_html__( 'Example 3', 'mervis-cpts' ) );
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( MERVIS_CPTS_SLUG . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/radios.php' );

?></p><?php



$atts 					= array();
$atts['aria'] 			= esc_html__( 'Select an option', 'mervis-cpts' );
$atts['blank'] 			= esc_html__( 'Select an option', 'mervis-cpts' );
$atts['class'] 			= 'widefat';
$atts['description'] 	= esc_html__( 'Select Field Description', 'mervis-cpts' );
$atts['id'] 			= 'select-field';
$atts['label'] 			= esc_html__( 'Select Field', 'mervis-cpts' );
$atts['name'] 			= 'select-field';
$atts['selections'][] 	= array( 'value' => 'example1', 'label' => esc_html__( 'Example 1', 'mervis-cpts' ) );
$atts['selections'][] 	= array( 'value' => 'example2', 'label' => esc_html__( 'Example 2', 'mervis-cpts' ) );
$atts['selections'][] 	= array( 'value' => 'example3', 'label' => esc_html__( 'Example 3', 'mervis-cpts' ) );
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
$atts['description'] 	= esc_html__( 'Text Field Description', 'mervis-cpts' );
$atts['id'] 			= 'text-field';
$atts['label'] 			= esc_html__( 'Text Field', 'mervis-cpts' );
$atts['name'] 			= 'text-field';
$atts['placeholder'] 	= esc_html__( '', 'mervis-cpts' );
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
$atts['description'] 	= esc_html__( 'Textarea Field Description', 'mervis-cpts' );
$atts['id'] 			= 'textarea-field';
$atts['label'] 			= esc_html__( 'Textarea Field', 'mervis-cpts' );
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
