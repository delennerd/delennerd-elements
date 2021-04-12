<?php
namespace DelennerdElements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Timeline Widget.
 *
 * Timeline for your history like 
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Timeline extends Widget_Base {

    public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

        wp_register_script( 
            'delennerd-elements-wow-script', 
            DELENNERD_ELEMENTS_ASSETS_URL . 'vendor/wow/wow.min.js', [ 'jquery' ], DELENNERD_ELEMENTS_VER, true
        );

        wp_register_script( 
            'delennerd-elements-timeline-widget-script', 
            DELENNERD_ELEMENTS_ASSETS_URL . 'widgets/timeline/timeline.js', [ 'jquery' ], DELENNERD_ELEMENTS_VER, true
        );

        wp_register_style( 
            'delennerd-elements-animate-style', 
            DELENNERD_ELEMENTS_ASSETS_URL . 'vendor/animate/animate.min.css', [], DELENNERD_ELEMENTS_VER
        );

        wp_register_style( 
            'delennerd-elements-timeline-widget-style', 
            DELENNERD_ELEMENTS_ASSETS_URL . 'widgets/timeline/timeline.css', [], DELENNERD_ELEMENTS_VER
        );
	}

	public function get_script_depends() {
		return [ 
            'delennerd-elements-wow-script',
            'delennerd-elements-timeline-widget-script',
        ];
	}

	public function get_style_depends() {
		return [
            'delennerd-elements-animate-style',
            'delennerd-elements-timeline-widget-style',
        ];
	}

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
        return 'dlm-timeline';
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
        return __( 'DLM Timeline', 'delennerd-elements' );
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
        return 'fa fa-list';
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
            'content_section',
            [
                'label' => __( 'Content', 'delennerd-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_date',
            [
                'label' => __( 'Timeline Items', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'since 04/2019' , 'delennerd-elements' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_company',
            [
                'label' => __( 'Company', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Foo bar GmbH' , 'delennerd-elements' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_job',
            [
                'label' => __( 'Job', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Web developer' , 'delennerd-elements' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_content',
            [
                'label' => __( 'Content', 'delennerd-elements' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Item content' , 'delennerd-elements' ),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'timeline_list',
            [
                'label' => __( 'Date', 'delennerd-elements' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __( 'Title #1', 'delennerd-elements' ),
                        'list_content' => __( 'Item content', 'delennerd-elements' ),
                    ],
                    [
                        'list_title' => __( 'Title #2', 'delennerd-elements' ),
                        'list_content' => __( 'Item content', 'delennerd-elements' ),
                    ],
                ],
                'title_field' => '{{{ list_date }}}: {{{ list_company }}}',
            ]
        );

        $this->end_controls_section();


        /***********************/
        /** STYLE: Box **/
        /***********************/

        $this->start_controls_section(
            'box_style_section',
            [
                'label' => __( 'Box', 'delennerd-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'margin',
            [
                'label' => __( 'Margin', 'delennerd-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .timeline-box-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', 'delennerd-elements' ),
                'selector' => '{{WRAPPER}} .timeline-box-inner',
            ]
        );
        
        $this->add_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __( 'Box Shadow', 'delennerd-elements' ),
                'default' => '0 1px 6px rgba(0,0,0,0.12)',
                'selector' => '{{WRAPPER}} .timeline-box-inner',
            ]
        );
        
        $this->end_controls_section();


        /***********************/
        /** STYLE: Date **/
        /***********************/

        $this->start_controls_section(
            'date_style_section',
            [
                'label' => __( 'Date', 'delennerd-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'date_color',
            [
                'label' => __( 'Date Color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#3867d6',
                'selectors' => [
                    '{{WRAPPER}} .list-date' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'date_typography',
                'label'    => __( 'Typography', 'delennerd-elements' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .list-date',
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
            'date_text_align',
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
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .list-date' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        /***********************/
        /** STYLE: Company **/
        /***********************/

        $this->start_controls_section(
            'company_style_section',
            [
                'label' => __( 'Company', 'delennerd-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'company_color',
            [
                'label' => __( 'Text Color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-company' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'company_typography',
                'label'    => __( 'Typography', 'delennerd-elements' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .list-company',
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
            'company_text_align',
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
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .list-company' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();


        /***********************/
        /** STYLE: Job **/
        /***********************/

        $this->start_controls_section(
            'job_style_section',
            [
                'label' => __( 'Job', 'delennerd-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_color',
            [
                'label' => __( 'Text Color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-job' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'job_typography',
                'label'    => __( 'Typography', 'delennerd-elements' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .list-job',
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
            'job_text_align',
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
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .list-job' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();


        /***********************/
        /** STYLE: Description **/
        /***********************/

        $this->start_controls_section(
            'description_style_section',
            [
                'label' => __( 'Description', 'delennerd-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __( 'Text Color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'label'    => __( 'Typography', 'delennerd-elements' ),
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .list-content',
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
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .list-content' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings_for_display();

        if ( $settings['timeline_list'] ) :
    ?>

        <div class="delennerd-timeline-wrapper">

            <div class="timeline">
                <div class="timeline-bar"></div>
                <div class="timeline-inner">

                    <?php $i=0; foreach ( $settings['timeline_list'] as $item ) : ?>

                        <?php $pos = ( ($i % 2) == 0 ) ? 'left' : 'right'; ?>

                        <div class="timeline-box timeline-box-<?php echo $pos ?> elementor-repeater-item-<?=$item['_id'] ?>">
                            <span class="dot"></span>
                            <div class="timeline-box-inner wow fadeIn<?php echo ucfirst($pos) ?>" data-wow-offset="50">
                                <span class="arrow"></span>
                                <div class="list-date"><?php echo $item['list_date'] ?></div>
                                <h3 class="list-company"><?php echo $item['list_company'] ?></h3>
                                <h4 class="list-job"><?php echo $item['list_job'] ?></h4>
                                <div class="list-content"><?php echo nl2br($item['list_content']) ?></div>
                            </div>
                        </div>

                    <?php $i++; endforeach; ?>

                </div>
            </div>

            <div class="clearfix" style="clear:both;"></div>
        </div>

    <?php

        endif;
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
	protected function _content_template() {
    ?>
		<#
		#>
        
        <div class="delennerd-timeline-wrapper">

            <div class="timeline">
                <div class="timeline-bar"></div>
                <div class="timeline-inner">

                <# if ( settings.timeline_list ) { #>

                    <# 
                    var index = 0;

                    _.each( settings.timeline_list, function( item, index ) {

                        var pos = (index % 2) == 0 ? 'left' : 'right';

                        var list_key = view.getRepeaterSettingKey( 'text', 'timeline_list', index );

                        view.addRenderAttribute(
                            'list_item',
                            {
                                'class': [ 
                                    'timeline-box-inner'
                                ],
                                'data-wow-offset': '50'
                            }
                        );
                    #>

                    <div class="timeline-box timeline-box-{{{ pos }}} elementor-repeater-item-">
                        <span class="dot"></span>

                        <div {{{ view.getRenderAttributeString('list_item') }}}>

                            <span class="arrow"></span>
                            <div class="list-date">{{{ item.list_date }}}</div>

                            <h3 class="list-company">{{{ item.list_company }}}</h3>

                            <h4 class="list-job">{{{ item.list_job }}}</h4>

                            <div class="list-content">{{{ item.list_content }}}</div>
                        </div>
                    </div>


                    <# 
                        index++;
                    #>

                    <#	} ); #>

                <# } #>

            </div><!-- end .timeline -->

        </div>

    <?php
	}
}