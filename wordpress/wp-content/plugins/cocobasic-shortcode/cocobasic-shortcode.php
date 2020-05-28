<?php

/*
  Plugin Name: CocoBasic - Caliris WP
  Description: User interface used in Caliris WP theme.
  Version: 1.3
  Author: CocoBasic
  Author URI: https://www.cocobasic.com
 */


if (!defined('ABSPATH'))
    die("Can't load this file directly");

class cocobasic_shortcodes {

    function __construct() {
        add_action('init', array($this, 'myplugin_load_textdomain'));
        add_action('admin_init', array($this, 'cocobasic_plugin_admin_enqueue_script'));
        add_action('wp_enqueue_scripts', array($this, 'cocobasic_plugin_enqueue_script'));
        add_action('init', array('cocobasicPageTemplater', 'get_instance'));
        if ((version_compare(get_bloginfo('version'), '5.0', '<')) || (class_exists( 'Classic_Editor' )) ) {
            add_action('admin_init', array($this, 'cocobasic_action_admin_init'));
        }
    }

    function cocobasic_action_admin_init() {
        // only hook up these filters if the current user has permission
        // to edit posts and pages
        if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
            add_filter('mce_buttons', array($this, 'cocobasic_filter_mce_button'));
            add_filter('mce_external_plugins', array($this, 'cocobasic_filter_mce_plugin'));
        }
    }

    function cocobasic_filter_mce_button($buttons) {
        // add a separation before the new button
        array_push($buttons, '|', 'cocobasic_shortcodes_button');
        return $buttons;
    }

    function cocobasic_filter_mce_plugin($plugins) {
        // this plugin file will work the magic of our button
        $plugins['shortcodes_options'] = plugin_dir_url(__FILE__) . 'editor_plugin.js';
        return $plugins;
    }

    function myplugin_load_textdomain() {
        load_plugin_textdomain('cocobasic-shortcode', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    function cocobasic_plugin_admin_enqueue_script() {
        wp_enqueue_style('colorpicker', plugins_url('css/colorpicker.css', __FILE__));
        wp_enqueue_style('admin-style', plugins_url('css/admin-style.css', __FILE__));

        wp_enqueue_script('colorpicker-js', plugins_url('js/colorpicker.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('cocobasic-admin-main-js', plugins_url('js/admin-main.js', __FILE__), array('jquery'), '', true);
    }

    function cocobasic_plugin_enqueue_script() {

        wp_enqueue_style('prettyPhoto', plugins_url('css/prettyPhoto.css', __FILE__));
        wp_enqueue_style('owl-carousel', plugins_url('css/owl.carousel.min.css', __FILE__));
        wp_enqueue_style('owl-theme-default', plugins_url('css/owl.theme.default.min.css', __FILE__));
        wp_enqueue_style('cocobasic-main-plugin-style', plugins_url('css/style.css', __FILE__));

        wp_enqueue_script('isotope', plugins_url('js/isotope.pkgd.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('imagesloaded', plugins_url('js/imagesloaded.pkgd.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('jquery-prettyPhoto', plugins_url('js/jquery.prettyPhoto.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('owl-carousel', plugins_url('js/owl.carousel.min.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('jquery-easing', plugins_url('js/jquery.easing.1.3.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_script('cocobasic-main-js', plugins_url('js/main.js', __FILE__), array('jquery'), '', true);


        //Infinite Loading JS variables for portfolio
        $portfolio_count_posts = wp_count_posts('portfolio');
        $portfolio_count_posts = $portfolio_count_posts->publish;


        wp_localize_script('cocobasic-main-js', 'ajax_var_portfolio', array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ajax-cocobasic-portfolio-load-more'),
            'total' => $portfolio_count_posts
        ));

        wp_localize_script('cocobasic-main-js', 'ajax_var_portfolio_content', array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ajax-cocobasic-portfolio-content')
        ));

        wp_localize_script('cocobasic-main-js', 'ajax_var_team', array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ajax-cocobasic-team-member')
        ));


        if (get_page_template_slug() == 'onepage.php') {
            $argCSS = '-1';
        } else {
            global $post;
            $argCSS = $post->ID;
        }
        $inlinePageCss = wp_strip_all_tags(cocobasic_inline_page_css($argCSS));
        wp_add_inline_style('cocobasic-main-plugin-style', $inlinePageCss);
    }

}

$cocobasic_shortcodes = new cocobasic_shortcodes();

add_theme_support('post-thumbnails', array('portfolio', 'team'));
add_action('add_meta_boxes', 'cocobasic_add_page_custom_meta_box');
add_action('init', 'cocobasic_allowed_plugin_html');
add_action('add_meta_boxes', 'cocobasic_add_portfolio_custom_meta_box');
add_action('add_meta_boxes', 'cocobasic_add_post_custom_meta_box');
add_action('add_meta_boxes', 'cocobasic_add_team_custom_meta_box');
add_action('save_post', 'cocobasic_save_page_custom_meta');
add_action('save_post', 'cocobasic_save_portfolio_custom_meta');
add_action('save_post', 'cocobasic_save_post_custom_meta');
add_action('save_post', 'cocobasic_save_team_custom_meta');
add_filter("the_content", "cocobasic_the_content_filter");
add_action('wp_ajax_team_ajax', 'cocobasic_member_load');
add_action('wp_ajax_nopriv_team_ajax', 'cocobasic_member_load');
add_action('wp_ajax_portfolio_ajax_content_load', 'cocobasic_portfolio_item_content_load');
add_action('wp_ajax_nopriv_portfolio_ajax_content_load', 'cocobasic_portfolio_item_content_load');
add_action('wp_ajax_portfolio_ajax_load_more', 'cocobasic_portfolio_load_more_item');
add_action('wp_ajax_nopriv_portfolio_ajax_load_more', 'cocobasic_portfolio_load_more_item');
add_filter('body_class', 'cocobasic_browserBodyClass');
add_filter('single_template', 'cocobasic_custom_single_post');

// <editor-fold defaultstate="collapsed" desc="Include Custom Signgle Post Templates">
function cocobasic_custom_single_post($template) {
    global $post;

    $arr = array("team", "portfolio");
    foreach ($arr as $value) {
        // Is this a "my-custom-post-type" post?
        if ($post->post_type == $value) {

            //Your plugin path 
            $plugin_path = plugin_dir_path(__FILE__);

            // The name of custom post type single template
            $template_name = 'single-' . $value . '.php';

            // A specific single template for my custom post type exists in theme folder?
            if ($template === get_stylesheet_directory() . '/' . $template_name) {

                //Then return "single.php" or "single-my-custom-post-type.php" from theme directory.
                return $template;
            }

            // If not, return my plugin custom post type template.
            return $plugin_path . 'templates/' . $template_name;
        }
    }

    //This is not my custom post type, do nothing with $template
    return $template;
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Include Custom Page Templates">
class cocobasicPageTemplater {

    /**
     * A reference to an instance of this class.
     */
    private static $instance;

    /**
     * The array of templates that this plugin tracks.
     */
    protected $templates;

    /**
     * Returns an instance of this class. 
     */
    public static function get_instance() {
        if (null == self::$instance) {
            self::$instance = new cocobasicPageTemplater();
        }
        return self::$instance;
    }

    /**
     * Initializes the plugin by setting filters and administration functions.
     */
    private function __construct() {
        $this->templates = array();
        // Add a filter to the attributes metabox to inject template into the cache.
        if (version_compare(get_bloginfo('version'), '4.7', '<')) {
            // 4.6 and older
            add_filter(
                    'page_attributes_dropdown_pages_args', array($this, 'register_project_templates')
            );
        } else {
            // Add a filter to the wp 4.7 version attributes metabox
            add_filter(
                    'theme_page_templates', array($this, 'add_new_template')
            );
        }
        // Add a filter to the save post to inject out template into the page cache
        add_filter(
                'wp_insert_post_data', array($this, 'register_project_templates')
        );
        // Add a filter to the template include to determine if the page has our 
        // template assigned and return it's path
        add_filter(
                'template_include', array($this, 'view_project_template')
        );
        // Add your templates to this array.
        $this->templates = array(
            'onepage.php' => 'OnePage',
            'page-split.php' => 'SplitPage'
        );
    }

    /**
     * Adds our template to the page dropdown for v4.7+
     *
     */
    public function add_new_template($posts_templates) {
        $posts_templates = array_merge($posts_templates, $this->templates);
        return $posts_templates;
    }

    /**
     * Adds our template to the pages cache in order to trick WordPress
     * into thinking the template file exists where it doens't really exist.
     */
    public function register_project_templates($atts) {
        // Create the key used for the themes cache
        $cache_key = 'page_templates-' . md5(get_theme_root() . '/' . get_stylesheet());
        // Retrieve the cache list. 
        // If it doesn't exist, or it's empty prepare an array
        $templates = wp_get_theme()->get_page_templates();
        if (empty($templates)) {
            $templates = array();
        }
        // New cache, therefore remove the old one
        wp_cache_delete($cache_key, 'themes');
        // Now add our template to the list of templates by merging our templates
        // with the existing templates array from the cache.
        $templates = array_merge($templates, $this->templates);
        // Add the modified cache to allow WordPress to pick it up for listing
        // available templates
        wp_cache_add($cache_key, $templates, 'themes', 1800);
        return $atts;
    }

    /**
     * Checks if the template is assigned to the page
     */
    public function view_project_template($template) {

        // Get global post
        global $post;
        // Return template if post is empty
        if (!$post) {
            return $template;
        }

        if (is_page_template()) {
            if (get_post_meta($post->ID, '_wp_page_template', true)) {
                if (file_exists(get_stylesheet_directory() . '/' . get_post_meta($post->ID, '_wp_page_template', true))) {
                    return get_stylesheet_directory() . '/' . get_post_meta($post->ID, '_wp_page_template', true);
                } elseif (file_exists(plugin_dir_path(__FILE__) . 'templates/' . get_post_meta($post->ID, '_wp_page_template', true))) {
                    return plugin_dir_path(__FILE__) . 'templates/' . get_post_meta($post->ID, '_wp_page_template', true);
                } else {
                    return $template;
                }
            }
        }
        return $template;
    }

}

//</editor-fold>
// <editor-fold defaultstate="collapsed" desc="Load Member with Ajax">
function cocobasic_member_load() {
    check_ajax_referer('ajax-cocobasic-team-member', 'security');
    if (isset($_POST["action"]) && ($_POST["action"] === 'team_ajax')) {
        $args = array(
            'p' => sanitize_text_field($_POST['member_id']),
            'post_type' => 'team',
            'posts_per_page' => 1
        );

        $member_query = new WP_Query($args);
        if (file_exists(get_stylesheet_directory() . '/single-team.php')) {
            require (get_stylesheet_directory() . '/single-team.php');
        } else {
            require ('templates/single-team.php');
        }
        exit;
    }
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Load Portfolio Item Content with Ajax">
function cocobasic_portfolio_item_content_load() {
    check_ajax_referer('ajax-cocobasic-portfolio-content', 'security');
    if (isset($_POST["action"]) && ($_POST["action"] === 'portfolio_ajax_content_load')) {
        $args = array(
            'p' => sanitize_text_field($_POST['portfolio_id']),
            'post_type' => 'portfolio',
            'posts_per_page' => 1
        );

        $portfolio_query = new WP_Query($args);
        if (file_exists(get_stylesheet_directory() . '/single-portfolio.php')) {
            require (get_stylesheet_directory() . '/single-portfolio.php');
        } else {
            require ('templates/single-portfolio.php');
        }
        exit;
    }
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Load Portfolio More Items with Ajax">
function cocobasic_portfolio_load_more_item() {
    check_ajax_referer('ajax-cocobasic-portfolio-load-more', 'security');
    if (isset($_POST["action"]) && ($_POST["action"] === 'portfolio_ajax_load_more')) {
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => sanitize_text_field($_POST['portfolio_posts_per_page']),
            'paged' => sanitize_text_field($_POST['portfolio_page_number'])
        );

        $portfolio_load_more_query = new WP_Query($args);
        if (file_exists(get_stylesheet_directory() . '/load-more-portfolio.php')) {
            require (get_stylesheet_directory() . '/load-more-portfolio.php');
        } else {
            require ('templates/load-more-portfolio.php');
        }
        exit;
    }
}

// </editor-fold>
//<editor-fold defaultstate="collapsed" desc="Inline Page CSS">
function cocobasic_inline_page_css($pageID) {
    if ($pageID != "-1") {
        $args = array('p' => $pageID, 'post_type' => 'page', 'posts_per_page' => '1');
    } else {
        $args = array('post_type' => 'page', 'posts_per_page' => '-1', 'orderby' => 'menu_order', 'order' => 'ASC');
    }
    $inlinePageCss = '';
    $inlineBigNumberCss = '';
    $loop = new WP_Query($args);
    global $post;
    if ($loop->have_posts()) :
        while ($loop->have_posts()) : $loop->the_post();
            if ('onepage.php' != get_page_template_slug($post->ID)) {
                $inlinePageCss .= '.section.post-' . $post->ID . '{';
                if (get_post_meta($post->ID, "page_background_img", true) != ''):
                    $inlinePageCss .= 'background-image: url("' . get_post_meta($post->ID, "page_background_img", true) . '"); ';
                endif;

                if (get_post_meta($post->ID, "page_background_color", true) != ''):
                    $inlinePageCss .= 'background-color:' . get_post_meta($post->ID, "page_background_color", true) . '; ';
                endif;

                if (get_post_meta($post->ID, "page_img_position", true) != ''):
                    $inlinePageCss .= 'background-position:' . get_post_meta($post->ID, "page_img_position", true) . '; ';
                endif;

                if (get_post_meta($post->ID, "page_img_repeat", true) != ''):
                    $inlinePageCss .= 'background-repeat:' . get_post_meta($post->ID, "page_img_repeat", true) . '; ';
                endif;

                if (get_post_meta($post->ID, "page_img_size", true) != ''):
                    $inlinePageCss .= 'background-size:' . get_post_meta($post->ID, "page_img_size", true) . '; ';
                endif;

                if (get_post_meta($post->ID, "page_custom_css", true) != ''):
                    $inlinePageCss .= get_post_meta($post->ID, "page_custom_css", true) . ' ';
                endif;

                $inlinePageCss .= '} ';
                $inlineBigNumberCss .= '.section.post-' . $post->ID . ' .section-title-holder {';
                if (get_post_meta($post->ID, "page_big_number_color", true) != ''):
                    $inlineBigNumberCss .= 'color:' . get_post_meta($post->ID, "page_big_number_color", true) . '; ';
                endif;
                $inlineBigNumberCss .= '} ';
            }
        endwhile;
    endif;
    wp_reset_postdata();
    return $inlinePageCss . $inlineBigNumberCss;
}

// </editor-fold>
//<editor-fold defaultstate="collapsed" desc="Columns shortcode">
function cocobasic_col($atts, $content = null) {
    extract(shortcode_atts(array(
        "size" => 'one',
        "class" => ''
                    ), $atts));

    switch ($size) {
        case "one":
            $return = '<div class = "one ' . $class . '">
    ' . do_shortcode($content) . '
    </div><div class = "clear"></div>';
            break;
        case "one_half_last":
            $return = '<div class = "one_half last ' . $class . '">' . do_shortcode($content) . '</div><div class = "clear"></div>';
            break;
        case "one_third_last":
            $return = '<div class = "one_third last ' . $class . '">' . do_shortcode($content) . '</div><div class = "clear"></div>';
            break;
        case "two_third_last":
            $return = '<div class = "two_third last ' . $class . '">' . do_shortcode($content) . '</div><div class = "clear"></div>';
            break;
        case "one_fourth_last":
            $return = '<div class = "one_fourth last ' . $class . '">' . do_shortcode($content) . '</div><div class = "clear"></div>';
            break;
        case "three_fourth_last":
            $return = '<div class = "three_fourth last ' . $class . '">' . do_shortcode($content) . '</div><div class = "clear"></div>';
            break;
        default:
            $return = '<div class = "' . $size . ' ' . $class . '">' . do_shortcode($content) . '</div>';
    }

    return $return;
}

add_shortcode("col", "cocobasic_col");

// </editor-fold>
//<editor-fold defaultstate="collapsed" desc="BR shortcode">
function cocobasic_br($atts, $content = null) {
    return '<br />';
}

add_shortcode("br", "cocobasic_br");

//</editor-fold>
// <editor-fold defaultstate="collapsed" desc="Button shortcode">
function cocobasic_button($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => '',
        "target" => '_self',
        "href" => '#',
        "position" => 'left'
                    ), $atts));

    switch ($position) {
        case 'center':
            $position = "center-text";
            break;
        case 'right':
            $position = "text-right";
            break;
        default:
            $position = "text-left";
    }

    $return = '<div class="' . $position . '"><a href="' . $href . '" target="' . $target . '" class="button ' . $class . '">' . do_shortcode($content) . '</a></div>';

    return $return;
}

add_shortcode("button", "cocobasic_button");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Service shortcode">
function cocobasic_service($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => '',
        "title" => '',
        "img" => '',
        "alt" => ''
                    ), $atts));

    $return = '<div class="service-item relative ' . $class . '"><img class="service-icon" src="' . $img . '" alt="' . $alt . '"/><p class="service-title">' . $title . '</p><div class="service-content">' . do_shortcode($content) . '</div></div>';


    return $return;
}

add_shortcode("service", "cocobasic_service");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Medium Text shortcode">
function cocobasic_med_text($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => ''
                    ), $atts));

    $return = '<p class="medium-text ' . $class . '">' . do_shortcode($content) . '</p>';

    return $return;
}

