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
class TP_banner extends Widget_Base
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
        return 'tp-banner';
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
        return __('banner', 'tpcore');
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
            'posts_per_page' => 4,
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

        // banner
        $this->start_controls_section(
            'golftio_banner_section_genaral',
            [
                'label' => esc_html__('banner Section', 'golftio-core')
            ]
        );


        $this->add_control(
            'golftio_banner_content_style_selection',
            [
                'label'   => esc_html__('Select Style', 'golftio-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'style_one' => esc_html__('Style One', 'golftio-core'),
                    'style_two' => esc_html__('Style Two', 'golftio-core'),
                    'style_three' => esc_html__('Style Three', 'golftio-core'),
                ],
                'default' => 'style_one',
            ]
        );

        $this->end_controls_section();




        // ====================================== banner Content One ============================================//
        $this->start_controls_section(
            'banner_overlay',
            [
                'label' => esc_html__('Bg Overlay', 'golftio-core'),
                'condition' => [
                    'golftio_banner_content_style_selection' => 'style_one',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type('overlay'),
            [
                'name' => 'background_overlay',
                'label' => esc_html__('Background Overlay', 'golftio-core'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .banner--secondary:after',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'banner_content',
            [
                'label' => esc_html__('Banner Content', 'golftio-core'),
                'condition' => [
                    'golftio_banner_content_style_selection' => 'style_one',
                ]
            ]
        );



        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__('Background', 'golftio-core'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .banner--secondary',
            ]
        );


        $this->add_control(
            'golftio_heading_content_subtitle',
            [
                'label' => esc_html__('Subtitle', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default Subtitle', 'golftio-core'),
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
                'default' => esc_html__('Our staff are always on hand to make all members feel welcome. Fully dedicated to golf lovers.', 'golftio-core'),
                'placeholder' => esc_html__('Type your description here', 'golftio-core'),
            ]
        );

        $this->end_controls_section();

        // banner_button
        $this->start_controls_section(
            'banner_button',
            [
                'label' => esc_html__('Button', 'golftio-core'),
            ]
        );

        // Button text
        $this->add_control(
            'golftio_banner_button_primary',
            [
                'label' => esc_html__('Button', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'golftio-core'),
                'placeholder' => esc_html__('Type your button here', 'golftio-core'),
                'label_block' => true,
            ]
        );

        // Button URL
        $this->add_control(
            'golftio_banner_button_primary_url',
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

        // Button text
        $this->add_control(
            'golftio_banner_button_secondary',
            [
                'label' => esc_html__('Button', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'golftio-core'),
                'placeholder' => esc_html__('Type your button here', 'golftio-core'),
                'label_block' => true,
            ]
        );

        // Button URL
        $this->add_control(
            'golftio_banner_button_secondary_url',
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


        // ====================================== Banner Two ============================================//

        $this->start_controls_section(
            'banner_overlay_two',
            [
                'label' => esc_html__('Bg Overlay', 'golftio-core'),
                'condition' => [
                    'golftio_banner_content_style_selection' => 'style_two',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type('overlay'),
            [
                'name' => 'background_overlay_two',
                'label' => esc_html__('Background Overlay', 'golftio-core'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .banner:after',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'banner_content_two',
            [
                'label' => esc_html__('Banner Content', 'golftio-core'),
                'condition' => [
                    'golftio_banner_content_style_selection' => 'style_two',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_two',
                'label' => esc_html__('Background', 'golftio-core'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .banner',
            ]
        );


        $this->add_control(
            'golftio_heading_content_subtitle_two',
            [
                'label' => esc_html__('Subtitle', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default Subtitle', 'golftio-core'),
                'placeholder' => esc_html__('Type your subtitle here', 'golftio-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'golftio_heading_content_title_two',
            [
                'label' => esc_html__('Title', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default Title', 'golftio-core'),
                'placeholder' => esc_html__('Type your title here', 'golftio-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'golftio_heading_content_description_two',
            [
                'label' => esc_html__('Short Description', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Our staff are always on hand to make all members feel welcome. Fully dedicated to golf lovers.', 'golftio-core'),
                'placeholder' => esc_html__('Type your description here', 'golftio-core'),
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


        // ====================================== Banner Three ============================================//

        $this->start_controls_section(
            'banner_overlay_three',
            [
                'label' => esc_html__('Bg Overlay', 'golftio-core'),
                'condition' => [
                    'golftio_banner_content_style_selection' => 'style_three',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type('overlay'),
            [
                'name' => 'background_overlay_three',
                'label' => esc_html__('Background Overlay', 'golftio-core'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .banner--secondary:after',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'banner_content_three',
            [
                'label' => esc_html__('Banner Content', 'golftio-core'),
                'condition' => [
                    'golftio_banner_content_style_selection' => 'style_three',
                ]
            ]
        );



        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_three',
                'label' => esc_html__('Background', 'golftio-core'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .banner--secondary',
            ]
        );

        $this->add_control(
            'golftio_heading_content_subtitle_three',
            [
                'label' => esc_html__('Subtitle', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default Subtitle', 'golftio-core'),
                'placeholder' => esc_html__('Type your subtitle here', 'golftio-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'golftio_heading_content_title_three',
            [
                'label' => esc_html__('Title', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default Title', 'golftio-core'),
                'placeholder' => esc_html__('Type your title here', 'golftio-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'golftio_heading_content_description_three',
            [
                'label' => esc_html__('Short Description', 'golftio-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Our staff are always on hand to make all members feel welcome. Fully dedicated to golf lovers.', 'golftio-core'),
                'placeholder' => esc_html__('Type your description here', 'golftio-core'),
            ]
        );

        $this->end_controls_section();


        // ======================= Style =================================//

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

        //    Description
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


        // =======================Button Style One===========================//

        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__('Button', 'golftio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
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
            'button_color',
            [
                'label'     => esc_html__('Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_secondary_color',
            [
                'label'     => esc_html__('Secondary Btn Color', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button.cmn-button--secondary' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_secondary_color_hover',
            [
                'label'     => esc_html__('Secondary Btn Hover', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button.cmn-button--secondary:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_bgcolor',
            [
                'label'     => esc_html__('Background Primary', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .cmn-button:after' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_hvr_bgcolor',
            [
                'label'     => esc_html__('Hover Background Primary', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button:hover' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_secondary_bgcolor',
            [
                'label'     => esc_html__('Background Secondary', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button.cmn-button--secondary:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .cmn-button.cmn-button--secondary:after' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_secondary_hvr_bgcolor',
            [
                'label'     => esc_html__('Hover Background Secondary', 'golftio-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cmn-button--secondary' => 'background: {{VALUE}} !important;',
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


        // card
        $this->start_controls_section(
            'card_style',
            [
                'label' => esc_html__('card', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'golftio_banner_content_style_selection' => 'style_two'
                ]
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
                    'golftio_banner_content_style_selection' => 'style_two'
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

        // Card Title
        $this->start_controls_section(
            'card_title_style',
            [
                'label' => esc_html__('Card Title', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'golftio_banner_content_style_selection' => 'style_two'
                ]
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


        // Card Descriptioin
        $this->start_controls_section(
            'card_des_style',
            [
                'label' => esc_html__('Card Descriptioin', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'golftio_banner_content_style_selection' => 'style_two'
                ]
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

        <!-- ==== banner section start ==== -->
        <?php if ($settings['golftio_banner_content_style_selection'] == 'style_one') : ?>
            <section class="banner--secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6 col-xl-7">
                            <div class="banner__content wow fadeInUp" data-wow-duration="0.4s">
                                <?php if (!empty($settings['golftio_heading_content_subtitle'])) :   ?>
                                    <h5 class="sub-title"><?php echo wp_kses($settings['golftio_heading_content_subtitle'], wp_kses_allowed_html('post'))  ?></h5>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_heading_content_title'])) :   ?>
                                    <h1 class="title"><?php echo wp_kses($settings['golftio_heading_content_title'], wp_kses_allowed_html('post'))  ?></h1>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_heading_content_description'])) :   ?>
                                    <p class="xlr pp primary-text banner__content-text"><?php echo wp_kses($settings['golftio_heading_content_description'], wp_kses_allowed_html('post'))  ?></p>
                                <?php endif ?>
                                <div class="banner__content-cta">
                                    <?php if (!empty($settings['golftio_banner_button_primary'])) : ?>
                                        <a href="<?php echo esc_html($settings['golftio_banner_button_primary_url']['url']) ?>" class="cmn-button"><?php echo esc_html($settings['golftio_banner_button_primary']) ?></a>
                                    <?php endif ?>
                                    <?php if (!empty($settings['golftio_banner_button_secondary'])) : ?>
                                        <a href="<?php echo esc_html($settings['golftio_banner_button_secondary_url']['url']) ?>" class="cmn-button cmn-button--secondary"><?php echo esc_html($settings['golftio_banner_button_secondary']) ?></a>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- ==== / banner section end ==== -->


        <!-- ==== about section two start ==== -->
        <?php if ($settings['golftio_banner_content_style_selection'] == 'style_two') : ?>
            <section class="banner">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-5 col-xl-6">
                            <div class="banner__content wow fadeInUp" data-wow-duration="0.4s">
                                <?php if (!empty($settings['golftio_heading_content_subtitle_two'])) :   ?>
                                    <h5 class="sub-title"><?php echo wp_kses($settings['golftio_heading_content_subtitle_two'], wp_kses_allowed_html('post'))  ?></h5>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_heading_content_title_two'])) :   ?>
                                    <h1 class="title"><?php echo wp_kses($settings['golftio_heading_content_title_two'], wp_kses_allowed_html('post'))  ?></h1>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_heading_content_description_two'])) :   ?>
                                    <p class="xlr pp primary-text banner__content-text"><?php echo wp_kses($settings['golftio_heading_content_description_two'], wp_kses_allowed_html('post'))  ?></p>
                                <?php endif ?>
                                <div class="banner__content-cta">
                                    <?php if (!empty($settings['golftio_banner_button_primary'])) : ?>
                                        <a href="<?php echo esc_html($settings['golftio_banner_button_primary_url']['url']) ?>" class="cmn-button"><?php echo esc_html($settings['golftio_banner_button_primary']) ?></a>
                                    <?php endif ?>
                                    <?php if (!empty($settings['golftio_banner_button_secondary'])) : ?>
                                        <a href="<?php echo esc_html($settings['golftio_banner_button_secondary_url']['url']) ?>" class="cmn-button cmn-button--secondary"><?php echo esc_html($settings['golftio_banner_button_secondary']) ?></a>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ==== overview section start ==== -->
            <div class="overview section section--space-top">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-10 col-xxl-9 order-last order-xl-first">
                            <div class="overview__inner cus_card wow fadeInUp" data-wow-duration="0.4s">
                                <div class="row section__row">
                                    <?php
                                    if ($query->have_posts()) :
                                        while ($query->have_posts()) :
                                            $query->the_post();
                                            $service_icon = function_exists('get_field') ? get_field('icon_name') : '';
                                    ?>
                                            <div class="col-sm-6 col-lg-3 section__col">
                                                <div class="overview__inner-card">
                                                    <div class="overview__inner-card__icon cus_icon">
                                                        <i class="<?php echo esc_html($service_icon) ?>"></i>
                                                    </div>
                                                    <div class="overview__inner-card__content cus_cont">
                                                        <h5>
                                                            <a href="<?php the_permalink(); ?>" class="cus_title_link">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h5>
                                                        <p class="secondary-text"><?php echo wp_trim_words(get_the_excerpt(), 6, '...'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile ?>
                                    <?php endif ?>
                                    <?php wp_reset_postdata(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-xxl-3 d-none d-xl-block">
                            <div class="overview__thumb text-center">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/golf-ball.png" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ==== / overview section end ==== -->
        <?php endif; ?>
        <!-- ==== about section two End ==== -->


        <!-- ==== about section three start ==== -->
        <?php if ($settings['golftio_banner_content_style_selection'] == 'style_three') : ?>
            <section class="banner--secondary banner--tertiary">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-10 col-lg-6 col-xl-7">
                            <div class="banner__content wow fadeInUp" data-wow-duration="0.4s">
                                <?php if (!empty($settings['golftio_heading_content_subtitle_three'])) :   ?>
                                    <h5 class="sub-title"><?php echo wp_kses($settings['golftio_heading_content_subtitle_three'], wp_kses_allowed_html('post'))  ?></h5>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_heading_content_title_three'])) :   ?>
                                    <h1 class="title"><?php echo wp_kses($settings['golftio_heading_content_title_three'], wp_kses_allowed_html('post'))  ?></h1>
                                <?php endif ?>
                                <?php if (!empty($settings['golftio_heading_content_description_three'])) :   ?>
                                    <p class="xlr pp primary-text banner__content-text"><?php echo wp_kses($settings['golftio_heading_content_description_three'], wp_kses_allowed_html('post'))  ?></p>
                                <?php endif ?>
                                <div class="banner__content-cta">
                                    <?php if (!empty($settings['golftio_banner_button_primary'])) : ?>
                                        <a href="<?php echo esc_html($settings['golftio_banner_button_primary_url']['url']) ?>" class="cmn-button"><?php echo esc_html($settings['golftio_banner_button_primary']) ?></a>
                                    <?php endif ?>
                                    <?php if (!empty($settings['golftio_banner_button_secondary'])) : ?>
                                        <a href="<?php echo esc_html($settings['golftio_banner_button_secondary_url']['url']) ?>" class="cmn-button cmn-button--secondary"><?php echo esc_html($settings['golftio_banner_button_secondary']) ?></a>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- ==== about section three start ==== -->
<?php
    }
}

$widgets_manager->register(new TP_banner());
