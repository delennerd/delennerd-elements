<?php
namespace DelennerdElements;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Widgets {

    private $widgets = [
        'timeline',
        'image-text-box',
        'bootstrap-button',
        'bootstrap-card',
        'section-headline',
        'flipbox',
    ];

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

    /**
	 * widget_styles
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_styles() {
        //
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {

        wp_enqueue_script( 
            'delennerd-elements', 
            DELENNERD_ELEMENTS_ASSETS_URL . 'js/delennerd-elements.js',
            [ 'jquery' ],
            DELENNERD_ELEMENTS_VER, 
            true 
        );
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
        foreach ( $this->widgets as $widget_name ) {
            require_once DELENNERD_ELEMENTS_WIDGETS_PATH . $widget_name . '.php';
        }
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		$this->include_widgets_files();

        foreach ( $this->widgets as $widget_name ) {
			$class_name = str_replace( '-', ' ', $widget_name );
			$class_name = str_replace( ' ', '', ucwords( $class_name ) );
			$class_name = __NAMESPACE__ . '\\Widgets\\' . $class_name;

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class_name() );
		}
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

        // add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

        add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

	}
}

// Instantiate Plugin Class
Widgets::instance();