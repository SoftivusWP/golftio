<?php

/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bentox
 */

// info
$bentox_btnone_switch = get_theme_mod('bentox_btnone_switch', false);
$bentox_btntwo_switch = get_theme_mod('bentox_btntwo_switch', false);
$bentox_cart_switch = get_theme_mod('bentox_cart_switch', false);



// contact button
$bentox_buttonone_text = get_theme_mod('bentox_btnone_text', __('Sign In', 'golftio'));
$bentox_buttontwo_text = get_theme_mod('bentox_btntwo_text', __('Sign Up', 'golftio'));
$bentox_buttonone_link = get_theme_mod('bentox_btnone_link', __('#', 'golftio'));
$bentox_buttontwo_link = get_theme_mod('bentox_btntwo_link', __('#', 'golftio'));



// header right
$bentox_header_right = get_theme_mod('bentox_header_right', false);
$bentox_menu_col = $bentox_header_right ? 'col-xxl-7 col-xl-7 col-lg-8 d-none d-lg-block' : 'col-xxl-10 col-xl-10 col-lg-9 d-none d-lg-block text-end';

?>

<!-- header area start -->

<?php
$bentox_preloader = get_theme_mod('bentox_preloader', false);
$bentox_backtotop = get_theme_mod('bentox_backtotop', false);


?>

<?php if (!empty($bentox_preloader)) : ?>
   <!-- pre loader area start -->
   <div id="preloader">
      <div id="ctn-preloader" class="ctn-preloader">
         <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
               <span data-text-preloader="L" class="letters-loading">
                  L
               </span>

               <span data-text-preloader="O" class="letters-loading">
                  O
               </span>

               <span data-text-preloader="A" class="letters-loading">
                  A
               </span>

               <span data-text-preloader="D" class="letters-loading">
                  D
               </span>

               <span data-text-preloader="I" class="letters-loading">
                  I
               </span>

               <span data-text-preloader="N" class="letters-loading">
                  N
               </span>

               <span data-text-preloader="G" class="letters-loading">
                  G
               </span>
            </div>
         </div>
         <div class="loader-section section-left"></div>
         <div class="loader-section section-right"></div>
      </div>
   </div>
   <!-- pre loader area end -->
<?php endif; ?>

<?php if (!empty($bentox_backtotop)) : ?>
   <!-- back to top start -->
   <!-- scroll to top -->
   <div class="progress-wrap">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
         <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
   </div>
   <!-- back to top end -->
<?php endif; ?>

<header class="header header--secondary">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <nav class="nav">
               <div class="nav__content">
                  <div class="nav__logo">
                     <a href="index.html">
                        <?php bentox_header_logo(); ?>
                     </a>
                  </div>
                  <div class="nav__menu">
                     <div class="nav__menu-logo d-flex d-xl-none">
                        <a href="index.html" class="text-center hide-nav">
                           <?php bentox_header_logo(); ?>
                        </a>
                        <a href="javascript:void(0)" class="nav__menu-close">
                           <i class="fa-solid fa-xmark"></i>
                        </a>
                     </div>




                     <?php bentox_header_menu(); ?>

                     <li class="nav__menu-item d-flex flex-column  d-md-none mt-4">

                        <?php if (!empty($bentox_btnone_switch)) : ?>
                           <a href="<?php echo esc_url($bentox_buttonone_link) ?>" class="cmn-button cmn-button--secondary"><?php echo esc_html($bentox_buttonone_text) ?></a>
                        <?php endif; ?>



                        <?php if (!empty($bentox_btntwo_switch)) : ?>

                           <a href="<?php echo esc_url($bentox_buttontwo_link) ?>" class="cmn-button"><?php echo esc_html($bentox_buttontwo_text) ?></a>

                        <?php endif; ?>
                     </li>
                     <div class="social">
                        <a href="#">
                              <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#">
                              <i class="fa-brands fa-twitter"></i>
                        </a>
                        <a href="#">
                              <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a href="#">
                              <i class="fa-brands fa-square-instagram"></i>
                        </a>
                     </div>

                  </div>
                  
                  

                  <?php if (!empty($bentox_cart_switch) || !empty($bentox_btnone_switch) || !empty($bentox_btntwo_switch)) : ?>
                     <div class="nav__uncollapsed">
                        <?php if (!empty($bentox_cart_switch)) : ?>
                           <?php
                              // Check if WooCommerce is active
                              if (class_exists('WooCommerce')) :
                           ?>
                              <a href="<?php echo wc_get_cart_url(); ?>" class="cart">
                                 <i class="golftio-cart"></i>
                              </a>
                           <?php endif; ?>
                        <?php endif; ?>

                        <div class="nav__uncollapsed-item d-none d-md-flex">
                           <?php if (!empty($bentox_btnone_switch)) : ?>
                              <a href="<?php echo esc_url($bentox_buttonone_link) ?>" class="cmn-button cmn-button--secondary"><?php echo esc_html($bentox_buttonone_text) ?></a>
                           <?php endif; ?>

                           <?php if (!empty($bentox_btntwo_switch)) : ?>
                              <a href="<?php echo esc_url($bentox_buttontwo_link) ?>" class="cmn-button"><?php echo esc_html($bentox_buttontwo_text) ?></a>
                           <?php endif; ?>
                        </div>
                     </div>
                  <?php else : ?>
                     <style>
                        .nav__uncollapsed {
                           display: none;
                        }
                     </style>
                  <?php endif; ?>
                  <button class="nav__bar d-block d-xl-none">
                     <span class="icon-bar top-bar"></span>
                     <span class="icon-bar middle-bar"></span>
                     <span class="icon-bar bottom-bar"></span>
                  </button>
               </div>
            </nav>
         </div>
      </div>
   </div>
   <div class="backdrop"></div>
</header>




<!-- header area end -->