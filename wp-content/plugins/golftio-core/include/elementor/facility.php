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
class TP_facility extends Widget_Base
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
        return 'tp-facility';
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
        return __('Facility', 'tpcore');
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



        $this->start_controls_section(
            'facility_general_content',
            [
                'label' => esc_html__('General', 'golftio-core')
            ]
        );
        $this->add_control(
            'golftio_content_style_selection',
            [
                'label'   => esc_html__('Select Style', 'golftio-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'style_one' => esc_html__('Style One', 'golftio-core'),
                    'style_two' => esc_html__('Style Two', 'golftio-core'),
                    'style_three' => esc_html__('Style Three', 'golftio-core'),
                    'style_four' => esc_html__('Style Four', 'golftio-core'),
                ],
                'default' => 'style_one',
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
                'label'       => esc_html__('Posts Per Page', 'corelaw-core'),
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



        $this->start_controls_section(
            'trainings_three_heading_general_content',
            [
                'label' => esc_html__('Heading', 'golftio-core'),
                'condition' => [
                    'golftio_content_style_selection' => ['style_one', 'style_three', 'style_four']
                ]
            ]
        );
        $this->add_control(
            'golftio_heading_content_subtitle',
            [
                'label' => esc_html__('Subtitle', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Facility', 'golftio-core'),
                'placeholder' => esc_html__('Type your subtitle here', 'golftio-core'),
                'label_block' => true,
                'condition' => [
                    'golftio_content_style_selection' => ['style_three', 'style_four']
                ]
            ]
        );
        $this->add_control(
            'golftio_heading_one_content_title',
            [
                'label' => esc_html__('Title', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default title', 'golftio-core'),
                'placeholder' => esc_html__('Type your title here', 'golftio-core'),
                'label_block' => true,
                'condition' => [
                    'golftio_content_style_selection' => ['style_one', 'style_three', 'style_four']
                ]
            ]
        );
        $this->add_control(
            'golftio_heading_content_description',
            [
                'label' => esc_html__('Short Description', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Golftio Sports Club is a golf club with a history that goes back to XX century. From a cricket club to soccer tournaments,', 'golftio-core'),
                'placeholder' => esc_html__('Type your description here', 'golftio-core'),
                'condition' => [
                    'golftio_content_style_selection' => ['style_three', 'style_four']
                ]
            ]
        );

        // Button text
        $this->add_control(
            'golftio_content_two_button',
            [
                'label' => esc_html__('Button', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'golftio-core'),
                'placeholder' => esc_html__('Type your button here', 'golftio-core'),
                'label_block' => true,
                'condition' => [
                    'golftio_content_style_selection' => 'style_four',
                ]
            ]
        );

        // Button URL
        $this->add_control(
            'golftio_content_two_button_url',
            [
                'label' => esc_html__('Button URL', 'golftio-core'),
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
                'condition' => [
                    'golftio_content_style_selection' => 'style_four',
                ]
            ]
        );

        $this->end_controls_section();



        // ======================= Heading Style =================================//


        // Section 
        $this->start_controls_section(
            'box_style',
            [
                'label' => esc_html__('Section Area', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_control(
            'box_style_color',
            [
                'label'     => esc_html__('Background', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .box_area' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .box_area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .box_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();


        // Subtitle 
        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__('Subtitle', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'golftio_content_style_selection' => ['style_three', 'style_four'],
                ]
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
                'label' => esc_html__('Title', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'golftio_content_style_selection' => ['style_one', 'style_three', 'style_four'],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'title_style_typ',
                'selector' => '{{WRAPPER}} .title',

            ]
        );

        $this->add_control(
            'title_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
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
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        //    Description
        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__('Description', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'golftio_content_style_selection' =>  ['style_three', 'style_four'],
                ]
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

        // card
        $this->start_controls_section(
            'card_style',
            [
                'label' => esc_html__('Card', 'plugin-name'),
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
            'card_img_border_radius',
            [
                'label'      => __('Image Border Radius', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'golftio_content_style_selection' => ['style_one', 'style_two', 'style_three']
                ]
            ]
        );

        $this->add_responsive_control(
            'card_border_radius',
            [
                'label'      => __('Border Radius', 'golftio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'card_style_margin',
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
            'card_style_padding',
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


        // card  Icon 
        $this->start_controls_section(
            'card_icon_style',
            [
                'label' => esc_html__('Icon', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'golftio_content_style_selection' => 'style_three'
                ]
            ]
        );

        $this->add_control(
            'card_icon_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_icon i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'card_icon_bg_color',
            [
                'label'     => esc_html__('background', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_icon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_icon_bdr_color',
            [
                'label' => esc_html__('Border Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_icon' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'card_icon_bdr_hvr_color',
            [
                'label' => esc_html__('Hover Border Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_icon:hover' => 'border:1px solid {{VALUE}}',
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
                    '{{WRAPPER}} .cus_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .cus_icon' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}} !important;',


                ],
            ]
        );

        $this->add_responsive_control(
            'card_icon_border_radius',
            [
                'label'      => __('Border Radius', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'card_icon_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cus_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_icon_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'card_title_style',
            [
                'label' => esc_html__('Card Title', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'card_title_style_typ',
                'selector' => '{{WRAPPER}} .cus_title_link',

            ]
        );

        $this->add_control(
            'card_title_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_title_link' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .cus_title_link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .cus_title_link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->end_controls_section();


        // Card Description
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
                'selector' => '{{WRAPPER}} .cus_cont p',

            ]
        );

        $this->add_control(
            'card_des_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_cont p' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .cus_cont p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .cus_cont p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // button link
        $this->start_controls_section(
            'button_link_style',
            [
                'label' => esc_html__('Button Link', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'golftio_content_style_selection' => ['style_one', 'style_two']
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'card_des_link_style_typ',
                'selector' => '{{WRAPPER}} .cus_btn_link',

            ]
        );

        $this->add_control(
            'button_link_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_btn_link' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_link_style_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cus_btn_link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_link_style_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_btn_link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();


        // =======================Button Style===========================//

        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__('Button', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'golftio_content_style_selection' => ['style_one', 'style_three', 'style_four']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'golftio-core'),
                'name'     => 'button_typ',
                'selector' => '{{WRAPPER}} .cmn-button',
            ]
        );

        $this->add_control(
            'button_secondary_color_hover',
            [
                'label'     => esc_html__('Btn Icon Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button.cmn-button--secondary i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'golftio_content_style_selection' => ['style_one', 'style_three']
                ]
            ]
        );
        $this->add_control(
            'button_secondary_color',
            [
                'label'     => esc_html__('Btn Icon Hover Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button.cmn-button--secondary:hover i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'golftio_content_style_selection' => ['style_one', 'style_three']
                ]
            ]
        );
        $this->add_control(
            'button_sec_color',
            [
                'label'     => esc_html__('Btn Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button.cmn-button--secondary' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'golftio_content_style_selection' => 'style_four',
                ]
            ]
        );
        $this->add_control(
            'button_sec_color_hover',
            [
                'label'     => esc_html__('Btn Hover Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button.cmn-button--secondary:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'golftio_content_style_selection' => 'style_four',
                ]
            ]
        );

        $this->add_control(
            'button_secondary_hvr_bgcolor',
            [
                'label'     => esc_html__('Btn BG', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button--secondary' => 'background: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'button_secondary_bgcolor',
            [
                'label'     => esc_html__('Btn BG Hover', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button.cmn-button--secondary:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .cmn-button.cmn-button--secondary:after' => 'background: {{VALUE}};',
                ],

            ]
        );
        $this->add_control(
            'button_bdr_color',
            [
                'label' => esc_html__('Border Color', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_bdr_hvr_color',
            [
                'label' => esc_html__('Hover Border Color', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button:hover' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_border_radius',
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
            'button_style_margin',
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
            'button_style_padding',
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

                // facility slider
                jQuery(".facility__slider")
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
                        prevArrow: jQuery(".prev-facility"),
                        nextArrow: jQuery(".next-facility"),
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


                // facility related slider
                jQuery(".facility--main__slider")
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
                        prevArrow: jQuery(".prev-related-facility"),
                        nextArrow: jQuery(".next-related-facility"),
                        centerMode: true,
                        centerPadding: "0px",
                        responsive: [{
                                breakpoint: 1400,
                                settings: {
                                    slidesToShow: 3,
                                },
                            },
                            {
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

            });
        </script>


        <!-- ==== training section start ==== -->
        <?php if ($settings['golftio_content_style_selection'] == 'style_one') : ?>
            <section class="section facility--main box_area wow fadeInUp" data-wow-duration="0.4s">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section__header--secondary">
                                <div class="row align-items-center">
                                    <div class="col-lg-8">
                                        <div class="section__header--secondary__content">
                                            <?php if (!empty($settings['golftio_heading_one_content_title'])) : ?>
                                                <h2 class="title"><?php echo wp_kses($settings['golftio_heading_one_content_title'], wp_kses_allowed_html('post'))  ?></h2>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="section__header--secondary__cta">
                                            <div class="slider-navigation justify-content-lg-end">
                                                <button class="next-related-facility cmn-button cmn-button--secondary">
                                                    <i class="fa-solid fa-angle-left"></i>
                                                </button>
                                                <button class="prev-related-facility cmn-button cmn-button--secondary">
                                                    <i class="fa-solid fa-angle-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-10 col-md-12">
                            <div class="facility--main__slider">
                                <?php if ($query->have_posts()) :
                                    while ($query->have_posts()) :
                                        $query->the_post();
                                ?>
                                        <div class="cus_card facility--main__card">
                                            <div class="facility--main__card-thumb">
                                                <a href="<?php the_permalink() ?>" class="cus_thumb">
                                                    <?php the_post_thumbnail() ?>
                                                </a>
                                            </div>
                                            <div class="facility--main__card-content cus_cont">
                                                <h5>
                                                    <a href="<?php the_permalink(); ?>" class="cus_title_link">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h5>
                                                <p class="secondary-text"><?php echo wp_trim_words(get_the_excerpt(), 9, '...'); ?></p>
                                                <a href="<?php the_permalink() ?>" class="cus_btn_link facility--main__card-content__cta">
                                                    <?php echo esc_html__('View More', 'golftio-core') ?>
                                                    <i class="golftio-long-right-arrow"></i>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endwhile ?>
                                <?php endif ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($settings['golftio_content_style_selection'] == 'style_two') : ?>
            <!-- ==== facility section start ==== -->
            <section class="section facility--main box_area wow fadeInUp" data-wow-duration="0.4s">
                <div class="container">
                    <div class="row section__row justify-content-center">
                        <?php if ($query->have_posts()) :
                            while ($query->have_posts()) :
                                $query->the_post();
                                // $service_icon = function_exists('get_field') ? get_field('icon_name') : '';
                        ?>
                                <div class="col-sm-10 col-md-6 col-lg-4 col-xxl-3 section__col">
                                    <div class="cus_card facility--main__card">
                                        <div class="facility--main__card-thumb">
                                            <a href="<?php the_permalink() ?>" class="cus_thumb">
                                                <?php the_post_thumbnail() ?>
                                            </a>
                                        </div>
                                        <div class="facility--main__card-content cus_cont">
                                            <h5>
                                                <a href="<?php the_permalink(); ?>" class="cus_title_link">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h5>
                                            <p class="secondary-text"><?php echo wp_trim_words(get_the_excerpt(), 9, '...'); ?></p>
                                            <a href="<?php the_permalink() ?>" class="cus_btn_link facility--main__card-content__cta">
                                                <?php echo esc_html__('View More', 'golftio-core') ?>
                                                <i class="golftio-long-right-arrow"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile ?>
                        <?php endif ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
            <!-- ==== / facility section end ==== -->
        <?php endif; ?>

        <?php if ($settings['golftio_content_style_selection'] == 'style_three') : ?>
            <section class="section facility box_area wow fadeInUp" data-wow-duration="0.4s">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="section__header">
                                <?php if (!empty($settings['golftio_heading_content_subtitle'])) :   ?>
                                    <h5 class="sub-title"><?php echo wp_kses($settings['golftio_heading_content_subtitle'], wp_kses_allowed_html('post'))  ?></h5>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_heading_one_content_title'])) :   ?>
                                    <h2 class="title"><?php echo wp_kses($settings['golftio_heading_one_content_title'], wp_kses_allowed_html('post'))  ?></h2>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_heading_content_description'])) :   ?>
                                    <p class="xlr pp "><?php echo wp_kses($settings['golftio_heading_content_description'], wp_kses_allowed_html('post'))  ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-10 col-lg-12">
                            <div class="facility__slider">
                                <?php if ($query->have_posts()) :
                                    while ($query->have_posts()) :
                                        $query->the_post();
                                        $service_icon = function_exists('get_field') ? get_field('icon_name') : '';
                                ?>
                                        <div class="cus_card facility__card">
                                            <div class="cus_icon facility__card-icon ">
                                                <i class="<?php echo esc_html($service_icon) ?>"></i>
                                            </div>
                                            <div class="facility__card-content cus_cont">
                                                <h5>
                                                    <a href="<?php the_permalink(); ?>" class="cus_title_link">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h5>
                                                <p class="secondary-text"><?php echo wp_trim_words(get_the_excerpt(), 9, '...'); ?></p>
                                            </div>
                                        </div>
                                    <?php endwhile ?>
                                <?php endif ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="slider-navigation">
                                <button class="next-facility cmn-button cmn-button--secondary">
                                    <i class="fa-solid fa-angle-left"></i>
                                </button>
                                <button class="prev-facility cmn-button cmn-button--secondary">
                                    <i class="fa-solid fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($settings['golftio_content_style_selection'] == 'style_four') : ?>
            <section class="section facility facility--secondary box_area wow fadeInUp" data-wow-duration="0.4s">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="section__header">
                                <?php if (!empty($settings['golftio_heading_content_subtitle'])) :   ?>
                                    <h5 class="sub-title"><?php echo wp_kses($settings['golftio_heading_content_subtitle'], wp_kses_allowed_html('post'))  ?></h5>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_heading_one_content_title'])) :   ?>
                                    <h2 class="title"><?php echo wp_kses($settings['golftio_heading_one_content_title'], wp_kses_allowed_html('post'))  ?></h2>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_heading_content_description'])) :   ?>
                                    <p class="xlr pp "><?php echo wp_kses($settings['golftio_heading_content_description'], wp_kses_allowed_html('post'))  ?></p>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_content_two_button'])) : ?>
                                    <div class="section__header-cta">
                                        <a href="<?php echo esc_html($settings['golftio_content_two_button_url']['url']) ?>" class="cmn-button cmn-button--secondary"><?php echo esc_html($settings['golftio_content_two_button']) ?></a>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 align-items-center justify-content-between cus_design  pt-xxl-3 pb-xxl-4 ">
                        <?php if ($query->have_posts()) :
                            while ($query->have_posts()) :
                                $query->the_post();
                                $service_icon = function_exists('get_field') ? get_field('icon_name') : '';
                        ?>
                                <div class="col-sm-6 col-lg-4 col-xxl-3">
                                    <div class="facility--secondary__cards">
                                        <div class="facility__card">
                                            <div class="facility__card-icon">
                                                <i class="<?php echo esc_html($service_icon) ?>"></i>
                                            </div>
                                            <div class="facility__card-content">
                                                <h5>
                                                    <a href="<?php the_permalink(); ?>" class="cus_title_link">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h5>
                                                <p class="secondary-text"><?php echo wp_trim_words(get_the_excerpt(), 8, '...'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile ?>
                        <?php endif ?>
                        <?php wp_reset_postdata(); ?>
                        <div class="facility--secondary__thumbs text-center cus_design_vector d-none d-lg-block">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/large-golf-ball.png" <?php echo esc_attr(' alt="Image"') ?>>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_facility());
