<?php get_header(); ?>

 		<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>

        <h1 class="amp-wp-title">
			<h2><?php the_title(); ?></h2>
		</h1>

		<ul class="amp-wp-meta">
			<li><?php _e('By','templatic-amp'); ?> <?php the_author_meta( 'display_name' ); ?></li>
			<li><?php _e('on','templatic-amp'); ?> <?php the_time( get_option( 'date_format' ) ) ?></li>
		</ul>
		
		<div class="post"> 

			<?php the_content(); ?>
			<?php wp_link_pages( 'before=<p>&after=</p>&next_or_number=number&pagelink=Page %' ); ?>
		</div>
		
		<div id="posttags">
			<p><?php the_tags( 'Tags: ', ', ' ); ?></p>
		</div>
		
		<div id="pagination">
			<div class="next"><?php next_post_link(); ?></div>
			<div class="prev"><?php previous_post_link(); ?></div>
			<div class="clearfix"></div>
		</div>

		<?php endwhile; ?>
		<?php endif;?>
<?php get_footer(); ?>