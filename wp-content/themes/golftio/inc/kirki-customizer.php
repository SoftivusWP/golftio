<?php

/**
 * bentox customizer
 *
 * @package bentox
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Added Panels & Sections
 */
function bentox_customizer_panels_sections($wp_customize)
{

    //Add panel
    $wp_customize->add_panel('bentox_customizer', [
        'priority' => 10,
        'title'    => esc_html__('Golftio Customizer', 'golftio'),
    ]);

    /**
     * Customizer Section
     */
    $wp_customize->add_section('header_top_setting', [
        'title'       => esc_html__('Header Info Setting', 'golftio'),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'bentox_customizer',
    ]);



    $wp_customize->add_section('header_top_setting_color', [
        'title'       => esc_html__('Header Menu Setting', 'golftio'),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'bentox_customizer',
    ]);

    $wp_customize->add_section('section_header_logo', [
        'title'       => esc_html__('Header Setting', 'golftio'),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'bentox_customizer',
    ]);

    $wp_customize->add_section('blog_setting', [
        'title'       => esc_html__('Blog Setting', 'golftio'),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'bentox_customizer',
    ]);

    $wp_customize->add_section('header_side_setting', [
        'title'       => esc_html__('Side Info', 'golftio'),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'bentox_customizer',
    ]);

    $wp_customize->add_section('breadcrumb_setting', [
        'title'       => esc_html__('Breadcrumb Setting', 'golftio'),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'bentox_customizer',
    ]);

    $wp_customize->add_section('blog_setting', [
        'title'       => esc_html__('Blog Setting', 'golftio'),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'bentox_customizer',
    ]);

    $wp_customize->add_section('footer_setting', [
        'title'       => esc_html__('Footer Settings', 'golftio'),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'bentox_customizer',
    ]);

    $wp_customize->add_section('color_setting', [
        'title'       => esc_html__('Color Setting', 'golftio'),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'bentox_customizer',
    ]);

    $wp_customize->add_section('404_page', [
        'title'       => esc_html__('404 Page', 'golftio'),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'bentox_customizer',
    ]);

    $wp_customize->add_section('typo_setting', [
        'title'       => esc_html__('Typography Setting', 'golftio'),
        'description' => '',
        'priority'    => 21,
        'capability'  => 'edit_theme_options',
        'panel'       => 'bentox_customizer',
    ]);
}

add_action('customize_register', 'bentox_customizer_panels_sections');

