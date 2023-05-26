<?php

/**
 * Theme Customizer - Header
 *
 * @package pcmalisic
 */

namespace Mild\Api\Customizer;

use WP_Customize_Color_Control;
use Mild\Api\Customizer;

/**
 * Customizer class
 */
class Header {

	/**
	 * register default hooks and actions for WordPress
	 *
	 * @return
	 */
	public function register( $wp_customize ) {
		$wp_customize->add_section(
			'mild_header_section',
			array(
				'title'       => __( 'Header', 'mild' ),
				'description' => __( 'Customize the Header' ),
				'priority'    => 35,
			)
			);

		$wp_customize->add_setting(
			'mild_header_background_color',
			array(
				'default'   => '#ffffff',
				'transport' => 'postMessage', // or refresh if you want the entire page to reload
			)
			);

		$wp_customize->add_setting(
			'mild_header_text_color',
			array(
				'default'   => '#333333',
				'transport' => 'postMessage', // or refresh if you want the entire page to reload
			)
			);

		$wp_customize->add_setting(
			'mild_header_link_color',
			array(
				'default'   => '#004888',
				'transport' => 'postMessage', // or refresh if you want the entire page to reload
			)
			);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'mild_header_background_color',
			array(
				'label'    => __( 'Header Background Color', 'mild' ),
				'section'  => 'mild_header_section',
				'settings' => 'mild_header_background_color',
			)
			)
			);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'mild_header_text_color',
			array(
				'label'    => __( 'Header Text Color', 'mild' ),
				'section'  => 'mild_header_section',
				'settings' => 'mild_header_text_color',
			)
			)
			);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'mild_header_link_color',
			array(
				'label'    => __( 'Header Link Color', 'mild' ),
				'section'  => 'mild_header_section',
				'settings' => 'mild_header_link_color',
			)
			)
			);

		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => function () {
						bloginfo( 'name' );
					},
				)
				);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => function () {
						bloginfo( 'description' );
					},
				)
				);
			$wp_customize->selective_refresh->add_partial(
				'mild_header_background_color',
				array(
					'selector'         => '#mild-header-control',
					'render_callback'  => array( $this, 'outputCss' ),
					'fallback_refresh' => true,
				)
				);
			$wp_customize->selective_refresh->add_partial(
				'mild_header_text_color',
				array(
					'selector'         => '#mild-header-control',
					'render_callback'  => array( $this, 'outputCss' ),
					'fallback_refresh' => true,
				)
				);
			$wp_customize->selective_refresh->add_partial(
				'mild_header_link_color',
				array(
					'selector'         => '#mild-header-control',
					'render_callback'  => array( $this, 'outputCss' ),
					'fallback_refresh' => true,
				)
				);
		}
	}

	/**
	 * Generate inline CSS for customizer async reload
	 */
	public function outputCss() {
	   echo '<style type="text/css">';
		echo Customizer::css( '.site-header', 'background-color', 'mild_header_background_color' );
		echo Customizer::css( '.site-header', 'color', 'mild_header_text_color' );
		echo Customizer::css( '.site-header a', 'color', 'mild_header_link_color' );
		echo '</style>';
	}
}
