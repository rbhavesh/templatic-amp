<?php
/* Twitter handler */
wp_embed_register_handler(
		'tmpl-amp-twitter',
		'#http(s|):\/\/twitter\.com(\/\#\!\/|\/)([a-zA-Z0-9_]{1,20})\/status(es)*\/(\d+)#i',
		'tmpl_amp_twitter_handler_render'
	);

function tmpl_amp_twitter_handler_render( $matches, $attr, $url, $rawattr ) {
	global $script_array;
	$id = false;

	if ( isset( $matches[5] ) && intval( $matches[5] ) ) {
		$id = intval( $matches[5] );
	}

	if ( ! $id ) {
		return '';
	}
	
	/* Push twitter script into array */
	array_push($script_array,'<script async custom-element="amp-twitter" src="https://cdn.ampproject.org/v0/amp-twitter-0.1.js"></script>');
	
	/* Return amp version of twitter html */
	return '<amp-twitter width="480" height="270" layout="responsive" data-tweetid="'.$id.'" data-cards="hidden"></amp-twitter>';
}
?>