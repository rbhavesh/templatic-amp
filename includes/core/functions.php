<?php
/* Include current theme style.php file for styling */
function tmpl_amp_custom_style() {
	if (is_dir(TEMPLATIC_AMP_DIR.'templates/'.TEMPLATIC_AMP_THEME)) {
		if (file_exists(TEMPLATIC_AMP_DIR.'templates/'.TEMPLATIC_AMP_THEME.'/style.php')) {
			include( TEMPLATIC_AMP_DIR.'templates/'.TEMPLATIC_AMP_THEME.'/style.php' );
		}
	}
}
add_action('tmpl_amp_custom_style','tmpl_amp_custom_style');

/* Define global to store required script */
global $script_array;
$script_array=array();

/* Include hander files start */

/* Youtube hander file */
include( TEMPLATIC_AMP_DIR.'includes/core/handler/youtube_handler.php' );

/* Twitter hander file */
include( TEMPLATIC_AMP_DIR.'includes/core/handler/twitter_handler.php' );

/* Instagram hander file */
include( TEMPLATIC_AMP_DIR.'includes/core/handler/instagram_handler.php' );

/* Facebook hander file */
include( TEMPLATIC_AMP_DIR.'includes/core/handler/facebook_handler.php' );

/* Vine hander file */
include( TEMPLATIC_AMP_DIR.'includes/core/handler/vine_handler.php' );

/* Common filter to change tags like img to amp-img, iframe tags */
include( TEMPLATIC_AMP_DIR.'includes/core/handler/common_filter.php' );

/* Dailymotion hander file */
include( TEMPLATIC_AMP_DIR.'includes/core/handler/dailymotion_handler.php' );

/* Vimeo hander file */
include( TEMPLATIC_AMP_DIR.'includes/core/handler/vimeo_handler.php' );


/* Include hander files end */


/* Include required script stored in global variable */
add_action('tmpl_amp_custom_scripts','tmpl_amp_custom_scripts_function');
function tmpl_amp_custom_scripts_function()
{
	global $script_array;
	/* Loop through each script and print it */
	foreach($script_array as $script)
	{
		echo $script;
	}
}

/* Hook to display header tracking code */
add_action('tmpl_amp_custom_header','tmpl_amp_custom_header_tracking_code');
function tmpl_amp_custom_header_tracking_code()
{
	/* Read settings from back end */
	$tmpdata = get_option('tmpl_amp_settings');
	echo $tmpdata['tmpl_amp_header_code'];
}

/* If content have iframe then include iframe scrpt */
add_action('tmpl_amp_include_amp_iframe_script','tmpl_amp_include_amp_iframe_script_function');

function tmpl_amp_include_amp_iframe_script_function()
{
	global $script_array;
	array_push($script_array,'<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>');
}

/* Hook to display footer tracking code */
add_action('tmpl_amp_custom_footer','tmpl_amp_custom_footer_tracking_code');
function tmpl_amp_custom_footer_tracking_code()
{
	/* Read settings from back end */
	$tmpdata = get_option('tmpl_amp_settings');
	echo $tmpdata['tmpl_amp_footer_code'];
}
?>