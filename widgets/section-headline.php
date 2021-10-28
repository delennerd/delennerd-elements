<?php
namespace DelennerdElements\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Image_Size;


class SectionHeadline extends Widget_Base
{
    public function get_name()
    {
        return 'section-headline';
    }

    public function get_title()
    {
        return __('Section Headline', 'delennerd-elements');
    }

    public function get_icon()
    {
        return 'eicon-t-letter';
    }

    public function get_categories()
    {
        return [ 'delennerd' ];
    }

    public function get_keywords() {
		return [ 
            'heading',
            'title',
            'subtitle',
            'text',
            'section',
            'abschnitt'
        ];
	}

	protected function register_controls() {
        
        /**
         * -------------------------------------------
         * Tab Content (Section Headline Content)
         * -------------------------------------------
         */

        $this->start_controls_section(
            'dlme_headline_content_settings',
            [
                'label' => __( 'Content', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => __( 'Enter your title', 'delennerd-elements' ),
                'default' => __( 'Add Your Heading Text Here', 'delennerd-elements' ),
                'dynamic' => array(
                    'active' => true
                ),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __( 'Subtitle', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => __( 'Enter your title', 'delennerd-elements' ),
                'default' => __( 'My Subtitle', 'delennerd-elements' ),
                'dynamic' => array(
                    'active' => true
                ),
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Global Style)
         * -------------------------------------------
         */

        $this->start_controls_section(
			'headline_style_section',
			[
				'label' => __( 'Alignment', 'delennerd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'headline_horizontal_align',
            [
                'label' => __( 'Alignment', 'delennerd-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'text-left',
                'options' => [
                    'text-left' => [
                        'title' => __( 'Left', 'delennerd-elements' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'text-center' => [
                        'title' => __( 'Center', 'delennerd-elements' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'text-right' => [
                        'title' => __( 'Right', 'delennerd-elements' ),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'dlmel_sh_custom_css',
            [
                'label' => __( 'Headline class', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => '',
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
				'default' => 'h2',
			]
		);

        $this->add_control(
            'title_font_size',
            [
                'label' => __( 'Font size', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'inherit'  => __( 'Headline Tag', 'delennerd-elements' ),
                    'normal'  => __( 'Normal', 'delennerd-elements' ),
                    'big'  => __( 'Big', 'delennerd-elements' ),
                    'bigger'  => __( 'Bigger', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'inherit',
                'options' => [
                    'inherit'  => __( 'Default', 'delennerd-elements' ),
                    'primary'  => __( 'Primary', 'delennerd-elements' ),
                    'secondary'  => __( 'Secondary', 'delennerd-elements' ),
                    'thirdy'  => __( 'Thirdy', 'delennerd-elements' ),
                    'black'  => __( 'Black', 'delennerd-elements' ),
                    'white'  => __( 'White', 'delennerd-elements' ),
                    'light-grey'  => __( 'Light Grey', 'delennerd-elements' ),
                    'custom1'  => __( 'Custom 1', 'delennerd-elements' ),
                    'custom2'  => __( 'Custom 2', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'title_custom_css',
            [
                'label' => __( 'Title class', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => '',
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Subtitle Style)
         * -------------------------------------------
         */

        $this->start_controls_section(
			'subtitle_style_section',
			[
				'label' => __( 'Subtitle', 'delennerd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'subtitle_html_tag',
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
				'default' => 'h5',
			]
		);

        $this->add_control(
            'subtitle_font_size',
            [
                'label' => __( 'Font size', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'inherit'  => __( 'Subtitle Tag', 'delennerd-elements' ),
                    'normal'  => __( 'Normal', 'delennerd-elements' ),
                    'big'  => __( 'Big', 'delennerd-elements' ),
                    'bigger'  => __( 'Bigger', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Color', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'inherit',
                'options' => [
                    'inherit'  => __( 'Default', 'delennerd-elements' ),
                    'primary'  => __( 'Primary', 'delennerd-elements' ),
                    'secondary'  => __( 'Secondary', 'delennerd-elements' ),
                    'thirdy'  => __( 'Thirdy', 'delennerd-elements' ),
                    'black'  => __( 'Black', 'delennerd-elements' ),
                    'white'  => __( 'White', 'delennerd-elements' ),
                    'light-grey'  => __( 'Light Grey', 'delennerd-elements' ),
                    'custom1'  => __( 'Custom 1', 'delennerd-elements' ),
                    'custom2'  => __( 'Custom 2', 'delennerd-elements' ),
                ],
            ]
        );

         $this->add_control(
            'subtitle_position',
            [
                'label' => __( 'Position', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top'  => __( 'Top', 'delennerd-elements' ),
                    'bottom'  => __( 'Bottom', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'subtitle_show_border',
            [
                'label' => __( 'Border', 'delennerd-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'subtitle_border_color',
            [
                'label' => __( 'Border color', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'black',
                'options' => [
                    'primary'  => __( 'Primary', 'delennerd-elements' ),
                    'secondary'  => __( 'Secondary', 'delennerd-elements' ),
                    'thirdy'  => __( 'Thirdy', 'delennerd-elements' ),
                    'black'  => __( 'Black', 'delennerd-elements' ),
                    'white'  => __( 'White', 'delennerd-elements' ),
                    'light-grey'  => __( 'Light Grey', 'delennerd-elements' ),
                    'custom1'  => __( 'Custom 1', 'delennerd-elements' ),
                    'custom2'  => __( 'Custom 2', 'delennerd-elements' ),
                ],
                'condition' => [
                    'subtitle_show_border' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'subtitle_border_width',
            [
                'label' => __( 'Border width', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fullwidth',
                'options' => [
                    'fullwidth'  => __( 'Full width', 'delennerd-elements' ),
                    'maxwidth1'  => __( 'With Max-Width 1', 'delennerd-elements' ),
                    'maxwidth2'  => __( 'With Max-Width 2', 'delennerd-elements' ),
                ],
                'condition' => [
                    'subtitle_show_border' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'subtitle_custom_css',
            [
                'label' => __( 'Subtitle class', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => '',
            ]
        );

		$this->end_controls_section();
    }

 	protected function render() {
		$settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'title' );
        $this->add_inline_editing_attributes( 'subtitle' );

        /************
        /** Global
        /***********/

        $this->add_render_attribute(
            'headline', [
                'class' => [
                    'section-headline',
                    $settings['headline_horizontal_align'],
                ]
            ]
        );

        // $this->add_render_attribute( 'headline', 'class', 'section-headline' );
        
        // if ( ! empty( $settings['headline_horizontal_align'] ) ) 
        //     $this->add_render_attribute( 'headline', 'class', $settings['headline_horizontal_align'] );

        if ( ! empty( $settings['dlmel_sh_custom_css'] ) ) 
            $this->add_render_attribute( 'headline', 'class', $settings['dlmel_sh_custom_css'] );
        

        /************
        /** Title
        ************/

        $this->add_render_attribute( 'title', 'class', 'section-headline__title' );

        if ( $settings['title_color'] != 'inherit' ) 
            $this->add_render_attribute( 'title', 'class', 'text-' . $settings['title_color'] );

        if ( ! empty( $settings['title_font_size'] ) ) 
            $this->add_render_attribute( 'title', 'class', 'section-headline__title--font-' . $settings['title_font_size'] );

		if ( ! empty( $settings['title_custom_css'] ) ) {
			$this->add_render_attribute( 'title', 'class', $settings['title_custom_css'] );
		}

        /************
        /** Subtitle
        ************/

        $this->add_render_attribute(
            'subtitle', [
                'class' => [
                    'section-headline__subtitle',
                    $settings['headline_horizontal_align'],
                ]
            ]
        );

        // $this->add_render_attribute( 'subtitle', 'class', 'section-headline__subtitle' );

        if ( ! empty( $settings['subtitle_font_size'] ) ) 
            $this->add_render_attribute( 'subtitle', 'class', 'section-headline__subtitle--font-' . $settings['subtitle_font_size'] );

        if ( $settings['subtitle_color'] != 'inherit' ) 
            $this->add_render_attribute( 'subtitle', 'class', 'text-' . $settings['subtitle_color'] );

        // if ( ! empty( $settings['headline_horizontal_align'] ) ) 
        //     $this->add_render_attribute( 'subtitle', 'class', $settings['headline_horizontal_align'] );

        if ( $settings['subtitle_show_border'] == 'yes' ) 
            $this->add_render_attribute( 'subtitle', 'class', [
                'text-underline',
                'text-underline--' . $settings['subtitle_border_width'],
                'text-underline--' . $settings['subtitle_border_color']
            ] );

        if ( ! empty( $settings['subtitle_custom_css'] ) ) 
            $this->add_render_attribute( 'subtitle', 'class', $settings['subtitle_custom_css'] );
    ?>
        
        <div <?php echo $this->get_render_attribute_string( 'headline' ); ?>>

            <?php 
                if ( $settings['subtitle_position'] === 'top' && !empty($settings['subtitle']) ) : 
            ?>

                <?php echo sprintf( 
                        '<%1$s %2$s>%3$s</%1$s>', 
                        $settings['subtitle_html_tag'], 
                        $this->get_render_attribute_string( 'subtitle' ), 
                        $settings['subtitle'] 
                ); ?>

            <?php endif;

            echo sprintf( 
                    '<%1$s %2$s>%3$s</%1$s>', 
                    $settings['title_html_tag'], 
                    $this->get_render_attribute_string( 'title' ), 
                    $settings['title'] 
            ); ?>

            <?php 
                if ( $settings['subtitle_position'] === 'bottom' && !empty($settings['subtitle']) ) : 
            ?>

                <?php echo sprintf( 
                        '<%1$s %2$s>%3$s</%1$s>', 
                        $settings['subtitle_html_tag'], 
                        $this->get_render_attribute_string( 'subtitle' ), 
                        $settings['subtitle'] 
                ); ?>

            <?php endif; ?>

        </div>


    <?php
    }

    protected function content_template() {
    ?>
        <#
            view.addInlineEditingAttributes( 'title' );
            view.addInlineEditingAttributes( 'subtitle' );

            var title = settings.title;
            var subtitle = settings.subtitle;

            /************
            /** Global
            ************/

            view.addRenderAttribute(
                'headline',
                {   
                    'class': [ 
                        'section-headline',
                        settings.headline_horizontal_align
                    ]
                }
            );

            if ( settings.dlmel_sh_custom_css != '' ) 
                view.addRenderAttribute( 'headline', 'class', settings.dlmel_sh_custom_css );

            /************
            /** Title
            ************/

            view.addRenderAttribute( 'title', 'class', 'section-headline__title' );

            if ( settings.title_color != 'inherit' ) 
                view.addRenderAttribute( 'title', 'class', 'text-' + settings.title_color );

            if ( settings.title_font_size != '' ) 
                view.addRenderAttribute( 'title', 'class', 'section-headline__title--font-' + settings.title_font_size );

            if ( settings.title_custom_css != '' ) 
                view.addRenderAttribute( 'title', 'class', settings.title_custom_css );
            
            /************
            /** Subtitle
            ************/

            view.addRenderAttribute( 'subtitle', 'class', [
                'section-headline__subtitle',
                'subtitle--' + settings.subtitle_position,
                settings.headline_horizontal_align
            ] );

            if ( settings.subtitle_font_size != '' ) 
                view.addRenderAttribute( 'subtitle', 'class', 'section-headline__subtitle--font-' + settings.title_font_size );

            if ( settings.subtitle_color != 'inherit' ) 
                view.addRenderAttribute( 'subtitle', 'class', 'text-' + settings.subtitle_color );

            if ( settings.subtitle_show_border == 'yes' ) 
                view.addRenderAttribute( 'subtitle', 'class', [
                    'text-underline',
                    'text-underline--' + settings.subtitle_border_color,
                    'text-underline--' + settings.subtitle_border_width
                ] );

            if ( settings.subtitle_custom_css != '' ) 
                view.addRenderAttribute( 'subtitle', 'class', settings.subtitle_custom_css );
        #>

        <div {{{ view.getRenderAttributeString( 'headline' ) }}}>

            <#

            if ( settings.subtitle_position == 'top' && settings.subtitle != '' ) {

                view.addInlineEditingAttributes( 'subtitle' );

                print( '<' + settings.subtitle_html_tag  + ' ' + view.getRenderAttributeString( 'subtitle' ) + '>' + subtitle + '</' + settings.subtitle_html_tag + '>' );
            }

            print( '<' + settings.title_html_tag  + ' ' + view.getRenderAttributeString( 'title' ) + '>' + title + '</' + settings.title_html_tag + '>' );

            if ( settings.subtitle_position == 'bottom' && settings.subtitle != '' ) {

                view.addInlineEditingAttributes( 'subtitle' );

                print( '<' + settings.subtitle_html_tag  + ' ' + view.getRenderAttributeString( 'subtitle' ) + '>' + subtitle + '</' + settings.subtitle_html_tag + '>' );
            }
            
            #>

        </div>

    <?php

    }
}