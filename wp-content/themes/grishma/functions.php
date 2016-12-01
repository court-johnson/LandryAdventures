<?php
/**
 * grishma functions, scripts and styles.
 *
 * @package grishma
 * @since grishma 1.0
 */


if ( ! function_exists( 'grishma_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 * @since grishma 1.0
 */
function grishma_setup() {

	/* Add custom post styles */
	require( get_template_directory() . '/includes/editor/add-styles.php' );

	/* Add Customizer settings */
	require( get_template_directory() . '/customizer.php' );

	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );
    //add_theme_support( 'custom-header' );

	/* Add editor styles */
	add_editor_style();

	/* Enable support for Post Thumbnails */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // Default Thumb
    add_theme_support( "title-tag" );
    add_image_size( 'grishma-large-image', 9999, 9999, false  );// Large Post Image
	/* Custom Background Support */
	add_theme_support( 'custom-background' );

        $args = array(
            'width'         => 2000,
            'height'        => 250,
            'default-image' => get_template_directory_uri() . '/images/header-image.jpeg',
        );
        add_theme_support( 'custom-header', $args );


	/* Register Menu */
	register_nav_menus( array(
		'main' 		=> __( 'Main Menu', 'grishma' ),
		'secondary' => __( 'Secondary', 'grishma' ),
		'footer' 	=> __( 'Footer Menu', 'grishma' )
	) );

	/* Make theme available for translation */
	load_theme_textdomain( 'grishma', get_template_directory() . '/languages' );

	/* Add gallery format and custom gallery support */
	add_theme_support( 'post-formats', array( 'gallery' ) );
	add_theme_support( 'array_themes_gallery_support' );

	// Add support for legacy widgets
	add_theme_support( 'array_toolkit_legacy_widgets' );

}
endif; // grishma_setup
add_action( 'after_setup_theme', 'grishma_setup' );


/* Enqueue scripts and styles */
function grishma_scripts() {

	$version = wp_get_theme()->Version;

	//Main Stylesheet
	wp_enqueue_style( 'grishma-style', get_stylesheet_uri() );
    
	//Font Awesome
	wp_enqueue_style( 'grishma-fontawesome-css', get_template_directory_uri() . "/includes/fonts/fontawesome/font-awesome.min.css", array(), '4.0.3', 'screen' );
    //grid css
	wp_enqueue_style( 'grishma-grid-css', get_template_directory_uri() . "/includes/styles/babylongrid-default.css", array(), '4.0.3', 'screen' );

	//Flexslider CSS
	wp_enqueue_style( 'grishma-flexslider-css', get_template_directory_uri() . "/includes/js/flexslider/flexslider.css", array(), '2.2.0', 'screen' );

	//Fitvids
	wp_enqueue_script( 'grishma-fitvids-js', get_template_directory_uri() . '/includes/js/fitvid/jquery.fitvids.js', array( 'jquery' ), '1.0.3', true );
    
    //grid js
    wp_enqueue_script( 'grishma-grid-js', get_template_directory_uri() . '/includes/js/jquery.babylongrid.js', array( 'jquery' ), '1.0.3', true );
    
    //Custom Scripts
	wp_enqueue_script( 'grishma-custom-js', get_template_directory_uri() . '/includes/js/custom/custom.js', array( 'jquery' ), $version, true );
    
	//Flexslider
	wp_enqueue_script( 'grishma-flexslider-js', get_template_directory_uri() . '/includes/js/flexslider/jquery.flexslider.js', array( 'jquery' ), '2.2.0', true );

	//HTML5 IE Shiv
	wp_enqueue_script( 'grishma-htmlshiv-js', get_template_directory_uri() . '/includes/js/html5/html5shiv.js', array(), '3.7.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'grishma_scripts' );


/* Set the content width */
if ( ! isset( $content_width ) )
	$content_width = 690; /* pixels */


/* Register sidebars */
function grishma_register_sidebars() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'grishma' ),
		'id'            => 'sidebar',
		'description'   => __( 'Widgets in this area will be shown on the sidebar of all pages.', 'grishma' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar Single', 'grishma' ),
		'id'            => 'single-sidebar',
		'description'   => __( 'This widget area is for single blog page.', 'grishma' ),
		'before_widget' => '<div id="sidebar"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>'
	) );
}
add_action( 'widgets_init', 'grishma_register_sidebars' );



