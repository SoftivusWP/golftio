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
class TP_trainings_det extends Widget_Base
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
        return 'tp-training_det';
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
        return __('Training Details', 'tpcore');
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
            'trainings_one_general_content',
            [
                'label' => esc_html__('Content Show', 'golftio-core')
            ]
        );


        $this->add_control(
            'trainings_category',
            [
                'label' => __('Select Trainings', 'turio-core'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options' => $this->get_post_list_by_post_type('trainings'),
                'default'     => $this->get_all_post_key('trainings'),
            ]
        );


        $this->add_control(
            'trainings_posts_per_page',
            [
                'label'       => esc_html__('Posts Per Page', 'corelaw-core'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => -1,
                'label_block' => false,
            ]
        );
        $this->add_control(
            'trainings_template_order_by',
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
            'trainings_template_order',
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
            'card_img_style',
            [
                'label' => esc_html__('Details card', 'plugin-name'),
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
                    '{{WRAPPER}} .cus_card img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
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


        $this->start_controls_section(
            'card_title_style',
            [
                'label' => esc_html__('Details Title', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'card_title_style_typ',
                'selector' => '{{WRAPPER}} .det_title',

            ]
        );

        $this->add_control(
            'card_title_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .det_title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .det_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .det_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                'selector' => '{{WRAPPER}} .det_content p',

            ]
        );

        $this->add_control(
            'card_des_style_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .det_content p' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .det_content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .det_content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                'post_type'      => 'trainings',
                'posts_per_page' => $settings['trainings_posts_per_page'],
                'orderby'        => $settings['trainings_template_order_by'],
                'order'          => $settings['trainings_template_order'],
                'offset'         => 0,
                'post_status'    => 'publish',

            )
        );

?>


        <section class="section details">
            <div class="container">
                <div class="row section__row">
                    <div class="col-12 col-xl-4 section__col">
                        <div class="sidebar wow fadeInUp" data-wow-duration="0.4s">
                            <div class="sidebar__single cus_card">
                                <h5 class="side_heading"><?php echo esc_html('Training Position') ?></h5>
                                <div class="sidebar__tab">
                                    <ul>
                                        <?php
                                        if ($query->have_posts()) :
                                            while ($query->have_posts()) :
                                                $query->the_post();
                                        ?>
                                                <li>
                                                    <a href="<?php the_permalink(); ?>" class="training-tab-btn side_list">
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
                        </div>
                    </div>
                    <div class="col-12 col-xl-8 section__col">
                        <div class="training__details">
                            <div class="training__details-inner cus_card">
                                <div class="training__details-thumb cus_det_thumb">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <div class="training__details-content det_content">
                                    <h2 class="det_title"> <?php the_title(); ?></h2>
                                    <?php the_excerpt() ?>

                                    <hr class="cus_border">
                                    <div>
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
                </div>
            </div>
        </section>
<?php
    }
}

$widgets_manager->register(new TP_trainings_det());
