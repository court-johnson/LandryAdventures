<?php

function one_blog_theme_supports(){
	register_nav_menu('header-menu',__('Header Menu','one-blog'));
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "title-tag" );
	$custom_back_args = array(
	'default-color' => 'FFFFFF',
	);
	add_theme_support( 'custom-background', $custom_back_args );
	add_image_size('one_blog_image',790,435,true);
	load_theme_textdomain( 'one-blog', get_template_directory().'/language' );
}

add_action('after_setup_theme','one_blog_theme_supports');

if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

function one_blog_add_editor_styles() {
    add_editor_style( 'css/editor-style.css' );
}

add_action( 'admin_init', 'one_blog_add_editor_styles' );


add_action('wp_enqueue_scripts', 'one_blog_theme_imports');
function one_blog_theme_imports(){

    wp_enqueue_style( 'one-blog-google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,500,700,900');
    wp_enqueue_style( 'flexslider', get_template_directory_uri().'/css/flexslider.css' );
    wp_enqueue_style( 'slicknav', get_template_directory_uri().'/css/slicknav.min.css' );
	wp_enqueue_style( 'one-blog-custom', get_stylesheet_uri(), 999 );
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ) );
	wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'one-blog-custom', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function one_blog_widgets_init() {
	register_sidebar( array(
		'name' => __('Primary Sidebar','one-blog'),
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget_box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="side_title">',
		'after_title' => '</h3>',	
	) );
	register_sidebar( array(
		'name' => __('Footer Col 1','one-blog'),
		'id' => 'footer-1',
		'before_widget' => '<div id="%1$s" class="widget_box footer_box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer_title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __('Footer Col 2','one-blog'),
		'id' => 'footer-2',
		'before_widget' => '<div id="%1$s" class="widget_box footer_box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer_title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __('Footer Col 3','one-blog'),
		'id' => 'footer-3',
		'before_widget' => '<div id="%1$s" class="widget_box footer_box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer_title">',
		'after_title' => '</h3>',
		'ignore_sticky_posts' => true
	) );
	
}
add_action( 'widgets_init', 'one_blog_widgets_init' );
function one_blog_post_meta_box() {
	add_meta_box(
			'one_blog_post_settings',
			__('Post Settings','one-blog'),
			'one_blog_post_meta_box_callback',
			'post'
		);
}
add_action( 'add_meta_boxes', 'one_blog_post_meta_box' );

function one_blog_post_meta_box_callback( $post ) {
	wp_nonce_field( 'one_blog_post_save_meta_box_data', 'one_blog_post_meta_box_nonce' );
	$show_in_slider = get_post_meta( $post->ID, 'one_blog_show_in_slider', true );

	echo '<p><label for="show_in_slider">'.__('Show in Slider','one-blog').': </label>';
	echo '<input type="checkbox" id="show_in_slider" name="show_in_slider" value="1" '.checked( $show_in_slider, '1', false ).' /></p>';
}

function one_blog_post_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['one_blog_post_meta_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['one_blog_post_meta_box_nonce'], 'one_blog_post_save_meta_box_data' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	if ( '1' === $_POST['show_in_slider'] ) {
        update_post_meta( $post_id, 'one_blog_show_in_slider', '1' );
	}
	else {
        delete_post_meta( $post_id, 'one_blog_show_in_slider' );
    }


}
add_action( 'save_post', 'one_blog_post_save_meta_box_data' );

function one_blog_customize_register($wp_customize){
    
    $wp_customize->add_section(
	'header_section',
	array( 
		'title' => __('Logo','one-blog'), 
		'capability' => 'edit_theme_options', 
		'description' =>  __('Allows you to edit your theme\'s layout.','one-blog')
	)
	);
	$wp_customize->add_setting('one_blog_logo', array(
	    'default' => get_template_directory_uri().'/images/logo.png',
	    'capability'  => 'edit_theme_options',
	    'type'	=> 'theme_mod',
	    'sanitize_callback' => 'one_blog_sanitize_url',
	));
	 
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo', array(
	    'label'    => __('Logo Image','one-blog'),
	    'section'  => 'header_section',
	    'settings' => 'one_blog_logo',
	)));
	$wp_customize->add_section(
	'slider_section', 
	array( 
		'title' =>  __('Slider','one-blog'), 
		'capability' => 'edit_theme_options', 
		'description' =>  __('Allows you to set your slider','one-blog')
	)
);
	$wp_customize->add_setting('one_blog_slider', array(
    'capability' => 'edit_theme_options',
    'type'       => 'theme_mod',
    'default'       => '1',
    'sanitize_callback' => 'one_blog_sanitize_html',
	));
	 
	$wp_customize->add_control('one_blog_slider', array(
	    'settings' => 'one_blog_slider',
	    'label'    => __('Show Slider','one-blog'),
	    'section'  => 'slider_section',
	    'type'     => 'checkbox', 
	));
	$wp_customize->add_section(
	'sm_section', 
	array( 
		'title' =>  __('Social Media','one-blog'), 
		'capability' => 'edit_theme_options', 
		'description' =>  __('Allows you to set your social media URLs','one-blog')
	)
);
	$socials = array('twitter','facebook','google-plus','instagram','pinterest','vimeo','youtube','linkedin');
	for($i=0;$i<count($socials);$i++){
		$name = str_replace('-',' ',ucfirst($socials[$i]));
		$wp_customize->add_setting('one_blog_'.$socials[$i].'_url', array(
	    'capability' => 'edit_theme_options',
	    'type'       => 'theme_mod',
	    'sanitize_callback' => 'one_blog_sanitize_url',
		));
		 
		$wp_customize->add_control('one_blog_'.$socials[$i].'_url', array(
		    'settings' => 'one_blog_'.$socials[$i].'_url',
		    'label'    => $name.' '.__('URL','one-blog'),
		    'section'  => 'sm_section',
		    'type'     => 'text', 
		));
	}
	$wp_customize->add_section(
	'footer_section', 
	array( 
		'title' =>  __('Footer','one-blog'), 
		'capability' => 'edit_theme_options', 
		'description' =>  __('Allows you to set your footer settings','one-blog')
	)
);
	$wp_customize->add_setting('one_blog_copyright', array(
    'capability' => 'edit_theme_options',
    'type'       => 'theme_mod',
    'sanitize_callback' => 'one_blog_sanitize_html',
	));
	 
	$wp_customize->add_control('one_blog_copyright', array(
	    'settings' => 'one_blog_copyright',
	    'label'    => __('Copyright Text','one-blog'),
	    'section'  => 'footer_section',
	    'type'     => 'textarea', 
	));
 
}

add_action('customize_register', 'one_blog_customize_register');

function one_blog($name, $default = false) {
	return get_theme_mod( $name, $default );
}

function one_blog_sanitize_html($value){
	return wp_filter_post_kses($value);
}

function one_blog_sanitize_url($value) {
	return esc_url_raw($value);
}