/* If excerpt slider is enabled, ignore sticky posts since we feature them in the slider */
function grishma_ignore_sticky( $query ) {
	if ( is_home() && $query->is_main_query() && get_option( 'grishma_customizer_slider_disable') == 'enable' )
        $query->set('ignore_sticky_posts', true);
}
add_action( 'pre_get_posts', 'grishma_ignore_sticky' );

/* Custom Comment Output */
function grishma_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">

		<div class="comment-block" id="comment-<?php comment_ID(); ?>">
			<div class="comment-info">
				<div class="comment-grishma vcard clearfix">
					<?php echo get_avatar( $comment->comment_grishma_email, 75 ); ?>

					<div class="comment-meta commentmetadata">
						<?php printf(__('<cite class="fn">%s</cite>', 'grishma'), get_comment_author_link()) ?>
					</div>
				</div>
			</div><!-- comment info -->

			<div class="comment-text">
				<?php comment_text() ?>

				<div class="comment-bottom">
					<p class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
					</p>
					<?php edit_comment_link(__('Edit', 'grishma'),' ', '' ) ?>
					<a class="comment-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'grishma'), get_comment_date(),  get_comment_time()) ?></a>
				</div>
			</div><!-- comment text -->

			<?php if ($comment->comment_approved == '0') : ?>
				<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'grishma') ?></em>
			<?php endif; ?>
		</div>
<?php
}

function grishma_cancel_comment_reply_button( $html, $link, $text ) {
    $style = isset($_GET['replytocom']) ? '' : ' style="display:none;"';
    $button = '<div id="cancel-comment-reply-link"' . $style . '>';
    return $button . '<i class="fa fa-times"></i> </div>';
}

add_action( 'cancel_comment_reply_link', 'grishma_cancel_comment_reply_button', 10, 3 );


/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function grishma_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'grishma' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'grishma_wp_title', 10, 2 );


/**
 * Sets the grishmadata global when viewing an author archive.
 *
 * It removes the need to call the_post() and rewind_posts() in an grishma
 * template to print information about the grishma.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function grishma_setup_grishma() {
	global $wp_query;

	if ( $wp_query->is_grishma() && isset( $wp_query->post ) ) {
		$GLOBALS['grishmadata'] = get_userdata( $wp_query->post->post_grishma );
	}
}
add_action( 'wp', 'grishma_setup_grishma' );


/**
 * Return the Google font stylesheet URL
 */
function grishma_fonts_url() {

	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Roboto, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$roboto = _x( 'on', 'Roboto font: on or off', 'grishma' );

	if ( 'off' !== $roboto ) {

		$query_args = array(
			'family' => urlencode( 'Roboto:300,400' ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}



function wpb_author_info_box( $content ) {

global $post;

// Detect if it is a single post with a post author
if ( is_single() && isset( $post->post_author ) ) {

// Get author's display name 
$display_name = get_the_author_meta( 'display_name', $post->post_author );

// If display name is not available then use nickname as display name
if ( empty( $display_name ) )
$display_name = get_the_author_meta( 'nickname', $post->post_author );

// Get author's biographical information or description
$user_description = get_the_author_meta( 'user_description', $post->post_author );

// Get author's website URL 
$user_website = get_the_author_meta('url', $post->post_author);

// Get link to the grishma archive page
$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
 
if ( ! empty( $display_name ) )

$author_details = '<p class="grishma_name">About <a href="'. $user_posts .'">' . $display_name . '</a></p>';

if ( ! empty( $user_description ) )
// author avatar and bio

$author_details .= '<p class="grishma_details">' . get_avatar( get_the_author_meta('user_email') , 90 ) . nl2br( $user_description ). '</p>';

$author_details .= '<p class="grishma_links"><a href="'. $user_posts .'">View all posts by ' . $display_name . '</a>';  

// Check if  author has a website in their profile
if ( ! empty( $user_website ) ) {

// Display author website link
$author_details .= ' | <a href="' . $user_website .'" target="_blank" rel="nofollow">Website</a></p>';

} else { 
// if there is no author website then just close the paragraph
$author_details .= '</p>';
}

// Pass all this info to post content  
$content = $content . '<footer class="grishma_bio_section" >' . $author_details . '</footer>';
}
echo $content;
}

// Add our function to the post content filter 
add_action( 'grishma_authorbox', 'wpb_author_info_box' );