function _header_top_fields($fields)
{
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'bentox_btnone_switch',
        'label'    => esc_html__('Button One Swicher', 'golftio'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'golftio'),
            'off' => esc_html__('Disable', 'golftio'),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'bentox_btntwo_switch',
        'label'    => esc_html__('Button Two Swicher', 'golftio'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'golftio'),
            'off' => esc_html__('Disable', 'golftio'),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'bentox_cart_switch',
        'label'    => esc_html__('Cart Swicher', 'golftio'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'golftio'),
            'off' => esc_html__('Disable', 'golftio'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'bentox_preloader',
        'label'    => esc_html__('Preloader On/Off', 'golftio'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'golftio'),
            'off' => esc_html__('Disable', 'golftio'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'bentox_backtotop',
        'label'    => esc_html__('Back To Top On/Off', 'golftio'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'golftio'),
            'off' => esc_html__('Disable', 'golftio'),
        ],
    ];

    // Button Text One
    $fields[] = [
        'type'     => 'text',
        'settings' => 'bentox_btnone_text',
        'label'    => esc_html__('Button One Text', 'golftio'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('Sign In', 'golftio'),
        'priority' => 10,
    ];
    // Button Text Two
    $fields[] = [
        'type'     => 'text',
        'settings' => 'bentox_btntwo_text',
        'label'    => esc_html__('Button Two Text', 'golftio'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('Sign Up', 'golftio'),
        'priority' => 10,
    ];

    // email
    $fields[] = [
        'type'     => 'link',
        'settings' => 'bentox_btnone_link',
        'label'    => esc_html__('Button One Link', 'golftio'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('', 'golftio'),
        'priority' => 10,
    ];
    // email
    $fields[] = [
        'type'     => 'link',
        'settings' => 'bentox_btntwo_link',
        'label'    => esc_html__('Button Two Link', 'golftio'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('', 'golftio'),
        'priority' => 10,
    ];

    return $fields;
}
add_filter('kirki/fields', '_header_top_fields');



/*
Header Settings
 */
function _header_header_fields($fields)
{
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__('Select Header Style', 'golftio'),
        'section'     => 'section_header_logo',
        'placeholder' => esc_html__('Select an option...', 'golftio'),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'header-style-1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
            'header-style-2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
        ],
        'default'     => 'header-style-1',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__('Header Logo', 'golftio'),
        'description' => esc_html__('Upload Your Logo.', 'golftio'),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/images/logo/logo.png',
        'active_callback' => [
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'seconday_logo',
        'label'       => esc_html__('Header Secondary Logo', 'golftio'),
        'description' => esc_html__('Header Logo Secondary', 'golftio'),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/images/logo/logo2.png',
        'active_callback' => [
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ],
        ],
    ];

    return $fields;
}
add_filter('kirki/fields', '_header_header_fields');



/*
Header Settings color
 */
function _header_top_fields_color($fields)
{

    // menu
   
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_bg_color',
        'label'       => __('Header BG Color', 'golftio'),
        'description' => esc_html__('This is a Header BG Color control.', 'golftio'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_active_bg_color',
        'label'       => __('Header Active BG Color', 'golftio'),
        'description' => esc_html__('This is a Header Active BG Color control.', 'golftio'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'header_menu_typography',
        'label'       => esc_html__('Menu Typography', 'golftio'),
        'section'     => 'header_top_setting_color',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.header .nav__menu-items li a,.header .nav__menu-items li.dropdown>a::after',
            ],
        ],
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_color',
        'label'       => __('Menu Color', 'golftio'),
        'description' => esc_html__('This is a Menu color control.', 'golftio'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_color_hover',
        'label'       => __('Menu Hover Color', 'golftio'),
        'description' => esc_html__('This is a Menu color control.', 'golftio'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_color_drop',
        'label'       => __('Menu Dropdown BG Color', 'golftio'),
        'description' => esc_html__('This is a Menu color control.', 'golftio'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_drop_color',
        'label'       => __('Menu Dropdown Color', 'golftio'),
        'description' => esc_html__('This is a Menu color control.', 'golftio'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_drop_color_hover',
        'label'       => __('Menu Dropdown Hover Color', 'golftio'),
        'description' => esc_html__('This is a Menu color control.', 'golftio'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];


    // rightside


    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'menu_btn_typography',
        'label'       => esc_html__('Button Typography', 'golftio'),
        'section'     => 'header_top_setting_color',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
        ],
        'priority'    => 12,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.cmn-button',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'menu_menu_cart_color',
        'label'       => __('Menu Cart Color', 'golftio'),
        'description' => esc_html__('This is a Cart color control.', 'golftio'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 12,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'custom_menu_css_buttom',
        'label'       => __('Menu Button BG', 'golftio'),
        'description' => esc_html__('This is a Button bg color control.', 'golftio'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 12,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'custom_menu_css_buttom_border',
        'label'       => __('Menu Button Border', 'golftio'),
        'description' => esc_html__('This is a Button border color control.', 'golftio'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 12,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'custom_menu_css_buttom_color',
        'label'       => __('Menu Button Color', 'golftio'),
        'description' => esc_html__('This is a Button color control.', 'golftio'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 12,
    ];

    return $fields;
}
add_filter('kirki/fields', '_header_top_fields_color');


/*
_header_page_title_fields
 */
function _header_page_title_fields($fields)
{

    // Breadcrumb Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_switch',
        'label'    => esc_html__('Breadcrumb Hide', 'golftio'),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'golftio'),
            'off' => esc_html__('Disable', 'golftio'),
        ],
    ];


    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__('Breadcrumb Background Image', 'golftio'),
        'description' => esc_html__('Breadcrumb Background Image', 'golftio'),
        'section'     => 'breadcrumb_setting',
        'default'     => get_template_directory_uri() . '/assets/images/banner/breadcrumb.png',
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'breadcrumb_bg_color',
        'label'       => __('Breadcrumb BG Color', 'golftio'),
        'description' => esc_html__('This is a Breadcrumb bg color control.', 'golftio'),
        'section'     => 'breadcrumb_setting',
        'default'     => '#05441a',
        'priority'    => 10,
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    // Breadcrumb title Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_title_switch',
        'label'    => esc_html__('Breadcrumb Title Hide', 'golftio'),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'golftio'),
            'off' => esc_html__('Disable', 'golftio'),
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'breadcrumb_title_typography',
        'label'       => esc_html__('Breadcrumb Title Font', 'golftio'),
        'section'     => 'breadcrumb_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.banner--inner .banner--inner__content h2',
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_title_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    // Breadcrumb text Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_text_switch',
        'label'    => esc_html__('Breadcrumb Text Hide', 'golftio'),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'golftio'),
            'off' => esc_html__('Disable', 'golftio'),
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'breadcrumb_text_typography',
        'label'       => esc_html__('Breadcrumb Font', 'golftio'),
        'section'     => 'breadcrumb_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.banner--inner__breadcrumb span, .banner--inner__breadcrumb',
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_text_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];



    // $fields[] = [
    //     'type'     => 'switch',
    //     'settings' => 'breadcrumb_info_switch',
    //     'label'    => esc_html__('Breadcrumb Info switch', 'golftio'),
    //     'section'  => 'breadcrumb_setting',
    //     'default'  => '1',
    //     'priority' => 10,
    //     'choices'  => [
    //         'on'  => esc_html__('Enable', 'golftio'),
    //         'off' => esc_html__('Disable', 'golftio'),
    //     ],
    // ];

    return $fields;
}
add_filter('kirki/fields', '_header_page_title_fields');

/*
Header Social
 */
function _header_blog_fields($fields)
{
    // Blog Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'bentox_blog_btn_switch',
        'label'    => esc_html__('Blog BTN On/Off', 'golftio'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'golftio'),
            'off' => esc_html__('Disable', 'golftio'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'bentox_blog_cat',
        'label'    => esc_html__('Blog Category Meta On/Off', 'golftio'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'golftio'),
            'off' => esc_html__('Disable', 'golftio'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'bentox_blog_author',
        'label'    => esc_html__('Blog Author Meta On/Off', 'golftio'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'golftio'),
            'off' => esc_html__('Disable', 'golftio'),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'bentox_blog_date',
        'label'    => esc_html__('Blog Date Meta On/Off', 'golftio'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'golftio'),
            'off' => esc_html__('Disable', 'golftio'),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'bentox_blog_comments',
        'label'    => esc_html__('Blog Comments Meta On/Off', 'golftio'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'golftio'),
            'off' => esc_html__('Disable', 'golftio'),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'bentox_blog_btn',
        'label'    => esc_html__('Blog Button text', 'golftio'),
        'section'  => 'blog_setting',
        'default'  => esc_html__('Read More', 'golftio'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__('Blog Title', 'golftio'),
        'section'  => 'blog_setting',
        'default'  => esc_html__('Blog', 'golftio'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__('Blog Details Title', 'golftio'),
        'section'  => 'blog_setting',
        'default'  => esc_html__('Blog Details', 'golftio'),
        'priority' => 10,
    ];
    return $fields;
}
add_filter('kirki/fields', '_header_blog_fields');

/*
Footer
 */
function _header_footer_fields($fields)
{
    // Footer Setting
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__('Choose Footer Style', 'golftio'),
        'section'     => 'footer_setting',
        'default'     => '5',
        'placeholder' => esc_html__('Select an option...', 'golftio'),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'footer-style-1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
        ],
        'default'     => 'footer-style-1',
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'bentox_footer_bg_color',
        'label'       => __('Footer BG Color', 'golftio'),
        'description' => esc_html__('This is a Footer bg color control.', 'golftio'),
        'section'     => 'footer_setting',
        'default'     => '#05441A',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_shape_image',
        'label'    => esc_html__('Shape Image On/Off', 'golftio'),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'golftio'),
            'off' => esc_html__('Disable', 'golftio'),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'bentox_copyright',
        'label'    => esc_html__('Copy Right', 'golftio'),
        'section'  => 'footer_setting',
        'default'  => esc_html__('Copyright &copy; 2024 Bankio. All Rights Reserved', 'golftio'),
        'priority' => 10,
    ];
    return $fields;
}
add_filter('kirki/fields', '_header_footer_fields');

// color
function bentox_color_fields($fields)
{

    // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'primary_color_option',
        'label'       => __('Primary Color', 'golftio'),
        'description' => esc_html__('This is a Primary color control.', 'golftio'),
        'section'     => 'color_setting',
        'default'     => '#0e7a31',
        'priority'    => 10,
    ];
    // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'secondary_color_option',
        'label'       => __('Secondary Color', 'golftio'),
        'description' => esc_html__('This is a Secondary color control.', 'golftio'),
        'section'     => 'color_setting',
        'default'     => '#ffffff',
        'priority'    => 10,
    ];
    // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'tertiary_color_option',
        'label'       => __('Tertiary Color', 'golftio'),
        'description' => esc_html__('This is a Tertiary color control.', 'golftio'),
        'section'     => 'color_setting',
        'default'     => '#3f3f3f',
        'priority'    => 10,
    ];

    return $fields;
}
add_filter('kirki/fields', 'bentox_color_fields');

