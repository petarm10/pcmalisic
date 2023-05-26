<?php

/**
 * ACF PRO
 *
 * @link https://github.com/elliotcondon/acf
 *
 * @package pcmalisic
 */

namespace Mild\Plugins;

class Acf {

	/**
	 * register default hooks and actions for WordPress
	 *
	 * @return
	 */

	public function register() {
		add_filter( 'acf/settings/save_json', array( $this, 'mild_acf_json_save_point' ) );
		add_filter( 'acf/settings/load_json', array( $this, 'mild_acf_json_load_point' ) );

		add_action( 'acf/init', array( $this, 'acf_google_api') );
		add_action( 'acf/init', array( $this, 'option_pages') );
	}

	public function acf_google_api() {
		acf_update_setting('google_api_key', get_field('maps_api_key', 'option'));
	}

	public function mild_acf_json_save_point( $path ) {
		// update path
		return get_stylesheet_directory() . '/acf-json';
	}

	public function mild_acf_json_load_point( $paths ) {
		// remove original path (optional)
		unset( $paths[0] );

		// append path
		$paths[] = get_stylesheet_directory() . '/acf-json';

		// return
		return $paths;
	}

	public function option_pages() {

		// Check function exists.
		if ( function_exists( 'acf_add_options_page' ) ) {

			$parent = acf_add_options_page(array(
				'page_title'  => __( 'Specifika inställningar för ' . get_bloginfo() . '' ),
				'menu_title'  => get_bloginfo(),
				'redirect'    => true,
			));

			acf_add_options_page(array(
				'page_title'  => __( 'Sidhuvudet' ),
				'menu_title'  => __( 'Sidhuvud' ),
				'parent_slug' => $parent['menu_slug'],
			));

			acf_add_options_page(array(
				'page_title'  => __( 'Sidfoten' ),
				'menu_title'  => __( 'Sidfot' ),
				'parent_slug' => $parent['menu_slug'],
			));

			acf_add_options_page(array(
				'page_title'  => __( 'Google Maps inställningar' ),
				'menu_title'  => __( 'Google Maps' ),
				'parent_slug' => $parent['menu_slug'],
			));

		}
	}

}
