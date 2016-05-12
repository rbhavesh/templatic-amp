<?php
/* Convert image/iframe tag to amp tags */
function amp_image_tag($content) {
	
	$content = str_ireplace('<img','<amp-img',$content);
	$content = preg_replace('/<amp-img(.*?)>/', '<amp-img$1></amp-img>',$content);
	
	$replace_iframe = array (
        '<iframe' => '<amp-iframe layout="responsive"
                          sandbox="allow-scripts allow-same-origin"
                          frameborder="0"',
        '</iframe' => '<amp-img layout="fill" src="'.TEMPLATIC_AMP_URL.'assets/images/placeholder-icon.png" placeholder></amp-img></amp-iframe'
    );
	
	$check_iframe=substr_count($content,'<iframe');
	if($check_iframe>0)
	{
		do_action('tmpl_amp_include_amp_iframe_script');
	}
	$content = strtr($content, $replace_iframe);
	return $content;
}

add_filter('the_content','amp_image_tag');
?>