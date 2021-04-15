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
class SectionHeadline extends Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.1.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'section-headline';
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
    public function get_title()
    {
        return __('Section Headline', 'delennerd-elements');
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
    public function get_icon()
    {
        return 'eicon-t-letter';
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
    public function get_categories()
    {
        return [ 'delennerd' ];
    }

    public function get_keywords() {
		return [ 'heading', 'title', 'text', 'section', 'abschnitt' ];
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
	protected function register_controls() {
        
        /*************************/
        /** SECTION: Content
        *************************/

        $this->start_controls_section(
            'section_content',
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

        /*************************/
        /** STYLE: Global
        *************************/

        $this->start_controls_section(
			'headline_style_section',
			[
				'label' => __( 'Alignment', 'delennerd-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'headline_horizontal_align',
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
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        /*************************/
        /** STYLE: Title
        *************************/

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

        /*************************/
        /** STYLE: Subtitle
        *************************/

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

        $this->add_inline_editing_attributes( 'title' );
        $this->add_inline_editing_attributes( 'subtitle' );

        // $this->add_render_attribute(
        //     'headline_attr', [
        //         'class' => [
        //             'section-headline',
        //             !empty($settings['headline_horizontal_align']) ? 'text-' . $settings['headline_horizontal_align'] : '',
        //         ]
        //     ]
        // );

        /************
        /** Global
        /***********/

        $this->add_render_attribute( 'headline', 'class', 'section-headline' );
        
        if ( ! empty( $settings['headline_horizontal_align'] ) ) 
            $this->add_render_attribute( 'headline', 'class', 'text-' . $settings['headline_horizontal_align'] );
        

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

        $this->add_render_attribute( 'subtitle', 'class', 'section-headline__subtitle' );

        if ( ! empty( $settings['subtitle_font_size'] ) ) 
            $this->add_render_attribute( 'subtitle', 'class', 'section-headline__subtitle--font-' . $settings['subtitle_font_size'] );

        if ( $settings['subtitle_color'] != 'inherit' ) 
            $this->add_render_attribute( 'subtitle', 'class', 'text-' . $settings['subtitle_color'] );

        if ( ! empty( $settings['headline_horizontal_align'] ) ) 
            $this->add_render_attribute( 'subtitle', 'class', 'text-' . $settings['headline_horizontal_align'] );

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
                        settings.headline_horizontal_align,
                        settings.headline_horizontal_align != '' ? 'text-' + settings.headline_horizontal_align : ''
                    ]
                }
            );

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

            if ( settings.headline_horizontal_align == 'center' ) 
                view.addRenderAttribute( 'subtitle', 'class', 'text-center' );

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