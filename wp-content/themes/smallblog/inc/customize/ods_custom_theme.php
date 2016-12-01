<?php

namespace Ods\Customize\Theme;

/**
 * Class odsCustomTheme
 * @since 1.0.0
 * @package Ods\Customize\Theme
 */
class odsCustomTheme
{

    /**
     * Added the construct.
     */
    public function __construct()
    {

        add_action( 'customize_register', array( $this, 'add_customize' ) );

    }


    /**
     * Added the customize fields for the theme.
     * @param $wp_customize
     */
    public function add_customize( $wp_customize )
    {

        // Add panel theme.
        $wp_customize->add_panel( 'panel_theme', array(
            'priority'       => 155,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Theme options', 'smallblog' ),
            'description'    => ''
        ) );


        // Add section logo.
        $wp_customize->add_section( 'ods_logo', array(
            'title'    => __( 'Logo', 'smallblog' ),
            'priority' => 10,
            'panel'    => 'panel_theme'
        ) );


        // Image logo upload.
        $wp_customize->add_setting( 'ods_logo_src', array(
            'default'           => null,
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod'
        ) );


        $wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'src_logo', array(
            'section'  => 'ods_logo',
            'settings' => 'ods_logo_src'
        ) ) );


        // Add section copyright.
        $wp_customize->add_section( 'ods_copyright', array(
            'title'    => __( 'Copyright', 'smallblog' ),
            'priority' => 40,
            'panel'    => 'panel_theme'
        ) );


        // Copyright
        $wp_customize->add_setting( 'ods_copyright', array(
            'default'           => __( 'Created by Monkey Themes', 'smallblog' ),
            'sanitize_callback' => 'esc_textarea',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod'
        ) );


        $wp_customize->add_control( 'ods_copyright', array(
            'section'     => 'ods_copyright',
            'settings'    => 'ods_copyright',
            'description' => __( 'Space dedicated to copyright positioned in the page footer.', 'smallblog' ),
            'type'        => 'textarea'
        ) );

    }

}

$ods_custom_theme = new odsCustomTheme();