add_shortcode("med_text", "cocobasic_med_text");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Big Text shortcode">
function cocobasic_big_text($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => ''
                    ), $atts));

    $return = '<h1 class="big-text ' . $class . '">' . do_shortcode($content) . '</h1>';

    return $return;
}

add_shortcode("big_text", "cocobasic_big_text");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Image Slider holder short code">
function cocobasic_image_slider($atts, $content = null) {
    extract(shortcode_atts(array(
        "name" => 'slider',
        "auto" => 'true',
        "hover_pause" => 'true',
        "items" => '1',
        "speed" => '750'
                    ), $atts));


    $return = '<script> var ' . $name . '_speed = "' . $speed . '";
                var ' . $name . '_auto = "' . $auto . '";                
                var ' . $name . '_hover = "' . $hover_pause . '";                
                var ' . $name . '_items = "' . $items . '";                
    </script>
    <div class="image-slider-wrapper relative">
    <div id = ' . $name . ' class = "owl-carousel owl-theme image-slider slider">
            ' . do_shortcode($content) . '
        </div>';


    $return .= '<div class = "clear"></div></div>';

    return $return;
}

add_shortcode("image_slider", "cocobasic_image_slider");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Image Slide short code">
function cocobasic_image_slide($atts, $content = null) {
    extract(shortcode_atts(array(
        "img" => '',
        "href" => '',
        "alt" => '',
        "target" => '_self'
                    ), $atts));
    if ($href != '') {
        return '<div><a href="' . $href . '" target="' . $target . '"><img src = "' . $img . '" alt = "' . $alt . '" /></a></div>';
    } else {
        return '<div><img src = "' . $img . '" alt = "' . $alt . '" /></div>';
    }
}

