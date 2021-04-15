<?php
namespace DelennerdElements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flipbox extends Widget_Base {

    public function get_name() {
        return 'dlm-flipbox';
    }

    public function get_title() {
        return __( 'Flipbox', 'delennerd-elements' );
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
            DELENNERD_ELEMENTS_ASSETS_URL . '/css/flipbox.css', [], DELENNERD_ELEMENTS_VER
        );
	}

	public function get_style_depends() {
		return [
            'delennerd-elements-flipbox-css',
        ];
	}

    protected function _register_controls() {

        /***********************/
        /** TOGGLE: Front side **/
        /***********************/

        $this->start_controls_section(
        'front_content',
            [
                'label' => __( 'Front side', 'delennerd-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'front_image_icon',
            [
                'label' => __( 'Show Image or icon', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image'  => __( 'Image', 'delennerd-elements' ),
                    'icon'  => __( 'Icon', 'delennerd-elements' ),
                    'bg-image'  => __( 'Background Image', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'front_image',
            [
                'label' => __( 'Image', 'delennerd-elements' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => 'https://picsum.photos/500/500',
                ],
                'condition' => [
                    'front_image_icon' => [ 'image', 'bg-image' ],
                ],
            ]
        );

        $this->add_control(
            Group_Control_Image_Size::get_type(),
            [
                'type' => Controls_Manager::SELECT,
                'label' => __( 'Image size', 'delennerd-elements' ),
                'name' => 'front_image_dimension', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [],
                'include' => [],
                'default' => 'medium',
                'options' => [
                    'thumbnail'  => __( 'Thumbnail - 150 x 150', 'delennerd-elements' ),
                    'medium' => __( 'Medium - 300 x 300', 'delennerd-elements' ),
                    'medium_large' => __( 'Medium Large - 768 x 0', 'delennerd-elements' ),
                    'custom' => __( 'Custom', 'delennerd-elements' ),
                ],
                'condition' => [
                    'front_image_icon' => [ 'image', 'bg-image' ],
                ],
            ]
        );

        $this->add_control(
            'front_icon',
            [
                'label' => __( 'Icon', 'delennerd-elements' ),
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
            'front_text',
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
        /** TOGGLE: Back side **/
        /***********************/

        $this->start_controls_section(
        'back_content',
            [
                'label' => __( 'Back side', 'delennerd-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        /*
        $this->add_control(
            'back_image_icon',
            [
                'label' => __( 'Show Image or icon', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image'  => __( 'Image', 'delennerd-elements' ),
                    'icon'  => __( 'Icon', 'delennerd-elements' ),
                    'bg-image'  => __( 'Background Image', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'back_image',
            [
                'label' => __( 'Image', 'delennerd-elements' ),
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
                'label' => __( 'Image size', 'delennerd-elements' ),
                'name' => 'back_image_dimension', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [],
                'include' => [],
                'default' => 'medium',
                'options' => [
                    'thumbnail'  => __( 'Thumbnail - 150 x 150', 'delennerd-elements' ),
                    'medium' => __( 'Medium - 300 x 300', 'delennerd-elements' ),
                    'medium_large' => __( 'Medium Large - 768 x 0', 'delennerd-elements' ),
                    'custom' => __( 'Custom', 'delennerd-elements' ),
                ],
                'condition' => [
                    'back_image_icon' => [ 'image', 'bg-image' ],
                ],
            ]
        );

        $this->add_control(
            'back_icon',
            [
                'label' => __( 'Icon', 'delennerd-elements' ),
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
            'back_text',
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
        /** STYLE: Front side **/
        /***********************/

        $this->start_controls_section(
        'front_style',
            [
                'label' => __( 'Front side', 'delennerd-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'front_bg_color',
            [
                'label' => __( 'Background color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
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
                'label' => __( 'Back side', 'delennerd-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'back_bg_color',
            [
                'label' => __( 'Background color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
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

        /************
        /** Front side
        ************/

        $this->add_render_attribute( 'flipbox_front', 'class', 'flipbox__front' );

        if ( $settings['front_image_icon'] == 'bg-image' ) {
            $frontImageBgUrl = wp_get_attachment_image_url( $settings['front_image']['id'], 'medium_large' );
            $this->add_render_attribute( 'flipbox_front', 'style', 'background-image: url('. $frontImageBgUrl .')' );
            $this->add_render_attribute( 'flipbox', 'class', 'flipbox--has-bg-image' );
        }

        $this->add_render_attribute( 'front_title', 'class', 'flipbox__title' );
        $this->add_render_attribute( 'front_text', 'class', 'flipbox__content' );

        /************
        /** Back side
        ************/
        $this->add_render_attribute( 'flipbox_back', 'class', 'flipbox__back' );
        $this->add_render_attribute( 'back_title', 'class', 'flipbox__title' );
        $this->add_render_attribute( 'back_text', 'class', 'flipbox__content' );

    ?>

         <div <?php echo $this->get_render_attribute_string( 'flipbox' ); ?>>

            <div <?php echo $this->get_render_attribute_string( 'flipbox_front' ); ?>>

                <div class="flipbox__inner">

                    <?php if ( $settings['front_image_icon'] == 'image' || $settings['front_image_icon'] == 'icon' ) : ?>

                    <div class="flipbox__image">

                        <?php if ( $settings['front_image_icon'] == 'image' ) : ?>

                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'front_image_dimension', 'front_image' ); ?>

                        <?php endif; ?>

                        <?php if ( $settings['front_image_icon'] == 'icon' ) : ?>

                            <?php if ( ! is_array($settings['front_icon']['value']) ) : ?>

                                <?php \Elementor\Icons_Manager::render_icon( $settings['front_icon'], [ 'aria-hidden' => 'true', 'class' => 'fa-3x' ] ); ?>

                            <?php else : ?>

                                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, '300x300', 'front_icon' ); ?>

                                <img src="<?php echo $settings['front_icon']['value']['url'] ?>" alt="<?php echo $settings['front_title'] ?>">

                            <?php endif; ?>

                        <?php endif; ?>

                    </div>

                    <?php endif; ?>

                    <div <?php echo $this->get_render_attribute_string( 'front_title' ); ?>>
                        
                        <?php echo sprintf( 
                                '<h3 %1$s>%2$s</h3>', 
                                'class="title"',
                                $settings['front_title'] 
                        ); ?>

                    </div>

                    <div <?php echo $this->get_render_attribute_string( 'front_text' ); ?>>
                        
                        <?php echo $settings['front_text']; ?>

                    </div>

                </div>

            </div>
            
            <div <?php echo $this->get_render_attribute_string( 'flipbox_back' ); ?>>

                <div class="flipbox__inner">

                    <div <?php echo $this->get_render_attribute_string( 'back_title' ); ?>>
                        
                            <?php echo sprintf( 
                                '<h3 %1$s>%2$s</h3>', 
                                'class="title"',
                                $settings['back_title'] 
                        ); ?>

                    </div>

                    <div <?php echo $this->get_render_attribute_string( 'flipbox__content' ); ?>>
                        
                        <?php echo $settings['back_text']; ?>

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
            view.addRenderAttribute( 'back_title', 'class', 'flipbox__back' );
            view.addRenderAttribute( 'back_text', 'class', 'flipbox__back' );
        #>

        <div {{{ view.getRenderAttributeString( 'flipbox' ) }}}>

            <div {{{ view.getRenderAttributeString( 'flipbox_front' ) }}}>
                <div class="flipbox__inner">

                    <# if ( frontImageIcon == 'image' || frontImageIcon == 'icon' ) { #>

                    <div class="flipbox__image">

                        <# if ( frontImageIcon == 'image' ) { #>
                            <img src="{{{ frontImageUrl }}}" alt="">
                        <# } #>

                        <# if ( frontImageIcon == 'icon' ) { #>
                            <# if ( frontIcon.value.url == 'undefined' ) { #>

                                <i class="fa-3x {{{ frontIcon.value }}}"></i>

                            <# } else { #>

                                <img src="{{{ frontIcon.value.url }}}" alt="{{{ frontTitle }}}">

                            <# } #>
                        <# } #>
                        
                    </div>

                    <# } #>

                    <div class="flipbox__title"><h3 class="title"> {{{ frontTitle }}} </h3></div>
                    <div class="flipbox__content"> {{{ frontText }}} </div>

                </div>
            </div>

            <div {{{ view.getRenderAttributeString( 'flipbox_back' ) }}}>
                <div class="flipbox__inner">

                    <div class="flipbox__title"><h3 class="title"> {{{ backTitle }}} </h3></div>
                    <div class="flipbox__content"> {{{ backText }}} </div>

                </div>
            </div>
        
        </div>

    <?php
    }
}