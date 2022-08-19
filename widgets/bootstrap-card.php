<?php
namespace DelennerdElements\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Schemes\Color;


class BootstrapCard extends Widget_Base {

    public function get_name() {
        return 'bootstrap-card';
    }

    public function get_title() {
        return esc_html__( 'BS Card', 'delennerd-elements' );
    }

    public function get_icon() {
        return 'eicon-icon-box';
    }

    public function get_categories() {
        return [ 'delennerd' ];
    }

	protected function register_controls() {
        
        /**
         * -------------------------------------------
         * Tab Content (Section Content)
         * -------------------------------------------
         */

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'delennerd-elements' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'label' => esc_html__( 'Image size', 'delennerd-elements' ),
                'name' => 'image_dimension', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [
                    '',
                ],
                'include' => [],
                'default' => 'medium',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Title', 'delennerd-elements' ),
                'dynamic' => [
					'active' => true,
				],
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'delennerd-elements' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( '<p>Box content</p>', 'delennerd-elements' ),
                'dynamic' => [
					'active' => true,
				],
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Content (Button)
         * -------------------------------------------
         */

        $this->start_controls_section(
        'button_content',
            [
                'label' => esc_html__( 'Button', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
            'link_href',
            [
                'label' => esc_html__( 'Button Link', 'delennerd-elements' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'delennerd-elements' ),
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
                'label' => esc_html__( 'Button link target', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => '_self',
                'options' => [
                    '_self'  => esc_html__( 'Same tab', 'delennerd-elements' ),
                    '_blank'  => esc_html__( 'New tab', 'delennerd-elements' ),
                    'custom'  => esc_html__( 'Custom', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'link_target_custom',
            [
                'label' => esc_html__( 'Custom link target', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'button_custom_css_class',
            [
                'label' => esc_html__( 'CSS Classes', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'My Button', 'delennerd-elements' ),
                'dynamic' => [
					'active' => true,
				],
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Image Style)
         * -------------------------------------------
         */

        $this->start_controls_section(
			'image_style_section',
			[
				'label' => esc_html__( 'Image', 'delennerd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'image_distance',
            [
                'label' => esc_html__( 'Distance', 'delennerd-elements' ),
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

        /**
         * -------------------------------------------
         * Tab Style (Title Style)
         * -------------------------------------------
         */

		$this->start_controls_section(
			'title_style_section',
			[
				'label' => esc_html__( 'Title', 'delennerd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'title_distance',
            [
                'label' => esc_html__( 'Distance', 'delennerd-elements' ),
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
			'title_html_tag',
			[
				'label' => esc_html__( 'HTML Tag', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
				],
				'default' => 'div',
			]
		);

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_1,
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
                'label'    => esc_html__( 'Typography', 'delennerd-elements' ),
                'scheme'   => Typography::TYPOGRAPHY_1,
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
                'label' => esc_html__( 'Alignment', 'delennerd-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-right',
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

        /**
         * -------------------------------------------
         * Tab Style (Content Style)
         * -------------------------------------------
         */

        $this->start_controls_section(
			'content_style_section',
			[
				'label' => esc_html__( 'Content', 'delennerd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'content_distance',
            [
                'label' => esc_html__( 'Distance', 'delennerd-elements' ),
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
                'label'    => esc_html__( 'Typography', 'delennerd-elements' ),
                'scheme'   => Typography::TYPOGRAPHY_1,
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
                'label' => esc_html__( 'Alignment', 'delennerd-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-right',
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

        /**
         * -------------------------------------------
         * Tab Style (Button Style)
         * -------------------------------------------
         */

        $this->start_controls_section(
			'button_style_section',
			[
				'label' => esc_html__( 'Button', 'delennerd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .widget-button a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => esc_html__( 'Background color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .widget-button a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_css_class',
            [
                'label' => esc_html__( 'Button Style', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => [
                    'link' => esc_html__( 'Link', 'delennerd-elements' ),
                    'primary' => esc_html__( 'Primary', 'delennerd-elements' ),
                    'secondary' => esc_html__( 'Secondary', 'delennerd-elements' ),

                    'outline-primary' => esc_html__( 'Outline Primary', 'delennerd-elements' ),
                    'outline-secondary' => esc_html__( 'Outline Secondary', 'delennerd-elements' ),

                    'outline-custom' => esc_html__( 'Outline Custom', 'delennerd-elements' ),
                    'outline-custom btn-outline-custom--primary' => esc_html__( 'Outline Custom - Primary', 'delennerd-elements' ),
                    'outline-custom btn-outline-custom--secondary' => esc_html__( 'Outline Custom - Secondary', 'delennerd-elements' ),
                    
                    'success' => esc_html__( 'Success', 'delennerd-elements' ),
                    'danger' => esc_html__( 'Danger', 'delennerd-elements' ),
                    'warning' => esc_html__( 'Warning', 'delennerd-elements' ),
                    'outline-success' => esc_html__( 'Outline Success', 'delennerd-elements' ),
                    'outline-danger' => esc_html__( 'Outline Danger', 'delennerd-elements' ),
                    'outline-warning' => esc_html__( 'Outline Warning', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => esc_html__( 'Button Style', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => [
                    '' => esc_html__( 'Normal', 'delennerd-elements' ),
                    'btn-sm' => esc_html__( 'Small', 'delennerd-elements' ),
                    'btn-lg' => esc_html__( 'Large', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
            'name'     => 'button_typography',
            'label'    => esc_html__( 'Typography', 'delennerd-elements' ),
            'scheme'   => Typography::TYPOGRAPHY_1,
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
                'label' => esc_html__( 'Alignment', 'delennerd-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-right',
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

 	protected function render() {
		$settings = $this->get_settings_for_display();

        $this->add_render_attribute(
            'title', [
                'class' => [
                    'widget-title', 
                    'card-title',
                ]
            ]
        );

        $this->add_render_attribute( 
            'button_link', 
            [   
                'href' => $settings['link_href']['url'],
                'target' => $settings['link_target'],
                'class' => [
                    'btn',
                    'btn-' . $settings['button_css_class'],
                    $settings['button_size'],
                ]
            ]
        );

        $this->add_render_attribute( 'button_link', 'class', $settings['button_custom_css_class'] );
        
    ?>
        <div class="bs-card-wrapper card">

            <?php if ( ! empty($settings['image']['url']) ) : ?>
            <div class="widget-image card-img-top" <?php echo wp_kses_post( $this->get_render_attribute_string( 'image' ) ); ?>>
                <?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_dimension', 'image' ) );
                ?>
            </div>
            <?php endif; ?>

            <div class="card-body">
                <?php echo sprintf( 
                    '<%1$s %2$s>%3$s</%1$s>', 
                    Utils::validate_html_tag( $settings['title_html_tag'] ), 
                    wp_kses_post( $this->get_render_attribute_string( 'title' ) ), 
                    wp_kses_post( $settings['title'] )
                ); ?>

                <div class="widget-content card-text" <?php echo wp_kses_post( $this->get_render_attribute_string( 'content' ) ); ?>>
                    <?php echo $this->parse_text_editor( $settings['content'] ); ?>
                </div>

                <?php if ( $settings['button_text'] ) : ?>
                <div class="widget-button card-button">
                    <a <?php echo wp_kses_post( $this->get_render_attribute_string( 'button_link' ) ); ?>><?php echo wp_kses_post( $settings['button_text'] ); ?></a>
                </div>
                <?php endif; ?>
            </div><!-- end .card-body -->

        </div>
    <?php
    }

    protected function content_template() {
    ?>
		<#
            view.addRenderAttribute(
                'title',
                {   
                    'class': [ 
                        'widget-title',
                        'card-title'
                    ]
                }
            );

            var image = {
                id: settings.image.id,
                url: settings.image.url,
                size: settings.image_dimension_size,
                dimension: settings.image_dimension_custom_dimension,
                model: view.getEditModel()
            };
            var image_url = elementor.imagesManager.getImageUrl( image );

            view.addRenderAttribute(
                'button_link',
                {   
                    'href': settings.link_href.url,
                    'target': settings.link_target,
                    'class': [ 
                        'btn',
                        'btn-' + settings.button_css_class,
                        settings.button_custom_css_class,
                        settings.button_size
                    ]
                }
            );

            var titleHtmlTag = elementor.helpers.validateHTMLTag( settings.title_html_tag );
		#>

        <div class="bs-card-wrapper card">

            <# if ( image_url.length > 0 ) { #>
            <div class="widget-image card-img-top" {{{ view.getRenderAttributeString( 'image' ) }}}>
                <img src="{{{ image_url }}}" alt="">
            </div>
            <# } #>

            <div class="card-body">
                <#
                print( '<' + titleHtmlTag  + ' ' + view.getRenderAttributeString( 'title' ) + '>' + settings.title + '</' + titleHtmlTag + '>' );
                #>

                <div class="widget-content card-text" {{{ view.getRenderAttributeString( 'content' ) }}}>
                    {{{ settings.content }}}
                </div>

                
                <# if ( settings.button_text ) { #>

                <div class="widget-button card-button">
                    <a {{{ view.getRenderAttributeString( 'button_link' ) }}}>{{{ settings.button_text }}}</a>
                </div>
                <# } #>

            </div>

        </div>

    <?php

    }
}