// 404
function bentox_404_fields($fields)
{
    // 404 settings
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'bentox_404_bg',
        'label'       => esc_html__('404 Image.', 'golftio'),
        'description' => esc_html__('404 Image.', 'golftio'),
        'section'     => '404_page',
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'bentox_error_title',
        'label'    => esc_html__('Not Found Title', 'golftio'),
        'section'  => '404_page',
        'default'  => esc_html__('Page not found', 'golftio'),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'bentox_error_desc',
        'label'    => esc_html__('404 Description Text', 'golftio'),
        'section'  => '404_page',
        'default'  => esc_html__('Oops! The page you are looking for does not exist. It might have been moved or deleted', 'golftio'),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'bentox_error_link_text',
        'label'    => esc_html__('404 Link Text', 'golftio'),
        'section'  => '404_page',
        'default'  => esc_html__('Back To Home', 'golftio'),
        'priority' => 10,
    ];
    return $fields;
}
add_filter('kirki/fields', 'bentox_404_fields');


/**
 * Added Fields
 */
function bentox_typo_fields($fields)
{
    // typography settings
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_body_setting',
        'label'       => esc_html__('Body Font', 'golftio'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'p',
            ],
        ],
    ];
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_link_setting',
        'label'       => esc_html__('Link', 'golftio'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'a',
            ],
        ],
    ];
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_span_setting',
        'label'       => esc_html__('Span', 'golftio'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'a',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h_setting',
        'label'       => esc_html__('Heading h1 Fonts', 'golftio'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h1',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h2_setting',
        'label'       => esc_html__('Heading h2 Fonts', 'golftio'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h2',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h3_setting',
        'label'       => esc_html__('Heading h3 Fonts', 'golftio'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h3',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h4_setting',
        'label'       => esc_html__('Heading h4 Fonts', 'golftio'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h4',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h5_setting',
        'label'       => esc_html__('Heading h5 Fonts', 'golftio'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h5',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h6_setting',
        'label'       => esc_html__('Heading h6 Fonts', 'golftio'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h6',
            ],
        ],
    ];
    return $fields;
}

add_filter('kirki/fields', 'bentox_typo_fields');




/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function bentox_THEME_option($name)
{
    $value = '';
    if (class_exists('golftio')) {
        $value = kirki::get_option(bentox_get_theme(), $name);
    }

    return apply_filters('bentox_THEME_option', $value, $name);
}

/**
 * Get config ID
 *
 * @return string
 */
function bentox_get_theme()
{
    return 'golftio';
}
