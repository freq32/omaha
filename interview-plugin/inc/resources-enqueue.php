<?php // Enqueue Resources

if (!defined('ABSPATH')) exit;

function interview_plugin_admin_enqueue_scripts() {
	
	$screen = get_current_screen();
	
	if (!is_object($screen)) $screen = new stdClass();
	
	if (!property_exists($screen, 'id')) return;
	
	if ($screen->id === 'settings_page_interview-plugin') {
		
		wp_enqueue_style('interview-plugin-settings', INTERVIEW_PLUGIN_URL .'css/settings.css', array(), INTERVIEW_PLUGIN_VERSION);
		wp_enqueue_script('interview-plugin-settings', INTERVIEW_PLUGIN_URL .'js/settings.js', $js_deps, INTERVIEW_PLUGIN_VERSION);
		
	}
	
}

