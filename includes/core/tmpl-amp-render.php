<?php
/* Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Tmpl_Amp_render' ) ) {
	/**
	 * Class that deals with all aspects of rendering the mobile website
	 *
	 * @package AmpWP
	 * @since 1.0
	 */
	class Tmpl_Amp_render {

		/**
		 * Initialize the rendering of the mobile website
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		public function tmpl_amp_render_theme() {
			/* Apply theme filters */
			add_filter( 'theme_root', array( &$this, 'tmpl_amp_set_theme_root' ) );
			add_filter( 'theme_root_uri', array (&$this, 'tmpl_amp_set_theme_uri' ) );
			add_filter( 'template', array( &$this, 'tmpl_amp_set_template' ) );
		}

		/**
		 * Sets the blogs template to the AmpWP template
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		public function tmpl_amp_set_template() {
			return TEMPLATIC_AMP_THEME;
		}

		/**
		 * Sets the theme root to the AmpWP theme directory
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		public function tmpl_amp_set_theme_root() {
			return TEMPLATIC_AMP_DIR . 'templates';
		}

		/**
		 * Sets the path to the themes directory
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		public function tmpl_amp_set_theme_uri() {
			return TEMPLATIC_AMP_DIR . 'templates';
		}
	}
}