<?php
/**
 * Template for the post meta, which includes share links, tags and categories.
 *
 * @package grishma
 * @since grishma 1.0
 */
?>


	<div class="bar">
		<div class="bar-frame clearfix">
			<div class="share">
				 <?php the_tags('<div class="tags">
                                                    <i class="fa fa-file-text-o"></i>
                                                    ',', ','
                    </div>'); ?>
                                           
			
		</div><!-- bar frame -->
	</div><!-- bar -->