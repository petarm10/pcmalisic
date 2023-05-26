<?php

/**
 * Build Gutenberg Blocks
 *
 * @package pcmalisic
 */

namespace Mild\Api\Gutenberg;

/**
 * Customizer class
 */
class Gutenberg {

	/**
	 * Register default hooks and actions for WordPress
	 *
	 * @return WordPress add_action()
	 */
	public function register() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		add_action( 'after_setup_theme', array( $this, 'gutenberg_init' ) );
		add_action( 'init', array( $this, 'gutenberg_enqueue' ) );
		add_action( 'enqueue_block_assets', array( $this, 'gutenberg_assets' ) );

		add_filter( 'allowed_block_types_all', array( $this,'allowed_block_types') );
	}

	public function allowed_block_types( $allowed_blocks ) {

		return $allowed_blocks;
	}

	/**
	 * Custom Gutenberg settings
	 *
	 * @return
	 */
	public function gutenberg_init() {
		add_theme_support(
			'gutenberg',
			array(
				// Theme supports responsive video embeds
				'responsive-embeds' => true,
				// Theme supports wide images, galleries and videos.
				'wide-images'       => true,
			)
		);

		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );

	}

	/**
	 * Enqueue scripts and styles of your Gutenberg blocks
	 *
	 * @return
	 */
	public function gutenberg_enqueue() {
	   wp_register_script( 'gutenberg-mild', get_template_directory_uri() . '/assets/dist/js/gutenberg.js', array( 'wp-blocks', 'wp-element', 'wp-editor' ) );

		register_block_type(
			'gutenberg-mild/mild-cta',
			array(
				'editor_script' => 'gutenberg-mild', // Load script in the editor
			)
			);
	}

	/**
	 * Enqueue scripts and styles of your Gutenberg blocks in the editor
	 *
	 * @return
	 */
	public function gutenberg_assets() {
		wp_enqueue_style( 'gutenberg-mild-cta', get_template_directory_uri() . '/assets/dist/css/gutenberg.css', null );
	}
}
