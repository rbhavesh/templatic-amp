<?php
/**
 * Plugin Name: Templatic AMP
 * Description: This plugin adds support for the Accelerated Mobile Pages (AMP) Project, which is an an open source initiative that aims to provide mobile optimized content that can load instantly on category, archive, pages and detail page.
 * Author: Templatic
 * Author URI: https://templatic.com/
 * Version: 0.0.1
 * Text Domain: templatic-amp
 * Domain Path: /languages/
 * License: 
 */

/* Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) exit; 

/* Plugin Folder Path */
define( 'TEMPLATIC_AMP_URL', plugin_dir_url( __FILE__ ) );

/* Plugin Root File */
define( 'TEMPLATIC_AMP_DIR', plugin_dir_path( __FILE__ ) );

/* Plugin activation hook */
register_activation_hook( __FILE__, 'tmpl_amp_activate' );
if(!function_exists('tmpl_amp_activate'))
{
	function tmpl_amp_activate(){
		$tmpdata = get_option('tmpl_amp_settings');
		$tmpdata['tmpl_amp_enable']="1";
		$tmpdata['tmpl_amp_theme']="templatic";
		$tmpdata['tmpl_amp_header_code']='';
		$tmpdata['tmpl_amp_footer_code']='';
		update_option('tmpl_amp_settings',$tmpdata);
		update_option('tmpl_amp_plugin_active', true);
		flush_rewrite_rules();
	}
}

/* Read settings from back end */
$tmpdata = get_option('tmpl_amp_settings');

/* Store if AMP is enable or not */
define( 'TEMPLATIC_AMP_ENABLE', $tmpdata['tmpl_amp_enable']);

/* Store AMP theme */
define( 'TEMPLATIC_AMP_THEME', $tmpdata['tmpl_amp_theme']);

/* Store AMP endpoint */
define( 'TEMPLATIC_AMP_ENDPOINT', 'amp');

/* Add setting link to plugin page */
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'tmpl_amp_plugin_action_links');

function tmpl_amp_plugin_action_links($links) {
    $plugin_links = '';
    $plugin_links = array(
            '<a href="' . admin_url('admin.php?page=tmpl_amp_setting') . '">' . __('Settings', 'templatic-amp') . '</a>',
    );
	return array_merge($plugin_links,$links);
}


/* Plugin deactivation hook */
register_deactivation_hook( __FILE__, 'tmpl_amp_deactivate' );
if(!function_exists('tmpl_amp_deactivate'))
{
	function tmpl_amp_deactivate(){
		delete_option('tmpl_amp_plugin_active');
		delete_option('tmpl_amp_settings');
		flush_rewrite_rules(true);
	}
}

/* Localization include */
add_action( 'init', 'tmpl_amp_init' );
if(!function_exists('tmpl_amp_init'))
{
	function tmpl_amp_init() {
		/* get current localization */
		$locale = get_locale();
		
		/* localization file for translation of plugins string */
		load_textdomain( 'templatic-amp', TEMPLATIC_AMP_DIR .'languages/'.$locale.'.mo' );
		add_rewrite_endpoint( TEMPLATIC_AMP_ENDPOINT, EP_ALL );
		
		add_filter('rewrite_rules_array','tmpl_amp_rewrite_rules',299);
	}
}

/* Activation message and reset permalink */ 
add_action('admin_init','tmpl_amp_showactivation_message');

if(!function_exists('tmpl_amp_showactivation_message'))
{
	function tmpl_amp_showactivation_message()
	{
		if(get_option('tmpl_amp_plugin_active') == true){
			update_option('tmpl_amp_plugin_active', false);
			wp_safe_redirect(admin_url('plugins.php?act_plug=tmpl_amp_template'));
		}
		if( isset($_GET['act_plug']) && $_GET['act_plug'] == "tmpl_amp_template" ){
		?>
			<div id="message" class="updated"><p><?php  _e('Templatic AMP Plugin is activated now, <a href="' . admin_url('admin.php?page=tmpl_amp_setting') . '">click here</a> for AMP settings.','templatic-amp');?></p></div>
		<?php
		}
		
		global $pagenow;
		if ( 'plugins.php' == $pagenow || 'themes.php' == $pagenow){ /* Test if theme is activate*/
			/*Set default permalink to postname start*/
			global $wp_rewrite;
			$wp_rewrite->set_permalink_structure( '/%postname%/' );
			$wp_rewrite->flush_rules();
			if(function_exists('flush_rewrite_rules')){
				flush_rewrite_rules(true);  
			}
			/*Set default permalink to postname end*/
		}
	}
}


/* Include admin functions file */
require_once( TEMPLATIC_AMP_DIR . 'includes/core/admin-functions.php' );

