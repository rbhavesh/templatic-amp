<?php get_header(); ?>
			<?php if ( have_posts() ) : ?>
				<h1 class="amp-wp-title"><?php printf( __( 'Category Archives: %s', 'templatic-amp' ), single_cat_title( '', false ) ); ?></h1>

				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				
					/* Start the Loop. */
					while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() );
					endwhile;
					/* Previous/next page navigation. */
				
				else :
					/* If no content, include the "No posts found" template. */
					get_template_part( 'content', 'none' );

				endif;
			?>
<?php
get_footer();
