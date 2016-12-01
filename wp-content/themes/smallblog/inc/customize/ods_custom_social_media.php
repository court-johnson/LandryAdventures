<?php

namespace Ods\Customize\SocialMedia;

/**
 * Class odsSocialMedia
 * @since 1.0.0
 * @package Ods\Customize\SocialMedia
 */
class odsSocialMedia
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

        $wp_customize->add_section( 'ods_social', array(
            'title'       => __( 'Social Media (Links)', 'smallblog' ),
            'description' => __( 'Enter your social media links here. If the field is empty the button on footer will not be visible.', 'smallblog' ),
            'priority'    => 20,
            'panel'       => 'panel_theme'
        ) );


        // Facebook
        $wp_customize->add_setting( 'ods_facebook_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod',
        ) );


        $wp_customize->add_control( 'ods_fb', array(
            'label'    => 'Facebook',
            'section'  => 'ods_social',
            'settings' => 'ods_facebook_url'
        ) );


        // Twitter
        $wp_customize->add_setting( 'ods_twitter_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod'
        ) );


        $wp_customize->add_control( 'ods_twitter', array(
            'label'    => 'Twitter',
            'section'  => 'ods_social',
            'settings' => 'ods_twitter_url'
        ) );


        // Xing
        $wp_customize->add_setting( 'ods_xing_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod'
        ) );


        $wp_customize->add_control( 'ods_xing', array(
            'label'    => 'Xing',
            'section'  => 'ods_social',
            'settings' => 'ods_xing_url'
        ) );


        // Youtube
        $wp_customize->add_setting( 'ods_youtube_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod'
        ) );


        $wp_customize->add_control( 'ods_youtube', array(
            'label'    => 'Youtube',
            'section'  => 'ods_social',
            'settings' => 'ods_youtube_url'
        ) );


        // Google Plus
        $wp_customize->add_setting( 'ods_googleplus_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod'
        ) );


        $wp_customize->add_control( 'ods_googleplus', array(
            'label'    => 'Google Plus',
            'section'  => 'ods_social',
            'settings' => 'ods_googleplus_url'
        ) );


        // Instagram
        $wp_customize->add_setting( 'ods_instagram_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod'
        ) );


        $wp_customize->add_control( 'ods_instagram', array(
            'label'    => 'Instagram',
            'section'  => 'ods_social',
            'settings' => 'ods_instagram_url'
        ) );


        // Path
        $wp_customize->add_setting( 'ods_path_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod'
        ) );


        $wp_customize->add_control( 'ods_path', array(
            'label'    => 'Path',
            'section'  => 'ods_social',
            'settings' => 'ods_path_url'
        ) );


        // Pinterest
        $wp_customize->add_setting( 'ods_pinterest_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod'
        ) );


        $wp_customize->add_control( 'ods_pinterest', array(
            'label'    => 'Pinterest',
            'section'  => 'ods_social',
            'settings' => 'ods_pinterest_url'
        ) );


        // Linkedin
        $wp_customize->add_setting( 'ods_linkedin_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod'
        ) );


        $wp_customize->add_control( 'ods_linkedin', array(
            'label'    => 'Linkedin',
            'section'  => 'ods_social',
            'settings' => 'ods_linkedin_url',
        ) );

    }

}

$ods_social_media = new odsSocialMedia();