/* Check amp is enable or not */
if(TEMPLATIC_AMP_ENABLE==1)
{
	/* IF amp is enable then check for endpoint url */
	if(strpos($_SERVER['REQUEST_URI'], TEMPLATIC_AMP_ENDPOINT) !== false){
		/* Load the amp functions file */
		require_once( TEMPLATIC_AMP_DIR . 'includes/core/functions.php' );

		/* Load the amp core class */
		require_once( TEMPLATIC_AMP_DIR . 'includes/core/tmpl-amp-core.php' );

		/* Create Tmpl_Amp_core object */
		if ( class_exists( 'Tmpl_Amp_core' ) ) {
			$tmpl_amp_core = new Tmpl_Amp_core;
			
			/* Initialize the Tmpl_Amp_core check logic and rendering */
			$tmpl_amp_core->tmpl_amp_load_site();
		}
		
		/* Change all post type, post, page, category link to amp link */
		add_filter('post_type_link', 'tmpl_amp_append_query_string');
		add_filter('page_link', 'tmpl_amp_append_query_string');
		add_filter('post_link', 'tmpl_amp_append_query_string');
		add_filter('term_link','tmpl_amp_append_query_string');
		
	}
}

/* Add rewrite rule for templatic amp */
function tmpl_amp_rewrite_rules($rewrite_rules){
	$all_post_type=get_post_types();
	/* Exclude wordpress default post type no need to rewrite it because it's works with endpoint */
	$exclude=array('post','page','attachment','revision','nav_menu_item');
	foreach($all_post_type as $post_type)
	{
		/* If default post type skip current post type */
		if(in_array($post_type,$exclude))
		{
			continue;
		}
		
		/* Post type rule */
		$amp_rule[$post_type.'/'.TEMPLATIC_AMP_ENDPOINT.'?$'] = 'index.php?post_type='.$post_type.'&amp;'.TEMPLATIC_AMP_ENDPOINT.'=1';
		
		$amp_rule[$post_type.'/'.TEMPLATIC_AMP_ENDPOINT.'/page/([0-9]{1,})/?$'] = 'index.php?post_type='.$post_type.'&amp;'.TEMPLATIC_AMP_ENDPOINT.'=1'.'&paged=$matches[1]';
		
		$amp_rule[$post_type.'/feed/(feed|rdf|rss|rss2|atom)/'.TEMPLATIC_AMP_ENDPOINT.'?$'] = 'index.php?post_type='.$post_type.'&feed=$matches[1]'.'&amp;'.TEMPLATIC_AMP_ENDPOINT.'=1'.'&paged=$matches[1]';
		
		$amp_rule[$post_type.'/(feed|rdf|rss|rss2|atom)/'.TEMPLATIC_AMP_ENDPOINT.'?$'] = 'index.php?post_type='.$post_type.'&feed=$matches[1]'.'&amp;'.TEMPLATIC_AMP_ENDPOINT.'=1'.'&paged=$matches[1]';
		
		/* Get texonomies object of post type */
		$taxonomies=get_object_taxonomies($post_type);
		foreach($taxonomies as $texonomy)
		{
			/* Get terms of texonomy */
			$terms = get_terms( array(
				'taxonomy' => $texonomy,
				'hide_empty' => false,
			));
			foreach($terms as $term)
			{
				/* Terms rule */
				$amp_rule[$texonomy . '/' . $term->slug . '/'.TEMPLATIC_AMP_ENDPOINT.'?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug.'&amp;'.TEMPLATIC_AMP_ENDPOINT.'=1';
				
				$amp_rule[$texonomy.'/'.$term->slug.'/'.TEMPLATIC_AMP_ENDPOINT.'/page/?([0-9]{1,})/?$'] = 'index.php?'.$term->taxonomy. '=' . $term->slug.'&amp;'.TEMPLATIC_AMP_ENDPOINT.'=1&paged=$matches[1]';
			}
		}
		$rewrite_rules = array_merge($amp_rule,$rewrite_rules);
	}
	return $rewrite_rules;
}

/* Convert all url to amp url */
function tmpl_amp_append_query_string($url)
{
	return $url.TEMPLATIC_AMP_ENDPOINT;
}

/* Add amp html link into normal pages */
add_action('wp_head','tmpl_amp_frontend_add_canonical');

function tmpl_amp_frontend_add_canonical()
{
	if(is_archive() || is_category() || is_single())
	{
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
		$protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")).$s;
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
		$currnt_url = $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; 
		echo '<link rel="amphtml" href="'.$currnt_url.TEMPLATIC_AMP_ENDPOINT.'/" />';
	}
}