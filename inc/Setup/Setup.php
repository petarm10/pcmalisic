<?php

namespace Mild\Setup;

class Setup {

	/**
	 * register default hooks and actions for WordPress
	 *
	 * @return
	 */
	public function register() {
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
		add_action( 'after_setup_theme', array( $this, 'content_width' ), 0 );

		add_filter( 'image_size_names_choose', array( $this, 'add_image_size_names') );

		/* register blocks */
		add_action('acf/init', array( $this, 'my_acf_init_block_types'));
	}

	public function theme_setup() {
		/*
		 * You can activate this if you're planning to build a multilingual theme
		 */
		// load_theme_textdomain( 'mild', get_template_directory() . '/languages' );

		/*
		 * Default Theme Support options better have
		 */
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add woocommerce support and woocommerce override
		 */
		// add_theme_support( 'woocommerce' );

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
			);

		add_theme_support(
			'custom-background',
			apply_filters(
			'mild_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
			)
			);

		/*
		 * Activate Post formats if you need
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'gallery',
				'link',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		// add_image_size( 'xs', 86, 86 );
		// add_image_size( 'sm', 306, 358 );
		// add_image_size( 'md', 636, 740 );
		// add_image_size( 'lg', 1632 );
		// add_image_size( 'xl', 2560 );
	}

	public function add_image_size_names( $sizes ) {
		return array_merge( $sizes, array(
		  'xs' => __( 'Anpassad storlek | Extra liten' ),
		  'sm' => __( 'Anpassad storlek | Liten' ),
		  'md' => __( 'Anpassad storlek | Medium' ),
		  'lg' => __( 'Anpassad storlek | Extra stor' ),
		  'xl' => __( 'Anpassad storlek | 2x Extra stor' ),
		) );
	}

	/*
		Define a max content width to allow WordPress to properly resize your images
	*/
	public function content_width() {
		$GLOBALS['content_width'] = apply_filters( 'content_width', 1440 );
	}

