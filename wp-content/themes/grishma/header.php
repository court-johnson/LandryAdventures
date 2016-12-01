    <?php
    /**
     *
     * Displays all of the <head> section and everything before <div id="content-wrap">
     *
     * @package grishma
     * @since grishma 1.0
     */
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

        <div id="wrapper" class="clearfix">
            <?php do_action( 'grishma_header_before' ); ?>


                        <div class="top-bar-header">
                            <div class="menu-wrap">
                                 <?php if ( has_nav_menu( 'secondary' ) ) { ?>
                                <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'secondary-nav clearfix' ) ); ?>
                                <?php } ?>
                                <div class="social-links">

                                <div class="socials">

                                <?php if ( get_theme_mod( 'grishma_facebook' ) ) : ?>
                                    <a href="<?php echo esc_url( get_theme_mod( 'grishma_facebook' ) ); ?>" class="facebook" data-title="Facebook" target="_blank"><span class="font-icon-social-facebook"><i class="fa fa-lg fa-facebook"></i></span></a>                        		    
                                <?php endif;  ?>

                                    <?php if ( get_theme_mod( 'grishma_twitter' ) ) : ?>
                                    <a href="<?php echo esc_url( get_theme_mod( 'grishma_twitter' ) ); ?>" class="twitter" data-title="Twitter" target="_blank"><span class="font-icon-social-twitter"><i class="fa fa-lg fa-twitter"></i></span></a>  
                                <?php endif;  ?>

                                    <?php if ( get_theme_mod( 'grishma_googleplus' ) ) : ?>
                                    <a href="<?php echo esc_url( get_theme_mod( 'grishma_googleplus' ) ); ?>" class="pinterest" data-title="Pinterest" target="_blank"><span class="font-icon-social-googleplus"><i class="fa fa-lg fa-google-plus"></i></span></a>                 

                                <?php endif;  ?>

                                    <?php if ( get_theme_mod( 'grishma_pinterest' ) ) : ?>
                                    <a href="<?php echo esc_url( get_theme_mod( 'grishma_pinterest' ) ); ?>" class="pinterest" data-title="Pinterest" target="_blank"><span class="font-icon-social-pinterest"><i class="fa fa-lg fa-pinterest"></i></span></a>                 
                                    <?php endif;  ?>

                                    <?php if ( get_theme_mod( 'grishma_linkedin' ) ) : ?>
                                    <a href="<?php echo esc_url( get_theme_mod( 'grishma_linkedin' ) ); ?>" class="linkedin" data-title="Linkedin" target="_blank"><span class="font-icon-social-linkedin"><i class="fa fa-lg fa-linkedin"></i></span></a>
                                <?php endif;  ?>

                            </div>


                            </div>

                            </div>


                            <div class="clearfix"></div>
                        </div><!-- top bar -->



            <div id="main" class="clearfix">
                <div class="header-wrapper clearfix">
                    <div class="header-inside clearfix">




                        <div class="hearder-holder">
                <img alt="" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" class="header-image" height="<?php echo get_custom_header()->height; ?>" />
                            <div class="logo-default">
                                <div class="logo-text">

                                    <?php if ( get_theme_mod( 'grishma_customizer_logo' ) ) { ?>

                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img class="logo" src="<?php echo esc_url( get_theme_mod( 'grishma_customizer_logo' ) );?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a><!-- load the logo -->
                         <?php } else { ?>       
                                    <!-- otherwise show the site title and description -->
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a>
                                    <span><?php bloginfo( 'description' ) ?></span>

                                    <?php } ?>
                                </div>

                            </div>

                        </div>

                        <?php if ( has_nav_menu( 'main' ) ) { ?>
                        <div class="top-bar">
                            <div class="menu-wrap">
                                <a class="menu-toggle" href="#"><i class="fa fa-bars"></i></a>
                                <?php wp_nav_menu( array( 'theme_location' => 'main', 'menu_class' => 'main-nav clearfix' ) ); ?>

                            </div>
                        </div><!-- top bar -->
                        <?php } ?>
                    </div><!-- header inside -->
                </div><!-- header wrapper -->

