<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://kunalsaha@wisdmlabs.com
 * @since      1.0.0
 *
 * @package    Subscribe_me_Kunal
 * @subpackage Subscribe_me_Kunal/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Subscribe_me_Kunal
 * @subpackage Subscribe_me_Kunal/includes
 * @author     Kunal Saha <sahakunal1803@gmail.com>
 */
class Subscribe_me_Kunal_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'subscribe_me-kunal',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
