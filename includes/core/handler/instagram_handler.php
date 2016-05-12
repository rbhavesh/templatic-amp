<?php
/* Instagram handler */
wp_embed_register_handler(
		'tmpl-amp-instagram',
		'#http(s?)://(www\.)?instagr(\.am|am\.com)/p/([^/?]+)#i',
		'tmpl_amp_instagram_handler_render'
	);

function tmpl_amp_instagram_handler_render( $matches, $attr, $url, $rawattr ) {
	global $script_array;
	
	/* Push instagram script into array */
	array_push($script_array,'<script async custom-element="amp-instagram" src="https://cdn.ampproject.org/v0/amp-instagram-0.1.js"></script>');
	
	/* Return amp version of instagram html */
	return '<amp-instagram width="480" height="270" layout="responsive" data-shortcode="'.end( $matches ).'"></amp-instagram>';
}
?>