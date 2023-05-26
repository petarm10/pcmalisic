<?php

namespace Mild\Custom;

/**
 * Search.
 */
class Search {

	/**
	 * register default hooks and actions for WordPress
	 *
	 * @return
	 */
	public function register() {
		add_filter( 'get_search_form', array($this, 'custom_search_form') );

	}

	public function custom_search_form( $form ) {
		$form = '<form role="search" method="get" id="searchform" class="searchform mb-4" action="' . home_url( '/' ) . '">
		<div class="position-relative">
			<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search" />
			<input type="submit" id="searchsubmit" value="GO" />
		</div>
		</form>';

		return $form;
	}
}