	public function my_acf_init_block_types() {

		if( function_exists('acf_register_block_type') ) {
	
			acf_register_block_type(array(
				'name'              => 'Four Columns display',
				'title'             => __('Four Columns display'),
				'description'       => __('A custom four column block.'),
				'render_template'   => 'views/blocks/4columns.php',
				'category'          => 'formatting',
				'icon'              => 'admin-comments',
				'keywords'          => array( 'four', 'columns', '4' ),
			));
			acf_register_block_type(array(
				'name'              => 'Three Columns display',
				'title'             => __('Three Columns display'),
				'description'       => __('A custom three column block.'),
				'render_template'   => 'views/blocks/3columns.php',
				'category'          => 'formatting',
				'icon'              => 'admin-comments',
				'keywords'          => array( 'three', 'columns', '3' ),
			));
			acf_register_block_type(array(
				'name'              => 'One Columns display',
				'title'             => __('One Columns display'),
				'description'       => __('A custom one column block.'),
				'render_template'   => 'views/blocks/1columns.php',
				'category'          => 'formatting',
				'icon'              => 'admin-comments',
				'keywords'          => array( 'one', 'columns', '1' ),
			));
			acf_register_block_type(array(
				'name'              => 'Two Columns display',
				'title'             => __('Two Columns display'),
				'description'       => __('A custom two column block.'),
				'render_template'   => 'views/blocks/2columns.php',
				'category'          => 'formatting',
				'icon'              => 'admin-comments',
				'keywords'          => array( 'two', 'columns', '2' ),
			));
			acf_register_block_type(array(
				'name'              => 'Products Two Columns display',
				'title'             => __('Products Two Columns display'),
				'description'       => __('A custom products two column block.'),
				'render_template'   => 'views/blocks/products-block2col.php',
				'category'          => 'formatting',
				'icon'              => 'admin-comments',
				'keywords'          => array( 'block', 'products', '2' ),
			));
			acf_register_block_type(array(
				'name'              => 'Swiper Slider Block',
				'title'             => __('Swiper Slider Block'),
				'description'       => __('A custom Swiper Slider Block.'),
				'render_template'   => 'views/blocks/swiper-block.php',
				'category'          => 'formatting',
				'icon'              => 'admin-comments',
				'keywords'          => array( 'swiper', 'slider', '1' ),
			));
			acf_register_block_type(array(
				'name'              => 'Tabs Block',
				'title'             => __('Tabs Block'),
				'description'       => __('A custom Tabs Block.'),
				'render_template'   => 'views/blocks/tabs-block.php',
				'category'          => 'formatting',
				'icon'              => 'admin-comments',
				'keywords'          => array( 'tabs', 'block', '1' ),
			));
			acf_register_block_type(array(
				'name'              => 'Related Block',
				'title'             => __('Related Block'),
				'description'       => __('A custom Related Block.'),
				'render_template'   => 'views/blocks/related-block.php',
				'category'          => 'formatting',
				'icon'              => 'products',
				'keywords'          => array( 'related', 'block', '1' ),
			));
			acf_register_block_type(array(
				'name'              => 'Product Table Block',
				'title'             => __('Product Table Block'),
				'description'       => __('A custom table Block.'),
				'render_template'   => 'views/blocks/product-table-block.php',
				'category'          => 'formatting',
				'icon'              => 'products',
				'keywords'          => array( 'product', 'table', 'block' ),
			));
			acf_register_block_type(array(
				'name'              => 'Success Stories Block',
				'title'             => __('Success Stories Block'),
				'description'       => __('A custom success stories Block.'),
				'render_template'   => 'views/blocks/success-stories-block.php',
				'category'          => 'formatting',
				'icon'              => 'products',
				'keywords'          => array( 'success', 'stories', 'block' ),
			));
			acf_register_block_type(array(
				'name'              => 'Slider Items Block',
				'title'             => __('Slider Items Block'),
				'description'       => __('A custom Slider Items Block.'),
				'render_template'   => 'views/blocks/slider-items-block.php',
				'category'          => 'formatting',
				'icon'              => 'slides',
				'keywords'          => array( 'slider', 'items', 'block' ),
			));
			acf_register_block_type(array(
				'name'              => 'Events Block 2 Column',
				'title'             => __('Events Block 2 Column'),
				'description'       => __('A custom Events Block 2 Column.'),
				'render_template'   => 'views/blocks/events-block2col.php',
				'category'          => 'formatting',
				'icon'              => 'calendar',
				'keywords'          => array( 'events', '2column', 'block' ),
			));
			acf_register_block_type(array(
				'name'              => 'Latest News Block',
				'title'             => __('Latest News Block CT'),
				'description'       => __('A custom Latest News Block.'),
				'render_template'   => 'views/blocks/latest-news-block.php',
				'category'          => 'formatting',
				'icon'              => 'info',
				'keywords'          => array( 'news', 'latest', 'block' ),
			));
			acf_register_block_type(array(
				'name'              => 'Insights Block',
				'title'             => __('Insights Block CT'),
				'description'       => __('A custom Insights Block.'),
				'render_template'   => 'views/blocks/insights-block.php',
				'category'          => 'formatting',
				'icon'              => 'info',
				'keywords'          => array( 'insights', 'news', 'block' ),
			));
			acf_register_block_type(array(
				'name'              => 'Featured Products Block',
				'title'             => __('Featured Products Block CT'),
				'description'       => __('A custom Featured Products Block.'),
				'render_template'   => 'views/blocks/featured-products-block.php',
				'category'          => 'formatting',
				'icon'              => 'products',
				'keywords'          => array( 'featured', 'products', 'block' ),
			));
			acf_register_block_type(array(
				'name'              => 'Downloads Block',
				'title'             => __('Downloads Block CT'),
				'description'       => __('A custom Downloads Block.'),
				'render_template'   => 'views/blocks/download-block.php',
				'category'          => 'formatting',
				'icon'              => 'download',
				'keywords'          => array( 'downloads', 'support', 'block' ),
			));
			acf_register_block_type(array(
				'name'              => 'Success Grid Block',
				'title'             => __('Success Block Grid'),
				'description'       => __('A custom Success Block.'),
				'render_template'   => 'views/blocks/success-stories-grid.php',
				'category'          => 'formatting',
				'icon'              => 'yes-alt',
				'keywords'          => array( 'success', 'stories', 'grid' ),
			));
			acf_register_block_type(array(
				'name'              => 'Office\'s Block',
				'title'             => __('Office\'s Block'),
				'description'       => __('A custom Office Block.'),
				'render_template'   => 'views/blocks/office-block.php',
				'category'          => 'formatting',
				'icon'              => 'location',
				'keywords'          => array( 'office', 'location', 'info' ),
			));
		}
	}
}
