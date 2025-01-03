<?php
namespace DelennerdElements\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use \Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Image_Size;

class Flipbox extends Widget_Base {

    public function get_name() {
        return 'dlm-flipbox';
    }

    public function get_title() {
        return esc_html__( 'Flipbox', 'delennerd-elements' );
    }

    public function get_icon() {
        return 'eicon-flip-box';
    }

    public function get_categories() {
        return [ 'delennerd' ];
    }

    public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

        wp_register_style( 
            'delennerd-elements-flipbox-css', 
            DELENNERD_ELEMENTS_ASSETS_URL . 'css/flipbox.css', [], DELENNERD_ELEMENTS_VER
        );
	}

	public function get_style_depends() {
		return [
            'delennerd-elements-flipbox-css',
        ];
	}

    protected function register_controls() {

        /***********************/
        /** TOGGLE: Front side **/
        /***********************/

        $this->start_controls_section(
        'front_content',
            [
                'label' => esc_html__( 'Front side', 'delennerd-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'front_image_icon',
            [
                'label' => esc_html__( 'Show Image or icon', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image'  => esc_html__( 'Image', 'delennerd-elements' ),
                    'icon'  => esc_html__( 'Icon', 'delennerd-elements' ),
                    'bg-image'  => esc_html__( 'Background Image', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'front_image',
            [
                'label' => esc_html__( 'Image', 'delennerd-elements' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => 'https://picsum.photos/500/500',
                ],
                'condition' => [
                    'front_image_icon' => [ 'image', 'bg-image' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'label' => esc_html__( 'Image size', 'delennerd-elements' ),
                'name' => 'front_image_dimension', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [
                    '',
                ],
                'include' => [],
                'default' => 'medium',
                'condition' => [
                    'front_image_icon' => [ 'image', 'bg-image' ],
                ],
            ]
        );

        $this->add_control(
            'front_icon',
            [
                'label' => esc_html__( 'Icon', 'delennerd-elements' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
					'library' => 'solid',
                ],
                'condition' => [
                    'front_image_icon' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'front_title',
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
            'front_text',
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

        /***********************/
        /** TOGGLE: Back side **/
        /***********************/

        $this->start_controls_section(
        'back_content',
            [
                'label' => esc_html__( 'Back side', 'delennerd-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        /*
        $this->add_control(
            'back_image_icon',
            [
                'label' => esc_html__( 'Show Image or icon', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image'  => esc_html__( 'Image', 'delennerd-elements' ),
                    'icon'  => esc_html__( 'Icon', 'delennerd-elements' ),
                    'bg-image'  => esc_html__( 'Background Image', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'back_image',
            [
                'label' => esc_html__( 'Image', 'delennerd-elements' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => null,
                ],
                'selectors' => [
                    '{{WRAPPER}} .flipbox__front' => 'background-image: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            Group_Control_Image_Size::get_type(),
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Image size', 'delennerd-elements' ),
                'name' => 'back_image_dimension', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [],
                'include' => [],
                'default' => 'medium',
                'options' => [
                    'thumbnail'  => esc_html__( 'Thumbnail - 150 x 150', 'delennerd-elements' ),
                    'medium' => esc_html__( 'Medium - 300 x 300', 'delennerd-elements' ),
                    'medium_large' => esc_html__( 'Medium Large - 768 x 0', 'delennerd-elements' ),
                    'custom' => esc_html__( 'Custom', 'delennerd-elements' ),
                ],
                'condition' => [
                    'back_image_icon' => [ 'image', 'bg-image' ],
                ],
            ]
        );

        $this->add_control(
            'back_icon',
            [
                'label' => esc_html__( 'Icon', 'delennerd-elements' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
					'library' => 'solid',
                ],
                'condition' => [
                    'front_image_icon' => 'icon',
                ],
            ]
        );
        */

        $this->add_control(
            'back_title',
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
            'back_text',
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

        /***********************/
        /** STYLE: Front side **/
        /***********************/

        $this->start_controls_section(
        'front_style',
            [
                'label' => esc_html__( 'Front side', 'delennerd-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'front_bg_color',
            [
                'label' => esc_html__( 'Background color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'global' => [
        			'default' => Global_Colors::COLOR_PRIMARY,
        		],
                'selectors' => [
                    '{{WRAPPER}} .flipbox__front' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        /***********************/
        /** STYLE: Back side **/
        /***********************/

        $this->start_controls_section(
        'back_style',
            [
                'label' => esc_html__( 'Back side', 'delennerd-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'back_bg_color',
            [
                'label' => esc_html__( 'Background color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'global' => [
        			'default' => Global_Colors::COLOR_PRIMARY,
        		],
                'selectors' => [
                    '{{WRAPPER}} .flipbox__back' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        /************
        /** Global
        ************/

        $this->add_render_attribute( 'flipbox', 'class', 'flipbox' );

        $has_image_or_icon = $settings['front_image_icon'] == 'image' || $settings['front_image_icon'] == 'icon';
        $is_image = $settings['front_image_icon'] == 'image';
        $is_icon = $settings['front_image_icon'] == 'icon';

        /************
        /** Front side
        ************/

        $this->add_render_attribute( 'flipbox_front', 'class', 'flipbox__front' );

        if ( $settings['front_image_icon'] == 'bg-image' ) {
            // $frontImageBgUrl = wp_get_attachment_image_url( $settings['front_image']['id'], 'medium_large' );
            $frontImageBgUrl = Group_Control_Image_Size::get_attachment_image_src( $settings['front_image']['id'], 'front_image_dimension', $settings );
            $this->add_render_attribute( 'flipbox_front', 'style', 'background-image: url('. $frontImageBgUrl .')' );
            $this->add_render_attribute( 'flipbox', 'class', 'flipbox--has-bg-image' );
        }

        /************
        /** Back side
        ************/

        $this->add_render_attribute( 'flipbox_back', 'class', 'flipbox__back' );

    ?>
         <div <?php echo $this->get_render_attribute_string( 'flipbox' ); ?>>
            <div <?php echo $this->get_render_attribute_string( 'flipbox_front' ); ?>>
                <div class="flipbox__inner">
                    <?php if ( $has_image_or_icon && !empty($settings['front_icon']['value']) ) : ?>
                        <div class="flipbox__image">

                            <?php if ( $is_image ) : ?>
                                <?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'front_image_dimension', 'front_image' ) ); ?>
                            <?php endif; ?>

                            <?php if ( $is_icon ) : ?>
                                <?php if ( is_array($settings['front_icon']['value']) ) : ?>
                                    <img src="<?php echo Utils::validate_html_tag( $settings['front_icon']['value']['url'] ); ?>" alt="<?php echo wp_kses_post( $settings['front_title'] ); ?>">
                                <?php else : ?>
                                    <?php wp_kses_post( \Elementor\Icons_Manager::render_icon( $settings['front_icon'], [ 'aria-hidden' => 'true', 'class' => 'fa-3x' ] ) ); ?>
                                <?php endif; ?>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                    <div class="flipbox__title" <?php echo wp_kses_post( $this->get_render_attribute_string( 'front_title' ) ); ?>>
                        <?php echo sprintf( 
                                '<h4 %1$s>%2$s</h4>', 
                                'class="title"',
                                wp_kses_post( $settings['front_title'] )
                        ); ?>
                    </div>
                    <div class="flipbox__content" <?php echo $this->get_render_attribute_string( 'front_text' ); ?>>
                        <?php echo $this->parse_text_editor( $settings['front_text'] ); ?>
                    </div>
                </div>
            </div>
            <div <?php echo wp_kses_post( $this->get_render_attribute_string( 'flipbox_back' ) ); ?>>
                <div class="flipbox__inner">
                    <div class="flipbox__title" <?php echo $this->get_render_attribute_string( 'flipbox_back' ); ?>>
                        <?php echo sprintf( 
                            '<h4 %1$s>%2$s</h4>',
                            'class="title"',
                            wp_kses_post( $settings['back_title'] )
                        ); ?>
                    </div>
                    <div class="flipbox__content" <?php echo $this->get_render_attribute_string( 'back_text' ); ?>>
                        <?php echo $this->parse_text_editor( $settings['back_text'] ); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php

    }

    protected function content_template() {
    ?>
        <#
            var frontTitle = settings.front_title;
            var frontText = settings.front_text;
            var frontImageIcon = settings.front_image_icon;
            var frontImage = settings.front_image;
            var frontIcon = settings.front_icon;
            var frontImageObj = {
                id: frontImage.id,
                url: frontImage.url,
                size: settings.front_image_dimension_size,
                dimension: settings.front_image_dimension_dimension,
                model: view.getEditModel(),
            };
            var frontImageUrl = elementor.imagesManager.getImageUrl( frontImageObj );

            var backTitle = settings.back_title;
            var backText = settings.back_text;

            /************
            /** Global
            ************/

            view.addRenderAttribute( 'flipbox', 'class', 'flipbox' );

            /************
            /** Front side
            ************/

            view.addRenderAttribute( 'flipbox_front', 'class', 'flipbox__front' );

            if ( frontImageIcon == 'bg-image' ) {
                view.addRenderAttribute( 'flipbox_front', 'style', 'background-image: url('+ frontImage.url +')' );
                view.addRenderAttribute( 'flipbox', 'class', 'flipbox--has-bg-image' );
            }

            /************
            /** Back side
            ************/

            view.addRenderAttribute( 'flipbox_back', 'class', 'flipbox__back' );            
        #>

        <div {{{ view.getRenderAttributeString( 'flipbox' ) }}}>

            <div {{{ view.getRenderAttributeString( 'flipbox_front' ) }}}>
                <div class="flipbox__inner">
                    <# if ( (frontImageIcon == 'image' || frontImageIcon == 'icon') && frontIcon.value != "" ) { #>
                        <div class="flipbox__image">
                            <# if ( frontImageIcon == 'image' ) { #>
                                <img src="{{{ frontImageUrl }}}" alt="">
                            <# } #>
                            <# if ( frontImageIcon == 'icon' ) { #>
                                <# if ( frontIcon.value.url != undefined ) { #>
                                    <img src="{{{ frontIcon.value.url }}}" alt="{{{ frontTitle }}}">
                                <# } else { #>
                                    <i class="fa-3x {{{ frontIcon.value }}}"></i>
                                <# } #>
                            <# } #>
                        </div>
                    <# } #>
                    <div class="flipbox__title" {{{ view.getRenderAttributeString( 'front_title' ) }}}><h3 class="title"> {{{ frontTitle }}} </h3></div>
                    <div class="flipbox__content" {{{ view.getRenderAttributeString( 'front_text' ) }}}> {{{ frontText }}} </div>
                </div>
            </div>
            <div {{{ view.getRenderAttributeString( 'flipbox_back' ) }}}>
                <div class="flipbox__inner">
                    <div class="flipbox__title" {{{ view.getRenderAttributeString( 'back_title' ) }}}>
                        <h3 class="title"> {{{ backTitle }}} </h3>
                    </div>
                    <div class="flipbox__content" {{{ view.getRenderAttributeString( 'back_text' ) }}}>{{{ backText }}}</div>
                </div>
            </div>
        
        </div>

    <?php
    }
}