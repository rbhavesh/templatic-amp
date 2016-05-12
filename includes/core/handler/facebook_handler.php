<?php
/* Facebook handler */
wp_embed_register_handler(
		'tmpl-amp-facebook',
		'#https?://(www\.)?facebook\.com/.*#i',
		'tmpl_amp_facebook_handler_render'
	);

function tmpl_amp_facebook_handler_render( $matches, $attr, $url, $rawattr ) {
	global $script_array;
	
	if ( empty( $url ) ) {
		return '';
	}
	
	/* Push facebook script into array */
	array_push($script_array,'<script async custom-element="amp-facebook" src="https://cdn.ampproject.org/v0/amp-facebook-0.1.js"></script>');
	
	/* Return amp version of facebook html */
	return '<amp-facebook width="552" height="310" layout="responsive" data-href="'.$url.'"></amp-facebook>';
}
?>