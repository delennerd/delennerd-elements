<?php
namespace DelennerdElements\Widgets;

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
        return __( 'Test Widget', 'delennerd-elements' );
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
	protected function _register_controls() {
        $this->start_controls_section(
        'section_content',
            [
                'label' => __( 'Content', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Angebotsbild', 'elementor-awesomesauce' ),
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
					'thumbnail'  => __( 'Thumbnail - 150 x 150', 'delennerd-elements' ),
					'medium' => __( 'Medium - 300 x 300', 'delennerd-elements' ),
					'medium_large' => __( 'Medium Large - 768 x 0', 'delennerd-elements' ),
					'custom' => __( 'Individuell', 'delennerd-elements' ),
				],
			]
		);

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Title', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
        'description',
            [
                'label' => __( 'Description', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Description', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
        'content',
            [
                'label' => __( 'Content', 'delennerd-elements' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Content', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
            'link_href',
            [
                'label' => __( 'Button Link', 'delennerd-elements' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'delennerd-elements' ),
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
                'label' => __( 'Button Text', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Button Text', 'delennerd-elements' ),
            ]
        );

        $this->end_controls_section();


		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style Section', 'elementor-awesomesauce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'space_between',
			[
				'label' => __( 'Spacing', 'delennerd-elements' ),
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
		    'label' => __( 'Alignment', 'elementor-awesomesauce' ),
		    'type' => \Elementor\Controls_Manager::CHOOSE,
		    'options' => [
		      'left' => [
		        'title' => __( 'Left', 'elementor-awesomesauce' ),
		        'icon' => 'fa fa-align-left',
		      ],
		      'center' => [
		        'title' => __( 'Center', 'elementor-awesomesauce' ),
		        'icon' => 'fa fa-align-center',
		      ],
		      'right' => [
		        'title' => __( 'Right', 'elementor-awesomesauce' ),
		        'icon' => 'fa fa-align-right',
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
		    'label'    => __( 'Typography', 'delennerd-elements' ),
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
            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
        </div>
		<h2 class="title" <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
		<div <?php echo $this->get_render_attribute_string( 'description' ); ?>><?php echo $settings['description']; ?></div>
		<div class="content" <?php echo $this->get_render_attribute_string( 'content' ); ?>><?php echo $settings['content']; ?></div>

        <a href="<?php echo $settings['link_href']; ?>" target="<?php echo $settings['link_target']; ?>" class="button">Angebot sichern</a>
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
	protected function _content_template() {
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
