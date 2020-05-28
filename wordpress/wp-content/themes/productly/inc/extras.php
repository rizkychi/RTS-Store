<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package productly
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function productly_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'productly_body_classes' );

/**
 * Custom excerpt more
 */
function productly_custom_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}
	return '&hellip; ';
}
add_filter( 'excerpt_more', 'productly_custom_excerpt_more' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function productly_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'productly_pingback_header' );

function productly_light_get_image_src( $image_id, $size = 'full' ) {
	$img_attr = wp_get_attachment_image_src( intval( $image_id ), $size );
	if ( ! empty( $img_attr[0] ) ) {
		return $img_attr[0];
	}
}
function productly_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'productly_excerpt_length', 1 );



/* Productly Theme Page */ 

function productly_themep_css_loading( $hook ) {
    if ( 'appearance_page_about-productly' !== $hook ) {
        return;
    }
    wp_enqueue_style( 'productly-themep-css', get_template_directory_uri() . '/css/themep.css' );
}
add_action( 'admin_enqueue_scripts', 'productly_themep_css_loading' );

add_action( 'admin_menu', 'productly_themep' );
function productly_themep() {
  add_theme_page( __('Productly', 'productly'), __('Productly Theme', 'productly'), 'edit_theme_options', 'about-productly.php', 'productly_themep_ct');
}
 
function productly_themep_ct(){ ?>
<div class="themepage-wrapper">
  <div class="headings-wrapper">
    <h2>Productly Informaton And Support</h2>
    <h3>If you can't find a solution, feel free to email me at Email@vilhodesign.com</h3>
  </div>
  <div class="themepage-left">
    <div class="help-box-wrapper">
      <a href="https://wordpress.org/support/" class="help-box" target="_blank">
        General WordPress Support 
      </a>
    </div>
    <div class="help-box-wrapper">
      <a href="http://vilhodesign.com/contact/" class="help-box" target="_blank">
        Productly Theme Support 
        <span>Email@vilhodesign.com</span>
      </a>
    </div>
    <div class="help-box-wrapper">
     <a href="http://vilhodesign.com/productly-theme/" class="help-box" target="_blank">
      Productly Theme Demo 
    </a>
  </div>
  <div class="help-box-wrapper">
    <a href="http://vilhodesign.com/productly-theme/" class="help-box" target="_blank">
      Productly Premium 
    </a>
  </div>
</div>
<div class="themepage-right">
        <a style="display:block;" href="http://vilhodesign.com/productly-theme/" target="_blank">
        <img src="http://vilhodesign.com/wp-content/uploads/2017/11/productlytheme.png"> 
        </a>
</div>
</div>
<?php }
