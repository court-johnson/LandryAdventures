<?php

namespace Ods\Customize\CustomHeader;

/**
 * Class odsCustomHeader
 * @since 1.0.0
 * @package Ods\Customize\CustomHeader
 */
class odsCustomHeader
{

    /**
     * Added the construct.
     */
    public function __construct()
    {

        add_action( 'init', array( $this, 'custom_header' ) );

    }


    /**
     *
     */
    public function custom_header()
    {

        $args = array(
            'default-image'          => get_template_directory_uri() . '/images/custom-header/default.jpg',
            'width'                  => 1920,
            'height'                 => 620,
            'flex-height'            => true,
            'flex-width'             => true,
            'uploads'                => true,
            'random-default'         => false,
            'header-text'            => true,
            'default-text-color'     => '000',
            'wp-head-callback'       => '',
            'admin-head-callback'    => '',
            'admin-preview-callback' => '',
        );

        add_theme_support( 'custom-header', $args );

    }

}

$ods_custom_header = new odsCustomHeader();





