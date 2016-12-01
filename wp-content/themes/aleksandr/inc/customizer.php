<?php
/**
 * Aleksandr Theme Customizer.
 *
 * @package Aleksandr
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function aleksandr_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->remove_section( 'background_image' );





	/**
	* Options section
	*/
	$wp_customize->add_section( 'aleksandr-options', 
		array(
			'title' => __( 'Theme options', 'aleksandr' ),
			'capability' => 'edit_theme_options',
			'description' => __( 'Change the default theme options', 'aleksandr' )

		)
	);


	/**
	* Header background color
	*/
	$wp_customize->add_setting( 'header_color', 
		array(
			'default' => '#18baaf',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_color',
				array(
					'label' => __( 'Header background color', 'aleksandr' ),
					'section' => 'aleksandr-options'
				)
		)
	);

	$wp_customize->get_control( 'header_textcolor' )->section   = 'aleksandr-options';

	/**
	* Main color
	*/
	$wp_customize->add_setting( 'main_color',
		array(
			'default' => '#18baaf',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_color',
				array(
					'label' => __( 'Main color used throughout the site', 'aleksandr' ),
					'section' => 'aleksandr-options'
				)
		)
	);


	/**
	* Sidebar layout
	*/
	$wp_customize->add_setting( 'layout_setting',
		array(
			'default' => 'sidebar-right',
			'type' => 'theme_mod',
			'sanitize_callback' => 'aleksandr_sanitize_layout',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'layout_control', 
		array(
			'settings' => 'layout_setting',
			'type' => 'radio',
			'label' => __( 'Sidebar positioning', 'aleksandr' ),
			'choices' => array(
				'sidebar-right' => __( 'Right sidebar', 'aleksandr' ),
				'sidebar-left' => __( 'Left sidebar', 'aleksandr' ),
				'sidebar-none' => __( 'No sidebar', 'aleksandr' )
			),
			'section' => 'aleksandr-options'
		)
	);


	/**
	* Continue reading option
	*/
	$wp_customize->add_setting( 'continue_reading_setting', 
		array(
			'default' => 'continue-reading',
			'type' => 'theme_mod',
			'transport' => 'refresh',
			'sanitize_callback' => 'aleksandr_sanitize_continue_reading'
		)
	);

	$wp_customize->add_control( 'continue_reading_control', 
		array(
			'settings' => 'continue_reading_setting',
			'type' => 'radio',
			'label' => __( 'Post layout on front page', 'aleksandr' ),
			'choices' => array(
				'continue-reading' => __( 'Continue reading button', 'aleksandr' ),
				'full-post' => __( 'Full posts', 'aleksandr' )
			),
			'section' => 'aleksandr-options'
		)
	);

	/**
	* Post author
	*/
	$wp_customize->add_setting( 'show_author',
		array(
			'default' => 'hide',
			'type' => 'theme_mod',
			'transport' => 'refresh',
			'sanitize_callback' => 'aleksandr_sanitize_show_author'
		)
	);

	$wp_customize->add_control( 'show_author',
		array(
			'type' => 'radio',
			'label' => __( 'Display author name', 'aleksandr' ),
			'choices' => array(
				'show' => __( 'Yes', 'aleksandr' ),
				'hide' => __( 'No', 'aleksandr' )
			),
			'section' => 'aleksandr-options'
		)
	);

	/**
	* Widget title style
	*/
	$wp_customize->add_setting( 'sidebar_title_style', 
		array(
			'default' => 'border_bottom',
			'type' => 'theme_mod',
			'transport' => 'postMessage',
			'sanitize_callback' => 'aleksandr_sanitize_sidebar_title'
		)
	);

	$wp_customize->add_control( 'sidebar_title_style', 
		array(
			'type' => 'radio',
			'label' => __( 'Widget title styling', 'aleksandr' ),
			'choices' => array(
				'boxed' => __( 'Boxed', 'aleksandr' ),
				'border_bottom' => __( 'Border bottom', 'aleksandr' ),
				'simple' => __( 'Simple', 'aleksandr' )
			),
			'section' => 'aleksandr-options'
		)
	);

	/**
	* Footer options
	*/
	$wp_customize->add_setting( 'footer_text_setting',
		array(
			'default' => 'Aleksandr',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field', 
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'footer_text_control',
		array(
			'settings' => 'footer_text_setting',
			'type' => 'text',
			'label' => __( 'Footer text', 'aleksandr' ),
			'section' => 'aleksandr-options'
		)
	);

	$wp_customize->add_setting( 'footer_link_setting',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control( 'footer_link_control',
		array(
			'settings' => 'footer_link_setting',
			'type' => 'text',
			'label' => __( 'Footer link', 'aleksandr' ),
			'section' => 'aleksandr-options'
		)
	);


	/**
	* Soical media in nav
	*/
	$wp_customize->add_section( 'aleksandr-social-media', 
		array(
			'title' => __( 'Social media icons', 'aleksandr' ),
			'capability' => 'edit_theme_options',
			'description' => __( 'Social media icon settings', 'aleksandr' )

		)
	);

	$wp_customize->add_setting( 'social-hover',
		array(
			'default' => 'fade',
			'type' => 'theme_mod',
			'sanitize_callback' => 'aleksandr_sanitize_social_hover',
			'transport' => 'refresh'
		)
	);

	$wp_customize->add_control( 'social-hover',
		array(
			'type' => 'radio',
			'label' => __( 'Hover style', 'aleksandr' ),
			'choices' => array(
				'fade' => 'Fade',
				'none' => 'None'
			),
			'section' => 'aleksandr-social-media'
		)
	);

	$social_medias = array
		( 'facebook', 'instagram', 'twitter', 'pinterest', 'youtube', 'vimeo', 'behance', 'google-plus', 'github', 'codepen', 'linkedin', 'flickr', 'tumblr', 'weibo', 'vkontakte', 'soundcloud' );


	foreach( $social_medias as $media ) {

		$default = '';

		if ( $media == 'facebook' || $media == 'instagram' || $media == 'youtube' ) { 
		 $default = $media;
		}



		$wp_customize->add_setting( $media . '-link', array(
		'default' => '',
		'type'    => 'theme_mod',
		'sanitize_callback' => 'esc_url',
		));
		$wp_customize->add_control( $media . '-link-control', array( 
			'settings' => $media . '-link',
			'type' => 'text',
			'label' => ucwords( str_replace( "-", " ", $media ) ),
			'section' => 'aleksandr-social-media',
		));
	}







}
add_action( 'customize_register', 'aleksandr_customize_register' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function aleksandr_customize_preview_js() {
	wp_enqueue_script( 'aleksandr_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'aleksandr_customize_preview_js' );

/*
* Sanitize layout settings
*/
function aleksandr_sanitize_layout( $value ) {
	if ( !in_array( $value, array( 'sidebar-left', 'sidebar-right', 'sidebar-none' ) ) ) {
		$value = 'sidebar-right';
	}

	return $value;
}

function aleksandr_sanitize_continue_reading( $value ) {
	if ( !in_array( $value, array( 'continue-reading', 'full-post' ) ) ) {
		$value = 'continue-reading';
	}

	return $value;
}

function aleksandr_sanitize_show_author( $value ) {
	if ( !in_array( $value, array( 'show', 'hide' ) ) ) {
		$value = 'hide';
	}

	return $value;
}

function aleksandr_sanitize_sidebar_title( $value ) {
	if ( !in_array( $value, array( 'boxed', 'border_bottom', 'simple' ) ) ) {
		$value = 'boxed';
	}

	return $value;
}

function aleksandr_sanitize_social_hover( $value ) {
	if ( !in_array( $value, array( 'fade', 'none' ) ) ) {
		$value = 'fade';
	}

	return $value;
}



/**
* Inject customizer CSS in header background
*/
function aleksandr_header_color_css() {
	$header_color = get_theme_mod('header_color');

	?>

	<style type="text/css">
		.site-header {
			background-color: <?php echo esc_html( $header_color ); ?>;
		}
	</style>

	<?php
}
add_action( 'wp_head', 'aleksandr_header_color_css' );

/**
* Inject custom color in the CSS
*/
function aleksandr_main_color_css() {
	$main_color = get_theme_mod('main_color', '#18baaf');

	?>

	<style type="text/css">

	blockquote::before,
	a,
	.read-more-button,
	input#submit,
	.paging-navigation .current,
	.paging-navigation .dots { 
		color: <?php echo esc_html( $main_color ); ?>; 
	}

	thead,
	.widget-area.boxed .widget-title,
	input#submit:hover,
	input#submit:focus,
	.hvr-sweep-to-top:before,
	.search-title {
		background: <?php echo esc_html( $main_color ); ?>;
	}

	a:hover,
	a:focus,
	a:active,
	.widget-area.border_bottom .widget-title {
		border-bottom: 3px solid <?php echo esc_html( $main_color ); ?>;
	}

	#wp-calendar thead,
	.paging-navigation .current {
		border-bottom: 2px solid <?php echo  esc_html( $main_color ); ?>;
	}

	#wp-calendar {
		border: 2px solid <?php echo  esc_html( $main_color ); ?>;
	}

	.read-more-button,
	input#submit {
		border: 1px solid <?php echo  esc_html( $main_color ); ?>;
	}

	.bypostauthor > div > .comment-wrapper {
		border-left: 6px solid <?php echo  esc_html( $main_color ); ?>;
	}

	</style>


	<?php
}
add_action( 'wp_head', 'aleksandr_main_color_css' );



