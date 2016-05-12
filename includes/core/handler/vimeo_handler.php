<?php
wp_embed_register_handler(
		'tmpl-amp-vimeo',
		'/https:\/\/(?:www.)?(vimeo|youtube).com\/(?:watch\?v=)?(.*?)(?:\z|&)/',
		'tmpl_amp_vimeo_handler_render'
	);

function tmpl_amp_vimeo_handler_render( $matches, $attr, $url, $rawattr ) {
	global $script_array;
	
	if ( empty( $url ) ) {
		return '';
	}
	
	/* Get video id from url */
	$video_id = get_vimeo_video_id_from_url( $url );
	
	if ( ! $video_id ) {
		return '';
	}
	
	/* Push vimeo script into array */
	array_push($script_array,'<script async custom-element="amp-vimeo" src="https://cdn.ampproject.org/v0/amp-vimeo-0.1.js"></script>');
	
	/* Return amp version of vimeo html */
	return '<amp-vimeo width="480" height="270" layout=responsive data-videoid="'.$video_id.'" ></amp-vimeo>';
}

function get_vimeo_video_id_from_url( $url ) {
	$video_id = false;
	$parsed_url = parse_url( $url );
	$short_url_host = 'vimeo.com';
	if ( $short_url_host === substr( $parsed_url['host'], -strlen( $short_url_host ) ) ) {
		$parts = explode( '/', $parsed_url['path'] );
		if ( ! empty( $parts ) ) {
			$video_id = end($parts);
		}
	} else {
		// ?v={id} or ?list={id}
		parse_str( $parsed_url['query'], $query_args );

		if ( isset( $query_args['v'] ) ) {
			$video_id = $query_args['v'];
		}
	}
	return $video_id;
}
?>