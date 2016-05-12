<?php get_header(); ?>
	<h1 class="amp-wp-title"><?php _e( 'Not Found', 'templatic-amp' ); ?></h1>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="page-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'templatic-amp' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .page-content -->
		</div><!-- #content -->
	</div><!-- #primary -->
<?php
get_footer();