add_shortcode("image_slide", "cocobasic_image_slide");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Portfolio shortcode">
function cocobasic_portfolio($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => '',
        "show" => '5'
                    ), $atts));

    $return = '<div id="portfolio-wrapper"><div class="portfolio-load-content-holder"></div>';

    global $post;
    $args = array('post_type' => 'portfolio', 'posts_per_page' => $show);
    $loop = new WP_Query($args);
    if ($loop->have_posts()) :
        $return .= '<div class="grid" id="portfolio-grid"><div class="gutter-sizer"></div><div class="grid-sizer"></div>';
        while ($loop->have_posts()) : $loop->the_post();
            if (has_post_thumbnail($post->ID)) {
                $portfolio_post_thumb = get_the_post_thumbnail();
            } else {
                $portfolio_post_thumb = '<img src = "' . plugin_dir_url(__FILE__) . '/images/no-photo.png" alt = "" />';
            }

            $p_size = get_post_meta($post->ID, "portfolio_thumb_image_size", true);

            if (get_post_meta($post->ID, "portfolio_hover_thumb_title", true) != ''):
                $p_thumb_title = get_post_meta($post->ID, "portfolio_hover_thumb_title", true);
            else:
                $p_thumb_title = get_the_title();
            endif;

            $p_thumb_text = get_post_meta($post->ID, "portfolio_hover_thumb_text", true);
            $link_thumb_to = get_post_meta($post->ID, "portfolio_link_item_to", true);

            switch ($link_thumb_to):
                case 'link_to_image_url':
                    $image_popup = get_post_meta($post->ID, "portfolio_image_popup", true);
                    $return .= '<div class="grid-item element-item ' . $p_size . '"><a class="item-link" href="' . $image_popup . '" data-rel="prettyPhoto[gallery1]">';
                    break;
                case 'link_to_video_url':
                    $video_popup = get_post_meta($post->ID, "portfolio_video_popup", true);
                    $return .= '<div class="grid-item element-item ' . $p_size . '"><a class="item-link" href="' . $video_popup . '" data-rel="prettyPhoto[gallery1]">';
                    break;
                case 'link_to_extern_url':
                    $extern_site_url = get_post_meta($post->ID, "portfolio_extern_site_url", true);
                    $return .= '<div class="grid-item element-item ' . $p_size . '"><a class="item-link" href="' . $extern_site_url . '" target="_blank">';
                    break;

                default:
                    $return .= '<div id="p-item-' . $post->ID . '" class="grid-item element-item ' . $p_size . '"><a class="item-link ajax-portfolio" href="' . get_permalink() . '" data-id="' . $post->ID . '">';
            endswitch;

            $return .= $portfolio_post_thumb . '<div class="portfolio-text-holder"><p class="portfolio-title">' . $p_thumb_title . '</p><p class="portfolio-desc">' . $p_thumb_text . '</p></div><p class="portfolio-plus"><img src="' . plugin_dir_url(__FILE__) . '/images/icon_plus.png" alt="" /></p></a></div>';

        endwhile;

        $return .= '</div>';
    endif;
    $return .= '<div class="clear"></div></div><div class = "block center-relative center-text more-posts-portfolio-holder"><a target = "_self" class = "more-posts-portfolio"><img src="' . plugin_dir_url(__FILE__) . '/images/icon_plus.png" alt="" /></a><a class = "more-posts-portfolio-loading"><img src="' . plugin_dir_url(__FILE__) . '/images/icon_plus.png" alt="" /></a><a class = "no-more-posts-portfolio"><img src="' . plugin_dir_url(__FILE__) . '/images/icon_plus.png" alt="" /></a></div>';
    wp_reset_postdata();
    return $return;
}

