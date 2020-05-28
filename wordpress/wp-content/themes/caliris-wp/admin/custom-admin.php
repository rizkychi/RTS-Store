<?php
/*
 * Register Theme Customizer
 */
add_action('customize_register', 'caliris_theme_customize_register');

function caliris_theme_customize_register($wp_customize) {

    function caliris_clean_html($value) {
        $allowed_html_array = caliris_allowed_html();
        $value = wp_kses($value, $allowed_html_array);
        return $value;
    }

    class Caliris_WP_Customize_Textarea_Control extends WP_Customize_Control {

        public $type = 'textarea';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <textarea rows="10" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
            </label>
            <?php
        }

    }

    //----------------------------- IMAGE SECTION  ---------------------------------------------

    $wp_customize->add_section('caliris_image_section', array(
        'title' => esc_html__('Images Section', 'caliris-wp'),
        'priority' => 33
    ));


    $wp_customize->add_setting('caliris_preloader', array(
        'default' => get_template_directory_uri() . '/images/preloader.gif',
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'caliris_preloader', array(
        'label' => esc_html__('Preloader Gif', 'caliris-wp'),
        'section' => 'caliris_image_section',
        'settings' => 'caliris_preloader'
    )));

    $wp_customize->add_setting('caliris_header_logo', array(
        'default' => get_template_directory_uri() . '/images/logo.png',
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'caliris_header_logo', array(
        'label' => esc_html__('Header Logo', 'caliris-wp'),
        'section' => 'caliris_image_section',
        'settings' => 'caliris_header_logo'
    )));


    //----------------------------- END IMAGE SECTION  ---------------------------------------------
    //
    //
    //
    //----------------------------------COLORS SECTION--------------------

    $wp_customize->add_setting('caliris_menu_color', array(
        'default' => '#808080',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'caliris_menu_color', array(
        'label' => esc_html__('Menu Color', 'caliris-wp'),
        'section' => 'colors',
        'settings' => 'caliris_menu_color'
    )));

    $wp_customize->add_setting('caliris_menu_hover_color', array(
        'default' => '#000000',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'caliris_menu_hover_color', array(
        'label' => esc_html__('Menu Hover Color', 'caliris-wp'),
        'section' => 'colors',
        'settings' => 'caliris_menu_hover_color'
    )));

    $wp_customize->add_setting('caliris_global_color', array(
        'default' => '#f1576b',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'caliris_global_color', array(
        'label' => esc_html__('Global Color', 'caliris-wp'),
        'section' => 'colors',
        'settings' => 'caliris_global_color'
    )));


    $wp_customize->add_setting('caliris_news_color', array(
        'default' => '#864eff',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'caliris_news_color', array(
        'label' => esc_html__('News Color', 'caliris-wp'),
        'section' => 'colors',
        'settings' => 'caliris_news_color'
    )));


    //----------------------------------------------------------------------------------------------
    //
    //
    //
      //------------------------- FOOTER TEXT SECTION ---------------------------------------------

    $wp_customize->add_section('caliris_footer_text_section', array(
        'title' => esc_html__('Footer', 'caliris-wp'),
        'priority' => 99
    ));


    $wp_customize->add_setting('caliris_footer_mail', array(
        'default' => '',
        'sanitize_callback' => 'caliris_clean_html'
    ));

    $wp_customize->add_control(new Caliris_WP_Customize_Textarea_Control($wp_customize, 'caliris_footer_mail', array(
        'label' => esc_html__('Footer Mail', 'caliris-wp'),
        'section' => 'caliris_footer_text_section',
        'settings' => 'caliris_footer_mail',
        'priority' => 999
    )));


    $wp_customize->add_setting('caliris_footer_tel', array(
        'default' => '',
        'sanitize_callback' => 'caliris_clean_html'
    ));

    $wp_customize->add_control(new Caliris_WP_Customize_Textarea_Control($wp_customize, 'caliris_footer_tel', array(
        'label' => esc_html__('Footer Phone Number', 'caliris-wp'),
        'section' => 'caliris_footer_text_section',
        'settings' => 'caliris_footer_tel',
        'priority' => 999
    )));

    $wp_customize->add_setting('caliris_footer_logo', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'caliris_footer_logo', array(
        'label' => esc_html__('Footer Logo', 'caliris-wp'),
        'section' => 'caliris_footer_text_section',
        'settings' => 'caliris_footer_logo'
    )));


    $wp_customize->add_setting('caliris_footer_social_content', array(
        'default' => '',
        'sanitize_callback' => 'caliris_clean_html'
    ));

    $wp_customize->add_control(new Caliris_WP_Customize_Textarea_Control($wp_customize, 'caliris_footer_social_content', array(
        'label' => esc_html__('Footer Social Content', 'caliris-wp'),
        'section' => 'caliris_footer_text_section',
        'settings' => 'caliris_footer_social_content',
        'priority' => 999
    )));


    $wp_customize->add_setting('caliris_footer_copyright_content', array(
        'default' => '',
        'sanitize_callback' => 'caliris_clean_html'
    ));

    $wp_customize->add_control(new Caliris_WP_Customize_Textarea_Control($wp_customize, 'caliris_footer_copyright_content', array(
        'label' => esc_html__('Footer Copyright Content:', 'caliris-wp'),
        'section' => 'caliris_footer_text_section',
        'settings' => 'caliris_footer_copyright_content',
        'priority' => 999
    )));

    $wp_customize->add_setting('caliris_footer_background', array(
        'default' => '#000000',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'caliris_footer_background', array(
        'label' => esc_html__('Footer Background Color', 'caliris-wp'),
        'section' => 'caliris_footer_text_section',
        'settings' => 'caliris_footer_background'
    )));

    $wp_customize->add_setting('caliris_footer_background_image', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'caliris_footer_background_image', array(
        'label' => esc_html__('Footer Background Image', 'caliris-wp'),
        'section' => 'caliris_footer_text_section',
        'settings' => 'caliris_footer_background_image'
    )));


    //---------------------------- END FOOTER TEXT SECTION --------------------------
    //
    //
    //--------------------------------------------------------------------------
    $wp_customize->get_setting('caliris_menu_color')->transport = 'postMessage';
    $wp_customize->get_setting('caliris_menu_hover_color')->transport = 'postMessage';
    $wp_customize->get_setting('caliris_global_color')->transport = 'postMessage';
    $wp_customize->get_setting('caliris_news_color')->transport = 'postMessage';
    $wp_customize->get_setting('caliris_footer_background')->transport = 'postMessage';
    //--------------------------------------------------------------------------
    /*
     * If preview mode is active, hook JavaScript to preview changes
     */
    if ($wp_customize->is_preview() && !is_admin()) {
        add_action('customize_preview_init', 'caliris_theme_customize_preview_js');
    }
}

