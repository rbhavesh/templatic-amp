<?php get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header>
				<h1 class="page-title screen-reader-text">
				<?php if ( is_category() ) : 
						single_cat_title(); 
						echo _e('Archives','templatic-amp'); 
						
					  elseif ( is_day() ) : 
						echo _e('Archive for','templatic-amp');
							the_time( 'F jS, Y' ); 
							
					  elseif ( is_month() ) : 
						echo _e('Archive for','templatic-amp');
							the_time( 'F, Y' ); 
							
					  elseif ( is_year() ) : 
							echo _e('Archive for','templatic-amp');
							the_time('Y');
					endif;
				?>
				</h1>
			</header>

		<?php $access_key = 1; ?>
		<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>

		<div class="post">
			<?php
			$thumb_id = get_post_thumbnail_id();
			$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
			$thumb_url = $thumb_url_array[0];            
			?>   

			<div class="post_image"><a href="<?php the_permalink(); ?>"><amp-img src=<?php echo $thumb_url ?> width=100 height=75></amp-img></a></div>


            <h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" accesskey="<?php echo $access_key; $access_key++; ?>"><?php the_title(); ?></a></h2>
            <?php $content = get_the_content();?>
            <p><?php echo wp_trim_words( $content , '15' ); ?></p>
		</div>

		<?php endwhile; ?>
		<?php endif; ?>

		<div id="pagination">
			<div class="next"><?php next_posts_link( 'Next &raquo;', 0 ) ?></div>
			<div class="prev"><?php previous_posts_link( '&laquo; Previous' ); ?></div>
			<div class="clearfix"></div>
		</div>
	</div>
</main>
</div>
<?php get_footer(); ?>