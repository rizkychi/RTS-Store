<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Digital Products
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require_once (dirname(__FILE__) . '/inc/class-tgm-plugin-activation.php');
if ( ! function_exists( 'digital_products_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function digital_products_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Digital Products, use a find and replace
	 * to change 'Digital Products' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'digital-products', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-header' );
  add_theme_support( "title-tag" );
  
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
  add_theme_support('custom-logo');
  add_image_size( 'digital-products-thumbnail-image', 260, 165, true );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'digital-products' )
	) );
  add_filter('siteorigin_widgets_active_widgets', 'digital_products_active_widgets');
  function digital_products_active_widgets($active){
    //Bundled Widgets
    $active['video'] = true;
    $active['testimonial'] = true;
    $active['simple-masonry'] = true;
    $active['slider'] = true;
    $active['cta'] = true;
    $active['contact'] = true;
    $active['features'] = true;
    $active['headline'] = true;
    $active['hero'] = true;
 
    return $active;
  }  
  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
    add_theme_support( 'html5', array('comment-form','comment-list','gallery','caption' ) );

}
endif;
add_action( 'after_setup_theme', 'digital_products_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function digital_products_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'digital_products_content_width', 640 );
}
add_action( 'after_setup_theme', 'digital_products_content_width', 0 );

/*
* TGM plugin activation register hook 
*/
add_action( 'tgmpa_register', 'digital_products_register_required_plugins' );
function digital_products_register_required_plugins() {
    if(class_exists('TGM_Plugin_Activation')){
      $plugins = array(
        array(
           'name'      => __('Page Builder by SiteOrigin','digital-products'),
           'slug'      => 'siteorigin-panels',
           'required'  => false,
        ),
        array(
           'name'      => __('SiteOrigin Widgets Bundle','digital-products'),
           'slug'      => 'so-widgets-bundle',
           'required'  => false,
        ),
        array(
           'name'      => __('Contact Form 7','digital-products'),
           'slug'      => 'contact-form-7',
           'required'  => false,
        ),
      );
      $config = array(
        'id'           => 'digital-products',
        'default_path' => '',
        'menu'         => 'digital-products-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => true,
        'message'      => '',
        'strings'      => array(
           'page_title'                      => __( 'Install Recommended Plugins', 'digital-products' ),
           'menu_title'                      => __( 'Install Plugins', 'digital-products' ),
           'installing'                      => __( 'Installing Plugin: %s', 'digital-products' ), 
           'oops'                            => __( 'Something went wrong with the plugin API.', 'digital-products' ),
           'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.','digital-products' ), 
           'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.','digital-products' ), 
           'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.','digital-products' ), 
           'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.','digital-products' ), 
           'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.','digital-products' ), 
           'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.','digital-products' ), 
           'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.','digital-products' ), 
           'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.','digital-products' ), 
           'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins','digital-products' ),
           'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins','digital-products' ),
           'return'                          => __( 'Return to Required Plugins Installer', 'digital-products' ),
           'plugin_activated'                => __( 'Plugin activated successfully.', 'digital-products' ),
           'complete'                        => __( 'All plugins installed and activated successfully. %s', 'digital-products' ), 
           'nag_type'                        => 'updated'
        )
      );
      tgmpa( $plugins, $config );
    }
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function digital_products_widgets_init() {
	register_sidebar(array(
    'name' => __('Main Sidebar', 'digital-products'),
    'id' => 'sidebar-1',
    'description' => __('Main sidebar that appears on the right.', 'digital-products'),
    'before_widget' => '<aside id="%1$s" class="widget widget_recent_entries %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h5>',
    'after_title' => '</h5>',
  ));
  register_sidebar(array(
    'name' => __('Footer Area One', 'digital-products'),
    'id' => 'footer-1',
    'description' => __('Footer Area One that appears on footer.', 'digital-products'),
    'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<div class="widget-title">',
    'after_title' => '</div>',
  ));
  register_sidebar(array(
    'name' => __('Footer Area Two', 'digital-products'),
    'id' => 'footer-2',
    'description' => __('Footer Area Two that appears on footer.', 'digital-products'),
    'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<div class="widget-title">',
    'after_title' => '</div>',
  ));
  register_sidebar(array(
    'name' => __('Footer Area Three', 'digital-products'),
    'id' => 'footer-3',
    'description' => __('Footer Area Three that appears on footer.', 'digital-products'),
    'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<div class="widget-title">',
    'after_title' => '</div>',
  ));
  register_sidebar(array(
    'name' => __('Footer Area Four', 'digital-products'),
    'id' => 'footer-4',
    'description' => __('Footer Area Four that appears on footer.', 'digital-products'),
    'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<div class="widget-title">',
    'after_title' => '</div>',
  ));
  register_sidebar(array(
    'name' => __('Footer Bottom Area', 'digital-products'),
    'id' => 'footer-5',
    'description' => __('This section will render after all footer widget and before copyright section.', 'digital-products'),
    'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<div class="widget-title">',
    'after_title' => '</div>',
  ));
}
add_action( 'widgets_init', 'digital_products_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function digital_products_scripts() {
  if(get_theme_mod( 'text_font_type' ) != '' || get_theme_mod( 'menu_font_type' )!= '' || get_theme_mod( 'heading_font_type' ) != ''){
    wp_enqueue_style( 'digital-products-google-fonts', digital_products_enqueue_google_font_url(), array(), null);
  }
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css');
	wp_enqueue_style( 'font-awsome', get_template_directory_uri().'/css/font-awesome.css');
	wp_enqueue_style( 'digital-products-default', get_template_directory_uri().'/css/default.css');	
	
  digital_products_custom_scripts();

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
  wp_enqueue_script('jquery');
  $fixed_header = get_theme_mod('fixed_header');  
  $current_url = wp_logout_url( get_permalink() ); 
  $credits_link = esc_url('https://wpdigipro.com/wordpress-themes/digital-products/');
  $credits_text = __('Digital Products WordPress Theme','digital-products');
  $power_text = __('Powered by ','digital-products');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '', true);
 
  if(is_plugin_active('siteorigin-panels/siteorigin-panels.php')){
    wp_enqueue_script( 'digital-products-custom', get_template_directory_uri() . '/js/custom.js', array('siteorigin-panels-front-styles','jquery'), '', true);
  } else{
    wp_enqueue_script( 'digital-products-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '', true);
  }
  wp_localize_script('digital-products-custom', 'digital_products_script',array('fixed_header'=>$fixed_header,'current_url' => $current_url,'credits_link' => $credits_link,'credits_text' => $credits_text,'power_text' => $power_text));

}
add_action( 'wp_enqueue_scripts', 'digital_products_scripts' );
/*
* Admin Script for Page and post metabox design
*/
function digital_products_page_options_load_scripts($hook) {
  $currentScreen = get_current_screen(); 
    if( $currentScreen->id != "customize" ) {
      wp_enqueue_media();     
      wp_localize_script('digital-products-options-custom', 'admin_url', admin_url('admin-ajax.php'));
    }
}
add_action('admin_enqueue_scripts', 'digital_products_page_options_load_scripts');

