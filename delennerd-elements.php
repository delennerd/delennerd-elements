<?php
/**
 * Plugin Name: Delennerd Elements
 * Description: Delennerd Elements
 * Version:     1.2.1
 * Author:      Pascal Lehnert
 * Author URI:  https://delennerd.de
 * Text Domain: delennerd-elements
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'DELENNERD_ELEMENTS_VER', '1.2.1' );
define( 'DELENNERD_ELEMENTS_MINIMUM_ELEMENTOR_VERSION', '2.0' );
define( 'DELENNERD_ELEMENTS_MINIMUM_PHP_VERSION', '7.0' );

define( 'DELENNERD_ELEMENTS_ELEMENTOR_VERSION_REQUIRED', '2.0' );
define( 'DELENNERD_ELEMENTS_PHP_VERSION_REQUIRED', '7.0' );

define( 'DELENNERD_ELEMENTS__FILE__', __FILE__ );
define( 'DELENNERD_ELEMENTS_PATH', plugin_dir_path( DELENNERD_ELEMENTS__FILE__ ) );
//define( 'DELENNERD_ELEMENTS_BASE', plugin_basename( DELENNERD_ELEMENTS__FILE__ ) );
define( 'DELENNERD_ELEMENTS_URL', plugins_url( '/', DELENNERD_ELEMENTS__FILE__ ) );
define( 'DELENNERD_ELEMENTS_ASSETS_PATH', DELENNERD_ELEMENTS_PATH . 'assets/' );
define( 'DELENNERD_ELEMENTS_WIDGETS_PATH', DELENNERD_ELEMENTS_PATH . 'widgets/' );
define( 'DELENNERD_ELEMENTS_ASSETS_URL', DELENNERD_ELEMENTS_URL . 'assets/' );
define( 'DELENNERD_ELEMENTS_WIDGETS_URL', DELENNERD_ELEMENTS_URL . 'widgets/' );

add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );

/**
 * Register a new elementor category
 */
function add_elementor_widget_categories( $elements_manager ) {
    $elements_manager->add_category(
        'delennerd',
        [
            'title' => __( 'Delennerd', 'delennerd-elements' ),
            'icon' => 'fa fa-plug',
        ]
    );
}

$delennerd_elements_inc_files = [
    '/vendor/autoload.php',
    '/inc/update-checker.php',
    '/inc/class.delennerd-elements.php',
];

foreach ( $delennerd_elements_inc_files as $file ) {
	require_once DELENNERD_ELEMENTS_PATH . $file;
}