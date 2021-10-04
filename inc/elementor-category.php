<?php
/**
 * Register a new elementor category
 * 
 * @package delennerd-elements
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );

function add_elementor_widget_categories( $elements_manager ) {
    $elements_manager->add_category(
        'delennerd',
        [
            'title' => __( 'Delennerd', 'delennerd-elements' ),
            'icon' => 'fa fa-plug',
        ]
    );
}