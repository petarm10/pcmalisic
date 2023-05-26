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
class Blocks {

	/**
	 * Register default hooks and actions for WordPress
	 *
	 * @return WordPress add_action()
	 */
	public function register() {
		if( function_exists('acf_register_block_type') ) {
			add_action('acf/init', array( $this, 'register_acf_block_types') );
		}

		add_filter( 'block_categories_all', array( $this, 'block_categories'), 10, 2 );
		//add_filter( 'render_block', array( $this, 'wrap_classic_block' ), 10, 2 );

	}

	public function register_acf_block_types() {

		acf_register_block_type( array(
			'name'            => 'some-block',
			'title'           => __( 'Ett block' ),
			'description'     => __( 'Här visas ett block' ),
			'render_template' => 'views/blocks/some-block.php',
			'category'        => 'acf',
			'mode'            => 'auto',
			'icon'            => 'star-filled',
			'keywords'        => array( 'block' ),
			'supports'        => [ 'anchor' => true, 'multiple' => false ]
		));
	}

	public function block_categories( $categories, $post ) {

		return array_merge(
			$categories,
			array(
				array(
					'slug' => 'acf',
					'title' => 'ACF Block',
				),
			)
		);

	}

	public function wrap_classic_block( $block_content, $block ) {

		if (preg_match('/\bacf\b/', $block['blockName']) == false && ! empty( $block_content ) && ! ctype_space( $block_content )) {
			$block_content = '<div class="' . (isset($block['attrs']['align']) ? 'align' . $block['attrs']['align'] : '' ) .'">' . $block_content . '</div>';
		}

		return $block_content;
	}
}
