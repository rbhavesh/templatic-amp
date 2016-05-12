<?php
/* Youtube handler */
wp_embed_register_handler(
		'tmpl-amp-youtube',
		'#https?://(?:www\.)?(?:youtube.com/(?:v/|e/|embed/|playlist|watch[/\#?])|youtu\.be/).*#i',
		'tmpl_amp_youtube_handler_render'
	);

function tmpl_amp_youtube_handler_render( $matches, $attr, $url, $rawattr ) {
	global $script_array;
	$video_id = false;
	if ( isset( $attr[0] ) ) {
		$url = ltrim( $attr[0] , '=' );
	}
	
	if ( empty( $url ) ) {
		return '';
	}
	
	/* Get video id from youtube video url */
	$video_id = get_youtube_video_id_from_url( $url );
	
	if ( ! $video_id ) {
		return '';
	}
	
	/* Push youtube script into array */
	array_push($script_array,'<script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>');
	
	/* Return amp version of youtube html */
	return '<amp-youtube width="480" height="270" layout=responsive data-videoid="'.$video_id.'" ></amp-youtube>';
}

/* Get video id from youtube video url */
function get_youtube_video_id_from_url( $url ) {
	$video_id = false;
	$parsed_url = parse_url( $url );
	$short_url_host = 'youtu.be';
	if ( $short_url_host === substr( $parsed_url['host'], -strlen( $short_url_host ) ) ) {
		/* youtu.be/{id} */
		$parts = explode( '/', $parsed_url['path'] );
		if ( ! empty( $parts ) ) {
			$video_id = $parts[1];
		}
	} else {
		/* ?v={id} or ?list={id} */
		parse_str( $parsed_url['query'], $query_args );

		if ( isset( $query_args['v'] ) ) {
			$video_id = $query_args['v'];
		}
	}

	if ( empty( $video_id ) ) {
		/* /(v|e|embed)/{id} */
		$parts = explode( '/', $parsed_url['path'] );

		if ( in_array( $parts[1], array( 'v', 'e', 'embed' ) ) ) {
			$video_id = $parts[2];
		}
	}
	return $video_id;
}
?>