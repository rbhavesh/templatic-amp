<?php
/* Dailymotion video handler */
wp_embed_register_handler(
		'tmpl-amp-dailymotion',
		'/^.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/',
		'tmpl_amp_dailymotion_handler_render'
	);

function tmpl_amp_dailymotion_handler_render( $matches, $attr, $url, $rawattr ) {
	global $script_array;
	
	/* Push dailymotion script into array */
	array_push($script_array,'<script async custom-element="amp-dailymotion" src="https://cdn.ampproject.org/v0/amp-dailymotion-0.1.js"></script>');
	
	/* Return amp version of dailymotion html */
	return '<amp-dailymotion data-videoid="'.end($matches).'" layout="responsive" data-ui-highlight="FF4081" width="480" height="270"></amp-dailymotion>';
}
?>