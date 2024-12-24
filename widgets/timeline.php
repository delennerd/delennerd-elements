<?php
namespace DelennerdElements\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use \Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use \Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

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
            DELENNERD_ELEMENTS_ASSETS_URL . 'js/timeline.js', [ 'jquery' ], DELENNERD_ELEMENTS_VER, true
        );

        wp_register_style( 
            'delennerd-elements-animate-style', 
            DELENNERD_ELEMENTS_ASSETS_URL . 'vendor/animate/animate.min.css', [], DELENNERD_ELEMENTS_VER
        );

        wp_register_style( 
            'delennerd-elements-timeline-widget-style', 
            DELENNERD_ELEMENTS_ASSETS_URL . 'css/timeline.css', [], DELENNERD_ELEMENTS_VER
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

    public function get_name() {
        return 'dlm-timeline';
    }

    public function get_title() {
        return esc_html__( 'DLM Timeline', 'delennerd-elements' );
    }

    public function get_icon() {
        return 'fa fa-list';
    }

    public function get_categories() {
        return [ 'delennerd' ];
    }

    protected function register_controls() {

        /***********************/
        /** SECTION: Content **/
        /***********************/

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'delennerd-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_date',
            [
                'label' => esc_html__( 'Timeline Items', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'since 04/2019' , 'delennerd-elements' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_company',
            [
                'label' => esc_html__( 'Company', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Foo bar GmbH' , 'delennerd-elements' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_job',
            [
                'label' => esc_html__( 'Job', 'delennerd-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Web developer' , 'delennerd-elements' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_content',
            [
                'label' => esc_html__( 'Content', 'delennerd-elements' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Item content' , 'delennerd-elements' ),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'timeline_list',
            [
                'label' => esc_html__( 'Date', 'delennerd-elements' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__( 'Title #1', 'delennerd-elements' ),
                        'list_content' => esc_html__( 'Item content', 'delennerd-elements' ),
                    ],
                    [
                        'list_title' => esc_html__( 'Title #2', 'delennerd-elements' ),
                        'list_content' => esc_html__( 'Item content', 'delennerd-elements' ),
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
                'label' => esc_html__( 'Box', 'delennerd-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'margin',
            [
                'label' => esc_html__( 'Margin', 'delennerd-elements' ),
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
                'label' => esc_html__( 'Border', 'delennerd-elements' ),
                'selector' => '{{WRAPPER}} .timeline-box-inner',
            ]
        );
        
        $this->add_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow', 'delennerd-elements' ),
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
                'label' => esc_html__( 'Date', 'delennerd-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'date_color',
            [
                'label' => esc_html__( 'Date Color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'global' => [
        			'default' => Global_Colors::COLOR_PRIMARY,
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
                'label'    => esc_html__( 'Typography', 'delennerd-elements' ),
                'global' => [
        			'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
        		],
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
                'label' => esc_html__( 'Company', 'delennerd-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'company_html_tag',
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
				'default' => 'h4',
			]
		);

        $this->add_control(
            'company_color',
            [
                'label' => esc_html__( 'Text Color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'global' => [
        			'default' => Global_Colors::COLOR_PRIMARY,
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
                'label'    => esc_html__( 'Typography', 'delennerd-elements' ),
                'global' => [
        			'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
        		],
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
                'label' => esc_html__( 'Job', 'delennerd-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_color',
            [
                'label' => esc_html__( 'Text Color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'global' => [
        			'default' => Global_Colors::COLOR_PRIMARY,
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
                'label'    => esc_html__( 'Typography', 'delennerd-elements' ),
                'global' => [
        			'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
        		],
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
                'label' => esc_html__( 'Description', 'delennerd-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Text Color', 'delennerd-elements' ),
                'type' => Controls_Manager::COLOR,
                'global' => [
        			'default' => Global_Colors::COLOR_PRIMARY,
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
                'label'    => esc_html__( 'Typography', 'delennerd-elements' ),
                'global' => [
        			'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
        		],
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

    protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'company', 'class', 'list-company' );

        if ( $settings['timeline_list'] ) :
    ?>

        <div class="delennerd-timeline-wrapper">

            <div class="timeline">
                <div class="timeline-bar"></div>
                <div class="timeline-inner">

                    <?php $i=0; foreach ( $settings['timeline_list'] as $item ) : ?>

                        <?php $pos = ( ($i % 2) == 0 ) ? 'left' : 'right'; ?>

                        <div class="timeline-box timeline-box-<?php echo esc_attr( $pos ); ?> elementor-repeater-item-<?=$item['_id'] ?>">
                            <span class="dot"></span>
                            <div class="timeline-box-inner wow fadeIn<?php echo ucfirst( esc_attr($pos ) ) ?>" data-wow-offset="50">
                                <span class="arrow"></span>
                                <div class="list-date"><?php echo wp_kses_post( $item['list_date'] ); ?></div>
                                
                                <?php if ( !empty($item['list_company']) ) { 
                                    echo sprintf( 
                                        '<%1$s %2$s>%3$s</%1$s>', 
                                        Utils::validate_html_tag( $settings['company_html_tag'] ),
                                        wp_kses_post( $this->get_render_attribute_string( 'company' ) ), 
                                        wp_kses_post( $item['list_company'] )
                                    );
                                } ?>
                                <?php if ( !empty($item['list_job']) ) : ?>
                                    <div class="list-job"><?php echo wp_kses_post( $item['list_job'] ); ?></div>
                                <?php endif; ?>
                                <div class="list-content"><?php echo $this->parse_text_editor( $item['list_content'] ); ?></div>
                            </div>
                        </div>

                    <?php $i++; 
                        endforeach; ?>

                </div>
            </div>

            <div class="clearfix" style="clear:both;"></div>
        </div>

    <?php

        endif;
    }

	protected function content_template() {
    ?>
		<#
            view.addRenderAttribute( 'company', 'class', [
                'list-company'
            ] );
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

                        var companyHtmlTag = elementor.helpers.validateHTMLTag( settings.company_html_tag );
                    #>

                    <div class="timeline-box timeline-box-{{{ pos }}} elementor-repeater-item-">
                        <span class="dot"></span>

                        <div {{{ view.getRenderAttributeString('list_item') }}}>

                            <span class="arrow"></span>
                            <div class="list-date">{{{ item.list_date }}}</div>

                            <# print( '<' + companyHtmlTag  + ' ' + view.getRenderAttributeString( 'company' ) + '>' + item.list_company + '</' + companyHtmlTag + '>' ); #>

                            <div class="list-job">{{{ item.list_job }}}</div>

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
