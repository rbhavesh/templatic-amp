<?php get_header(); ?>
	<div id="contentwrap">

			<?php if ( have_posts() ) : ?>

			<div id="title">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'templatic-amp' ), get_search_query() ); ?></h1>
			</div>

				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() );
					endwhile;
					/* Previous/next post navigation. */
					tmpl_amp_paging_nav();
				else :
					/* If no content, include the "No posts found" template. */
					get_template_part( 'content', 'none' );

				endif;
			?>

		</div>
<?php
get_footer();
