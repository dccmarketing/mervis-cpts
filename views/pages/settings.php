<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    DocBlock
 * @subpackage DocBlock/classes/views
 */

?><h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<form method="post" action="options.php"><?php

settings_fields( MERVIS_CPTS_SLUG . '-options' );

do_settings_sections( MERVIS_CPTS_SLUG );

submit_button( 'Save Settings' );

?></form>