<?php
/**
 * Plugin Name: Paged WP
 * Plugin URI:  https://github.com/electricbookworks/paged-wp
 * Description: A WordPress plugin for using paged.js
 * Version:     1.0.3
 * Author:      Electric Book Works
 * Author URI:  https://electricbookworks.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: paged-wp
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

use PagedWP\Plugin_Base;

define( 'PAGED_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PAGED_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PAGED_VERSION', '1.0.3' );

require PAGED_PLUGIN_DIR . 'vendor/autoload.php';

new Plugin_Base( __FILE__, PAGED_VERSION );