add_shortcode("portfolio", "cocobasic_portfolio");

//</editor-fold>
// <editor-fold defaultstate="collapsed" desc="Vertical Skills Holder shortcode">
function cocobasic_v_skills($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => ''
                    ), $atts));

    $return = '<div class="v-skills-holder ' . $class . '">' . do_shortcode($content) . '</div>';
    return $return;
}

add_shortcode("v_skills", "cocobasic_v_skills");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Vertical Skill shortcode">
function cocobasic_v_skill($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => '',
        "percent" => '50%',
        "text" => 'PhP',
        "color" => '#27E0C0'
                    ), $atts));

    $return = '<div class="v-skill ' . $class . '"><div class="v-skill-fill" style="width: ' . $percent . '; height:' . $percent . '; background-color: ' . $color . '"></div><div class="v-skill-text" style="bottom:' . $percent . ';"><span style="color: ' . $color . ';">' . $percent . '</span>' . $text . '</div></div>';
    return $return;
}

add_shortcode("v_skill", "cocobasic_v_skill");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Pulse shortcode">
function cocobasic_pulse($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => '',
                    ), $atts));

    $return = '<div class="sonar-wrapper"><div class="sonar-emitter"><div class="sonar-wave"></div></div>' . do_shortcode($content) . '</div>';
    return $return;
}

add_shortcode("pulse", "cocobasic_pulse");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Video PopUP shortcode">
function cocobasic_video_up($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => '',
        "name" => 'video1',
        "video" => ''
                    ), $atts));

    $return = '<a class="video-popup-holder ' . $class . '" href="' . $video . '" data-rel="prettyPhoto[gallery-' . $name . ']"><p class="popup-play"></p></a>';
    return $return;
}

add_shortcode("video_up", "cocobasic_video_up");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Info shortcode">
function cocobasic_info($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => '',
                    ), $atts));

    $return = '<div class="info-text">' . do_shortcode($content) . '</div>';
    return $return;
}

add_shortcode("info", "cocobasic_info");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Show Team Members shortcode">
function cocobasic_show_team($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => '',
        "col" => '3'
                    ), $atts));

    switch ($col):
        case '2': $col = "one_half";
            break;
        case '3': $col = "one_third";
            break;
        case '4': $col = "one_fourth";
            break;
        default: $col = "one_third";
    endswitch;

    $return = '<div id="team-holder"><div class="team-load-content-holder"></div>';

    global $post;
    $args = array('post_type' => 'team', 'posts_per_page' => '-1');
    $loop = new WP_Query($args);
    if ($loop->have_posts()) :
        $return .= '<ul class="member-holder-wrapper">';
        while ($loop->have_posts()) : $loop->the_post();
            $return .= '<li class="member-holder ' . $col . '"><a class="img-link" href="' . get_permalink() . '" data-id="' . $post->ID . '">' . get_the_post_thumbnail() . '<div class="member-mask"><img src="' . plugin_dir_url(__FILE__) . '/images/icon_plus.png" alt="" /></div></a><p class="member-name">' . get_the_title() . '</p><p class="member-position">' . get_post_meta($post->ID, "team_member_position", true) . '</p></li>';
        endwhile;
        $return .= '</ul>';
    endif;
    $return .= '<div class="clear"></div></div>';
    wp_reset_postdata();
    return $return;
}

add_shortcode("show_team", "cocobasic_show_team");

