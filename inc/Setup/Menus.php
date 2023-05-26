<?php

namespace Mild\Setup;

/**
 * Menus
 */
class Menus {

	/**
	 * register default hooks and actions for WordPress
	 *
	 * @return
	 */
	public function register() {
		add_action( 'after_setup_theme', array( $this, 'register_menus' ) );
	}

	public function register_menus() {
		/*
			Register all your menus here
		*/
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'mild' ),
				'footer' => esc_html__( 'Footer', 'mild' ),
			)
			);
	}
}
