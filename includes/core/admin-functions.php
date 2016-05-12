<?php
/* Include admin style */
add_action( 'admin_enqueue_scripts', 'tmpl_amp_admin_style' );
if (! function_exists( 'tmpl_amp_admin_style') ) {
	function tmpl_amp_admin_style()
	{
		wp_register_style( 'tmpl_amp_admin_style', TEMPLATIC_AMP_URL . '/assets/css/amp-admin-style.css', false, '1.0.0' );
		wp_enqueue_style( 'tmpl_amp_admin_style' );
	}
}

/* Add setting menu page. */
add_action('admin_menu', 'tmpl_amp_add_admin_menu_item');
if(! function_exists('tmpl_amp_add_admin_menu_item'))
{
	function tmpl_amp_add_admin_menu_item()
	{
		add_menu_page(__( 'AMP Setting', 'templatic-amp' ),'AMP','manage_options','tmpl_amp_setting','tmpl_amp_setting_page',TEMPLATIC_AMP_URL.'assets/images/templatic-logo.png',80); 
	}
}

/* Include setting menu page */
if(! function_exists('tmpl_amp_setting_page'))
{
	function tmpl_amp_setting_page(){
		include( TEMPLATIC_AMP_DIR . 'includes/admin/form.php');
	}
}
?>