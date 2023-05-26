<?php

/**
 * Helpers methods
 * List all your static functions you wish to use globally on your theme
 *
 * @package pcmalisic
 */

if ( ! function_exists( 'dd' ) ) {
	/**
	 * Var_dump and die method
	 *
	 * @return void
	 */
	function dd() {
		echo '<pre>';
		array_map(
			function ( $x ) {
				var_dump( $x );
			},
			func_get_args()
        );
		echo '</pre>';
		die;
	}
}

if ( ! function_exists( 'starts_with' ) ) {
	/**
	 * Determine if a given string starts with a given substring.
	 *
	 * @param  string       $haystack
	 * @param  string|array $needles
	 * @return bool
	 */
	function starts_with( $haystack, $needles ) {
		foreach ( (array) $needles as $needle ) {
			if ( $needle != '' && substr( $haystack, 0, strlen( $needle ) ) === (string) $needle ) {
				return true;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'mix' ) ) {
	/**
	 * Get the path to a versioned Mix file.
	 *
	 * @param  string $path
	 * @param  string $manifest_directory
	 * @return \Illuminate\Support\HtmlString
	 *
	 * @throws \Exception
	 */
	function mix( $path, $manifest_directory = '' ) {
		if ( ! $manifest_directory ) {
			// Setup path for standard AWPS-Folder-Structure
			$manifest_directory = 'assets/dist/';
		}
		static $manifest;
		if ( ! starts_with( $path, '/' ) ) {
			$path = "/{$path}";
		}
		if ( $manifest_directory && ! starts_with( $manifest_directory, '/' ) ) {
			$manifest_directory = "/{$manifest_directory}";
		}
		$root_dir = dirname( __FILE__, 2 );
		if ( file_exists( $root_dir . '/' . $manifest_directory . '/hot' ) ) {
			return getenv( 'WP_SITEURL' ) . ':8080' . $path;
		}
		if ( ! $manifest ) {
			$manifest_path = $root_dir . $manifest_directory . 'mix-manifest.json';
			if ( ! file_exists( $manifest_path ) ) {
				wp_die(
					'<h1>The Mix manifest does not exist.</h1>
					If this is the first time you install Mild\'s theme, you need to first run "npm install" from the root of theme dir and then "npm run dev".
					<br />
					<br />
					* \'npm run watch\' to start browserSync with LiveReload and proxy to your custom URL<br />
					* \'npm run dev\' to quickly compile and bundle all the assets without watching<br />
					* \'npm run prod\' to compile the assets for production<br />
					'
				);
			}
			$manifest = json_decode( file_get_contents( $manifest_path ), true );
		}

		if ( starts_with( $manifest[ $path ], '/' ) ) {
			$manifest[ $path ] = ltrim( $manifest[ $path ], '/' );
		}

		$path = $manifest_directory . $manifest[ $path ];

		return get_template_directory_uri() . $path;
	}
}

if ( ! function_exists( 'assets' ) ) {
	/**
	 * Easily point to the assets dist folder.
	 *
	 * @param  string $path
	 */
	function assets( $path ) {
		if ( ! $path ) {
			return;
		}

		echo get_template_directory_uri() . '/assets/dist/' . $path;
	}
}

if ( ! function_exists( 'svg' ) ) {
	/**
	 * Easily point to the assets dist folder.
	 *
	 * @param  string $path
	 */
	function svg( $path ) {
		if ( ! $path ) {
			return;
		}

		echo get_template_part( 'assets/svg/inline', $path . '.svg' );
	}
}
