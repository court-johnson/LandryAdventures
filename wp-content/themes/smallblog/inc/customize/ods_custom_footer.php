<?php

namespace Ods\Customize\Footer;

/**
 * Class odsCustomFooter
 * @since 1.0.0
 * @package Ods\Customize\Footer
 */
class odsCustomFooter
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

        $wp_customize->add_section( 'ods_footer', array(
            'title'       => __( 'Footer', 'smallblog' ),
            'priority'    => 50,
            'description' => '',
            'panel'       => 'panel_theme'
        ) );


        // Image upload.
        $wp_customize->add_setting( 'ods_footer_img_src', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod'
        ) );


        $wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'ods_footer_img_src', array(
            'label'    => __( 'Image', 'smallblog' ),
            'section'  => 'ods_footer',
            'settings' => 'ods_footer_img_src'
        ) ) );


        // Content text.
        $wp_customize->add_setting( 'ods_footer_text', array(
            'default'           => 'Per lor maledizione si non si perde, che non possa tornar, l`etterno amore, mentre che la speranza ha fior del verde.',
            'sanitize_callback' => 'esc_textarea',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod'
        ) );


        $wp_customize->add_control( 'ods_footer_text', array(
            'label'    => __( 'Content', 'smallblog' ),
            'section'  => 'ods_footer',
            'settings' => 'ods_footer_text',
            'type'     => 'textarea'
        ) );

    }

}

$ods_custom_footer = new odsCustomFooter();

