<?php
/**
 * Plugin Name: PNG Print Calculator
 * Description: A plugin to calculate product prices based on user input. Requires ACF Pro.
 * Version: 1.0.2
 * Author: Yurii Nykolyshyn
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

// Check if ACF Pro is active.
add_action( 'admin_init', function() {
	if ( ! class_exists( 'ACF' ) ) {
		add_action( 'admin_notices', function() {
			echo '<div class="notice notice-error"><p>PNG Print Calculator requires ACF Pro to be active.</p></div>';
		});
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}
});

// Define constants.
define( 'PNG_CALCULATOR_PATH', plugin_dir_path( __FILE__ ) );
define( 'PNG_CALCULATOR_URL', plugin_dir_url( __FILE__ ) );





// Include core plugin files.
include_once PNG_CALCULATOR_PATH . 'includes/functions.php';
include_once PNG_CALCULATOR_PATH . 'includes/scripts.php';
include_once PNG_CALCULATOR_PATH . 'includes/acf-fields.php';
include_once PNG_CALCULATOR_PATH . 'includes/crm_integration.php';


