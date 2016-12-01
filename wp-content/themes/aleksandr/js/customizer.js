/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Footer text.
	wp.customize( 'footer_text_setting', function( value ) {
		value.bind( function( to ) {
			$( '.footer-link' ).text( to );
		} );
	} );


	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Header background color
	wp.customize( 'header_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-header' ).css( {
				'background-color': to
			});
		} );
	} );

	// Main color color
	wp.customize( 'main_color', function( value ) {
		value.bind( function( to ) {
			$( '<style>blockquote::before{ color:'+to+'; }a:hover, a:focus, a:active, .widget-area.border_bottom .widget-title { border-bottom: 3px solid '+to+'; }input#submit:hover, input#submit:focus, .hvr-sweep-to-top:before, .widget-area.boxed .widget-title{ background: '+to+'; ?>; }.hvr-sweep-to-top:hover, .hvr-sweep-to-top:focus, .hvr-sweep-to-top:active {color: #fff !important; }</style>').appendTo('head');
			$( 'a, .read-more-button, #input-submit, .pagining-navigation .current, .paging-navigation .dots' ).not( 'h2.entry-title a, h1.site-title a, li.menu-item a').css({ 'color': to });
			$( 'thead, .search-title' ).css({ 'background': to });
			$( '#wp-calendar thead, .paging-navigation .current' ).css({ 'border-bottom': '2px solid ' + to });
			$( '#wp-calendar' ).css({ 'border': '2px solid ' + to });
			$( '.read-more-button, #input-submit' ).css({ 'border': '1px solid ' + to });
			$( '.bypostauthor > div > .comment-wrapper' ).css({ 'border-left': '6px solid ' + to });
			$( 'a.no-border' ).css({ 'color': '#fff' });
		
		} );
	} );

	// Sidebar options
	wp.customize( 'layout_setting', function( value ) {
		value.bind( function( to ) {
			$( '#page' ).removeClass( 'sidebar-right sidebar-left sidebar-none' );
			$( '#page' ).addClass( to );
			console.log( to );
			if ( to == 'sidebar-none' ) {
				$('.sidebar-none .widget-area').masonry({
				// options
					itemSelector: '.widget',
					columnWidth: '.widget'
				});
			} else {
				$('.widget-area').masonry('destroy');
			}
		});
	});

	// Sidebar title
	wp.customize( 'sidebar_title_style', function( value ) {
		value.bind( function( to ) {

			$( '#secondary' ).removeClass	( 'boxed border_bottom simple' );
			$( '#secondary' ).addClass( to );


		});
	});

} )( jQuery );
