<?php
/**
 * productly functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package productly
 */

if ( ! function_exists( 'productly_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function productly_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on productly, use a find and replace
	 * to change 'productly' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'productly', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'productly-full-thumb', 768, 0, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'productly' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'productly_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif;
add_action( 'after_setup_theme', 'productly_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function productly_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'productly_content_width', 640 );
}
add_action( 'after_setup_theme', 'productly_content_width', 0 );

/**
 *
 * Add Custom editor styles
 *
 */
function productly_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'productly_add_editor_styles' );

/**
 *
 * Load Google Fonts
 *
 */
function productly_google_fonts_url(){

    $fonts_url  = '';
    $Lato = _x( 'on', 'Lato font: on or off', 'productly' );
    $Montserrat      = _x( 'on', 'Montserrat font: on or off', 'productly' );
 
    if ( 'off' !== $Lato || 'off' !== $Montserrat ){

        $font_families = array();
 
        if ( 'off' !== $Lato ) {

            $font_families[] = 'Lato:300,400,400i,700';

        }
 
        if ( 'off' !== $Montserrat ) {

            $font_families[] = 'Montserrat:400,400i,500,600,700';

        }
        
 
        $query_args = array(

            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

    }
 
    return esc_url_raw( $fonts_url );
}

function productly_enqueue_googlefonts() {

    wp_enqueue_style( 'productly-googlefonts', productly_google_fonts_url(), array(), null );
}

add_action( 'wp_enqueue_scripts', 'productly_enqueue_googlefonts' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function productly_widgets_init() {

	register_sidebar( array(
		'name' => esc_html__('Header Widget (Right)', 'productly'),
		'id' => 'header_widget_right',
		'before_widget' => '<div class="header-widgets">',
		'description'   => esc_html__( 'Widgets here will appear inside the header image, to the right', 'productly' ),
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );

	register_sidebar( array(
		'name' => esc_html__('Top Widgets: left', 'productly'),
		'id' => 'top_widget_left',
		'before_widget' => '<div class="top-widgets">',
		'description'   => esc_html__( 'Widgets here will appear under the header image', 'productly' ),
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );

		register_sidebar( array(
		'name' => esc_html__('Top Widgets: middle', 'productly'),
		'id' => 'top_widget_middle',
		'description'   => esc_html__( 'Widgets here will appear under the header image', 'productly' ),
		'before_widget' => '<div class="top-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );

		register_sidebar( array(
		'name' => esc_html__('Top Widgets: right', 'productly'),
		'id' => 'top_widget_right',
		'before_widget' => '<div class="top-widgets">',
		'after_widget' => '</div>',
		'description'   => esc_html__( 'Widgets here will appear under the header image', 'productly' ),
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );


	register_sidebar( array(
		'name' => esc_html__('Footer Widget One', 'productly'),
		'id' => 'footer_widget_left',
		'before_widget' => '<div class="footer-widgets">',
		'description'   => esc_html__( 'Widgets here will appear in the footer', 'productly' ),
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );

		register_sidebar( array(
		'name' => esc_html__('Footer Widget Two', 'productly'),
		'id' => 'footer_widget_middle',
		'description'   => esc_html__( 'Widgets here will appear in the footer', 'productly' ),
		'before_widget' => '<div class="footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );

		register_sidebar( array(
		'name' => esc_html__('Footer Widget Three', 'productly'),
		'id' => 'footer_widget_right',
		'before_widget' => '<div class="footer-widgets">',
		'after_widget' => '</div>',
		'description'   => esc_html__( 'Widgets here will appear in the footer', 'productly' ),
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );


}
add_action( 'widgets_init', 'productly_widgets_init' );

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function productly_custom_excerpt_length( $length ) {
    return 75;
}
add_filter( 'excerpt_length', 'productly_custom_excerpt_length', 999 );


/**
 * Enqueue scripts and styles.
 */
function productly_scripts() {
	wp_enqueue_style( 'productly-style', get_stylesheet_uri() );
	wp_enqueue_style( 'productly-font-awesome-css', get_template_directory_uri() . '/css/font-awesome.min.css');

	wp_enqueue_script( 'productly-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'productly-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'productly-jquery-script', get_template_directory_uri() . '/js/productly.js', array('jquery'), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'productly_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


