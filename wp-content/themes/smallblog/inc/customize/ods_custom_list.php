<?php

namespace Ods\Customize\CustomList;

/**
 * Class odsCustomList
 * @since 1.0.0
 * @package Ods\Customize\CustomList
 */
class odsCustomList
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


        $wp_customize->add_section( 'ods_section_customize_list', array(
            'title'    => __( 'Customize List ', 'smallblog' ),
            'priority' => 10,
            'panel'    => 'panel_theme'
        ) );


        // Add a short list.
        $wp_customize->add_setting( 'ods_minimize_list', array(
            'default'           => false,
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod'
        ) );


        $wp_customize->add_control( 'ods_minimize_list', array(
            'label'    => __( 'Minimizes the list to only the title and the basic information.', 'smallblog' ),
            'section'  => 'ods_section_customize_list',
            'settings' => 'ods_minimize_list',
            'type'     => 'checkbox'
        ) );


        // Excerpt more.
        $wp_customize->add_setting( 'ods_excerpt_more', array(
            'default'           => '...',
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod'
        ) );


        $wp_customize->add_control( 'ods_excerpt_more', array(
            'label'       => __( 'Ellipsis', 'smallblog' ),
            'section'     => 'ods_section_customize_list',
            'settings'    => 'ods_excerpt_more',
            'input_attrs' => array(
                'style' => 'width: 60px;'
            )
        ) );

    }

}

$ods_custom_list = new odsCustomList();

