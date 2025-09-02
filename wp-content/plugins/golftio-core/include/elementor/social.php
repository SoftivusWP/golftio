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
class TP_social extends Widget_Base
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
        return 'tp-social';
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
        return __('Social', 'tpcore');
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


        // ======================================Content One============================================//
        $this->start_controls_section(
            'social_content',
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
                'default'         => 'center',
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

        // ======================= Style =================================//



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

<?php
    }
}

$widgets_manager->register(new TP_social());
