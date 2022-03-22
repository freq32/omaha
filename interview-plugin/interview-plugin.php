<?php 
/*
	Plugin Name: Interview Plugin
	Plugin URI: https://twitter.com/CBSNews/status/1506065684215873544
	Description: For Mutual of Omaha.
	Author: Mark Aaron
	Author URI: https://docs.google.com/document/d/1ed9IKtB0Bk8ifGhqTOKHzZgUHeyuSpOzuOAnD0Z8Kj4/edit?usp=sharing
	Text Domain: interview-plugin
	Domain Path: /languages
	License: GPL v2 or later
*/
if (!defined('ABSPATH')) die();

if (!class_exists('InterviewPlugin')) {
	
	class InterviewPlugin {
		
		function __construct() {
			
			$this->constants();
			$this->includes();
			
			add_action('admin_init',          array($this, 'check_version'));
			add_action('init',                array($this, 'load_i18n'));
			
			add_action('admin_enqueue_scripts', 'interview_plugin_admin_enqueue_scripts');
			add_action('admin_menu',            'add_admin_page');
			add_filter('admin_init',            'interview_plugin_init');
			
			add_filter('wp_enqueue_scripts', 'interview_plugin_wp_enqueue_scripts', 100);
			
		}
		
		function constants() {

			if (!defined('INTERVIEW_PLUGIN_NAME'))    define('INTERVIEW_PLUGIN_NAME',    __('Interview Plugin', 'interview-plugin'));
			if (!defined('INTERVIEW_PLUGIN_HOME'))    define('INTERVIEW_PLUGIN_HOME',    esc_url('https://docs.google.com/document/d/1ed9IKtB0Bk8ifGhqTOKHzZgUHeyuSpOzuOAnD0Z8Kj4/edit?usp=sharing'));
			if (!defined('INTERVIEW_PLUGIN_URL'))     define('INTERVIEW_PLUGIN_URL',     plugin_dir_url(__FILE__));
			if (!defined('INTERVIEW_PLUGIN_DIR'))     define('INTERVIEW_PLUGIN_DIR',     plugin_dir_path(__FILE__));
			if (!defined('INTERVIEW_PLUGIN_FILE'))    define('INTERVIEW_PLUGIN_FILE',    plugin_basename(__FILE__));
			if (!defined('INTERVIEW_PLUGIN_SLUG'))    define('INTERVIEW_PLUGIN_SLUG',    basename(dirname(__FILE__)));
			
		}
		
		function includes() {
			
			require_once INTERVIEW_PLUGIN_DIR .'inc/plugin-core.php';

			if (is_admin()) {
				
				require_once INTERVIEW_PLUGIN_DIR .'inc/resources-enqueue.php';
				require_once INTERVIEW_PLUGIN_DIR .'inc/settings-display.php';

			}
			
		}
		
		function options() {
	
		}

		function check_version() {
			
			$wp_version = get_bloginfo('version');
			
			if (isset($_GET['activate']) && $_GET['activate'] == 'true') {
				
				if (version_compare($wp_version, INTERVIEW_PLUGIN_REQUIRE, '<')) {
					
					if (is_plugin_active(INTERVIEW_PLUGIN_FILE)) {
						
						deactivate_plugins(INTERVIEW_PLUGIN_FILE);
						
						$msg  = '<strong>'. INTERVIEW_PLUGIN_NAME .'</strong> '. esc_html__('requires WordPress ', 'interview-plugin') . INTERVIEW_PLUGIN_REQUIRE;
						$msg .= esc_html__(' or higher, and has been deactivated! ', 'interview-plugin');
						$msg .= esc_html__('Please return to the', 'interview-plugin') .' <a href="'. admin_url() .'">';
						$msg .= esc_html__('WP Admin Area', 'interview-plugin') .'</a> '. esc_html__('to upgrade WordPress and try again.', 'interview-plugin');
						
						wp_die($msg);
						
					}
					
				}
				
			}
			
		}
		
		function load_i18n() {
			
			load_plugin_textdomain('interview-plugin', false, dirname(plugin_basename(__FILE__)) .'/languages/');
			
		}

	}
	
	global $InterviewPlugin;
	
	$InterviewPlugin = new InterviewPlugin(); 
	
}
