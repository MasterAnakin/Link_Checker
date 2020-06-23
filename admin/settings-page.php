<?php // MyPlugin - Settings Page

// disable direct file access
if (!defined('ABSPATH')) {

	exit;

}

// display the plugin settings page
function myplugin_display_settings_page() {

	// check if user is allowed access
	if (!current_user_can('manage_options')) {
		return;
	}

	?>

	<div class="wrap">


	<?php

	// output security fields
	settings_fields('myplugin_options');

	// output setting sections
	do_settings_sections('myplugin');

	echo '<form action="options-general.php?page=link-checker" method="post">';

	echo '<input type="hidden" value="true" name="test_button" />';
	submit_button('Get Header Response');
	echo '</form>';

	echo '<form action="options-general.php?page=link-checker" method="post">';

	echo '<input type="hidden" value="true" name="test_button_2" />';
	submit_button('Get the Links');
	echo '</form>';

	echo '<form action="options-general.php?page=link-checker" method="post">';

	echo '<input type="hidden" value="true" name="test_button_3" />';
	submit_button('Check Links');
	echo '</form>';

	echo '</div>';

}
