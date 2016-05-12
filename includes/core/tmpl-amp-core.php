<?php
/* Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Tmpl_Amp_core' ) ) {
	/**
	 * The core AmpWP class where the magic happens
	 *
	 * @package AmpWP
	 * @since 1.0
	 */
	class Tmpl_Amp_core {

		/**
		 * Does the checks and decides whether to render a mobile or normal website
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		public function tmpl_amp_load_site() {

			/* Check if not admin and template directory exist, if not exist then stop exectuion */
			if (!is_admin() ) {
				if (!is_dir(TEMPLATIC_AMP_DIR.'templates/'.TEMPLATIC_AMP_THEME)) {
					_e("Please enter valid theme name.","templatic-amp");
					exit();
				}
				/* Include rander file */
				require_once( dirname( __FILE__ ) . '/tmpl-amp-render.php' );
				$tmpl_amp_render = new Tmpl_Amp_render();
				$tmpl_amp_render->tmpl_amp_render_theme();
			}
		}
	}
}