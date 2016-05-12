<?php
/* Vine handler */
wp_embed_register_handler(
		'tmpl-amp-vine',
		'#https?://vine\.co/v/([^/?]+)#i',
		'tmpl_amp_vine_handler_render'
	);

function tmpl_amp_vine_handler_render( $matches, $attr, $url, $rawattr ) {
	global $script_array;
	
	/* Push vine script into array */
	array_push($script_array,'<script async custom-element="amp-vine" src="https://cdn.ampproject.org/v0/amp-vine-0.1.js"></script>');
	
	/* Return amp version of vine html */
	return '<amp-vine width="480" height="270" layout=responsive data-vineid="'.end( $matches ).'"></amp-vine>';
}
?>