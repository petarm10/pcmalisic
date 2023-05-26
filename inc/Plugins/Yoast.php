<?php

/**
 * Yoast
 *
 *
 *
 * @package pcmalisic
 */

namespace Mild\Plugins;

class Yoast {

	/**
	 * register default hooks and actions for WordPress
	 *
	 * @return
	 */
	public function register() {
		add_filter('wpseo_breadcrumb_single_link', [$this, 'change_breadcrumb_html'], 10, 2);
	}

	public function change_breadcrumb_html($link, $breadcrumb) {

		if ($breadcrumb['id'] == get_option('page_on_front')) :
			$link = preg_replace('/<a (href=".*?").*?>/', '<a $1 class="breadcrumb-frontpage">', $link);
		endif;

		return $link;
	}
}
