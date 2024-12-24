<?php
namespace DelennerdElements\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

class SectionHeadline extends Widget_Base
{
    public function get_name()
    {
        return 'section-headline';
    }

    public function get_title()
    {
        return esc_html__('Section Headline', 'delennerd-elements');
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
                'label' => esc_html__( 'Content', 'delennerd-elements' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__( 'Enter your title', 'delennerd-elements' ),
                'default' => esc_html__( 'Add Your Heading Text Here', 'delennerd-elements' ),
                'dynamic' => array(
                    'active' => true
                ),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__( 'Enter your title', 'delennerd-elements' ),
                'default' => esc_html__( 'My Subtitle', 'delennerd-elements' ),
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
				'label' => esc_html__( 'Alignment', 'delennerd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'headline_horizontal_align',
            [
                'label' => esc_html__( 'Alignment', 'delennerd-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'text-left text-start',
                'options' => [
                    'text-left text-start' => [
                        'title' => esc_html__( 'Left', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right text-end' => [
                        'title' => esc_html__( 'Right', 'delennerd-elements' ),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'toggle' => true,
            ]
        );

        $this->add_control(
            'dlmel_sh_custom_css',
            [
                'label' => esc_html__( 'Headline class', 'delennerd-elements' ),
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
				'label' => esc_html__( 'Title', 'delennerd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
				'default' => 'h2',
			]
		);

        $this->add_control(
            'title_font_size',
            [
                'label' => esc_html__( 'Font size', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'inherit'  => esc_html__( 'Headline Tag', 'delennerd-elements' ),
                    'normal'  => esc_html__( 'Normal', 'delennerd-elements' ),
                    'medium'  => esc_html__( 'Medium', 'delennerd-elements' ),
                    'big'  => esc_html__( 'Big', 'delennerd-elements' ),
                    'bigger'  => esc_html__( 'Bigger', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'inherit',
                'options' => [
                    'inherit'  => esc_html__( 'Default', 'delennerd-elements' ),
                    'primary'  => esc_html__( 'Primary', 'delennerd-elements' ),
                    'secondary'  => esc_html__( 'Secondary', 'delennerd-elements' ),
                    'thirdy'  => esc_html__( 'Thirdy', 'delennerd-elements' ),
                    'black'  => esc_html__( 'Black', 'delennerd-elements' ),
                    'white'  => esc_html__( 'White', 'delennerd-elements' ),
                    'light-grey'  => esc_html__( 'Light Grey', 'delennerd-elements' ),
                    'custom1'  => esc_html__( 'Custom 1', 'delennerd-elements' ),
                    'custom2'  => esc_html__( 'Custom 2', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'title_custom_css',
            [
                'label' => esc_html__( 'Title class', 'delennerd-elements' ),
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
				'label' => esc_html__( 'Subtitle', 'delennerd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'subtitle_html_tag',
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
				'default' => 'h5',
			]
		);

        $this->add_control(
            'subtitle_font_size',
            [
                'label' => esc_html__( 'Font size', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'inherit'  => esc_html__( 'Subtitle Tag', 'delennerd-elements' ),
                    'normal'  => esc_html__( 'Normal', 'delennerd-elements' ),
                    'medium'  => esc_html__( 'Medium', 'delennerd-elements' ),
                    'big'  => esc_html__( 'Big', 'delennerd-elements' ),
                    'bigger'  => esc_html__( 'Bigger', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Color', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'inherit',
                'options' => [
                    'inherit'  => esc_html__( 'Default', 'delennerd-elements' ),
                    'primary'  => esc_html__( 'Primary', 'delennerd-elements' ),
                    'secondary'  => esc_html__( 'Secondary', 'delennerd-elements' ),
                    'thirdy'  => esc_html__( 'Thirdy', 'delennerd-elements' ),
                    'black'  => esc_html__( 'Black', 'delennerd-elements' ),
                    'white'  => esc_html__( 'White', 'delennerd-elements' ),
                    'light-grey'  => esc_html__( 'Light Grey', 'delennerd-elements' ),
                    'custom1'  => esc_html__( 'Custom 1', 'delennerd-elements' ),
                    'custom2'  => esc_html__( 'Custom 2', 'delennerd-elements' ),
                ],
            ]
        );

         $this->add_control(
            'subtitle_position',
            [
                'label' => esc_html__( 'Position', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top'  => esc_html__( 'Top', 'delennerd-elements' ),
                    'bottom'  => esc_html__( 'Bottom', 'delennerd-elements' ),
                ],
            ]
        );

        $this->add_control(
            'subtitle_show_border',
            [
                'label' => esc_html__( 'Border', 'delennerd-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'subtitle_border_color',
            [
                'label' => esc_html__( 'Border color', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'black',
                'options' => [
                    'primary'  => esc_html__( 'Primary', 'delennerd-elements' ),
                    'secondary'  => esc_html__( 'Secondary', 'delennerd-elements' ),
                    'thirdy'  => esc_html__( 'Thirdy', 'delennerd-elements' ),
                    'black'  => esc_html__( 'Black', 'delennerd-elements' ),
                    'white'  => esc_html__( 'White', 'delennerd-elements' ),
                    'light-grey'  => esc_html__( 'Light Grey', 'delennerd-elements' ),
                    'custom1'  => esc_html__( 'Custom 1', 'delennerd-elements' ),
                    'custom2'  => esc_html__( 'Custom 2', 'delennerd-elements' ),
                ],
                'condition' => [
                    'subtitle_show_border' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'subtitle_border_width',
            [
                'label' => esc_html__( 'Border width', 'delennerd-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fullwidth',
                'options' => [
                    'fullwidth'  => esc_html__( 'Full width', 'delennerd-elements' ),
                    'maxwidth1'  => esc_html__( 'With Max-Width 1', 'delennerd-elements' ),
                    'maxwidth2'  => esc_html__( 'With Max-Width 2', 'delennerd-elements' ),
                ],
                'condition' => [
                    'subtitle_show_border' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'subtitle_custom_css',
            [
                'label' => esc_html__( 'Subtitle class', 'delennerd-elements' ),
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
                    'subtitle--' . $settings['subtitle_position'],
                    // $settings['headline_horizontal_align'],
                ]
            ]
        );

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
        
        <div <?php echo wp_kses_post( $this->get_render_attribute_string( 'headline' ) ); ?>>

            <?php 
                if ( $settings['subtitle_position'] === 'top' && !empty($settings['subtitle']) ) : 
            ?>

                <?php echo sprintf( 
                    '<%1$s %2$s>%3$s</%1$s>', 
                    Utils::validate_html_tag( $settings['subtitle_html_tag'] ),
                    wp_kses_post( $this->get_render_attribute_string( 'subtitle' ) ),
                    wp_kses_post( $settings['subtitle'] )
                ); ?>

            <?php endif;

            if ( !empty($settings['title']) ) :

                echo sprintf( 
                    '<%1$s %2$s>%3$s</%1$s>', 
                    Utils::validate_html_tag( $settings['title_html_tag'] ), 
                    wp_kses_post( $this->get_render_attribute_string( 'title' ) ), 
                    wp_kses_post( $settings['title'] )
                ); 

            endif;    
            ?>

            <?php 
                if ( $settings['subtitle_position'] === 'bottom' && !empty($settings['subtitle']) ) : 
            ?>

                <?php echo sprintf( 
                    '<%1$s %2$s>%3$s</%1$s>', 
                    Utils::validate_html_tag( $settings['subtitle_html_tag'] ), 
                    wp_kses_post( $this->get_render_attribute_string( 'subtitle' ) ), 
                    wp_kses_post( $settings['subtitle'] ) 
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
                        'section-headline'
                    ]
                }
            );

            view.addRenderAttribute( 'headline', 'class', settings.headline_horizontal_align );

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

            var titleHtmlTag = elementor.helpers.validateHTMLTag( settings.title_html_tag );
            var subTitleHtmlTag = elementor.helpers.validateHTMLTag( settings.subtitle_html_tag );
        #>

        <div {{{ view.getRenderAttributeString( 'headline' ) }}}>

            <#

            if ( settings.subtitle_position == 'top' && settings.subtitle != '' ) {

                view.addInlineEditingAttributes( 'subtitle' );

                print( '<' + subTitleHtmlTag  + ' ' + view.getRenderAttributeString( 'subtitle' ) + '>' + subtitle + '</' + subTitleHtmlTag + '>' );
            }

            print( '<' + titleHtmlTag  + ' ' + view.getRenderAttributeString( 'title' ) + '>' + title + '</' + titleHtmlTag + '>' );

            if ( settings.subtitle_position == 'bottom' && settings.subtitle != '' ) {

                view.addInlineEditingAttributes( 'subtitle' );

                print( '<' + subTitleHtmlTag  + ' ' + view.getRenderAttributeString( 'subtitle' ) + '>' + subtitle + '</' + subTitleHtmlTag + '>' );
            }
            
            #>

        </div>

    <?php

    }
}