/**
 * Bind Theme Customizer JavaScript
 */
function caliris_theme_customize_preview_js() {
    wp_enqueue_script('caliris-wp-theme-customizer', get_template_directory_uri() . '/admin/js/custom-admin.js', array('customize-preview'), '20120910', true);
}

/*
 * Generate CSS Styles
 */

class calirisWPLiveCSS {

    public static function caliris_theme_customized_style() {
        echo '<style type="text/css">' .
        //Menu Color and Hover Color
        caliris_generate_css('body .site-wrapper .main-menu.sm-clean a', 'color', 'caliris_menu_color') .
        caliris_generate_css('body .site-wrapper .sm-clean a:hover, body .site-wrapper .main-menu.sm-clean .sub-menu li a:hover, body .site-wrapper .sm-clean li.active a, body .site-wrapper .sm-clean li.current-page-ancestor > a, body .site-wrapper .sm-clean li.current_page_ancestor > a, body .site-wrapper .sm-clean li.current_page_item > a', 'color', 'caliris_menu_hover_color', '', '!important') .
        //Global Color
        caliris_generate_css('body .site-wrapper a, body .site-wrapper a:hover, .site-wrapper .navigation.pagination a:hover, .single .site-wrapper .entry-info .cat-links a:hover, .site-wrapper .tags-holder a, .single .site-wrapper .wp-link-pages, .site-wrapper .comment-form-holder a:hover, .site-wrapper .replay-at-author, body .site-wrapper .footer a:hover, .site-wrapper .blog-item-holder .cat-links ul a, .site-wrapper blockquote:not(.cocobasic-block-pullquote):before', 'color', 'caliris_global_color') .
        caliris_generate_css('.site-wrapper blockquote:not(.cocobasic-block-pullquote), .single .site-wrapper .entry-info .cat-links a, .site-wrapper .tags-holder a, .site-wrapper .owl-theme .owl-dots .owl-dot.active span, .site-wrapper .owl-theme .owl-dots .owl-dot:hover span', 'border-color', 'caliris_global_color') .
        caliris_generate_css('.blog .site-wrapper h1.entry-title, .blog .site-wrapper .more-posts, .blog .site-wrapper .no-more-posts, .blog .site-wrapper .more-posts-loading, .site-wrapper .navigation.pagination .current, .site-wrapper .tags-holder a:hover, .search .site-wrapper h1.entry-title, .archive .site-wrapper h1.entry-title, .site-wrapper a.button, .site-wrapper .sonar-emitter, .site-wrapper .sonar-wave, .site-wrapper .member-mask, .site-wrapper .grid-item a.item-link:after, .site-wrapper .more-posts-portfolio, .site-wrapper .no-more-posts-portfolio, .site-wrapper .more-posts-portfolio-loading', 'background-color', 'caliris_global_color') .
        //News Color
        caliris_generate_css('.site-wrapper .blog-item-holder-scode h4 a:hover, .site-wrapper .blog-item-holder-scode .cat-links ul a', 'color', 'caliris_news_color') .
        caliris_generate_css('.site-wrapper .blog-holder-scode .more-posts-link', 'background-color', 'caliris_news_color') .
        //Footer Color
        caliris_generate_css('.site-wrapper .footer', 'background-color', 'caliris_footer_background') .
        caliris_generate_additional_css() .
        '</style>';
    }

}

/*
 * Generate CSS Class - Helper Method
 */

function caliris_generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $rgba = '') {
    $return = '';
    $mod = get_option($mod_name);
    if (!empty($mod)) {
        if ($rgba === true) {
            $mod = '0px 0px 50px 0px ' . cardea_hex2rgba($mod, 0.65);
        }
        $return = sprintf('%s { %s:%s; }', $selector, $style, $prefix . $mod . $postfix
        );
    }
    return $return;
}

function caliris_hex2rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if (empty($color))
        return $default;

    //Sanitize $color if "#" is provided 
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    //Return rgb(a) color string
    return $output;
}

function caliris_generate_additional_css() {
    $allowed_html_array = caliris_allowed_html();
    $return = '';
    if (get_option('caliris_footer_background_image') !== '' && get_option('caliris_footer_background_image') !== false):
        $return .= '.site-wrapper .footer{background-image: url(' . esc_url(get_option('caliris_footer_background_image')) . '); margin-bottom: 50px;} .site-wrapper .footer-content{padding-top:140px; padding-bottom:90px; width: 900px;}';
    endif;
    $return = wp_kses($return, $allowed_html_array);
    return $return;
}
?>