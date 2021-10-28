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
        return __( 'BS Card', 'delennerd-elements' );
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

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'label' => __( 'Image size', 'delennerd-elements' ),
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

        /**
         * -------------------------------------------
         * Tab Content (Button)
         * -------------------------------------------
         */

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

        /**
         * -------------------------------------------
         * Tab Style (Image Style)
         * -------------------------------------------
         */

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

        /**
         * -------------------------------------------
         * Tab Style (Title Style)
         * -------------------------------------------
         */

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
			'title_html_tag',
			[
				'label' => __( 'HTML Tag', 'elementor' ),
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
                'label' => __( 'Title Color', 'delennerd-elements' ),
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
                'label'    => __( 'Typography', 'delennerd-elements' ),
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
                'label' => __( 'Alignment', 'delennerd-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                        'left' => [
                        'title' => __( 'Left', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                        'center' => [
                        'title' => __( 'Center', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                        'right' => [
                        'title' => __( 'Right', 'delennerd-elements' ),
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
                'label' => __( 'Alignment', 'delennerd-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                        'left' => [
                        'title' => __( 'Left', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                        'center' => [
                        'title' => __( 'Center', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                        'right' => [
                        'title' => __( 'Right', 'delennerd-elements' ),
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
                'label' => __( 'Background color', 'delennerd-elements' ),
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
                'label' => __( 'Button Style', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => [
                    'link' => __( 'Link', 'delennerd-elements' ),
                    'primary' => __( 'Primary', 'delennerd-elements' ),
                    'secondary' => __( 'Secondary', 'delennerd-elements' ),

                    'outline-primary' => __( 'Outline Primary', 'delennerd-elements' ),
                    'outline-secondary' => __( 'Outline Secondary', 'delennerd-elements' ),

                    'outline-custom' => __( 'Outline Custom', 'delennerd-elements' ),
                    'outline-custom btn-outline-custom--primary' => __( 'Outline Custom - Primary', 'delennerd-elements' ),
                    'outline-custom btn-outline-custom--secondary' => __( 'Outline Custom - Secondary', 'delennerd-elements' ),
                    
                    'success' => __( 'Success', 'delennerd-elements' ),
                    'danger' => __( 'Danger', 'delennerd-elements' ),
                    'warning' => __( 'Warning', 'delennerd-elements' ),
                    'outline-success' => __( 'Outline Success', 'delennerd-elements' ),
                    'outline-danger' => __( 'Outline Danger', 'delennerd-elements' ),
                    'outline-warning' => __( 'Outline Warning', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => __( 'Button Style', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => [
                    '' => __( 'Normal', 'delennerd-elements' ),
                    'btn-sm' => __( 'Small', 'delennerd-elements' ),
                    'btn-lg' => __( 'Large', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
            'name'     => 'button_typography',
            'label'    => __( 'Typography', 'delennerd-elements' ),
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
                'label' => __( 'Alignment', 'delennerd-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                        'left' => [
                        'title' => __( 'Left', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                        'center' => [
                        'title' => __( 'Center', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                        'right' => [
                        'title' => __( 'Right', 'delennerd-elements' ),
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
            <div class="widget-image card-img-top" <?php echo $this->get_render_attribute_string( 'image' ); ?>>
                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_dimension', 'image' );
                ?>
            </div>
            <?php endif; ?>

            <div class="card-body">
                <?php echo sprintf( 
                    '<%1$s %2$s>%3$s</%1$s>', 
                    $settings['title_html_tag'], 
                    $this->get_render_attribute_string( 'title' ), 
                    $settings['title'] 
                ); ?>

                <div class="widget-content card-text" <?php echo $this->get_render_attribute_string( 'content' ); ?>>
                    <?php echo $settings['content']; ?>
                </div>

                <?php if ( $settings['button_text'] ) : ?>
                <div class="widget-button card-button">
                    <a <?php echo $this->get_render_attribute_string( 'button_link' ); ?>><?php echo $settings['button_text']; ?></a>
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
		#>

        <div class="bs-card-wrapper card">

            <# if ( image_url.length > 0 ) { #>
            <div class="widget-image card-img-top" {{{ view.getRenderAttributeString( 'image' ) }}}>
                <img src="{{{ image_url }}}" alt="">
            </div>
            <# } #>

            <div class="card-body">
                <#
                print( '<' + settings.title_html_tag  + ' ' + view.getRenderAttributeString( 'title' ) + '>' + settings.title + '</' + settings.title_html_tag + '>' );
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
