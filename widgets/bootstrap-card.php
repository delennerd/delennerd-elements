<?php
namespace DelennerdElements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class BootstrapCard extends Widget_Base {

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
        return 'bootstrap-card';
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
        return __( 'BS Card', 'delennerd-elements' );
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
        return 'eicon-icon-box';
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
        
        /***********************/
        /** SECTION: Content **/
        /***********************/

        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Image', 'delennerd-elements' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            Group_Control_Image_Size::get_type(),
            //'image_dimension',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __( 'Image size', 'delennerd-elements' ),
                'name' => 'image_dimension', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [],
                'include' => [],
                'default' => 'medium',
                'options' => [
                    'thumbnail'  => __( 'Thumbnail - 150 x 150', 'delennerd-elements' ),
                    'medium' => __( 'Medium - 300 x 300', 'delennerd-elements' ),
                    'medium_large' => __( 'Medium Large - 768 x 0', 'delennerd-elements' ),
                    'custom' => __( 'Custom', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Title', 'delennerd-elements' ),
                'dynamic' => [
					'active' => true,
				],
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __( 'Content', 'delennerd-elements' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( '<p>Box content</p>', 'delennerd-elements' ),
                'dynamic' => [
					'active' => true,
				],
            ]
        );

        $this->end_controls_section();

        /***********************/
        /** SECTION: Button **/
        /***********************/

        $this->start_controls_section(
        'button_content',
            [
                'label' => __( 'Button', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
            'link_href',
            [
                'label' => __( 'Button Link', 'delennerd-elements' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'delennerd-elements' ),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => true,
                ],
                'dynamic' => [
					'active' => true,
				],
            ]
        );

        $this->add_control(
            'link_target',
            [
                'label' => __( 'Button link target', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => '_self',
                'options' => [
                    '_self'  => __( 'Same tab', 'delennerd-elements' ),
                    '_blank'  => __( 'New tab', 'delennerd-elements' ),
                    'custom'  => __( 'Custom', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'link_target_custom',
            [
                'label' => __( 'Custom link target', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'button_custom_css_class',
            [
                'label' => __( 'CSS Classes', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'My Button', 'delennerd-elements' ),
                'dynamic' => [
					'active' => true,
				],
            ]
        );

        $this->end_controls_section();

        /***********************/
        /** STYLE: Image **/
        /***********************/

        $this->start_controls_section(
			'image_style_section',
			[
				'label' => __( 'Image', 'delennerd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'image_distance',
            [
                'label' => __( 'Distance', 'delennerd-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .widget-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /***********************/
        /** STYLE: Title **/
        /***********************/

		$this->start_controls_section(
			'title_style_section',
			[
				'label' => __( 'Title', 'delennerd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'title_distance',
            [
                'label' => __( 'Distance', 'delennerd-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __( 'Typography', 'delennerd-elements' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .widget-title',
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

        $this->add_control(
            'title_text_align',
            [
                'label' => __( 'Alignment', 'delennerd-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                        'left' => [
                        'title' => __( 'Left', 'delennerd-elements' ),
                        'icon' => 'fa fa-align-left',
                    ],
                        'center' => [
                        'title' => __( 'Center', 'delennerd-elements' ),
                        'icon' => 'fa fa-align-center',
                    ],
                        'right' => [
                        'title' => __( 'Right', 'delennerd-elements' ),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'default' => '',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'text-align: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_section();

        /***********************/
        /** STYLE: Content **/
        /***********************/

        $this->start_controls_section(
			'content_style_section',
			[
				'label' => __( 'Content', 'delennerd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'content_distance',
            [
                'label' => __( 'Distance', 'delennerd-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .widget-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'label'    => __( 'Typography', 'delennerd-elements' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .widget-content',
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

        $this->add_control(
            'content_text_align',
            [
                'label' => __( 'Alignment', 'delennerd-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                        'left' => [
                        'title' => __( 'Left', 'delennerd-elements' ),
                        'icon' => 'fa fa-align-left',
                    ],
                        'center' => [
                        'title' => __( 'Center', 'delennerd-elements' ),
                        'icon' => 'fa fa-align-center',
                    ],
                        'right' => [
                        'title' => __( 'Right', 'delennerd-elements' ),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'default' => '',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .widget-content' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        /***********************/
        /** STYLE: Button **/
        /***********************/

        $this->start_controls_section(
			'button_style_section',
			[
				'label' => __( 'Button', 'delennerd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .widget-button a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Background color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .widget-button a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'css_class',
            [
                'label' => __( 'Button Style', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => [
                    'primary' => __( 'Primary', 'delennerd-elements' ),
                    'secondary' => __( 'Secondary', 'delennerd-elements' ),
                    'outline-custom' => __( 'Outline Custom', 'delennerd-elements' ),
                    'outline-custom btn-outline-custom--primary' => __( 'Outline Custom - Primary', 'delennerd-elements' ),
                    'outline-custom btn-outline-custom--secondary' => __( 'Outline Custom - Secondary', 'delennerd-elements' ),
                    
                    'success' => __( 'Success', 'delennerd-elements' ),
                    'danger' => __( 'Danger', 'delennerd-elements' ),
                    'warning' => __( 'Warning', 'delennerd-elements' ),

                    'outline-primary' => __( 'Outline Primary', 'delennerd-elements' ),
                    'outline-secondary' => __( 'Outline Secondary', 'delennerd-elements' ),
                    'outline-success' => __( 'Outline Success', 'delennerd-elements' ),
                    'outline-danger' => __( 'Outline Danger', 'delennerd-elements' ),
                    'outline-warning' => __( 'Outline Warning', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
            'name'     => 'button_typography',
            'label'    => __( 'Typography', 'delennerd-elements' ),
            'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .widget-button a',
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

        $this->add_control(
            'button_text_align',
            [
                'label' => __( 'Alignment', 'delennerd-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                        'left' => [
                        'title' => __( 'Left', 'delennerd-elements' ),
                        'icon' => 'fa fa-align-left',
                    ],
                        'center' => [
                        'title' => __( 'Center', 'delennerd-elements' ),
                        'icon' => 'fa fa-align-center',
                    ],
                        'right' => [
                        'title' => __( 'Right', 'delennerd-elements' ),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'default' => '',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .widget-button' => 'text-align: {{VALUE}}',
                ],
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

        $this->add_render_attribute( 
            'button_link', 
            [   
                'href' => $settings['link_href']['url'],
                'target' => $settings['link_target'],
                'class' => [
                    'btn',
                    'btn-' . $settings['css_class'],
                ]
            ]
        );

        $this->add_render_attribute( 'button_link', 'class', $settings['button_custom_css_class'] );
        
    ?>
        <div class="bs-card-wrapper card">

            <div class="widget-image card-img-top" <?php echo $this->get_render_attribute_string( 'image' ); ?>>
                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_dimension', 'image' );
                ?>
            </div>

            <div class="card-body">
                <h5 class="widget-title card-title" <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h5>

                <div class="widget-content card-text" <?php echo $this->get_render_attribute_string( 'content' ); ?>>
                    <?php echo $settings['content']; ?>
                </div>

                <?php if ( $settings['button_text'] ) : ?>
                <div class="widget-button">
                    <a <?php echo $this->get_render_attribute_string( 'button_link' ); ?>><?php echo $settings['button_text']; ?></a>
                </div>
                <?php endif; ?>
            </div><!-- end .card-body -->
        </div>

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
            var image = {
                id: settings.image.id,
                url: settings.image.url,
                size: settings.image_dimension_size,
                dimension: settings.image_dimension_custom_dimension,
                model: view.getEditModel()
            };
            var image_url = elementor.imagesManager.getImageUrl( image );

            view.addRenderAttribute(
                'buttonLink',
                {   
                    'href': settings.link_href.url,
                    'target': settings.link_target,
                    'class': [ 
                        'btn',
                        'btn-' + settings.css_class,
                        settings.button_custom_css_class
                    ]
                }
            );
		#>

        <div class="card">

            <div class="widget-image card-img-top">
                <img src="{{{ image_url }}}" alt="">
            </div>

            <div class="card-body">
                
                <#
                print( '<h5 class="widget-title card-title">' + settings.title + '</h5>' );
                #>

                <div class="widget-content card-text" {{{ view.getRenderAttributeString( 'content' ) }}}>
                    {{{ settings.content }}}
                </div>

                
                <# if ( settings.button_text ) { #>

                <div class="widget-button" {{{ view.getRenderAttributeString( 'button_text' ) }}}>
                    <a {{{ view.getRenderAttributeString( 'buttonLink' ) }}}>{{{ settings.button_text }}}</a>
                </div>
                <# } #>

            </div>

        </div>

    <?php

    }
}
