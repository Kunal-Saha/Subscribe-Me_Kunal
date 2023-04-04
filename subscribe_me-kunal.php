<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://kunalsaha@wisdmlabs.com
 * @since             1.0.0
 * @package           Subscribe_me_Kunal
 *
 * @wordpress-plugin
 * Plugin Name:       Subscribe_me
 * Plugin URI:        https://Subscribe.me@kunal.com
 * Description:       This Plugin will help to give a notification on the mail after we click on the Subscribe button
 * Version:           1.0.0
 * Author:            Kunal Saha
 * Author URI:        https://kunalsaha@wisdmlabs.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       subscribe_me-kunal
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
define( 'SUBSCRIBE_ME_KUNAL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-subscribe_me-kunal-activator.php
 */
function activate_subscribe_me_kunal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-subscribe_me-kunal-activator.php';
	Subscribe_me_Kunal_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-subscribe_me-kunal-deactivator.php
 */
function deactivate_subscribe_me_kunal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-subscribe_me-kunal-deactivator.php';
	Subscribe_me_Kunal_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_subscribe_me_kunal' );
register_deactivation_hook( __FILE__, 'deactivate_subscribe_me_kunal' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-subscribe_me-kunal.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function remove_schedule()
{
	wp_clear_scheduled_hook('sendemail');
}
register_deactivation_hook(__FILE__, 'remove_schedule');

function run_subscribe_me_kunal() {

	$plugin = new Subscribe_me_Kunal();
	$plugin->run();

}
run_subscribe_me_kunal();
