<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Aleksandr
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h4 class="page-title search-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'aleksandr' ); ?></h4>
				</header><!-- .page-header -->

				<div class="page-content">
					<p class="text-404">
						<?php esc_html_e( 'This is what you would call a 404.', 'aleksandr' ); ?><br/>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><b><?php esc_html_e( ' Click here ', 'aleksandr' ); ?></b></a>
						<?php esc_html_e( 'to head back to the homepage.', 'aleksandr' ); ?>
					</p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
