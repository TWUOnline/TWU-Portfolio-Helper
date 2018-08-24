<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://cog.dog/
 * @since             1.0.0
 * @package           Twu_Portfolio
 *
 * @wordpress-plugin
 * Plugin Name:       TWU Portfolio Helper
 * Plugin URI:        https://github.com/TWUOnline/twu-portfolio-helper
 * Description:       This provides additional functionality, content types for the learning portfolios at TWU
 * Version:           0.2
 * Author:            Alan Levine
 * Author URI:        https://cog.dog/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       twu-portfolio
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-twu-portfolio-activator.php
 */
function activate_twu_portfolio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twu-portfolio-activator.php';
	Twu_Portfolio_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-twu-portfolio-deactivator.php
 */
function deactivate_twu_portfolio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twu-portfolio-deactivator.php';
	Twu_Portfolio_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_twu_portfolio' );
register_deactivation_hook( __FILE__, 'deactivate_twu_portfolio' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-twu-portfolio.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_twu_portfolio() {

	$plugin = new Twu_Portfolio();
	$plugin->run();

}
run_twu_portfolio();


add_shortcode( 'artifact_count', 'twu_portfolio_count_artifcats');

function twu_portfolio_count_artifcats( $atts ) {

		extract( shortcode_atts( array( "link" => 0), $atts ) );  
	
		if ( $link ) {
			return '<a href="' . get_post_type_archive_link( 'twu-portfolio' ) . '">' . wp_count_posts('twu-portfolio')->publish  . ' artifacts</a>';
		} else {
			return wp_count_posts('twu-portfolio')->publish  . ' artifacts';
		}
	}
