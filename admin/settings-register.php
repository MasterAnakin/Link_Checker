<?php // MyPlugin - Register Settings

// disable direct file access
if (!defined('ABSPATH')) {

	exit;

}

// register plugin settings
function myplugin_register_settings() {

	register_setting(
		'myplugin_options',
		'myplugin_options',
		'myplugin_callback_validate_options'
	);

	add_settings_section(
		'myplugin_section_login',
		'List Links',
		'myplugin_callback_section_login',
		'myplugin'
	);

	add_settings_section(
		'myplugin_section_admin',
		'Run the Functions',
		'myplugin_callback_section_admin',
		'myplugin'
	);

	add_settings_field(
		'custom_url',
		'Custom URL',
		'myplugin_callback_field_text',
		'myplugin',
		'myplugin_section_login',
		['id' => 'custom_url', 'label' => 'Custom URL for the login logo link']
	);
}

add_action('admin_init', 'myplugin_register_settings');
