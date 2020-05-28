<?php
/**
 * productly Theme Customizer.
 *
 * @package productly
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function productly_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_section('header_image')->title = __( 'Header', 'productly' );
    $wp_customize->get_section('colors')->title = __( 'Background Color', 'productly' );



    $wp_customize->add_section(
        'productly_help_subsection',
        array(
          'title' => __('Need Some Help?', 'productly'),
          'priority' => 0,
          'description' => __('
            <p><strong>I have a problem with a plugin</strong>
            <br>
            Not all plugins are integrated in Productly, so if you are having problems with a plugin, please contact the plugin author.
            </p>
            <p><strong>I have a problem with WordPress Features</strong>
            <br>
            If you are having problems with WordPress or basic features, please go to the <a href="https://wordpress.org/support/" target="_blank">WordPress Support Forum</a> 
            </p>
            <p><strong>I have a problem with Productly Theme</strong>
            <br>
            If you are having problems with Productly theme please contact me at Email@vilhodesign.com or through this <a href="http://vilhodesign.com/contact/" target="_blank">contact form</a>.
            </p><br>
            <p><strong>Productly Premium Features</strong>
            <p>
            <a style="display:block;" href="http://vilhodesign.com/productly-theme/" target="_blank">
            <img src="http://vilhodesign.com/wp-content/uploads/2017/11/productlytheme.png">
            </a>
            </p>
            ', 'productly') 
)
);  
$wp_customize->add_setting('productly_optionsinfo', array(
    'sanitize_callback' => 'productly_no_sanitize',
    'type' => 'info_control',
    'capability' => 'edit_theme_options',
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'needsomehelp', array(
    'section' => 'productly_help_subsection',
    'settings' => 'productly_optionsinfo',
    'type' => 'themearea',
    'priority' => 109
    ) )
);   

$wp_customize->add_panel( 'theme_options' ,
    array(
        'title'       => esc_html__( 'Theme Options', 'productly' ),
        'description' => ''
        )
    );
$wp_customize->add_setting( 'header_title_color', array(
    'default'           => '#fcfafd',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'postMessage',
    ) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_title_color', array(
    'label'       => __( 'Header Title Color', 'productly' ),
    'section'     => 'header_image',
    'priority' => 1,
    'settings'    => 'header_title_color',
    ) ) );
$wp_customize->add_setting( 'header_tagline_color', array(
    'default'           => '#b9adeb',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'postMessage',
    ) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_tagline_color', array(
    'label'       => __( 'Tagline Color', 'productly' ),
    'section'     => 'header_image',
    'priority' => 1,
    'settings'    => 'header_tagline_color',
    ) ) );
$wp_customize->add_setting( 'left_button_text', array(
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'wp_kses_post',
    ) );

$wp_customize->add_control( 'left_button_text', array(
    'label'    => __( "Left Button Text", 'productly' ),
    'section'  => 'header_image',
    'type'     => 'text',
    'description' => __( 'For example: Left Button', 'productly' ),

    'priority' => 1,
    ) );
$wp_customize->add_setting( 'left_button_link', array(
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw'
    ) );

$wp_customize->add_control( 'left_button_link', array(
    'label'    => __( "Left Button Link URL", 'productly' ),
    'section'  => 'header_image',
    'description' => __( 'For example: Http://google.com/', 'productly' ),
    'type'     => 'text',
    'priority' => 1,
    ) );



$wp_customize->add_setting( 'right_button_text', array(
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'wp_kses_post',
    ) );

$wp_customize->add_control( 'right_button_text', array(
    'label'    => __( "Right Button Text", 'productly' ),
    'section'  => 'header_image',
    'type'     => 'text',
    'description' => __( 'For example: right Button', 'productly' ),

    'priority' => 1,
    ) );
$wp_customize->add_setting( 'right_button_link', array(
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw'
    ) );

$wp_customize->add_control( 'right_button_link', array(
    'label'    => __( "Right Button Link URL", 'productly' ),
    'section'  => 'header_image',
    'description' => __( 'For example: Http://google.com/', 'productly' ),
    'type'     => 'text',
    'priority' => 1,
    ) );





$wp_customize->add_setting( 'header_button_color', array(
    'default'           => '#fff',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'postMessage',
    ) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_button_color', array(
    'label'       => __( 'Buttons Color', 'productly' ),
    'section'     => 'header_image',
    'priority' => 1,
    'settings'    => 'header_button_color',
    ) ) );


$wp_customize->add_setting( 'header_widget_titles', array(
    'default'           => '#fff',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'postMessage',
    ) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_widget_titles', array(
    'label'       => __( 'Right Widget Headline Color', 'productly' ),
    'section'     => 'header_image',
    'priority' => 1,
    'settings'    => 'header_widget_titles',
    ) ) );

$wp_customize->add_setting( 'header_widget_text', array(
    'default'           => '#fff',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'postMessage',
    ) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_widget_text', array(
    'label'       => __( 'Right Widget Text Color', 'productly' ),
    'section'     => 'header_image',
    'priority' => 1,
    'settings'    => 'header_widget_text',
    ) ) );
$wp_customize->add_setting( 'header_widget_link', array(
    'default'           => '#fff',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'postMessage',
    ) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_widget_link', array(
    'label'       => __( 'Right Widget Link Color', 'productly' ),
    'section'     => 'header_image',
    'priority' => 1,
    'settings'    => 'header_widget_link',
    ) ) );







$wp_customize->add_setting( 'header_bg_color', array(
    'default'           => '#1b1b1b',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'postMessage',
    ) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color', array(
    'label'       => __( 'Header Background Color', 'productly' ),
    'description' => __( 'Applied to header background.', 'productly' ),
    'section'     => 'header_image',
    'settings'    => 'header_bg_color',
    ) ) );
$wp_customize->add_control( 'header_textcolor', array(
    'label'    => __( 'Header Text Color', 'productly' ),
    'section'  => 'head_options',
    ) );




    // Social Media Settings
$wp_customize->add_section( 'productly_navigation' ,
    array(
        'title'      => esc_html__('Navigation', 'productly'),
        'priority'   => 1,
        ) 
    );

$wp_customize->add_setting(
    'productly_facebook',
    array(
        'default'     => '',
        'description' => __( 'Enter your social media link(URL. Icons will not show if left blank.', 'productly' ),
            'sanitize_callback' => 'esc_url_raw'
            )
    );
$wp_customize->add_setting(
    'productly_twitter',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_url_raw'
        )
    );
$wp_customize->add_setting(
    'productly_instagram',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_url_raw'
        )
    );
$wp_customize->add_setting(
    'productly_pinterest',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_url_raw'
        )
    );
$wp_customize->add_setting(
    'productly_tumblr',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_url_raw'
        )
    );
$wp_customize->add_setting(
    'productly_bloglovin',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_url_raw'
        )
    );
$wp_customize->add_setting(
    'productly_google',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_url_raw'
        )
    );
$wp_customize->add_setting(
    'productly_youtube',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_url_raw'
        )
    );
$wp_customize->add_setting(
    'productly_soundcloud',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_url_raw'
        )
    );
$wp_customize->add_setting(
    'productly_vimeo',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_url_raw'
        )
    );
$wp_customize->add_setting(
    'productly_linkedin',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_url_raw'
        )
    );
$wp_customize->add_setting(
    'productly_rss',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_url_raw'
        )
    );


$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'productly_facebook',
        array(
            'label'      => esc_html__('Facebook', 'productly'),
            'section'    => 'productly_navigation',
            'description' => __( 'Enter your social media link(URL). Icons will not show if left blank. For example http://facebook.com/user/', 'productly' ),
            'settings'   => 'productly_facebook',
            'type'       => 'text',
            'priority'   => 99
            )
        )
    );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'productly_twitter',
        array(
            'label'      => esc_html__('Twitter', 'productly'),
            'section'    => 'productly_navigation',
            'description' => __( 'Enter your social media link(URL). Icons will not show if left blank. For example http://facebook.com/user/', 'productly' ),
            'settings'   => 'productly_twitter',
            'type'       => 'text',
            'priority'   => 99
            )
        )
    );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'productly_instagram',
        array(
            'label'      => esc_html__('Instagram', 'productly'),
            'section'    => 'productly_navigation',
            'description' => __( 'Enter your social media link(URL). Icons will not show if left blank. For example http://facebook.com/user/', 'productly' ),
            'settings'   => 'productly_instagram',
            'type'       => 'text',
            'priority'   => 99
            )
        )
    );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'productly_pinterest',
        array(
            'label'      => esc_html__('Pinterest', 'productly'),
            'section'    => 'productly_navigation',
            'description' => __( 'Enter your social media link(URL). Icons will not show if left blank. For example http://facebook.com/user/', 'productly' ),
            'settings'   => 'productly_pinterest',
            'type'       => 'text',
            'priority'   => 99
            )
        )
    );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'productly_bloglovin',
        array(
            'label'      => esc_html__('Bloglovin', 'productly'),
            'section'    => 'productly_navigation',
            'description' => __( 'Enter your social media link(URL). Icons will not show if left blank. For example http://facebook.com/user/', 'productly' ),
            'settings'   => 'productly_bloglovin',
            'type'       => 'text',
            'priority'   => 99
            )
        )
    );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'productly_google',
        array(
            'label'      => esc_html__('Google Plus', 'productly'),
            'section'    => 'productly_navigation',
            'description' => __( 'Enter your social media link(URL). Icons will not show if left blank. For example http://facebook.com/user/', 'productly' ),
            'settings'   => 'productly_google',
            'type'       => 'text',
            'priority'   => 99
            )
        )
    );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'productly_tumblr',
        array(
            'label'      => esc_html__('Tumblr', 'productly'),
            'section'    => 'productly_navigation',
            'description' => __( 'Enter your social media link(URL). Icons will not show if left blank. For example http://facebook.com/user/', 'productly' ),
            'settings'   => 'productly_tumblr',
            'type'       => 'text',
            'priority'   => 99
            )
        )
    );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'productly_youtube',
        array(
            'label'      => esc_html__('Youtube', 'productly'),
            'section'    => 'productly_navigation',
            'description' => __( 'Enter your social media link(URL). Icons will not show if left blank. For example http://facebook.com/user/', 'productly' ),
            'settings'   => 'productly_youtube',
            'type'       => 'text',
            'priority'   => 99
            )
        )
    );

$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'productly_soundcloud',
        array(
            'label'      => esc_html__('Soundcloud', 'productly'),
            'section'    => 'productly_navigation',
            'description' => __( 'Enter your social media link(URL). Icons will not show if left blank. For example http://facebook.com/user/', 'productly' ),
            'settings'   => 'productly_soundcloud',
            'type'       => 'text',
            'priority'   => 99
            )
        )
    );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'productly_vimeo',
        array(
            'label'      => esc_html__('Vimeo', 'productly'),
            'section'    => 'productly_navigation',
            'description' => __( 'Enter your social media link(URL). Icons will not show if left blank. For example http://facebook.com/user/', 'productly' ),
            'settings'   => 'productly_vimeo',
            'type'       => 'text',
            'priority'   => 99
            )
        )
    );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'productly_linkedin',
        array(
            'label'      => esc_html__('Linkedin', 'productly'),
            'section'    => 'productly_navigation',
            'description' => __( 'Enter your social media link(URL). Icons will not show if left blank. For example http://facebook.com/user/', 'productly' ),
            'settings'   => 'productly_linkedin',
            'type'       => 'text',
            'priority'   => 99
            )
        )
    );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'productly_rss',
        array(
            'label'      => esc_html__('Rss', 'productly'),
            'section'    => 'productly_navigation',
            'description' => __( 'Enter your social media link(URL). Icons will not show if left blank. For example http://facebook.com/user/', 'productly' ),
            'settings'   => 'productly_rss',
            'type'       => 'text',
            'priority'   => 99
            )
        )
    );


    // Social Media Settings


$wp_customize->add_section(
    'productly_features_subsection',
    array(
      'title' => __('Unlock New Features', 'productly'),
      'priority' => 999999,
      'description' => __('
        <p>
        <a style="display:block;" href="http://vilhodesign.com/productly-theme/" target="_blank">
        <img src="http://vilhodesign.com/wp-content/uploads/2017/11/productlytheme.png">
        </a>
        </p>
        ', 'productly') 
      )
    );  
$wp_customize->add_setting('productly_options_morefeatures', array(
    'sanitize_callback' => 'productly_no_sanitize',
    'type' => 'info_control',
    'capability' => 'edit_theme_options',
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'morefeatures', array(
    'section' => 'productly_features_subsection',
    'settings' => 'productly_options_morefeatures',
    'type' => 'themearea',
    'priority' => 109
    ) )
);   




}
add_action( 'customize_register', 'productly_customize_register' );

function productly_sanitize_checkbox( $input ){
    if ( $input == 1 || $input == 'true' || $input === true ) {
        return 1;
    } else {
        return 0;
    }
}

function productly_sanitize_number( $number, $setting ) {
    $number = absint( $number );
    return ( $number ? $number : $setting->default );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function productly_customize_preview_js() {
	wp_enqueue_script( 'productly_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'productly_customize_preview_js' );

/**
 * Load customizer style
 */
