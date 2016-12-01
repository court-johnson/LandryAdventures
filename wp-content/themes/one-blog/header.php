<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header id="head">
		<div class="head-fixed">
			<div class="head-top">	
				<div class="container">
					<div class="head-nav">
						<?php wp_nav_menu(array('theme_location' => 'header-menu')); ?>
					</div>
					<div class="head-socials">
						<ul>
							<?php
								$socials = array('twitter','facebook','google-plus','instagram','pinterest','vimeo','youtube','linkedin');
								for($i=0;$i<count($socials);$i++){
									$url = '';
									$s = $socials[$i];
									$url = esc_url(one_blog('one_blog_'.$s.'_url'));
									echo ($url != '' ? '<li><a target="_blank" href="'.$url.'"><img src="'.esc_url( get_template_directory_uri() ).'/images/social-light/'.$s.'-icon.png" /></a></li>':'');
								}
							?>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div><!--//head-fixed-->
		
		<div class="head-logo">
			<div class="container">
				<div class="logo">
				<?php
					if (one_blog('one_blog_logo') != '') :
						echo '<a href="'.esc_url(home_url()).'"><img src="'.esc_url(one_blog('one_blog_logo')).'" class="logo" alt="'.__('logo','one-blog').'"></a>';
					else:
						echo '<h1><a href="'.esc_url(home_url()).'">'.get_bloginfo('name').'</a></h1>';
					endif;
				?>
				</div>
			</div>
		</div>
		
	</header>