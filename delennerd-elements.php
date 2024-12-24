<?php
/**
 * Plugin Name: Delennerd Elements
 * Description: Delennerd Elements
 * Version:     1.5
 * Author:      delennerd.media
 * Author URI:  https://www.delennerd.media
 * Text Domain: delennerd-elements
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'DELENNERD_ELEMENTS_VER', '1.5' );
//define( 'DELENNERD_ELEMENTS_MINIMUM_ELEMENTOR_VERSION', '3.0' );
//define( 'DELENNERD_ELEMENTS_MINIMUM_PHP_VERSION', '8.1' );

define( 'DELENNERD_ELEMENTS_ELEMENTOR_VERSION_REQUIRED', '3.2' );
define( 'DELENNERD_ELEMENTS_PHP_VERSION_REQUIRED', '8.0' );

define( 'DELENNERD_ELEMENTS__FILE__', __FILE__ );
define( 'DELENNERD_ELEMENTS_PATH', plugin_dir_path( DELENNERD_ELEMENTS__FILE__ ) );
//define( 'DELENNERD_ELEMENTS_BASE', plugin_basename( DELENNERD_ELEMENTS__FILE__ ) );
define( 'DELENNERD_ELEMENTS_URL', plugins_url( '/', DELENNERD_ELEMENTS__FILE__ ) );
define( 'DELENNERD_ELEMENTS_ASSETS_PATH', DELENNERD_ELEMENTS_PATH . 'assets/' );
define( 'DELENNERD_ELEMENTS_WIDGETS_PATH', DELENNERD_ELEMENTS_PATH . 'widgets/' );
define( 'DELENNERD_ELEMENTS_ASSETS_URL', DELENNERD_ELEMENTS_URL . 'assets/' );
define( 'DELENNERD_ELEMENTS_WIDGETS_URL', DELENNERD_ELEMENTS_URL . 'widgets/' );

$delennerd_elements_inc_files = [
    '/vendor/autoload.php',
    '/inc/update-checker.php',
    '/inc/elementor-category.php',
    '/inc/class.delennerd-elements.php',
];

foreach ( $delennerd_elements_inc_files as $file ) {
	require_once sanitize_text_field( realpath( DELENNERD_ELEMENTS_PATH . $file ) );
}
