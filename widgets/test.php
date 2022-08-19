<?php
namespace DelennerdElements\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Test extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'testwidget';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Test Widget', 'delennerd-elements' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'fa fa-pencil';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'delennerd' ];
    }

  /**
   * Register the widget controls.
   *
   * Adds different input fields to allow the user to change and customize the widget settings.
   *
   * @since 1.1.0
   *
   * @access protected
   */
	protected function register_controls() {
        $this->start_controls_section(
        'section_content',
            [
                'label' => esc_html__( 'Content', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Angebotsbild', 'elementor-awesomesauce' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
			Group_Control_Image_Size::get_type(),
			[
                //'type' => Controls_Manager::SELECT,
                'label' => 'Bildgröße',
				'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'medium',
                'options' => [
					'thumbnail'  => esc_html__( 'Thumbnail - 150 x 150', 'delennerd-elements' ),
					'medium' => esc_html__( 'Medium - 300 x 300', 'delennerd-elements' ),
					'medium_large' => esc_html__( 'Medium Large - 768 x 0', 'delennerd-elements' ),
					'custom' => esc_html__( 'Individuell', 'delennerd-elements' ),
				],
			]
		);

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Title', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
        'description',
            [
                'label' => esc_html__( 'Description', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Description', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
        'content',
            [
                'label' => esc_html__( 'Content', 'delennerd-elements' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Content', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
            'link_href',
            [
                'label' => esc_html__( 'Button Link', 'delennerd-elements' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'delennerd-elements' ),
				'show_external' => true,
                'default' => [
                    'url' => 'https://your-link.com',
                    'is_external' => true,
                    'nofollow' => true,
                ]
            ]
        );

        $this->add_control(
            'link_text',
            [
                'label' => esc_html__( 'Button Text', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Button Text', 'delennerd-elements' ),
            ]
        );

        $this->end_controls_section();


		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style Section', 'elementor-awesomesauce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'space_between',
			[
				'label' => esc_html__( 'Spacing', 'delennerd-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .widget-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
		  'text_align',
		  [
		    'label' => esc_html__( 'Alignment', 'elementor-awesomesauce' ),
		    'type' => \Elementor\Controls_Manager::CHOOSE,
		    'options' => [
		      'left' => [
		        'title' => esc_html__( 'Left', 'elementor-awesomesauce' ),
		        'icon' => 'eicon-text-align-left',
		      ],
		      'center' => [
		        'title' => esc_html__( 'Center', 'elementor-awesomesauce' ),
		        'icon' => 'eicon-text-align-center',
		      ],
		      'right' => [
		        'title' => esc_html__( 'Right', 'elementor-awesomesauce' ),
		        'icon' => 'eicon-text-align-right',
		      ],
		    ],
		    'default' => 'center',
		    'toggle' => true,
		  ]
		);

		$this->add_group_control(
		  Group_Control_Typography::get_type(),
		  [
		    'name'     => 'content_typography',
		    'label'    => esc_html__( 'Typography', 'delennerd-elements' ),
		    'scheme'   => Typography::TYPOGRAPHY_1,
		    'selector' => '{{WRAPPER}} .title',
		    'fields_options' => [
		      'letter_spacing' => [
		        'range' => [
		          'min' => 0,
		          'max' => 100
		        ]
		      ]
		    ]
		  ]
		);

		$this->end_controls_section();
  }

  /**
   * Render the widget output on the frontend.
   *
   * Written in PHP and used to generate the final HTML.
   *
   * @since 1.1.0
   *
   * @access protected
   */
 	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'none' );
		$this->add_inline_editing_attributes( 'description', 'basic' );
		$this->add_inline_editing_attributes( 'content', 'advanced' );
	?>
        <div class="image">
            <?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ) ); ?>
        </div>
		<div class="title" <?php echo wp_kses_post( $this->get_render_attribute_string( 'title' ) ); ?>><?php echo wp_kses_post( $settings['title'] ); ?></div>
		<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'description' ) ); ?>><?php echo wp_kses_post( $settings['description'] ); ?></div>
		<div class="content" <?php echo wp_kses_post( $this->get_render_attribute_string( 'content' ) ); ?>><?php echo wp_kses_post( $settings['content'] ); ?></div>

        <a href="<?php echo esc_attr( $settings['link_href'] ); ?>" target="<?php echo esc_attr( $settings['link_target'] ); ?>" class="button"><?php wp_kses_post( $settings['link_text'] ); ?></a>
    <?php
  }

  /**
   * Render the widget output in the editor.
   *
   * Written as a Backbone JavaScript template and used to generate the live preview.
   *
   * @since 1.1.0
   *
   * @access protected
   */
	protected function content_template() {
?>
		<#
		view.addInlineEditingAttributes( 'title', 'none' );
		view.addInlineEditingAttributes( 'description', 'basic' );
		view.addInlineEditingAttributes( 'content', 'advanced' );

        var image = {
			id: settings.image.id,
			url: settings.image.url,
			size: settings.thumbnail_size,
			dimension: settings.thumbnail_custom_dimension,
			model: view.getEditModel()
		};
		var image_url = elementor.imagesManager.getImageUrl( image );
		#>
        <div class="image">
            <img src="{{{ image_url }}}" alt="">
        </div>
		<h2 {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</h2>
		<div {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
		<div {{{ view.getRenderAttributeString( 'content' ) }}}>{{{ settings.content }}}</div>
<?php
	}
}