/** Google Fonts **/
function digital_products_enqueue_google_font_url()  {
  $google_fonts = array();
  $google_fonts[] = get_theme_mod( 'text_font_type','Open Sans' );
  $google_fonts[] = get_theme_mod( 'menu_font_type','Open Sans' );
  $google_fonts[] = get_theme_mod( 'heading_font_type','Open Sans');
  
  $google_fonts = array_unique( $google_fonts );
  $i = 0;
  $params = '';
  foreach( $google_fonts as $google_font ) {    
      if( $i > 0 ) {
        $params .= '|';
      }
      $params .= $google_font . ':400,300,600,700,800';
      $i++;
    }
  $google_fonts_url = add_query_arg( 'family', urlencode( $params ), "https://fonts.googleapis.com/css");
  return $google_fonts_url;
}

function digital_products_hex_to_rgba($color, $opacity) {
  $default = 'rgb(0,0,0)';
  if(empty($color))
          return $default; 
        if ($color[0] == '#' ) 
        {
          $color = substr( $color, 1 );
        }
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
        $rgb =  array_map('hexdec', $hex);
        if($opacity){
          if(abs($opacity) > 1)
            $opacity = 1.0;
          $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
          $output = 'rgb('.implode(",",$rgb).')';
        }
        return $output;
}

function digital_products_get_attachment( $attachment_id ) {
  if(isset($attachment_id)){
    $attachment = get_post( $attachment_id );
    if($attachment) {
      return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
      );
    } else {
      return false;
    }
  } else{
    return array(
      'alt' => '',
      'caption' => '',
      'description' => '',
      'href' => '',
      'src' => '',
      'title' => ''
    );
  }
}
/** Remove query string*/
function digital_products_remove_script_version( $src ){
    $parts = explode( '?ver', $src );
        return $parts[0];
}
add_filter( 'script_loader_src', 'digital_products_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'digital_products_remove_script_version', 15, 1 );

function digital_products_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

add_action( 'admin_menu', 'digital_products_admin_menu');
function digital_products_admin_menu( ) {
    add_theme_page( __('WPDigiPro Suite','digital-products'), __('WPDigiPro Suite','digital-products'), 'manage_options', 'digital-products-pro-buynow', 'digital_products_pro_buy_now', 300 ); 
  
}
function digital_products_pro_buy_now(){ ?>  
  <div class="digital_products_pro_version">
  <a href="<?php echo esc_url('https://goo.gl/r6sjWA'); ?>" target="_blank">
    <img src ="<?php echo esc_url('http://d3itwt1jzx3aw2.cloudfront.net/wpdigipro-infographic.jpg') ?>" width="100%" height="auto" />
  </a>
</div>
<?php }

add_filter('upload_mimes', 'digital_products_mime_types');
/** Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';
/** Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';
/**  Custom functions that act independently of the theme templates. */
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/theme-customization.php';
require get_template_directory() . '/inc/social-links.php';