<?php // Display Settings

if (!defined('ABSPATH')) exit;

function add_admin_page() {
	
	add_options_page('IP Settings', 'IP Settings', 'manage_options', 'interview-plugin', 'interview_plugin_display_settings');
}

function interview_plugin_display_settings() { ?>

<div class="table-container">
  <main class="inner">
    <div class="color-picker" id="cp">
      <div data-color="ffffff" data-type="one"></div>
      <div data-color="262e3e" data-type="two"></div>
      <div data-color="323846" data-type="three"></div>
    </div>
    <h1>SHOW DATA</h1>
    <div id="showData"></div>
  </main>
</div>

<?php }
