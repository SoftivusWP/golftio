<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_team extends Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'tp-team';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Team', 'tpcore');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'tp-icon';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['tpcore'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['tpcore'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {

        // team
        $this->start_controls_section(
            'golftio_team_section_genaral',
            [
                'label' => esc_html__('Team Section', 'golftio-core')
            ]
        );


        $this->add_control(
            'golftio_team_content_style_selection',
            [
                'label'   => esc_html__('Select Style', 'golftio-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'style_one' => esc_html__('Style One', 'golftio-core'),
                    'style_two' => esc_html__('Style Two', 'golftio-core'),
                ],
                'default' => 'style_one',
            ]
        );

        $this->end_controls_section();


        // ======================================Content One============================================//
        $this->start_controls_section(
            'team_slide_content_one',
            [
                'label' => esc_html__('Slide', 'golftio-core'),
                'condition' => [
                    'golftio_team_content_style_selection' => ['style_one', 'style_two']
                ]
            ]
        );

        // Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'team_image',
            [
                'label' => esc_html__('Choose Image', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'team_name',
            [
                'label' => esc_html__('Name', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default Name', 'golftio-core'),
                'placeholder' => esc_html__('Type your name here', 'golftio-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'team_designation',
            [
                'label' => esc_html__('Designation', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Designation', 'golftio-core'),
                'placeholder' => esc_html__('Type your designation here', 'golftio-core'),
                'label_block' => true,
            ]
        );

        // Facebook URL
        $repeater->add_control(
            'social_fb_icon_url',
            [
                'label' => esc_html__('Facebook URL', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => esc_html__('#', 'golftio-core'),
                'placeholder' => esc_html__('https://your-link.com', 'golftio-core'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );
        // Twitter URL
        $repeater->add_control(
            'social_tw_icon_url',
            [
                'label' => esc_html__('Twitter URL', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'golftio-core'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );
        // Instagram URL
        $repeater->add_control(
            'social_in_icon_url',
            [
                'label' => esc_html__('Instagram URL', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'golftio-core'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );
        // LinkedIn URL
        $repeater->add_control(
            'social_ln_icon_url',
            [
                'label' => esc_html__('LinkedIn URL', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'golftio-core'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );
        // YouTube URL
        $repeater->add_control(
            'social_yt_icon_url',
            [
                'label' => esc_html__('YouTube URL', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'golftio-core'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );
        // fb URL
        $repeater->add_control(
            'social_tel_icon_url',
            [
                'label' => esc_html__('Telegram URL', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'golftio-core'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );
        // fb URL
        $repeater->add_control(
            'social_wc_icon_url',
            [
                'label' => esc_html__('WhatsApp URL', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'golftio-core'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );
        // fb URL
        $repeater->add_control(
            'social_wa_icon_url',
            [
                'label' => esc_html__('WeChat URL', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'golftio-core'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );



        $this->add_control(
            'team_repeater',
            [
                'label' => esc_html__('Testimonial List', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'team_name' => esc_html__('Member Name', 'golftio-core'),
                    ],
                    [
                        'team_name' => esc_html__('Member Name', 'golftio-core'),
                    ],
                    [
                        'team_name' => esc_html__('Member Name', 'golftio-core'),
                    ],
                    [
                        'team_name' => esc_html__('Member Name', 'golftio-core'),
                    ],
                    [
                        'team_name' => esc_html__('Member Name', 'golftio-core'),
                    ],

                ],
                'title_field' => '{{{ team_name }}}',

            ]
        );



        $this->end_controls_section();


        $this->start_controls_section(
            'team_content_one',
            [
                'label' => esc_html__('Content', 'golftio-core'),
                'condition' => [
                    'golftio_team_content_style_selection' => 'style_one'
                ]
            ]
        );

        $this->add_responsive_control(
            'golftio_heading_content_align_one',
            [
                'label'         => esc_html__('Heading Text Align', 'golftio-core'),
                'type'             => \Elementor\Controls_Manager::CHOOSE,
                'options'         => [
                    'left'         => [
                        'title' => esc_html__('Left', 'golftio-core'),
                        'icon'     => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'golftio-core'),
                        'icon'     => 'eicon-text-align-center',
                    ],
                    'right'     => [
                        'title' => esc_html__('Right', 'golftio-core'),
                        'icon'     => 'eicon-text-align-right',
                    ],
                    'justify'     => [
                        'title' => esc_html__('Justified', 'golftio-core'),
                        'icon'     => 'eicon-text-align-justify',
                    ],
                ],
                'default'         => 'left',
                'selectors'     => [
                    '{{WRAPPER}} .section__content' => 'text-align: {{VALUE}};',
                ],

            ]
        );



        $this->add_control(
            'golftio_heading_content_subtitle',
            [
                'label' => esc_html__('Subtitle', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Our Team', 'golftio-core'),
                'placeholder' => esc_html__('Type your subtitle here', 'golftio-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'golftio_heading_content_title',
            [
                'label' => esc_html__('Title', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default Title', 'golftio-core'),
                'placeholder' => esc_html__('Type your title here', 'golftio-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'golftio_heading_content_description',
            [
                'label' => esc_html__('Short Description', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptas doloribus provident assumenda quidem. Minus quia doloribus, eveniet nam esse molestiae iste dolores numquam.', 'golftio-core'),
                'placeholder' => esc_html__('Type your description here', 'golftio-core'),
            ]
        );


        // Button text
        $this->add_control(
            'golftio_content_button',
            [
                'label' => esc_html__('Button', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default Button', 'golftio-core'),
                'placeholder' => esc_html__('Type your button here', 'golftio-core'),
                'label_block' => true,
            ]
        );

        // Button URL
        $this->add_control(
            'golftio_content_button_url',
            [
                'label' => esc_html__('Button URL', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'golftio-core'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );

        $this->end_controls_section();


        //Pricing List Repeater
        $this->start_controls_section(
            'list_text_content',
            [
                'label' => esc_html__('List Content', 'golftio-core'),
                'condition' => [
                    'golftio_team_content_style_selection' => 'style_one'
                ]
            ]
        );

        // list content
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'golftio_pricing_list',
            [
                'label' => esc_html__('list content', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Lorem Ipsum is simply.', 'golftio-core'),
                'placeholder' => esc_html__('Type your list content here', 'golftio-core'),
            ]
        );

        $this->add_control(
            'pricing_list_repeater',
            [
                'label' => esc_html__('pricing Card List', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'golftio_pricing_list' => esc_html__('Type your list content', 'golftio-core'),

                    ],
                    [
                        'golftio_pricing_list' => esc_html__('Type your list content', 'golftio-core'),

                    ],
                    [
                        'golftio_pricing_list' => esc_html__('Type your list content ', 'golftio-core'),

                    ],
                    [
                        'golftio_pricing_list' => esc_html__('Type your list content ', 'golftio-core'),

                    ],

                ],
                'title_field' => '{{{ golftio_pricing_list }}}',
            ]
        );

        $this->end_controls_section();


        // ====================================== Content Two ============================================//
        $this->start_controls_section(
            'team_content_two',
            [
                'label' => esc_html__('team two', 'golftio-core'),
                'condition' => [
                    'golftio_team_content_style_selection' => 'style_two'
                ]
            ]
        );



        $this->add_responsive_control(
            'golftio_heading_content_align_two',
            [
                'label'         => esc_html__('Heading Text Align', 'golftio-core'),
                'type'             => \Elementor\Controls_Manager::CHOOSE,
                'options'         => [
                    'left'         => [
                        'title' => esc_html__('Left', 'golftio-core'),
                        'icon'     => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'golftio-core'),
                        'icon'     => 'eicon-text-align-center',
                    ],
                    'right'     => [
                        'title' => esc_html__('Right', 'golftio-core'),
                        'icon'     => 'eicon-text-align-right',
                    ],
                    'justify'     => [
                        'title' => esc_html__('Justified', 'golftio-core'),
                        'icon'     => 'eicon-text-align-justify',
                    ],
                ],
                'default'         => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .section__header' => 'text-align: {{VALUE}};',
                ],

            ],

        );

        $this->add_responsive_control(
            'golftio_card_content_align_two',
            [
                'label'         => esc_html__('Slider Text Align', 'golftio-core'),
                'type'             => \Elementor\Controls_Manager::CHOOSE,
                'options'         => [
                    'left'         => [
                        'title' => esc_html__('Left', 'golftio-core'),
                        'icon'     => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'golftio-core'),
                        'icon'     => 'eicon-text-align-center',
                    ],
                    'right'     => [
                        'title' => esc_html__('Right', 'golftio-core'),
                        'icon'     => 'eicon-text-align-right',
                    ],
                    'justify'     => [
                        'title' => esc_html__('Justified', 'golftio-core'),
                        'icon'     => 'eicon-text-align-justify',
                    ],
                ],
                'default'         => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .team__slider-card' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .team__slider-card__author' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .team__slider-card__body-review' => 'justify-content: {{VALUE}};',
                ],
            ],
        );

        $this->add_control(
            'golftio_heading_two_content_subtitle',
            [
                'label' => esc_html__('Subtitle', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Our Team', 'golftio-core'),
                'placeholder' => esc_html__('Type your subtitle here', 'golftio-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'golftio_heading_two_content_title',
            [
                'label' => esc_html__('Title', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default Title', 'golftio-core'),
                'placeholder' => esc_html__('Type your title here', 'golftio-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'golftio_heading_two_content_description',
            [
                'label' => esc_html__('Short Description', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptas doloribus provident assumenda quidem. Minus quia doloribus, eveniet nam esse molestiae iste dolores numquam.', 'golftio-core'),
                'placeholder' => esc_html__('Type your description here', 'golftio-core'),
            ]
        );

        // Repeater
        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'team_icon',
            [
                'label' => esc_html__('Icon', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'golftio-quote',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'team_rating',
            [
                'label' => esc_html__('Rating', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 5,
            ]
        );

        $repeater->add_control(
            'team_description',
            [
                'label' => esc_html__('Description', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even...', 'golftio-core'),
                'placeholder' => esc_html__('Type your description here', 'golftio-core'),
            ]
        );

        $repeater->add_control(
            'team_image',
            [
                'label' => esc_html__('Choose Image', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'team_name',
            [
                'label' => esc_html__('Name', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default title', 'golftio-core'),
                'placeholder' => esc_html__('Type your name here', 'golftio-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'team_designation',
            [
                'label' => esc_html__('Designation', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default title', 'golftio-core'),
                'placeholder' => esc_html__('Type your designation here', 'golftio-core'),
                'label_block' => true,
            ]
        );


        $this->add_control(
            'team_second_repeater',
            [
                'label' => esc_html__('team List', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'team_description' => esc_html__('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even...', 'golftio-core'),

                    ],

                ],
                'title_field' => '{{{ team_description }}}',

            ]
        );


        $this->end_controls_section();


        // ======================= Style =================================//

        // background 
        $this->start_controls_section(
            'bg_style',
            [
                'label' => esc_html__('Background Color', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_bg_style_color',
            [
                'label'     => esc_html__('Slider Box Bg', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team__slider-card' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_style_one_color',
            [
                'label'     => esc_html__('Style One Bg', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team::before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_style_two_color',
            [
                'label'     => esc_html__('Style Two Bg', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team--secondary' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Subtitle 
        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__('Subtitle', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'golftio-core'),
                'name'     => 'subtitle_style_typ',
                'selector' => '{{WRAPPER}} .sub-title',
            ]
        );

        $this->add_control(
            'subtitle_style_color',
            [
                'label'     => esc_html__('Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_style_margin',
            [
                'label' => esc_html__('Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_style_padding',
            [
                'label'      => __('Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // Title 
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'golftio-core'),
                'name'     => 'title_style_typ',
                'selector' => '{{WRAPPER}} .title',

            ]
        );

        $this->add_control(
            'title_style_color',
            [
                'label'     => esc_html__('Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_style_margin',
            [
                'label' => esc_html__('Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_style_padding',
            [
                'label'      => __('Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // description
        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__('Description', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'golftio-core'),
                'name'     => 'description_style_typ',
                'selector' => '{{WRAPPER}} .pp',

            ]
        );

        $this->add_control(
            'description_style_color',
            [
                'label'     => esc_html__('Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pp' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'description_style_margin',
            [
                'label' => esc_html__('Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pp' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_style_padding',
            [
                'label'      => __('Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .pp' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();


        // ======================= List Style =================================//

        // list content 
        $this->start_controls_section(
            'pricing_list_style',
            [
                'label' => esc_html__('List Content', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'golftio-core'),
                'name'     => 'pricing_list_style_typ',
                'selector' => '{{WRAPPER}} .section__content-inner li',

            ]
        );

        $this->add_control(
            'pricing_list_color',
            [
                'label'     => esc_html__('Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section__content-inner li' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .section__content-inner li i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_list_style_margin',
            [
                'label' => esc_html__('Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .section__content-inner li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_list_style_padding',
            [
                'label'      => __('Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .section__content-inner li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();


        //    slider style



        $this->start_controls_section(
            'slider_description_style',
            [
                'label' => esc_html__('Slider Content', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Name Typography', 'golftio-core'),
                'name'     => 'slider_name_style_typ',
                'selector' => '{{WRAPPER}} .team_name',

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Designation Typography', 'golftio-core'),
                'name'     => 'slider_desig_style_typ',
                'selector' => '{{WRAPPER}} .team_deg',

            ]
        );

        $this->add_control(
            'slider_name_style_color',
            [
                'label'     => esc_html__('Name Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_name' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'slider_desig_style_color',
            [
                'label'     => esc_html__('Designation Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_deg' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'slider_social_icon_style_color',
            [
                'label'     => esc_html__('Social Icon Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'slider_social_iconhov_style_color',
            [
                'label'     => esc_html__('Social Icon Hover Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social a:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_name_style_margin',
            [
                'label' => esc_html__('Name Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .team_name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_name_style_padding',
            [
                'label'      => __('Name Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .team_name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();


        // =======================Button Style One===========================//

        $this->start_controls_section(
            'button_one_style',
            [
                'label' => esc_html__('Button', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'golftio-core'),
                'name'     => 'button_one_typ',
                'selector' => '{{WRAPPER}} .cmn-button',
            ]
        );

        $this->add_control(
            'button_one_color',
            [
                'label'     => esc_html__('Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_one_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_one_bgcolor',
            [
                'label'     => esc_html__('Background', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .cmn-button:after' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_one_hvr_bgcolor',
            [
                'label'     => esc_html__('Hover Background', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button:hover' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_one_bdr_color',
            [
                'label' => esc_html__('Border Color', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_one_bdr_hvr_color',
            [
                'label' => esc_html__('Hover Border Color', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button:hover' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_one_border_radius',
            [
                'label'      => __('Border Radius', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cmn-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'button_one_style_margin',
            [
                'label' => esc_html__('Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cmn-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_one_style_padding',
            [
                'label'      => __('Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cmn-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>

        <script>
            jQuery(document).ready(function($) {
                // team slider
                jQuery(".team__slider")
                    .not(".slick-initialized")
                    .slick({
                        infinite: true,
                        autoplay: true,
                        focusOnSelect: true,
                        slidesToShow: 2,
                        speed: 900,
                        slidesToScroll: 1,
                        arrows: true,
                        dots: false,
                        prevArrow: jQuery(".prev-team"),
                        nextArrow: jQuery(".next-team"),
                        centerMode: true,
                        centerPadding: "0px",
                        responsive: [{
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 2,
                                },
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 1,
                                },
                            },
                        ],
                    });


                // team secondary slider
                jQuery(".team__slider--secondary")
                    .not(".slick-initialized")
                    .slick({
                        infinite: true,
                        autoplay: true,
                        focusOnSelect: true,
                        slidesToShow: 4,
                        speed: 900,
                        slidesToScroll: 1,
                        arrows: true,
                        dots: false,
                        prevArrow: jQuery(".prev-team--secondary"),
                        nextArrow: jQuery(".next-team--secondary"),
                        centerMode: true,
                        centerPadding: "0px",
                        responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 3,
                                },
                            },
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 3,
                                },
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 2,
                                },
                            },
                            {
                                breakpoint: 576,
                                settings: {
                                    slidesToShow: 1,
                                },
                            },
                        ],
                    });
            });
        </script>



        <!-- ==== team section primary start ==== -->
        <?php if ($settings['golftio_team_content_style_selection'] == 'style_one') : ?>
            <section class="section team wow fadeInUp" data-wow-duration="0.4s">
                <div class="container">
                    <div class="row section__row align-items-center">
                        <div class="col-lg-6 col-xl-6 section__col">
                            <div class="team__slider">
                                <?php foreach ($settings['team_repeater'] as $item) : ?>
                                    <div class="team__slider-card">
                                        <?php if (!empty($item['team_image']['url'])) :   ?>
                                            <div class="team__slider-card__thumb">
                                                <img src="<?php echo esc_url($item['team_image']['url']) ?>" alt="<?php echo esc_attr('Team') ?>">
                                            </div>
                                        <?php endif ?>
                                        <div class="team__slider-card__content">
                                            <?php if (!empty($item['team_name'])) :   ?>
                                                <h5 class="team_name"><?php echo esc_html($item['team_name']) ?></h5>
                                            <?php endif ?>
                                            <?php if (!empty($item['team_designation'])) :   ?>
                                                <p class="team_deg secondary-text"><?php echo esc_html($item['team_designation']) ?></p>
                                            <?php endif ?>
                                            <div class="social">
                                                <?php if (!empty($item['social_fb_icon_url'])) :   ?>
                                                    <a href="<?php echo esc_html($item['social_fb_icon_url']['url']) ?>">
                                                        <i class="fa-brands fa-facebook-f"></i>
                                                    </a>
                                                <?php endif ?>
                                                <?php if (!empty($item['social_tw_icon_url']['url'])) :   ?>
                                                    <a href="<?php echo esc_html($item['social_tw_icon_url']['url']) ?>">
                                                        <i class="fa-brands fa-twitter"></i>
                                                    </a>
                                                <?php endif ?>
                                                <?php if (!empty($item['social_in_icon_url']['url'])) :   ?>
                                                    <a href="<?php echo esc_html($item['social_in_icon_url']['url']) ?>">
                                                        <i class="fa-brands fa-square-instagram"></i>
                                                    </a>
                                                <?php endif ?>
                                                <?php if (!empty($item['social_ln_icon_url']['url'])) :   ?>
                                                    <a href="<?php echo esc_html($item['social_ln_icon_url']['url']) ?>">
                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                    </a>
                                                <?php endif ?>
                                                <?php if (!empty($item['social_yt_icon_url']['url'])) :   ?>
                                                    <a href="<?php echo esc_html($item['social_yt_icon_url']['url']) ?>">
                                                        <i class="fa-brands fa-youtube"></i>
                                                    </a>
                                                <?php endif ?>
                                                <?php if (!empty($item['social_tel_icon_url']['url'])) :   ?>
                                                    <a href="<?php echo esc_html($item['social_tel_icon_url']['url']) ?>">
                                                        <i class="fa-brands fa-telegram"></i>
                                                    </a>
                                                <?php endif ?>
                                                <?php if (!empty($item['social_wc_icon_url']['url'])) :   ?>
                                                    <a href="<?php echo esc_html($item['social_wc_icon_url']['url']) ?>">
                                                        <i class="fa-brands fa-weixin"></i>
                                                    </a>
                                                <?php endif ?>
                                                <?php if (!empty($item['social_wa_icon_url']['url'])) :   ?>
                                                    <a href="<?php echo esc_html($item['social_wa_icon_url']['url']) ?>">
                                                        <i class="fa-brands fa-whatsapp"></i>
                                                    </a>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="slider-navigation justify-content-start">
                                        <button class="next-team cmn-button cmn-button--secondary">
                                            <i class="fa-solid fa-angle-left"></i>
                                        </button>
                                        <button class="prev-team cmn-button cmn-button--secondary">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-5 offset-xl-1 order-first order-lg-last section__col">
                            <div class="section__content">
                                <?php if (!empty($settings['golftio_heading_content_subtitle'])) :   ?>
                                    <h5 class="sub-title"><?php echo wp_kses($settings['golftio_heading_content_subtitle'], wp_kses_allowed_html('post'))  ?></h5>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_heading_content_title'])) :   ?>
                                    <h2 class="title"><?php echo wp_kses($settings['golftio_heading_content_title'], wp_kses_allowed_html('post'))  ?></h2>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_heading_content_description'])) :   ?>
                                    <p class="xlr pp section__content-text"><?php echo wp_kses($settings['golftio_heading_content_description'], wp_kses_allowed_html('post'))  ?></p>
                                <?php endif ?>

                                <?php if (!empty($settings['pricing_list_repeater'])) : ?>
                                    <div class="section__content-inner">
                                        <ul>
                                            <?php foreach ($settings['pricing_list_repeater'] as $item) : ?>
                                                <li>
                                                    <i class="golftio-pin-checked"></i>
                                                    <?php echo !empty($item['golftio_pricing_list']) ? esc_html($item['golftio_pricing_list']) : ''; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($settings['golftio_content_button'])) : ?>
                                    <div class="section__content-cta">
                                        <a href="<?php echo esc_html($settings['golftio_content_button_url']['url']) ?>" class="cmn-button"><?php echo esc_html($settings['golftio_content_button']) ?></a>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- ==== / team section primary end ==== -->


        <!-- ==== team section secondary start ==== -->
        <?php if ($settings['golftio_team_content_style_selection'] == 'style_two') : ?>
            <section class="section team wow fadeInUp" data-wow-duration="0.4s">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="section__header">
                                <?php if (!empty($settings['golftio_heading_two_content_subtitle'])) :   ?>
                                    <h5 class="sub-title"><?php echo wp_kses($settings['golftio_heading_two_content_subtitle'], wp_kses_allowed_html('post'))  ?></h5>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_heading_two_content_title'])) :   ?>
                                    <h2 class="title"><?php echo wp_kses($settings['golftio_heading_two_content_title'], wp_kses_allowed_html('post'))  ?></h2>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_heading_two_content_description'])) :   ?>
                                    <p class="xlr pp section__content-text"><?php echo wp_kses($settings['golftio_heading_two_content_description'], wp_kses_allowed_html('post'))  ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="team__slider--secondary">
                        <?php foreach ($settings['team_repeater'] as $item) : ?>
                            <div class="team__slider-card">
                                <?php if (!empty($item['team_image']['url'])) :   ?>
                                    <div class="team__slider-card__thumb">
                                        <img src="<?php echo esc_url($item['team_image']['url']) ?>" alt="<?php echo esc_attr('Team') ?>">
                                    </div>
                                <?php endif ?>
                                <div class="team__slider-card__content">
                                    <?php if (!empty($item['team_name'])) :   ?>
                                        <h5 class="team_name"><?php echo esc_html($item['team_name']) ?></h5>
                                    <?php endif ?>
                                    <?php if (!empty($item['team_designation'])) :   ?>
                                        <p class="team_deg secondary-text"><?php echo esc_html($item['team_designation']) ?></p>
                                    <?php endif ?>

                                    <div class="social">
                                        <?php if (!empty($item['social_fb_icon_url'])) :   ?>
                                            <a href="<?php echo esc_html($item['social_fb_icon_url']['url']) ?>">
                                                <i class="fa-brands fa-facebook-f"></i>
                                            </a>
                                        <?php endif ?>
                                        <?php if (!empty($item['social_tw_icon_url']['url'])) :   ?>
                                            <a href="<?php echo esc_html($item['social_tw_icon_url']['url']) ?>">
                                                <i class="fa-brands fa-twitter"></i>
                                            </a>
                                        <?php endif ?>
                                        <?php if (!empty($item['social_in_icon_url']['url'])) :   ?>
                                            <a href="<?php echo esc_html($item['social_in_icon_url']['url']) ?>">
                                                <i class="fa-brands fa-square-instagram"></i>
                                            </a>
                                        <?php endif ?>
                                        <?php if (!empty($item['social_ln_icon_url']['url'])) :   ?>
                                            <a href="<?php echo esc_html($item['social_ln_icon_url']['url']) ?>">
                                                <i class="fa-brands fa-linkedin-in"></i>
                                            </a>
                                        <?php endif ?>
                                        <?php if (!empty($item['social_yt_icon_url']['url'])) :   ?>
                                            <a href="<?php echo esc_html($item['social_yt_icon_url']['url']) ?>">
                                                <i class="fa-brands fa-youtube"></i>
                                            </a>
                                        <?php endif ?>
                                        <?php if (!empty($item['social_tel_icon_url']['url'])) :   ?>
                                            <a href="<?php echo esc_html($item['social_tel_icon_url']['url']) ?>">
                                                <i class="fa-brands fa-telegram"></i>
                                            </a>
                                        <?php endif ?>
                                        <?php if (!empty($item['social_wc_icon_url']['url'])) :   ?>
                                            <a href="<?php echo esc_html($item['social_wc_icon_url']['url']) ?>">
                                                <i class="fa-brands fa-weixin"></i>
                                            </a>
                                        <?php endif ?>
                                        <?php if (!empty($item['social_wa_icon_url']['url'])) :   ?>
                                            <a href="<?php echo esc_html($item['social_wa_icon_url']['url']) ?>">
                                                <i class="fa-brands fa-whatsapp"></i>
                                            </a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="slider-navigation">
                                <button class="next-team--secondary cmn-button cmn-button--secondary">
                                    <i class="fa-solid fa-angle-left"></i>
                                </button>
                                <button class="prev-team--secondary cmn-button cmn-button--secondary">
                                    <i class="fa-solid fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- ==== team section secondary end ==== -->

<?php
    }
}

$widgets_manager->register(new TP_team());
