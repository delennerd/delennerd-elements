<?php
namespace DelennerdElements\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;


class BootstrapButton extends Widget_Base {

    public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

        wp_register_style( 
            'delennerd-elements-bs-buttons-widget-css', 
            DELENNERD_ELEMENTS_ASSETS_URL . '/css/bs-button.css', [], DELENNERD_ELEMENTS_VER
        );
	}

	public function get_style_depends() {
		return [ 'delennerd-elements-bs-buttons-widget-css' ];
	}

    public function get_name() {
        return 'bootstrap-button';
    }

    public function get_title() {
        return __( 'Bootstrap Button', 'delennerd-elements' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'delennerd' ];
    }

	protected function register_controls() {

        /***********************/
        /** SECTION: Button settings **/
        /***********************/

        $this->start_controls_section(
            'button_style',
            [
                'label' => __( 'Button style', 'delennerd-elements' ),
            ]
        );

        $this->add_responsive_control(
			'space_between',
			[
				'label' => __( 'Space Between', 'delennerd-elements' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dlm-elements-bs-buttons-items .dlm-elements-bs-buttons-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .dlm-elements-bs-buttons-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body.rtl {{WRAPPER}} .dlm-elements-bs-buttons-items .dlm-elements-bs-buttons-item:after' => 'left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body:not(.rtl) {{WRAPPER}} .dlm-elements-bs-buttons-items .dlm-elements-bs-buttons-item:after' => 'right: calc(-{{SIZE}}{{UNIT}}/2)',
				],
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => __( 'Alignment', 'delennerd-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'delennerd-elements' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'delennerd-elements' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'delennerd-elements' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
			]
		);

        $this->end_controls_section();

        /***********************/
        /** SECTION: Button **/
        /***********************/

        $this->start_controls_section(
            'button_content',
            [
                'label' => __( 'Buttons', 'delennerd-elements' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => __( 'Text', 'delennerd-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'List Item', 'delennerd-elements' ),
				'default' => __( 'List Item', 'delennerd-elements' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
        
		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'delennerd-elements' ),
                'default' => [
                    'url' => '#',
                ],
			]
		);

        $repeater->add_control(
            'link_custom_target',
            [
                'label' => __( 'Custom link target', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'custom_css_id',
            [
                'label' => __( 'CSS ID', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'custom_css_class',
            [
                'label' => __( 'CSS Classes', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'css_class',
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
			'button_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => __( 'Button #1', 'delennerd-elements' ),
                        'css_class' => 'primary',
                        'link' => '#',
					],
					[
						'text' => __( 'Button #2', 'delennerd-elements' ),
                        'css_class' => 'secondary',
                        'link' => '#',
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);

        $this->end_controls_section();
    }

 	protected function render() {
		$settings = $this->get_settings_for_display();

        $this->add_render_attribute( 
            'buttons_wrapper', 
            [
                'class' => [
                    'dlm-elements-bs-buttons-items',
                    'list-inline'
                ]
            ]
        );

        $this->add_render_attribute( 
            'button_item', 
            [
                'class' => [
                    'dlm-elements-bs-buttons-item',
                    'list-inline-item'
                ]
            ]
        );

        ?>

        <ul <?php echo $this->get_render_attribute_string( 'buttons_wrapper' ); ?>>

            <?php

            foreach ( $settings['button_list'] as $index => $item ) :
                $repeater_setting_key = $this->get_repeater_setting_key( 'text', 'button_list', $index );

                $this->add_render_attribute( 
                    $repeater_setting_key, 
                    [
                        'class' => [
                            'btn',
                            'btn-' . $item['css_class'],
                            $item['custom_css_class']
                        ],
                        'id' => ( !empty($item['custom_css_id']) ? $item['custom_css_id'] : '' )
                    ]
                );

            ?>

            <li <?php echo $this->get_render_attribute_string( 'button_item' ); ?>>

                <?php
                if ( ! empty( $item['link']['url'] ) ) {
                    $link_key = 'link_' . $index;

                    if ( !empty($item['link_custom_target']) ) {
                        if ( !empty($item['link']['custom_attributes']) ) {
                            $item['link']['custom_attributes'] .= ',target|' . $item['link_custom_target'];
                        }
                        else {
                            $item['link']['custom_attributes'] .= 'target|' . $item['link_custom_target'];
                        }
                    }

                    $this->add_link_attributes( $link_key, $item['link'] );

                    echo '<a ' . $this->get_render_attribute_string( $link_key ) . ' ' . $this->get_render_attribute_string( $repeater_setting_key ) . '>';
                }

                echo $item['text'];
                
                if (! empty($item['link']['url'])) {
                    echo '</a>';
                }

                ?>

            </li>
                
            <?php endforeach; ?>

        </ul>
    <?php

    }

	protected function _content_template() {
    ?>
		<#
            view.addRenderAttribute(
                'buttons_wrapper',
                {
                    'class': [ 
                        'dlm-elements-bs-buttons-items', 
                        'list-inline' 
                    ]
                }
            );

            view.addRenderAttribute(
                'button_item',
                {
                    'class': [ 
                        'dlm-elements-bs-buttons-item', 
                        'list-inline-item' 
                    ]
                }
            );
		#>

        <# if ( settings.button_list ) { #>
            <ul {{{ view.getRenderAttributeString( 'buttons_wrapper' ) }}}>

            <# _.each( settings.button_list, function( item, index ) { 

                var buttonKey = view.getRepeaterSettingKey( 'text', 'button_list', index );

                var btn_css_id = 

                view.addRenderAttribute(
                    buttonKey,
                    {
                        'class': [ 
                            'btn', 
                            'btn-' + item.css_class,
                            item.custom_css_class
                        ],
                        'id': item.custom_css_id
                    }
                );
                
            #>
                
                <li {{{ view.getRenderAttributeString( 'button_item' ) }}}>
                    <# if ( item.link && item.link.url ) { #>
                        <a href="{{ item.link.url }}" {{{ view.getRenderAttributeString( buttonKey ) }}}>
                    <# } #>
                        {{{ item.text }}}
                    <# if ( item.link && item.link.url ) { #>
                        </a>
                    <# } #>
                </li>

            <#	} ); #>

            </ul>
        <# } #>

    <?php
	}
}
