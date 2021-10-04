<?php
namespace DelennerdElements\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Schemes\Color;


class ImageTextBox extends Widget_Base {

    public function get_name() {
        return 'image-text-box';
    }

    public function get_title() {
        return __( 'Image Text Box', 'delennerd-elements' );
    }

    public function get_icon() {
        return 'eicon-icon-box';
    }

    public function get_categories() {
        return [ 'delennerd' ];
    }

	protected function register_controls() {
        
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

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'label' => __( 'Image size', 'delennerd-elements' ),
                'name' => 'image_dimension', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [],
                'include' => [],
                'default' => 'medium',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Title', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __( 'Content', 'delennerd-elements' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Box content', 'delennerd-elements' ),
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
                    'url' => 'https://your-link.com',
                    'is_external' => false,
                    'nofollow' => true,
                ]
            ]
        );

        $this->add_control(
            'link_target',
            [
                'label' => __( 'Button Text', 'delennerd-elements' ),
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
            'button_text',
            [
                'label' => __( 'Button Text', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'My Button', 'delennerd-elements' ),
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
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
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
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
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
                'default' => 'center',
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
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
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
                'default' => 'center',
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
                'default' => 'center',
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

		$this->add_inline_editing_attributes( 'title', 'none' );
		$this->add_inline_editing_attributes( 'content', 'basic' );
		$this->add_inline_editing_attributes( 'button_text', 'none' );

        $this->add_render_attribute( 
            'button_link', 
            [   
                'href' => $settings['link_href']['url'],
                'target' => $settings['link_target'],
                'class' => [
                    'btn',
                    'btn-' . $settings['css_class']
                ]
            ]
        );
	?>
        <div class="delennerd-image-text-box-wrapper">

            <div class="widget-image" <?php echo $this->get_render_attribute_string( 'image' ); ?>>
                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_dimension', 'image' );
                //echo wp_get_attachment_image( $settings['image']['id'], $settings['image_dimension_size'] );
                ?>
            </div>
            <h4 class="widget-title" <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h4>

            <div class="widget-content" <?php echo $this->get_render_attribute_string( 'content' ); ?>><?php echo $settings['content']; ?></div>

            <div class="widget-button">
                <a <?php echo $this->get_render_attribute_string( 'button_link' ); ?>><?php echo $settings['button_text']; ?></a>
            </div>

        </div>
    <?php
    }

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
                'button_link',
                {   
                    'href': settings.link_href.url,
                    'target': settings.link_target,

                    'class': [ 
                        'btn',
                        'btn-' + settings.css_class
                    ]
                }
            );
		#>

        <div class="widget-image">
            <img src="{{{ image_url }}}" alt="">
        </div>

		<div class="widget-title" {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</div>

		<div class="widget-content" {{{ view.getRenderAttributeString( 'content' ) }}}>{{{ settings.content }}}</div>

        <div class="widget-button" {{{ view.getRenderAttributeString('button_text') }}}>
            <a {{{ view.getRenderAttributeString( 'button_link' ) }}}>{{{ settings.button_text }}}</a>
        </div>

    <?php
	}
}
