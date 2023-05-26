<?php

Namespace Mild\Api\Ajax;

class GetPosts {

    function __construct()
    {
        add_action('wp_ajax_get_posts', array($this, 'get_posts'), 10);
        add_action('wp_ajax_nopriv_get_posts', array($this, 'get_posts'), 10);
    }

    function get_posts() {
		$params = json_decode( stripslashes( $_POST['query'] ), true );

		$sticky = get_option( 'sticky_posts' );

		$params['paged']               = $_POST['paged'] + 1;
		$params['post_status']         = 'publish';
		$params['ignore_sticky_posts'] = true;
		$params['post__not_in']        = $sticky;

		query_posts( $params );

		$return = [];

		if ( have_posts() ) {
		while ( have_posts() ) :
				the_post();

				ob_start();
				get_template_part( 'views/content', get_post_format() );
				$template = ob_get_clean();

				$return['html'][] = $template;
		endwhile;
		}

		wp_send_json( $return );
    }
}
