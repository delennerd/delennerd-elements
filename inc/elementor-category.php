<?php
/**
 * Register a new elementor category
 * 
 * @package delennerd-elements
 */

namespace DelennerdElements;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if (! class_exists('DLME_Categories')) {
    class DLME_Categories
    {
        public function __construct()
        {
            add_action('elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ]);
        }

        public function add_elementor_widget_categories($elements_manager)
        {
            $elements_manager->add_category(
                'delennerd',
                [
                'title' => __('Delennerd', 'delennerd-elements'),
                'icon' => 'fa fa-plug',
            ]
            );
        }
    }
}

new DLME_Categories();