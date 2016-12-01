<?php

namespace Ods\Register\Widgets;

/**
 * Class odsWidgets
 * @since 1.0.0
 * @package Ods\Register\Widgets
 */
class odsWidgets
{

    /**
     * Added the construct.
     */
    public function __construct()
    {

        add_action( 'widgets_init', array( $this, 'widgets_init' ) );

    }


    /**
     * Registers the sidebars.
     * Use the register_sidebar function of wordpress.
     */
    public function widgets_init()
    {

        register_sidebar( array(
            'name'          => __( 'Sidebar', 'smallblog' ),
            'id'            => 'sidebar-1',
            'description'   => __( 'These widgets appear on the sidebar of the categories, archive, author list articles.', 'smallblog' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

    }

}

$ods_widgets = new odsWidgets();

