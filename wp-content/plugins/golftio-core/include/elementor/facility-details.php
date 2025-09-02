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
class TP_facility_det extends Widget_Base
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
        return 'tp-facility_det';
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
        return __('Facility Details', 'tpcore');
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

    public function get_post_list_by_post_type($post_type)
    {
        $return_val = [];
        $args       = array(
            'post_type'      => $post_type,
            'posts_per_page' => -1,
            'post_status'      => 'publish',
        );
        $all_post   = new \WP_Query($args);

        while ($all_post->have_posts()) {
            $all_post->the_post();
            $return_val[get_the_ID()] = get_the_title();
        }
        wp_reset_query();
        return $return_val;
    }

    public function get_all_post_key($post_type)
    {
        $return_val = [];
        $args       = array(
            'post_type'      => $post_type,
            'posts_per_page' => 6,
            'post_status'      => 'publish',

        );
        $all_post   = new \WP_Query($args);

        while ($all_post->have_posts()) {
            $all_post->the_post();
            $return_val[] = get_the_ID();
        }
        wp_reset_query();
        return $return_val;
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


        // inner card
        $this->start_controls_section(
            'golftio_card_details',
            [
                'label' => esc_html__('Card', 'golftio-core'),
            ]
        );


        // Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'golftio_card_icon_one',
            [
                'label' => esc_html__('Icon', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'golftio-shot-upper',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'golftio_card_title_one',
            [
                'label' => esc_html__(' Title', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default title', 'golftio-core'),
                'placeholder' => esc_html__('Type your title here', 'golftio-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'golftio_card_content_one',
            [
                'label' => esc_html__('Short Description', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Lorem ipsum dolor sit amet consectetur', 'golftio-core'),
                'placeholder' => esc_html__('Type your description here', 'golftio-core'),
            ]
        );


        $this->add_control(
            'card_inner_repeater',
            [
                'label' => esc_html__('Card', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'golftio_card_title_one' => esc_html__('Default title', 'golftio-core'),

                    ],
                    [
                        'golftio_card_title_one' => esc_html__('Default title', 'golftio-core'),

                    ],
                    [
                        'golftio_card_title_one' => esc_html__('Default title', 'golftio-core'),

                    ],
                    [
                        'golftio_card_title_one' => esc_html__('Default title', 'golftio-core'),

                    ],

                ],
                'title_field' => '{{{ golftio_card_title_one }}}',
            ]
        );

        $this->end_controls_section();


        //play_card Section
        $this->start_controls_section(
            'golftio_play_card_card_section_genaral',
            [
                'label' => esc_html__('Play Button', 'golftio-core')
            ]
        );

        // popup
        $this->add_control(
            'golftio_popup_content_image',
            [
                'label' => esc_html__('Choose Image', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'golftio_popup_link',
            [
                'label' => esc_html__('Link', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'golftio-core'),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );

        $this->end_controls_section();


        //Description Section
        $this->start_controls_section(
            'golftio_heading_one_section_genaral',
            [
                'label' => esc_html__('Description', 'golftio-core')
            ]
        );

        $this->add_responsive_control(
            'golftio_heading_content_align',
            [
                'label'         => esc_html__('Description Text Align', 'golftio-core'),
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
                    '{{WRAPPER}} .pp' => 'text-align: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'golftio_heading_content_description_one',
            [
                'label' => esc_html__('Short Description', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptas doloribus provident assumenda quidem. Minus quia doloribus, eveniet nam esse molestiae iste dolores numquam.', 'golftio-core'),
                'placeholder' => esc_html__('Type your description here', 'golftio-core'),
            ]
        );
        $this->add_control(
            'golftio_heading_content_description_two',
            [
                'label' => esc_html__('Short Description Down', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptas doloribus provident assumenda quidem. Minus quia doloribus, eveniet nam esse molestiae iste dolores numquam.', 'golftio-core'),
                'placeholder' => esc_html__('Type your description here', 'golftio-core'),
            ]
        );

        $this->end_controls_section();

        // testimonial
        $this->start_controls_section(
            'testimonial_content_three',
            [
                'label' => esc_html__('Testimonial', 'golftio-core'),
            ]
        );


        $this->add_responsive_control(
            'golftio_card_content_align_three',
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
                    '{{WRAPPER}} .facility__slider-single' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .testimonial__slider-card__author' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .testimonial__slider-card__body-review' => 'justify-content: {{VALUE}};',
                ],
            ],
        );



        // Repeater
        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'testi_icon',
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
            'testi_rating',
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
            'testi_description',
            [
                'label' => esc_html__('Description', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even...', 'golftio-core'),
                'placeholder' => esc_html__('Type your description here', 'golftio-core'),
            ]
        );

        $repeater->add_control(
            'testimonial_image',
            [
                'label' => esc_html__('Choose Image', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'testi_name',
            [
                'label' => esc_html__('Name', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Author Name', 'golftio-core'),
                'placeholder' => esc_html__('Type your name here', 'golftio-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testi_designation',
            [
                'label' => esc_html__('Designation', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Designation', 'golftio-core'),
                'placeholder' => esc_html__('Type your designation here', 'golftio-core'),
                'label_block' => true,
            ]
        );


        $this->add_control(
            'testimonial_repeater_three',
            [
                'label' => esc_html__('Testimonial List', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'testi_description' => esc_html__('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even...', 'golftio-core'),

                    ],

                ],
                'title_field' => '{{{ testi_description }}}',

            ]
        );

        $this->end_controls_section();


        // social icon
        $this->start_controls_section(
            'social_content_one',
            [
                'label' => esc_html__('Social', 'golftio-core'),
            ]
        );


        $this->add_responsive_control(
            'golftio_social_content_align',
            [
                'label'         => esc_html__('Social Align', 'golftio-core'),
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
                    '{{WRAPPER}} .social ' => 'justify-content: {{VALUE}};',
                ],

            ],

        );

        // Facebook URL
        $this->add_control(
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
        $this->add_control(
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
        $this->add_control(
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
        $this->add_control(
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
        $this->add_control(
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
        $this->add_control(
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
        $this->add_control(
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
        $this->add_control(
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

        $this->end_controls_section();



        // Posts Per Page Show
        $this->start_controls_section(
            'facility_one_general_content',
            [
                'label' => esc_html__('Content', 'golftio-core')
            ]
        );


        $this->add_control(
            'facility_category',
            [
                'label' => __('Select facility', 'turio-core'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options' => $this->get_post_list_by_post_type('facility'),
                'default'     => $this->get_all_post_key('facility'),
            ]
        );


        $this->add_control(
            'facility_posts_per_page',
            [
                'label'       => esc_html__('Content Show', 'corelaw-core'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => -1,
                'label_block' => false,
            ]
        );
        $this->add_control(
            'facility_template_order_by',
            [
                'label'   => esc_html__('Order By', 'corelaw-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'ID',
                'options' => [
                    'ID'         => esc_html__('Post Id', 'corelaw-core'),
                    'author'     => esc_html__('Post Author', 'corelaw-core'),
                    'title'      => esc_html__('Title', 'corelaw-core'),
                    'post_date'  => esc_html__('Date', 'corelaw-core'),
                    'rand'       => esc_html__('Random', 'corelaw-core'),
                    'menu_order' => esc_html__('Menu Order', 'corelaw-core'),
                ],
            ]
        );
        $this->add_control(
            'facility_template_order',
            [
                'label'   => esc_html__('Order', 'corelaw-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'asc'  => esc_html__('Ascending', 'corelaw-core'),
                    'desc' => esc_html__('Descending', 'corelaw-core')
                ],
                'default' => 'desc',
            ]
        );

        $this->end_controls_section();




        //======================= Style =================================//

        $this->start_controls_section(
            'card_img_style',
            [
                'label' => esc_html__('Details Box', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_style_color',
            [
                'label'     => esc_html__('Background Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_card' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_box_border_radius',
            [
                'label'      => __('Box Radius', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'card_img_border_radius',
            [
                'label'      => __('Image  Radius', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_thumbs img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'card_title_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cus_card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_title_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // Sidebar
        $this->start_controls_section(
            'card_titside_style',
            [
                'label' => esc_html__('Sidebar Heading', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_side_title_style_color',
            [
                'label'     => esc_html__('Heading Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .side_heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Heading Typography', 'plugin-name'),
                'name'     => 'card_side_title_style_typ',
                'selector' => '{{WRAPPER}} .side_heading',

            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'card_side_style',
            [
                'label' => esc_html__('Sidebar Details', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Sidebar List Typography', 'plugin-name'),
                'name'     => 'card_side_list_style_typ',
                'selector' => '{{WRAPPER}} .side_list',

            ]
        );
        $this->add_control(
            'card_side_style_color',
            [
                'label'     => esc_html__('Sidebar List Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .side_list' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_side_i_style_color',
            [
                'label'     => esc_html__('Sidebar Icon Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .side_list i' => 'color: {{VALUE}}; border:1px solid {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'card_side_hover_style_color',
            [
                'label'     => esc_html__('List Hover Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .side_list:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .side_list i' => 'color: {{VALUE}}; border:1px solid {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'card_side_bg_style_color',
            [
                'label'     => esc_html__('List Hover BG', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .side_list' => 'background: {{VALUE}};',
                ],
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'card_icon_custom_dimensionsss',
            [
                'label' => esc_html__('Icon Size', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .side_list i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Icon box Size
        $this->add_responsive_control(
            'icon_box_custom_dimensionsss',
            [
                'label' => esc_html__('Box Size', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .side_list i' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}} !important;',


                ],
            ]
        );


        $this->add_responsive_control(
            'card_side_bg_style_radius',
            [
                'label'      => __('List Box Radius', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .side_list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );


        $this->add_responsive_control(
            'card_side_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .side_list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_side_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .side_list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // Details Title
        $this->start_controls_section(
            'card_details_title_style',
            [
                'label' => esc_html__('Details Title', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'card_det_title_style_typ',
                'selector' => '{{WRAPPER}} .det_title',

            ]
        );

        $this->add_control(
            'card_details_title_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .det_title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'card_details_title_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .det_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_details_title_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .det_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();


        //Details Description 
        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__('Description', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'description_style_typ',
                'selector' => '{{WRAPPER}} .pp',
                'selector' => '{{WRAPPER}} .facility__single p',

            ]
        );

        $this->add_control(
            'description_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pp' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .facility__single p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'description_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pp' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .facility__single p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .facility__single p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->end_controls_section();


        //inner card 
        // Icon 
        $this->start_controls_section(
            'facility_icon_style',
            [
                'label' => esc_html__('Card Icon', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'facility_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .card_icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .card_icon i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_hover_color',
            [
                'label'     => esc_html__('Hover Icon Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .card_icon:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .card_icon:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bgcolor',
            [
                'label'     => esc_html__('Background', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .card_icon' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_hvr_bgcolor',
            [
                'label'     => esc_html__('Hover Background', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .card_icon:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'facility_bdr_color',
            [
                'label' => esc_html__('Border Color', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .card_icon' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'facility_bdr_hvr_color',
            [
                'label' => esc_html__('Hover Border Color', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .card_icon:hover' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'inner_card_icon_custom_dimensionsss',
            [
                'label' => esc_html__('Icon Size', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .card_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .card_icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Icon box Size
        $this->add_responsive_control(
            'inner_card_icon_box_custom_dimensionsss',
            [
                'label' => esc_html__('Box Size', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .card_icon' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}} !important;',


                ],
            ]
        );

        $this->add_responsive_control(
            'inner_card_border_radius',
            [
                'label'      => __('Border Radius', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .card_icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'inner_card_icon_style_margin',
            [
                'label' => esc_html__('Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .card_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'inner_card_icon_style_padding',
            [
                'label'      => __('Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .card_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();


        // card title
        $this->start_controls_section(
            'card_title_style',
            [
                'label' => esc_html__('Card Content', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'golftio-core'),
                'name'     => 'card_title_style_typ',
                'selector' => '{{WRAPPER}} .cart_title',
            ]
        );

        $this->add_control(
            'card_title_style_color',
            [
                'label'     => esc_html__('Title Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'card_desc_style_color',
            [
                'label'     => esc_html__('Description Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .secondary-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'des_card_title_style_margin',
            [
                'label' => esc_html__('Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cart_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'des_card_title_style_padding',
            [
                'label'      => __('Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cart_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'card_des_style',
            [
                'label' => esc_html__('Card Description', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'card_des_style_typ',
                'selector' => '{{WRAPPER}} .facility__overview-single-content p',

            ]
        );

        $this->add_control(
            'card_des_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .facility__overview-single-content p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'card_des_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .facility__overview-single-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_des_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .facility__overview-single-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();


        // ======================= contact card Start Style =================================//

        // Play  Icon 
        $this->start_controls_section(
            'card_icon_style',
            [
                'label' => esc_html__('Play Icon', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_icon_color',
            [
                'label'     => esc_html__('Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .play-btn i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'card_icon_bg_color',
            [
                'label'     => esc_html__('BG Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .play-btn' => 'background: {{VALUE}};',
                ],
            ]
        );


        // Icon Size
        $this->add_responsive_control(
            'counter_icon_custom_dimensionsss',
            [
                'label' => esc_html__('Icon Size', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .play-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Icon box Size
        $this->add_responsive_control(
            'play_icon_box_custom_dimensionsss',
            [
                'label' => esc_html__('Box Size', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .play-btn' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}} !important;',


                ],
            ]
        );

        $this->add_control(
            'card_box_bg_color',
            [
                'label'     => esc_html__('Background Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .play-btn ' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'facility_border_radius',
            [
                'label'      => __('Border Radius', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .play-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'facility_main_border_radius',
            [
                'label'      => __('Image Border Radius', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .facility__popup img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'facility_icon_style_margin',
            [
                'label' => esc_html__('Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .play-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'facility_icon_style_padding',
            [
                'label'      => __('Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .play-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();



        //    slider style

        // Slider Card 
        $this->start_controls_section(
            'test_card_style',
            [
                'label' => esc_html__('Slider Area', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'test_icon_color',
            [
                'label'     => esc_html__('BG Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .facility__slider-wrapper' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'test_card_style_margin',
            [
                'label' => esc_html__('Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .facility__slider-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'test_card_border_radius',
            [
                'label'      => __('Border Radius', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .facility__slider-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'test_card_style_padding',
            [
                'label'      => __('Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .facility__slider-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // Quotation Icon 
        $this->start_controls_section(
            'test_icon_style',
            [
                'label' => esc_html__('Slider Quotation Icon', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'test_quot_color',
            [
                'label'     => esc_html__('Icon Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quotation svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .quotation i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'test_icon_hover_color',
            [
                'label'     => esc_html__('Hover Icon Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quotation:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .quotation:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'test_icon_custom_dimensionsss',
            [
                'label' => esc_html__('Icon Size', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .quotation i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .quotation svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'test_facility_icon_style_margin',
            [
                'label' => esc_html__('Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .quotation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'test_facility_icon_style_padding',
            [
                'label'      => __('Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .quotation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // star Icon 
        $this->start_controls_section(
            'facility_icon_star_style',
            [
                'label' => esc_html__('Slider Star Icon', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'facility_icon_star_color',
            [
                'label'     => esc_html__('Icon Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial__slider-card__body-review svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .testimonial__slider-card__body-review i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'star_icon_hover_color',
            [
                'label'     => esc_html__('Hover Icon Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial__slider-card__body-review:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .testimonial__slider-card__body-review:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'star_icon_custom_dimensionsss',
            [
                'label' => esc_html__('Icon Size', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial__slider-card__body-review i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .testimonial__slider-card__body-review svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'facility_icon_star_style_margin',
            [
                'label' => esc_html__('Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial__slider-card__body-review' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'facility_icon_star_style_padding',
            [
                'label'      => __('Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial__slider-card__body-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_description_style',
            [
                'label' => esc_html__('Slider Description', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'golftio-core'),
                'name'     => 'slider_description_style_typ',
                'selector' => '{{WRAPPER}} .facility__slider-single__two p',

            ]
        );

        $this->add_control(
            'slider_description_style_color',
            [
                'label'     => esc_html__('Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .facility__slider-single__two p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_description_style_margin',
            [
                'label' => esc_html__('Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .facility__slider-single__two p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_description_style_padding',
            [
                'label'      => __('Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .facility__slider-single__two p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'slider_author_style',
            [
                'label' => esc_html__('Slider author', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'golftio-core'),
                'name'     => 'slider_author_style_typ',
                'selector' => '{{WRAPPER}} .testimonial__slider-card__author-info h6',

            ]
        );

        $this->add_control(
            'slider_author_style_color',
            [
                'label'     => esc_html__('Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial__slider-card__author-info h6' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_author_style_margin',
            [
                'label' => esc_html__('Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial__slider-card__author-info h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_author_style_padding',
            [
                'label'      => __('Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial__slider-card__author-info h6' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'slider_deg_style',
            [
                'label' => esc_html__('Slider Deg', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'golftio-core'),
                'name'     => 'slider_deg_style_typ',
                'selector' => '{{WRAPPER}} .testimonial__slider-card__author-info p',

            ]
        );

        $this->add_control(
            'slider_deg_style_color',
            [
                'label'     => esc_html__('Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial__slider-card__author-info p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_deg_style_margin',
            [
                'label' => esc_html__('Margin', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial__slider-card__author-info p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_deg_style_padding',
            [
                'label'      => __('Padding', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial__slider-card__author-info p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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

        $query = new \WP_Query(
            array(
                'post_type'      => 'facility',
                'posts_per_page' => $settings['facility_posts_per_page'],
                'orderby'        => $settings['facility_template_order_by'],
                'order'          => $settings['facility_template_order'],
                'offset'         => 0,
                'post_status'    => 'publish',

            )
        );

?>



        <script>
            jQuery(document).ready(function($) {
                $(".facility__slider--testimonial").not(".slick-initialized").slick({
                    infinite: true,
                    autoplay: true,
                    focusOnSelect: true,
                    slidesToShow: 1,
                    speed: 700,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: false,
                    prevArrow: $(".prev-facility-testimonial"),
                    nextArrow: $(".next-facility-testimonial"),
                    centerMode: true,
                    centerPadding: "0px"
                });
            });
        </script>


        <!-- ==== details start ==== -->
        <section class="section details">
            <div class="container">
                <div class="row section__row">
                    <div class="col-12 col-xl-8 section__col">
                        <div class="facility__details">
                            <div class="facility__thumb cus_thumbs">
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <div class="facility__single">
                                <h2 class="det_title"> <?php the_title(); ?></h2>
                                <?php the_excerpt() ?>
                            </div>
                            <div class="facility__overview">
                                <div class="row section__row">
                                    <?php foreach ($settings['card_inner_repeater'] as $item) : ?>
                                        <div class="col-md-6 section__col">
                                            <div class="facility__overview-single">
                                                <?php if (!empty($item['golftio_card_icon_one'])) : ?>
                                                    <div class="facility__overview-single-thumb card_icon">
                                                        <?php \Elementor\Icons_Manager::render_icon($item['golftio_card_icon_one'], ['aria-hidden' => 'true']); ?>
                                                    </div>
                                                <?php endif ?>
                                                <?php if (!empty($item['golftio_card_title_one'])) :   ?>
                                                    <div class="facility__overview-single-content">
                                                        <h6 class="cart_title"><?php echo esc_html($item['golftio_card_title_one']) ?></h6>
                                                        <p class="secondary-text"><?php echo esc_html($item['golftio_card_content_one']) ?></p>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="facility__popup">
                                <?php if (!empty($settings['golftio_popup_content_image']['url'])) :   ?>
                                    <img src="<?php echo esc_url($settings['golftio_popup_content_image']['url']) ?>" alt="<?php echo esc_attr('Facility Details') ?>">
                                <?php endif ?>
                                <div class="play-wrapper">
                                    <?php if (!empty($settings['golftio_popup_link'])) :   ?>
                                        <a href="<?php echo esc_url($settings['golftio_popup_link']['url']) ?>" class="play-btn" target="<?php echo esc_attr('_blank') ?>" title="<?php echo esc_attr('Youtube Video Player') ?>">
                                            <i class="fa-solid fa-play"></i>
                                        </a>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="facility__single">
                                <?php if (!empty($settings['golftio_heading_content_description_one'])) : ?>
                                    <p class="xlr pp"><?php echo wp_kses($settings['golftio_heading_content_description_one'], wp_kses_allowed_html('post')) ?></p>
                                <?php endif; ?>
                            </div>
                            <!-- slider -->
                            <div class="facility__slider-wrapper slider-navigation">
                                <button class="next-facility-testimonial cmn-button cmn-button--secondary">
                                    <i class="fa-solid fa-angle-left"></i>
                                </button>
                                <div class="facility__slider--testimonial">
                                    <?php foreach ($settings['testimonial_repeater_three'] as $item) : ?>
                                        <div class="facility__slider-single">
                                            <div class="facility__slider-single__two">
                                                <?php if (!empty($item['testi_icon'])) : ?>
                                                    <div class="quotation">
                                                        <?php \Elementor\Icons_Manager::render_icon($item['testi_icon'], ['aria-hidden' => 'true']); ?>
                                                    </div>
                                                <?php endif ?>
                                                <?php if (!empty($item['testi_rating'])) :   ?>
                                                    <div class="facility-review">
                                                        <?php for ($i = 0; $i < $item['testi_rating']; $i++) : ?>
                                                            <i class="golftio-star"></i>
                                                        <?php endfor; ?>
                                                    </div>
                                                <?php endif ?>
                                                <?php if (!empty($item['testi_description'])) :   ?>
                                                    <p class="ppp"><?php echo esc_html($item['testi_description']) ?></p>
                                                <?php endif ?>
                                            </div>
                                            <div class="testimonial__slider-card__author">
                                                <?php if (!empty($item['testimonial_image']['url'])) :   ?>
                                                    <div class="testimonial__slider-card__author-thumb">
                                                        <img src="<?php echo esc_url($item['testimonial_image']['url']) ?>" alt="<?php echo esc_attr('image') ?>">
                                                    </div>
                                                <?php endif ?>
                                                <div class="testimonial__slider-card__author-info">
                                                    <?php if (!empty($item['testi_name'])) :   ?>
                                                        <h6><?php echo esc_html($item['testi_name']) ?></h6>
                                                    <?php endif ?>
                                                    <?php if (!empty($item['testi_designation'])) :   ?>
                                                        <p class="secondary-text"><?php echo esc_html($item['testi_designation']) ?></p>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button class="prev-facility-testimonial cmn-button cmn-button--secondary">
                                    <i class="fa-solid fa-angle-right"></i>
                                </button>
                            </div>
                            <div class="facility__single">
                                <?php if (!empty($settings['golftio_heading_content_description_two'])) : ?>
                                    <p class="xlr pp"><?php echo wp_kses($settings['golftio_heading_content_description_two'], wp_kses_allowed_html('post')) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4 section__col">
                        <div class="sidebar cus_card wow fadeInUp" data-wow-duration="0.4s">
                            <div class="sidebar__single cus_card">
                                <h5 class="side_heading"><?php echo esc_html('Search') ?></h5>
                                <hr>
                                <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                                    <div class="search_form">
                                        <input type="text" name="s" value="<?php echo get_search_query(); ?>" id="supportSearch" placeholder="<?php echo esc_attr__('Search', 'gamestorm'); ?>">
                                        <button type="submit">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="sidebar__single cus_card">
                                <h5 class="side_heading"><?php echo esc_html('All Facility') ?></h5>
                                <div class="sidebar__tab">
                                    <ul>
                                        <?php
                                        if ($query->have_posts()) :
                                            while ($query->have_posts()) :
                                                $query->the_post();
                                        ?>
                                                <li>
                                                    <a href="<?php the_permalink(); ?>" class="facility-tab-btn side_list">
                                                        <i class="fa-solid fa-angle-right"></i>
                                                        <?php the_title(); ?>
                                                    </a>
                                                </li>
                                            <?php endwhile ?>
                                        <?php endif ?>
                                        <?php wp_reset_postdata(); ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar__single cus_card">
                                <h5 class="side_heading"><?php echo esc_html('Follow Our Journey') ?></h5>
                                <hr class="cus_border">
                                <div class="social">
                                    <?php if (!empty($settings['social_fb_icon_url'])) :   ?>
                                        <a href="<?php echo esc_html($settings['social_fb_icon_url']['url']) ?>">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    <?php endif ?>
                                    <?php if (!empty($settings['social_tw_icon_url']['url'])) :   ?>
                                        <a href="<?php echo esc_html($settings['social_tw_icon_url']['url']) ?>">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a>
                                    <?php endif ?>
                                    <?php if (!empty($settings['social_in_icon_url']['url'])) :   ?>
                                        <a href="<?php echo esc_html($settings['social_in_icon_url']['url']) ?>">
                                            <i class="fa-brands fa-square-instagram"></i>
                                        </a>
                                    <?php endif ?>
                                    <?php if (!empty($settings['social_ln_icon_url']['url'])) :   ?>
                                        <a href="<?php echo esc_html($settings['social_ln_icon_url']['url']) ?>">
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        </a>
                                    <?php endif ?>
                                    <?php if (!empty($settings['social_yt_icon_url']['url'])) :   ?>
                                        <a href="<?php echo esc_html($settings['social_yt_icon_url']['url']) ?>">
                                            <i class="fa-brands fa-youtube"></i>
                                        </a>
                                    <?php endif ?>
                                    <?php if (!empty($settings['social_tel_icon_url']['url'])) :   ?>
                                        <a href="<?php echo esc_html($settings['social_tel_icon_url']['url']) ?>">
                                            <i class="fa-brands fa-telegram"></i>
                                        </a>
                                    <?php endif ?>
                                    <?php if (!empty($settings['social_wc_icon_url']['url'])) :   ?>
                                        <a href="<?php echo esc_html($settings['social_wc_icon_url']['url']) ?>">
                                            <i class="fa-brands fa-weixin"></i>
                                        </a>
                                    <?php endif ?>
                                    <?php if (!empty($settings['social_wa_icon_url']['url'])) :   ?>
                                        <a href="<?php echo esc_html($settings['social_wa_icon_url']['url']) ?>">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </a>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ==== details start ==== -->

<?php
    }
}

$widgets_manager->register(new TP_facility_det());
