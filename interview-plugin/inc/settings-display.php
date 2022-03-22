<?php // Display Settings

if (!defined('ABSPATH')) exit;

function add_admin_page() {
	
	add_options_page('IP Settings', 'IP Settings', 'manage_options', 'interview-plugin', 'interview_plugin_display_settings');
}

function interview_plugin_display_settings() { ?>

<main><h1>SHOW DATA</h1>
<div id="showData"></div>
</main>

<?php }
