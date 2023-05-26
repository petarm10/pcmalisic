<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pcmalisic
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <script src="https://kit.fontawesome.com/7a54613852.js" crossorigin="anonymous"></script>

    <?php wp_head(); ?>
</head>

    <header>
        <nav id="nav">
            <ul class="nav">
                <li class="logo">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/dist/images/logo-regina.svg" class="main-logo" alt="Villa Regina">
                    </a>
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/dist/images/logo-regina.svg" class="main-logo-icon" alt="Villa Regina">
                    </a>
                </li>

                <li class="mobile-menu">
                    <input id="btn-1" type="checkbox" />
                    <label for="btn-1">
                        <span class="hamburger">
                            <span class="line-1"></span>
                            <span class="line-2"></span>
                            <span class="line-3"></span>
                            <span class="cross"></span>
                        </span>
                    </label>
                    <ul class="mobile-menu-items">
                    <?php
                    if (has_nav_menu('primary')) :
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'primary',
                                'menu_id'         => 'primary-menu',
                                'menu_class'      => 'mobile-menu-items-class',
                                'container_class' => 'mobile-menu-items',
                                'walker'          => new Mild\Core\WalkerNav(),
                            )
                        );
                    endif;
                    ?>

                        <a href="" class="featured-product">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/dist/images/07.jpg" alt="Cor Net Feed Aggregator">
                            <h2 class="featured-product-title">See Our<br>Events</h2>
                        </a>
                        <div class="social-links-mobile">
                        
                        <a href="#" class="light-link secondary" target="_blank">
                            <i class="fa fa-instagram"></i>
                        </a>
                        <a href="#" class="light-link secondary" target="_blank">
                            <i class="fa fa-facebook-square"></i>
                        </a>
                        <a href="#" class="light-link secondary" target="_blank">
                            <i class="fa fa-youtube"></i>
                        </a>
                    </div>
                    </ul>
                </li>

                <li class="menu">
                    <?php
                    if (has_nav_menu('primary')) :
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'primary',
                                'menu_id'         => 'primary-menu',
                                'menu_class'      => 'menu-items',
                                'container_class' => 'menu-items-container',
                                'walker'          => new Mild\Core\WalkerNav(),
                            )
                        );
                    endif;
                    ?>
                </li>
            </ul>
        </nav>
    </header>

<body <?php body_class(); ?>>