//</editor-fold>
// <editor-fold defaultstate="collapsed" desc="Latest posts shortcode">
function cocobasic_latest_posts($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => '',
        "num" => 5,
        "more" => ''
                    ), $atts));
    global $post;

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $num
    );


    $loop = new WP_Query($args);
    $return = '<div class="blog-holder-scode latest-posts-scode block center-relative">';

    while ($loop->have_posts()) : $loop->the_post();
        $cat = '';
        foreach ((get_the_category()) as $category) {
            $cat .= '<li><a href = "' . get_category_link($category->term_id) . '">' . $category->name . '</a></li > ';
        }
        $return .= '<article id="post-' . $post->ID . '"  class="relative blog-item-holder-scode">';
        $return .= '<h4 class="entry-title"><a href="' . get_permalink($post->ID) . '">' . get_the_title() . '</a></h4>
                    <div class="entry-date published">' . get_the_date('j M Y') . '</div>
		                            <div class="cat-links">
                            <ul>
                            ' . $cat . '                              
                            </ul>
                        </div>';

        $return .= '</article>';

    endwhile;

    if ($more != '') {
        $return .= '<div class="more-posts-link"><a href="' . $more . '"><img src="' . plugin_dir_url(__FILE__) . '/images/arrow_right@2x.png" alt="" /></a></div>';
    }

    $return .= '<div class="clear"></div></div>';
    wp_reset_postdata();
    return $return;
}

add_shortcode("latest_posts", "cocobasic_latest_posts");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Register custom 'team' post type">
function create_team() {
    $team_args = array(
        'label' => esc_html__('Team', 'cocobasic-shortcode'),
        'singular_label' => esc_html__('Team', 'cocobasic-shortcode'),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => true,
        'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
        'show_in_rest' => true
    );
    register_post_type('team', $team_args);
}

add_action('init', 'create_team');

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Register custom 'portfolio' post type">
function create_portfolio() {
    $portfolio_args = array(
        'label' => esc_html__('Portfolio', 'cocobasic-shortcode'),
        'singular_label' => esc_html__('Portfolio', 'cocobasic-shortcode'),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => true,
        'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
        'show_in_rest' => true
    );
    register_post_type('portfolio', $portfolio_args);
}

add_action('init', 'create_portfolio');

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Add the Meta Box to 'Portfolio' posts"> 
function cocobasic_add_portfolio_custom_meta_box() {
    add_meta_box(
            'cocobasic_portfolio_custom_meta_box', // $id  
            esc_html__('Portfolio Preference', 'cocobasic-shortcode'), // $title   
            'cocobasic_show_portfolio_custom_meta_box', // $callback  
            'portfolio', // $page  
            'normal', // $context  
            'high'); // $priority     
}

