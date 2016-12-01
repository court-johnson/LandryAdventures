<?php

namespace Ods\Setup;

/**
 * Smallblog setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * Class odsSetup
 * @since 1.0.0
 * @package Ods\Setup
 */
class odsSetup
{


    /**
     * Added the construct.
     */
    public function __construct()
    {

        if ( !function_exists( $this->setup() ) ) add_action( 'after_setup_theme', array( $this, 'setup' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_filter( 'excerpt_more', array( $this, 'new_excerpt_more' ) );

    }


    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    public function setup()
    {


        /**
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on cosimo, use a find and replace
         * to change 'smallblog' to the name of your theme in all the template files
         */
        load_theme_textdomain( 'smallblog', get_template_directory() . '/languages' );


        /**
         * Add default posts and comments RSS feed links to head.
         */
        add_theme_support( 'automatic-feed-links' );


        /**
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );


        /**
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support( 'post-thumbnails' );


        /**
         * Register custom background.
         */
        add_theme_support( 'custom-background' );


        /**
         * This theme uses wp_nav_menu() in two location.
         */
        register_nav_menus(
            array(
                'primary'   => __( 'Header Menu', 'smallblog' ),
                'secondary' => __( 'Footer Menu', 'smallblog' )
            )
        );


        /**
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ) );


        /**
         * Enable support for Post Formats.
         */
        add_theme_support( 'post-formats', array(
            'video',
            'image',
            'gallery',
            'audio',
            'quote'
        ) );


        /**
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style( array( 'css/editor-style.min.css', $this->add_editor_font() ) );

    }


    /**
     * Enqueue scripts and styles.
     */
    public function enqueue_scripts()
    {

        /**
         * Add Roboto and Roboto Condensed font, used in the main stylesheet.
         */
        $ods_protocol = is_ssl() ? 'https' : 'http';
        wp_enqueue_style( 'font-roboto', $ods_protocol . '://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,100,100italic', array(), null );


        /**
         * Load our main stylesheet.
         */
        wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.min.css' );


        /**
         * Load our main javascript.
         */
        wp_enqueue_script( 'json2' );
        wp_enqueue_script( 'jquery' );
        if ( is_single() or is_page() ) wp_enqueue_script( 'validate', get_template_directory_uri() . '/js/lib/jquery.validate.min.js' );
        wp_enqueue_script( 'global', get_template_directory_uri() . '/js/global.js' );


        /**
         * Load script for the comments.
         */
        if ( is_singular() && comments_open() ) wp_enqueue_script( "comment-reply" );


        /**
         * Load our main localize script file.
         */
        include_once( 'ods_localize_script.php' );

    }


    /**
     * Styled MORE excerpt.
     * @param $more
     * @return string
     */
    public function new_excerpt_more()
    {
        return '&nbsp;' . get_theme_mod( 'ods_excerpt_more', '...' );
    }


    /**
     * Add editor font.
     * @return mixed
     */
    private function add_editor_font()
    {

        return str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,300,400|Roboto:500,400italic,300,500italic,300italic,400' );

    }

}

$ods_setup = new odsSetup();

/**
 * Defined width content
 */
if ( !isset( $content_width ) ) $content_width = 1200;