function productly_customizer_load_css(){
    wp_enqueue_style( 'productly-customizer', get_template_directory_uri() . '/css/customizer.css' );
}
add_action('customize_controls_print_styles', 'productly_customizer_load_css');



if(! function_exists('productly_user_chosen_css_changes' ) ):
    function productly_user_chosen_css_changes(){

        ?>

        <style type="text/css">
        .header-container{ padding-top: <?php echo esc_attr(get_theme_mod( 'header_top_padding')); ?>px; }
        .header-container{ padding-bottom: <?php echo esc_attr(get_theme_mod( 'header_bottom_padding')); ?>px; }
        .header-widgets h3 { color: <?php echo esc_attr(get_theme_mod( 'header_widget_titles')); ?>; }
        .header-widgets, .header-widgets p, .header-widgets li, .header-widgets table td, .header-widgets table th, .header-widgets   { color: <?php echo esc_attr(get_theme_mod( 'header_widget_text')); ?>; }
        .header-widgets a, .header-widgets a, .header-widgets .menu li a { color: <?php echo esc_attr(get_theme_mod( 'header_widget_link')); ?>; }
        header#masthead { background-color: <?php echo esc_attr(get_theme_mod( 'header_bg_color')); ?>; }
        .site-title{ color: <?php echo esc_attr(get_theme_mod( 'header_title_color')); ?>; }
        p.site-description{ color: <?php echo esc_attr(get_theme_mod( 'header_tagline_color')); ?>; }
        .button-divider{ background-color: <?php echo esc_attr(get_theme_mod( 'header_button_divider_color')); ?>; }
        .header-button{ border-color: <?php echo esc_attr(get_theme_mod( 'header_button_color')); ?>; }
        .header-button, .header-button-text{ color: <?php echo esc_attr(get_theme_mod( 'header_button_color')); ?>; }
        .header-button-text:after { background: <?php echo esc_attr(get_theme_mod( 'header_button_color')); ?>; }
        #site-navigation .menu li, #site-navigation .menu .sub-menu, #site-navigation .menu .children, nav#site-navigation{ background: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?>; }
        #site-navigation .menu li a, #site-navigation .menu li a:hover, #site-navigation .menu li a:active, #site-navigation .menu > li.menu-item-has-children > a:after, #site-navigation ul.menu ul a, #site-navigation .menu ul ul a, #site-navigation ul.menu ul a:hover, #site-navigation .menu ul ul a:hover, div#top-search a, div#top-search a:hover { color: <?php echo esc_attr(get_theme_mod( 'navigation_link_color')); ?>; }
        .m_menu_icon { background-color: <?php echo esc_attr(get_theme_mod( 'navigation_link_color')); ?>; }
        #top-social a, #top-social a:hover, #top-social a:active, #top-social a:focus, #top-social a:visited{ color: <?php echo esc_attr(get_theme_mod( 'navigation_social_link_color')); ?>; }  
        .top-widgets h1, .top-widgets h2, .top-widgets h3, .top-widgets h4, .top-widgets h5, .top-widgets h6 { color: <?php echo esc_attr(get_theme_mod( 'topwidgets_headline_color')); ?>; }
        .top-widgets p, .top-widgets, .top-widgets li, .top-widgets ol, .top-widgets cite{ color: <?php echo esc_attr(get_theme_mod( 'topwidgets_text_color')); ?>; }
        .top-widget-fullwidth h3:after{ background: <?php echo esc_attr(get_theme_mod( 'topwidgets_headline_color')); ?>; }
        .top-widgets ul li a, .top-widgets a, .top-widgets a:hover, .top-widgets a:visited, .top-widgets a:focus, .top-widgets a:active, .top-widgets ol li a, .top-widgets li a, .top-widgets .menu li a, .top-widgets .menu li a:hover, .top-widgets .menu li a:active, .top-widgets .menu li a:focus{ color: <?php echo esc_attr(get_theme_mod( 'topwidgets_link_color')); ?>; }
        .blog-feed-category a{ color: <?php echo esc_attr(get_theme_mod( 'blogpage_category_color')); ?>; }
        .blog h2.entry-title a, .nav-previous a, .nav-next a { color: <?php echo esc_attr(get_theme_mod( 'blogpage_headline_color')); ?>; }
        .blog-feed-post-wrapper .blog-feed-meta * { color: <?php echo esc_attr(get_theme_mod( 'blogpage_date_color')); ?>; }
        .blog-feed-post-wrapper p { color: <?php echo esc_attr(get_theme_mod( 'blogpage_text_color')); ?>; }
        .blog .entry-more a { color: <?php echo esc_attr(get_theme_mod( 'blogpage_button_color')); ?>; }
        .blog .entry-more a { border-color: <?php echo esc_attr(get_theme_mod( 'blogpage_button_color')); ?>; }
        .blog .entry-more a:hover { background: <?php echo esc_attr(get_theme_mod( 'blogpage_button_color')); ?>; }
        .single-post .comment-metadata time, .page .comment-metadata time, .single-post time.entry-date.published, .page time.entry-date.published, .single-post .posted-on a, .page .posted-on a { color: <?php echo esc_attr(get_theme_mod( 'postpage_date')); ?>; }
        .single-post #main th, .page #main th, .single-post .entry-cate a h2.entry-title, .single-post h1.entry-title, .page h2.entry-title, .page h1.entry-title, .single-post #main h1, .single-post #main h2, .single-post #main h3, .single-post #main h4, .single-post #main h5, .single-post #main h6, .page #main h1, .page #main h2, .page #main h3, .page #main h4, .page #main h5, .page #main h6 { color: <?php echo esc_attr(get_theme_mod( 'postpage_headline')); ?>; }
        .comments-title:after{ background: <?php echo esc_attr(get_theme_mod( 'postpage_headline')); ?>; }
        .post #main .nav-next a:before, .single-post #main .nav-previous a:before, .page #main .nav-previous a:before, .single-post #main .nav-next a:before, .single-post #main a, .page #main a{ color: <?php echo esc_attr(get_theme_mod( 'postpage_link')); ?>; }
        .page #main, .page #main p, .page #main th,.page .comment-form label, .single-post #main, .single-post #main p, .single-post #main th,.single-post .comment-form label, .single-post .comment-author .fn, .page .comment-author .fn   { color: <?php echo esc_attr(get_theme_mod( 'postpage_text')); ?>; }
        .single-post .comment-form input.submit, .page .comment-form input.submit { border-color: <?php echo esc_attr(get_theme_mod( 'postpage_button')); ?>; }
        .single-post .comment-form input.submit, .page .comment-form input.submit { color: <?php echo esc_attr(get_theme_mod( 'postpage_button')); ?>; }
        .single-post .comment-form input.submit:hover, .page .comment-form input.submit:hover { color:#fff; background-color: <?php echo esc_attr(get_theme_mod( 'postpage_button')); ?>; }
        .single-post #main .entry-cate a, .page #main .entry-cate a { color: <?php echo esc_attr(get_theme_mod( 'postpage_category')); ?>; }
        .single-post .comment-content, .page .comment-content, .single-post .navigation.post-navigation, .page .navigation.post-navigation, .single-post #main td, .page #main td,  .single-post #main th, .page #main th, .page #main input[type="url"], .single-post #main input[type="url"],.page #main input[type="text"], .single-post #main input[type="text"],.page #main input[type="email"], .single-post #main input[type="email"], .page #main textarea, .single-post textarea { border-color: <?php echo esc_attr(get_theme_mod( 'postpage_border')); ?>; }
        .footer-widget-single, .footer-widget-single p, .footer-widgets-wrapper p, .footer-widgets-wrapper { color: <?php echo esc_attr(get_theme_mod( 'footer_text')); ?>; }
        .footer-widgets-wrapper  ul li a, .footer-widgets-wrapper li a,.footer-widgets-wrapper a,.footer-widgets-wrapper a:hover,.footer-widgets-wrapper a:active,.footer-widgets-wrapper a:focus, .footer-widget-single a, .footer-widget-single a:hover, .footer-widget-single a:active{ color: <?php echo esc_attr(get_theme_mod( 'footer_link')); ?>; }
        .footer-widget-single h3, .footer-widgets .search-form input.search-field { border-color: <?php echo esc_attr(get_theme_mod( 'footer_border')); ?>; }
        footer .site-info { background: <?php echo esc_attr(get_theme_mod( 'footer_copyright_background')); ?>; }
        footer .site-info { color: <?php echo esc_attr(get_theme_mod( 'footer_copyright_text')); ?>; }
        .readmore-btn { color: <?php echo esc_attr(get_theme_mod( 'blogpage_link_color')); ?>; }
    }   
    </style>
    <?php }
    add_action( 'wp_head', 'productly_user_chosen_css_changes' );
    endif;
