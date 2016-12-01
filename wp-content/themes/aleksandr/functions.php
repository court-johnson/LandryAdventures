<?php
/**
 * Aleksandr functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Aleksandr
 */

if ( ! function_exists( 'aleksandr_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function aleksandr_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Aleksandr, use a find and replace
	 * to change 'aleksandr' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'aleksandr', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'aleksandr' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


}
endif;
add_action( 'after_setup_theme', 'aleksandr_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aleksandr_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'aleksandr_content_width', 640 );
}
add_action( 'after_setup_theme', 'aleksandr_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aleksandr_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'aleksandr' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'aleksandr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function aleksandr_scripts() {
	wp_enqueue_style( 'aleksandr-style', get_stylesheet_uri() );

	wp_enqueue_script( 'aleksandr-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'aleksandr-custom-js', get_template_directory_uri() . '/js/custom-js.js', array( 'jquery' ), '20160201', true );

	wp_localize_script( 'aleksandr-navigation', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'aleksandr' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'aleksandr' ) . '</span>',
	) );

	wp_enqueue_script( 'aleksandr-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//Adding Font Awesome
	wp_enqueue_style( 'aleksandr-fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3' );

	//Adding google fonts. Unica One & Quattrocento
	wp_enqueue_style( 'aleksandr-google-fonts', 'https://fonts.googleapis.com/css?family=Unica+One|Quattrocento:400,700);');

	//Masonry for cascading grid with no sidebar
	wp_enqueue_script( 'jquery-masonry');

}
add_action( 'wp_enqueue_scripts', 'aleksandr_scripts' );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function aleksandr_excerpt_more( $more ) {
    return ' ...';
}
add_filter( 'excerpt_more', 'aleksandr_excerpt_more' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
* The comments styling function
*/
require get_template_directory() . '/inc/comments.php';