// Field Array Post Page 
$prefix = 'portfolio_';
$portfolio_custom_meta_fields = array(
    array(
        'label' => esc_html__('Custom thumb title on mouse over', 'cocobasic-shortcode'),
        'desc' => esc_html__('by default is used item title', 'cocobasic-shortcode'),
        'id' => $prefix . 'hover_thumb_title',
        'type' => 'text'
    ),
    array(
        'label' => esc_html__('Thumb text on mouse over (second line)', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'hover_thumb_text',
        'type' => 'text'
    ),
    array(
        'label' => esc_html__('Thumb image size', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'thumb_image_size',
        'type' => 'select',
        'options' => array(
            'one' => array(
                'label' => '50%',
                'value' => 'p_one_half'
            ),
            'two' => array(
                'label' => '100%',
                'value' => 'p_one'
            )
        )
    ),
    array(
        'label' => esc_html__('Link thumb to', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'link_item_to',
        'type' => 'select',
        'options' => array(
            'one' => array(
                'label' => esc_html__('This post', 'cocobasic-shortcode'),
                'value' => 'link_to_this_post'
            ),
            'two' => array(
                'label' => esc_html__('Image', 'cocobasic-shortcode'),
                'value' => 'link_to_image_url'
            ),
            'three' => array(
                'label' => esc_html__('Video', 'cocobasic-shortcode'),
                'value' => 'link_to_video_url'
            ),
            'four' => array(
                'label' => esc_html__('External URL', 'cocobasic-shortcode'),
                'value' => 'link_to_extern_url'
            )
        )
    ),
    array(
        'label' => esc_html__('Link thumb to Image:', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'image_popup',
        'type' => 'text'
    ),
    array(
        'label' => esc_html__('Link thumb to Video', 'cocobasic-shortcode'),
        'desc' => esc_html__('For example: http://vimeo.com/XXXXXX or http://www.youtube.com/watch?v=XXXXXX', 'cocobasic-shortcode'),
        'id' => $prefix . 'video_popup',
        'type' => 'text'
    ),
    array(
        'label' => esc_html__('Link thumb to External URL:', 'cocobasic-shortcode'),
        'desc' => esc_html__('Set URL to external site', 'cocobasic-shortcode'),
        'id' => $prefix . 'extern_site_url',
        'type' => 'text'
    )
);

// The Callback  
function cocobasic_show_portfolio_custom_meta_box() {
    global $portfolio_custom_meta_fields, $post;
    $allowed_plugin_tags = cocobasic_allowed_plugin_html();
// Use nonce for verification  
    echo '<input type="hidden" name="custom_meta_box_nonce" value="' . esc_attr(wp_create_nonce(basename(__FILE__))) . '" />';
// Begin the field table and loop  
    echo '<table class="form-table">';
    foreach ($portfolio_custom_meta_fields as $field) {
// get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);
// begin a table row with  
        echo '<tr> 
                <th><label for="' . esc_attr($field['id']) . '">' . esc_attr($field['label']) . '</label></th> 
                <td>';
        switch ($field['type']) {
// case items will go here  
// text  
            case 'text':

                if ($field['id'] == 'portfolio_image_popup') {
                    echo '<label for="upload_image">
				<input id="' . esc_attr($field['id']) . '" class="image-url-input" type="text" size="36" name="' . esc_attr($field['id']) . '" value="' . esc_attr($meta) . '" /> 
				<input id="upload_image_button" class="button" type="button" value="' . esc_attr__('Upload Image', 'cocobasic-shortcode') . '" />
                                <br /><span class="image-upload-desc">' . esc_html($field['desc']) . '</span>                                                                    
                                <span id="small-background-image-preview" class="has-background"></span>				
				</label>';
                } else {
                    echo '<input type="text" name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" value="' . esc_attr($meta) . '" size="50" /> 
						<br /><span class="description">' . esc_html($field['desc']) . '</span>';
                }
                break;
// select  
            case 'select':
                echo '<select name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="' . esc_attr($option['value']) . '">' . esc_html($option['label']) . '</option>';
                }
                echo '</select><br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
// textarea  
            case 'textarea':
                echo '<textarea name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" cols="60" rows="4">' . wp_kses($meta, $allowed_plugin_tags) . '</textarea> 
					<br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
        } //end switch  
        echo '</td></tr>';
    } // end foreach  
    echo '</table>'; // end table  
}

// Save the Data  
function cocobasic_save_portfolio_custom_meta($post_id) {
    global $portfolio_custom_meta_fields;
    $allowed_plugin_tags = cocobasic_allowed_plugin_html();
// verify nonce  
    if (isset($_POST['custom_meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }
// check autosave  
// Stop WP from clearing custom fields on autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
// Prevent quick edit from clearing custom fields
    if (defined('DOING_AJAX') && DOING_AJAX)
        return;
// check permissions  
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
// loop through fields and save the data  
    foreach ($portfolio_custom_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = null;
        if (isset($_POST[$field['id']])) {
            $new = $_POST[$field['id']];
        }
        if ($new && $new != $old) {
            $new = wp_kses($new, $allowed_plugin_tags);
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach  
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Add the Meta Box to 'Pages'"> 
function cocobasic_add_page_custom_meta_box() {
    add_meta_box(
            'cocobasic_page_custom_meta_box', // $id  
            esc_html__('Page Preference', 'cocobasic-shortcode'), // $title   
            'cocobasic_show_page_custom_meta_box', // $callback  
            'page', // $page  
            'normal', // $context  
            'high'); // $priority     
}

// Field Array Post Page 
$prefix = 'page_';

$page_custom_meta_fields = array(
    array(
        'label' => __('Page Structure', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'structure',
        'type' => 'select',
        'options' => array(
            'one' => array(
                'label' => __('Separated / Stand Alone Page', 'cocobasic-shortcode'),
                'value' => '1'
            ),
            'two' => array(
                'label' => __('Include in One Page', 'cocobasic-shortcode'),
                'value' => '2'
            )
        )
    ),
    array(
        'label' => __('Show Page Title', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'show_title',
        'type' => 'select',
        'options' => array(
            'one' => array(
                'label' => 'Yes',
                'value' => 'yes'
            ),
            'two' => array(
                'label' => 'No',
                'value' => 'no'
            )
        )
    ),
    array(
        'label' => __('Page Custom Title', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'custom_title',
        'type' => 'text'
    ),
    array(
        'label' => __('Page Description', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'description',
        'type' => 'textarea'
    ),
    array(
        'label' => __('Big Number / Text', 'cocobasic-shortcode'),
        'desc' => __('big number above the title', 'cocobasic-shortcode'),
        'id' => $prefix . 'big_number',
        'type' => 'text'
    ),
    array(
        'label' => __('Small Number / Text', 'cocobasic-shortcode'),
        'desc' => __('small number above the title', 'cocobasic-shortcode'),
        'id' => $prefix . 'small_number',
        'type' => 'text'
    ),
    array(
        'label' => __('Big Number Color', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'big_number_color',
        'type' => 'text'
    ),
    array(
        'label' => __('Full Screen Page', 'cocobasic-shortcode'),
        'desc' => __('minimal page height to fit screen', 'cocobasic-shortcode'),
        'id' => $prefix . 'full_screen',
        'type' => 'select',
        'options' => array(
            'one' => array(
                'label' => 'No',
                'value' => 'no'
            ),
            'two' => array(
                'label' => 'Yes',
                'value' => 'yes'
            )
        )
    ),
    array(
        'label' => __('Page Title Position', 'cocobasic-shortcode'),
        'desc' => __('*only for SplitPage template', 'cocobasic-shortcode'),
        'id' => $prefix . 'title_position',
        'type' => 'select',
        'options' => array(
            'one' => array(
                'label' => __('Left', 'cocobasic-shortcode'),
                'value' => 'left'
            ),
            'two' => array(
                'label' => __('Right', 'cocobasic-shortcode'),
                'value' => 'right'
            )
        )
    ),
    array(
        'label' => __('Page Title Background Image URL', 'cocobasic-shortcode'),
        'desc' => __('background image for the title (corner image)', 'cocobasic-shortcode'),
        'id' => $prefix . 'background_img_title',
        'type' => 'text'
    ),
    array(
        'label' => __('Page Title Background Color', 'cocobasic-shortcode'),
        'desc' => __('backup for "Page Title Background Image" on small resolution', 'cocobasic-shortcode'),
        'id' => $prefix . 'background_color_title',
        'type' => 'text'
    ),
    array(
        'label' => __('Page Background Color', 'cocobasic-shortcode'),
        'desc' => __('background color for a whole page', 'cocobasic-shortcode'),
        'id' => $prefix . 'background_color',
        'type' => 'text'
    ),
    array(
        'label' => __('Page Background Image URL', 'cocobasic-shortcode'),
        'desc' => __('background image for a whole page', 'cocobasic-shortcode'),
        'id' => $prefix . 'background_img',
        'type' => 'text'
    ),
    array(
        'label' => __('Background Image Position', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'img_position',
        'type' => 'select',
        'options' => array(
            'one' => array(
                'label' => 'Left Top',
                'value' => 'left top'
            ),
            'two' => array(
                'label' => 'Left Center',
                'value' => 'left center'
            ),
            'three' => array(
                'label' => 'Left Bottom',
                'value' => 'left bottom'
            ),
            'four' => array(
                'label' => 'Center Top',
                'value' => 'center top'
            ),
            'five' => array(
                'label' => 'Center Center',
                'value' => 'center center'
            ),
            'six' => array(
                'label' => 'Center Bottom',
                'value' => 'center bottom'
            ),
            'seven' => array(
                'label' => 'Right Top',
                'value' => 'right top'
            ),
            'eight' => array(
                'label' => 'Right Center',
                'value' => 'right center'
            ),
            'nine' => array(
                'label' => 'Right Bottom',
                'value' => 'right bottom'
            )
        )
    ),
    array(
        'label' => __('Background Image Repeat', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'img_repeat',
        'type' => 'select',
        'options' => array(
            'one' => array(
                'label' => 'No Repeat',
                'value' => 'no-repeat'
            ),
            'two' => array(
                'label' => 'Repeat-X',
                'value' => 'repeat-x'
            ),
            'three' => array(
                'label' => 'Repeat-Y',
                'value' => 'repeat-y'
            ),
            'four' => array(
                'label' => 'Repeat All',
                'value' => 'repeat'
            )
        )
    ), array(
        'label' => __('Background Image Size', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'img_size',
        'type' => 'select',
        'options' => array(
            'one' => array(
                'label' => 'Auto',
                'value' => 'auto'
            ),
            'two' => array(
                'label' => 'Cover',
                'value' => 'cover'
            ),
            'three' => array(
                'label' => 'Contain',
                'value' => 'contain'
            ),
            'fourth' => array(
                'label' => 'Width 100%',
                'value' => '100% auto'
            )
        )
    ),
    array(
        'label' => __('Page Custom CSS', 'cocobasic-shortcode'),
        'desc' => __('additional CSS just for this page (optional)', 'cocobasic-shortcode'),
        'id' => $prefix . 'custom_css',
        'type' => 'textarea'
    )
);

// The Callback  
function cocobasic_show_page_custom_meta_box() {
    global $page_custom_meta_fields, $post;
    $allowed_plugin_tags = cocobasic_allowed_plugin_html();
// Use nonce for verification  
    echo '<input type="hidden" name="custom_meta_box_nonce" value="' . esc_attr(wp_create_nonce(basename(__FILE__))) . '" />';
// Begin the field table and loop  
    echo '<table class="form-table">';
    foreach ($page_custom_meta_fields as $field) {
// get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);
// begin a table row with  
        echo '<tr class="' . $field['id'] . '"> 
                <th><label for="' . esc_attr($field['id']) . '">' . esc_attr($field['label']) . '</label></th> 
                <td>';
        switch ($field['type']) {
// case items will go here  
// text  
            case 'text':
                if ($field['id'] == 'page_background_img_title') {
                    echo '<label for="upload_image">
				<input id="' . esc_attr($field['id']) . '" class="image-url-input" type="text" size="36" name="' . esc_attr($field['id']) . '" value="' . esc_attr($meta) . '" /> 
				<input id="upload_image_button" class="button" type="button" value="' . esc_attr__('Upload Image', 'cocobasic-shortcode') . '" />
                                <br /><span class="image-upload-desc">' . esc_html($field['desc']) . '</span>                                                                    
                                <span id="small-background-image-preview" class="has-background"></span>				
				</label>';
                } elseif ($field['id'] == 'page_background_img') {
                    echo '<label for="upload_image">
				<input id="' . esc_attr($field['id']) . '" class="image-url-input" type="text" size="36" name="' . esc_attr($field['id']) . '" value="' . esc_attr($meta) . '" /> 
				<input id="upload_image_button2" class="button" type="button" value="' . esc_attr__('Upload Image', 'cocobasic-shortcode') . '" />
                                <br /><span class="image-upload-desc">' . esc_html($field['desc']) . '</span>                                                                    
                                <span id="small-background-image-preview2" class="has-background"></span>				
				</label>';
                } elseif ($field['id'] == 'page_background_color') {
                    echo '<div id="colorPageBackgroundColor"><div></div></div>
                      <input style="display:none" type="text" name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" value="' . esc_attr($meta) . '" size="50" /> 
                        <br /><span class="description">' . esc_html($field['desc']) . '</span>';
                } elseif ($field['id'] == 'page_background_color_title') {
                    echo '<div id="colorPageTitleBackgroundColor"><div></div></div>
                      <input style="display:none" type="text" name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" value="' . esc_attr($meta) . '" size="50" /> 
                        <br /><span class="description">' . esc_html($field['desc']) . '</span>';
                } elseif ($field['id'] == 'page_big_number_color') {
                    echo '<div id="colorBigNumberColor"><div></div></div>
                      <input style="display:none" type="text" name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" value="' . esc_attr($meta) . '" size="50" /> 
                        <br /><span class="description">' . esc_html($field['desc']) . '</span>';
                } else {
                    echo '<input type="text" name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" value="' . esc_attr($meta) . '" size="50" /> 
						<br /><span class="description">' . esc_html($field['desc']) . '</span>';
                }
                break;
// select  
            case 'select':
                echo '<select name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="' . esc_attr($option['value']) . '">' . esc_html($option['label']) . '</option>';
                }
                echo '</select><br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
// textarea  
            case 'textarea':
                echo '<textarea name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" cols="60" rows="4">' . wp_kses($meta, $allowed_plugin_tags) . '</textarea> 
					<br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
        } //end switch  
        echo '</td></tr>';
    } // end foreach  
    echo '</table>'; // end table  
}

// Save the Data  
function cocobasic_save_page_custom_meta($post_id) {
    global $page_custom_meta_fields, $post;


    $allowed_plugin_tags = cocobasic_allowed_plugin_html();
// verify nonce  
    if (isset($_POST['custom_meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }
// check autosave  
// Stop WP from clearing custom fields on autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
// Prevent quick edit from clearing custom fields
    if (defined('DOING_AJAX') && DOING_AJAX)
        return;
// check permissions  
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
// loop through fields and save the data  
    foreach ($page_custom_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = null;
        if (isset($_POST[$field['id']])) {
            $new = $_POST[$field['id']];
        }
        if ($new && $new != $old) {
            $new = wp_kses($new, $allowed_plugin_tags);
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach  
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Add the Meta Box to 'Posts' regular"> 
function cocobasic_add_post_custom_meta_box() {
    add_meta_box(
            'cocobasic_post_custom_meta_box', // $id  
            esc_html__('Post Preference', 'cocobasic-shortcode'), // $title   
            'cocobasic_show_post_custom_meta_box', // $callback  
            'post', // $page  
            'normal', // $context  
            'high'); // $priority     
}

// Field Array Post Page 
$prefix = 'post_';
$post_custom_meta_fields = array(
    array(
        'label' => esc_html__('Show Featured Image on Single Post', 'cocobasic-shortcode'),
        'desc' => esc_html__('Note: Featured image on Blog page will be still visible', 'cocobasic-shortcode'),
        'id' => $prefix . 'show_featured_image',
        'type' => 'select',
        'options' => array(
            'one' => array(
                'label' => esc_html__('Yes', 'cocobasic-shortcode'),
                'value' => 'yes'
            ),
            'two' => array(
                'label' => esc_html__('No', 'cocobasic-shortcode'),
                'value' => 'no'
            )
        )
    ),
    array(
        'label' => __('Post Header Content', 'cocobasic-shortcode'),
        'desc' => esc_html__('set slider, vimeo or youtube iframe video in header', 'cocobasic-shortcode'),
        'id' => $prefix . 'header_content',
        'type' => 'textarea'
    )
);

// The Callback  
function cocobasic_show_post_custom_meta_box() {
    global $post_custom_meta_fields, $post;
    $allowed_plugin_tags = cocobasic_allowed_plugin_html();
// Use nonce for verification  
    echo '<input type="hidden" name="custom_meta_box_nonce" value="' . esc_attr(wp_create_nonce(basename(__FILE__))) . '" />';
// Begin the field table and loop  
    echo '<table class="form-table">';
    foreach ($post_custom_meta_fields as $field) {
// get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);
// begin a table row with  
        echo '<tr> 
                <th><label for="' . esc_attr($field['id']) . '">' . esc_attr($field['label']) . '</label></th> 
                <td>';
        switch ($field['type']) {
// case items will go here 
// select  
            case 'text':
                echo '<input type="text" name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" value="' . esc_attr($meta) . '" size="50" /> 
						<br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
            // select  
            case 'select':
                echo '<select name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="' . esc_attr($option['value']) . '">' . esc_html($option['label']) . '</option>';
                }
                echo '</select><br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
            // textarea  
            case 'textarea':
                echo '<textarea name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" cols="60" rows="4">' . wp_kses($meta, $allowed_plugin_tags) . '</textarea> 
					<br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
        } //end switch  
        echo '</td></tr>';
    } // end foreach  
    echo '</table>'; // end table  
}

// Save the Data  
function cocobasic_save_post_custom_meta($post_id) {
    global $post_custom_meta_fields;
    $allowed_plugin_tags = cocobasic_allowed_plugin_html();
// verify nonce  
    if (isset($_POST['custom_meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }
// check autosave  
// Stop WP from clearing custom fields on autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
// Prevent quick edit from clearing custom fields
    if (defined('DOING_AJAX') && DOING_AJAX)
        return;
// check permissions  
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
// loop through fields and save the data  
    foreach ($post_custom_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = null;
        if (isset($_POST[$field['id']])) {
            $new = $_POST[$field['id']];
        }
        if ($new && $new != $old) {
            $new = wp_kses($new, $allowed_plugin_tags);
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach  
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Add the Meta Box to 'Team' posts"> 
function cocobasic_add_team_custom_meta_box() {
    add_meta_box(
            'cocobasic_team_custom_meta_box', // $id  
            esc_html__('Team Preference', 'cocobasic-shortcode'), // $title   
            'cocobasic_show_team_custom_meta_box', // $callback  
            'team', // $page  
            'normal', // $context  
            'high'); // $priority     
}

// Field Array Post Page 
$prefix = 'team_';
$team_custom_meta_fields = array(
    array(
        'label' => __('Member Position', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'member_position',
        'type' => 'text'
    )
);

// The Callback  
function cocobasic_show_team_custom_meta_box() {
    global $team_custom_meta_fields, $post;
    $allowed_plugin_tags = cocobasic_allowed_plugin_html();
// Use nonce for verification  
    echo '<input type="hidden" name="custom_meta_box_nonce" value="' . esc_attr(wp_create_nonce(basename(__FILE__))) . '" />';
// Begin the field table and loop  
    echo '<table class="form-table">';
    foreach ($team_custom_meta_fields as $field) {
// get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);
// begin a table row with  
        echo '<tr> 
                <th><label for="' . esc_attr($field['id']) . '">' . esc_attr($field['label']) . '</label></th> 
                <td>';
        switch ($field['type']) {
// case items will go here 
// select  
            case 'text':
                echo '<input type="text" name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" value="' . esc_attr($meta) . '" size="50" /> 
						<br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
            // select  
            case 'select':
                echo '<select name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="' . esc_attr($option['value']) . '">' . esc_html($option['label']) . '</option>';
                }
                echo '</select><br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
            // textarea  
            case 'textarea':
                echo '<textarea name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" cols="60" rows="4">' . wp_kses($meta, $allowed_plugin_tags) . '</textarea> 
					<br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
        } //end switch  
        echo '</td></tr>';
    } // end foreach  
    echo '</table>'; // end table  
}

// Save the Data  
function cocobasic_save_team_custom_meta($post_id) {
    global $team_custom_meta_fields;
    $allowed_plugin_tags = cocobasic_allowed_plugin_html();
// verify nonce  
    if (isset($_POST['custom_meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }
// check autosave  
// Stop WP from clearing custom fields on autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
// Prevent quick edit from clearing custom fields
    if (defined('DOING_AJAX') && DOING_AJAX)
        return;
// check permissions  
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
// loop through fields and save the data  
    foreach ($team_custom_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = null;
        if (isset($_POST[$field['id']])) {
            $new = $_POST[$field['id']];
        }
        if ($new && $new != $old) {
            $new = wp_kses($new, $allowed_plugin_tags);
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach  
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Browser Body Class">
function cocobasic_browserBodyClass($classes) {
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
    if ($is_lynx)
        $classes[] = 'lynx';
    elseif ($is_gecko)
        $classes[] = 'gecko';
    elseif ($is_opera)
        $classes[] = 'opera';
    elseif ($is_NS4)
        $classes[] = 'ns4';
    elseif ($is_safari)
        $classes[] = 'safari';
    elseif ($is_chrome)
        $classes[] = 'chrome';
    elseif ($is_IE) {
        $classes[] = 'ie';
        if (preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
            $classes[] = 'ie' . $browser_version[1];
    } else
        $classes[] = 'unknown';
    if ($is_iphone)
        $classes[] = 'iphone';
    if (stristr($_SERVER['HTTP_USER_AGENT'], "mac")) {
        $classes[] = 'osx';
    } elseif (stristr($_SERVER['HTTP_USER_AGENT'], "linux")) {
        $classes[] = 'linux';
    } elseif (stristr($_SERVER['HTTP_USER_AGENT'], "windows")) {
        $classes[] = 'windows';
    }
    return $classes;
}

// </editor-fold> 
// <editor-fold defaultstate="collapsed" desc="Shortcodes p-tag fix">
function cocobasic_the_content_filter($content) {
    // array of custom shortcodes requiring the fix 
    $block = join("|", array("col", "image_slider", "image_slide", "v_skills", "v_skill", "social_holder", "social", "member", "portfolio", "info", "service", "big_number", "big_text", "pricing", "text_slider", "text_slide", "full_width", "p_full_width"));
    // opening tag
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content);

    // closing tag
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep);
    return $rep;
}

//</editor-fold>
// <editor-fold defaultstate="collapsed" desc="Allowed HTML Tags">
function cocobasic_allowed_plugin_html() {
    $allowed_tags = array(
        'a' => array(
            'class' => array(),
            'href' => array(),
            'rel' => array(),
            'title' => array(),
            'target' => array(),
            'data-rel' => array(),
            'data-id' => array(),
        ),
        'abbr' => array(
            'title' => array(),
        ),
        'b' => array(),
        'blockquote' => array(
            'cite' => array(),
        ),
        'cite' => array(
            'title' => array(),
        ),
        'code' => array(),
        'del' => array(
            'datetime' => array(),
            'title' => array(),
        ),
        'dd' => array(),
        'div' => array(
            'id' => array(),
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'br' => array(),
        'dl' => array(),
        'dt' => array(),
        'em' => array(),
        'h1' => array(),
        'h2' => array(),
        'h3' => array(),
        'h4' => array(),
        'h5' => array(),
        'h6' => array(),
        'i' => array(),
        'img' => array(
            'alt' => array(),
            'class' => array(),
            'height' => array(),
            'src' => array(),
            'width' => array(),
        ),
        'li' => array(
            'class' => array(),
        ),
        'ol' => array(
            'class' => array(),
        ),
        'p' => array(
            'class' => array(),
        ),
        'q' => array(
            'cite' => array(),
            'title' => array(),
        ),
        'span' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'strike' => array(),
        'strong' => array(),
        'ul' => array(
            'class' => array(),
        ),
        'iframe' => array(
            'class' => array(),
            'src' => array(),
            'allowfullscreen' => array(),
            'width' => array(),
            'height' => array(),
        )
    );

    return $allowed_tags;
}

//</editor-fold>
?>