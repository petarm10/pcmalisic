<?php

namespace Mild\Custom;

/**
 * Extras.
 */
class Extras {

	/**
	 * register default hooks and actions for WordPress
	 *
	 * @return
	 */
	public function register() {
		add_filter( 'body_class', array( $this, 'body_class' ) );
		add_filter( 'wp_is_mobile', array( $this, 'mm_exclude_ipad' ) );

		/* image sizes */
		add_image_size('insights-thumb-main', 647, 647, true);
		add_image_size('insights-thumb', 311, 311, true);
		add_image_size('insights-thumb-bottom', 647, 364, true);
		add_image_size('insight-large', 880, 560, true);
		add_image_size('fourcolumn-thumb', 622, 414, true);
		add_image_size('threecolumn-thumb', 423, 282, true);
		add_image_size('twocolumn-thumb', 648, 432, true);
		add_image_size('ss-thumb', 860, 397, true);

	}

	public function body_class( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}

	function mm_exclude_ipad( $is_mobile ) {
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
			$is_mobile = false;
		}
		return $is_mobile ;
	}
	  
}
