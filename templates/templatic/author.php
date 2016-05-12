<?php get_header(); ?>
			<?php if ( have_posts() ) : ?>

				<h1 class="amp-wp-title">
					<?php
						the_post();

						printf( __( 'All posts by %s', 'templatic-amp' ), get_the_author() );
					?>
				</h1>
				<?php if ( get_the_author_meta( 'description' ) ) : ?>
				<div class="author-description"><?php the_author_meta( 'description' ); ?></div>
				<?php endif; ?>
			<?php
					rewind_posts();

					// Start the Loop.
					while ( have_posts() ) : the_post();

						get_template_part( 'content', get_post_format() );

					endwhile;
					// Previous/next page navigation.
					tmpl_amp_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );
				endif;
			?>
<?php
get_footer();
