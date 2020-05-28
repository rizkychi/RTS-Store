<?php
/**
 *
 *
 * Please browse readme.txt for credits and forking information
 *
 * @package productly
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses productly_header_style()
 */
function productly_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'productly_custom_header_args', array(
		'default-image'          => '%s/img/default-bg.png',
		'default-text-color'     => 'fff',
		'width'                  => 1600,
		'height'                 => 500,
		'flex-height'            => true,
		'flex-width'	         => true,
		'wp-head-callback'       => 'productly_header_style',
		) ) );


	/*
	 * Default custom headers packaged with the theme.
	 * %s is a placeholder for the theme template directory URI.
	 */
	register_default_headers( array(
		'mountains' => array(
			'url'           => '%s/img/default-bg.png',
			'thumbnail_url' => '%s/img/default_thumbnail.png',
			'description'   => _x( 'Default', 'Default header image', 'productly' )
			),	
		) );
}
add_action( 'after_setup_theme', 'productly_custom_header_setup' );

if ( ! function_exists( 'productly_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see productly_custom_header_setup().
 */
function productly_header_style() {
	$header_image = get_header_image();
	$header_text_color   = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( empty( $header_image ) && $header_text_color == get_theme_support( 'custom-header', 'default-text-color' ) ){
		return;
	}

	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="productly-header-css">
	<?php
	if ( ! empty( $header_image ) ) :

	?>
	header#masthead {
		background-image: url(<?php header_image(); ?>);
	}		
	<?php endif; 
	?>
	</style>
	<?php
}
endif; // productly_header_style




