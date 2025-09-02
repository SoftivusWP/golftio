<?php

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bentox
 */

$footer_bg_img = get_theme_mod('bentox_footer_bg');
$bentox_footer_logo = get_theme_mod('bentox_footer_logo');
$bentox_footer_top_space = function_exists('get_field') ? get_field('bentox_footer_top_space') : '0';
$bentox_copyright_center = $bentox_footer_logo ? 'col-lg-4 offset-lg-4 col-md-6 text-right' : 'col-lg-12 text-center';
$bentox_footer_bg_url_from_page = function_exists('get_field') ? get_field('bentox_footer_bg') : '';
$bentox_footer_bg_color_from_page = function_exists('get_field') ? get_field('bentox_footer_bg_color') : '';
$footer_bg_color = get_theme_mod('bentox_footer_bg_color');

// bg image
$bg_img = !empty($bentox_footer_bg_url_from_page['url']) ? $bentox_footer_bg_url_from_page['url'] : $footer_bg_img;

// bg color
$bg_color = !empty($bentox_footer_bg_color_from_page) ? $bentox_footer_bg_color_from_page : $footer_bg_color;



// footer_columns
$footer_columns = 0;
$footer_widgets = get_theme_mod('footer_widget_number', 5);

for ($num = 1; $num <= $footer_widgets; $num++) {
    if (is_active_sidebar('footer-' . $num)) {
        $footer_columns++;
    }
}

switch ($footer_columns) {
    case '1':
        $footer_class[1] = 'col-lg-12';
        break;
    case '2':
        $footer_class[1] = 'col-lg-6 col-md-6';
        $footer_class[2] = 'col-lg-6 col-md-6';
        break;
    case '3':
        $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
        $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
        $footer_class[3] = 'col-xl-4 col-lg-6';
        break;
    case '4':
        $footer_class[1] = 'col-md-6 col-lg-4 col-xl-3 section__col';
        $footer_class[2] = 'col-md-6 col-lg-2 col-xl-3 section__col';
        $footer_class[3] = 'col-md-6 col-lg-3 col-xl-3 section__col';
        $footer_class[4] = 'col-md-6 col-lg-3 col-xl-3 section__col';
        break;
    case '5':
        $footer_class[1] = 'col-xl-3 col-lg-3 col-md-4 col-6';
        $footer_class[2] = 'col-xl-2 col-lg-2 col-6';
        $footer_class[3] = 'col-xl-2 col-lg-2 col-6';
        $footer_class[4] = 'col-xl-2 col-lg-2 col-6';
        $footer_class[5] = 'col-xl-3 col-8';
        break;
    default:
        $footer_class = 'col-xl-3 col-lg-3 col-md-6';
        break;
}






?>

    <!-- footer area start -->

    <?php
    $style_attributes = '';

    if (isset($bg_color)) {
        $style_attributes .= 'background-color: ' . esc_attr($bg_color) . '; ';
    }


    ?>

    <footer style="<?php echo esc_attr($style_attributes); ?>" class="footer">
        <div class="container">
        <?php if (is_active_sidebar('footer-1') or is_active_sidebar('footer-2') or is_active_sidebar('footer-3') or is_active_sidebar('footer-4') or is_active_sidebar('footer-5')) : ?>
            <div class="row section__row section-footer">
           
                <?php
                if ($footer_columns < 4) {
                    print '<div class="col-md-6 col-lg-4 col-xl-3 section__col">';
                    dynamic_sidebar('footer-1');
                    print '</div>';

                    print '<div class="col-md-6 col-lg-2 col-xl-3 section__col">';
                    dynamic_sidebar('footer-2');
                    print '</div>';

                    print '<div class="col-md-6 col-lg-3 col-xl-3 section__col">';
                    dynamic_sidebar('footer-3');
                    print '</div>';

                    print '<div class="col-md-6 col-lg-3 col-xl-3 section__col">';
                    dynamic_sidebar('footer-4');
                    print '</div>';

                } else {
                    for ($num = 1; $num <= $footer_columns; $num++) {
                        if (!is_active_sidebar('footer-' . $num)) {
                            continue;
                        }
                        print '<div class="' . esc_attr($footer_class[$num]) . '">';
                        dynamic_sidebar('footer-' . $num);
                        print '</div>';
                    }
                }
                ?>
               
            </div>
        <?php endif;?>
            <hr>




            <div class="row">
                <div class="col-12">
                    <div class="copyright copyright_link">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <p><?php print bentox_copyright_text(); ?> </p>
                            </div>
                            <div class="col-lg-6">
                                <?php bentox_footer_menu() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>
    </footer>