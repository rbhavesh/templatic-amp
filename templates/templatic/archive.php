<?php get_header(); ?>
			<?php if ( have_posts() ) : ?>
				<h1 class="amp-wp-title">
					<?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'templatic-amp' ), get_the_date() );

						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'templatic-amp' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'templatic-amp' ) ) );

						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'templatic-amp' ), get_the_date( _x( 'Y', 'yearly archives date format', 'templatic-amp' ) ) );

						else :
							_e( 'Archives', 'templatic-amp' );

						endif;
					?>
				</h1>
			<?php
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
