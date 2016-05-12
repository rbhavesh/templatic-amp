<!doctype html>
<html amp>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<title><?php echo function_exists( 'wp_get_document_title' ) ? wp_get_document_title() : wp_title( '', false );	?>
	</title>
	<style amp-custom><?php	do_action('tmpl_amp_custom_style'); ?></style>
	<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
	<link rel="canonical" href="<?php echo get_the_permalink(); ?>" />
	<script async src="https://cdn.ampproject.org/v0.js"></script>
	<?php do_action( 'tmpl_amp_custom_header' ); ?>
</head>
<body>
<nav class="amp-wp-title-bar">
	<div>
		<a href="<?php bloginfo('url'); ?>">
			<?php bloginfo('name'); ?>
		</a>
	</div>
</nav>
<div class="amp-wp-content">