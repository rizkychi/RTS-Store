<?php
/**
* Digital Products Customization options
**/
function digital_products_customize_register( $wp_customize ) {
	
	// GENERAL PANEL 
	$wp_customize->add_panel(
   'digital_products_general',
   array(
     'title' => esc_html__( 'General Settings', 'digital-products' ),
     'description' => esc_html__('General options','digital-products'),
     'priority' => 20, 
     )
   ); 
	$wp_customize->get_section('title_tagline')->panel = 'digital_products_general'; 
	$wp_customize->get_section('header_image')->panel = 'digital_products_general'; 
	$wp_customize->get_control('header_textcolor')->section = 'color';
  $wp_customize->get_control('header_textcolor')->priority = 32;
  $wp_customize->get_section('static_front_page')->panel = 'digital_products_general';
	// END GENERAL PANEL
  //Menu Option
  $wp_customize->add_section( 'menu_settings' , array(
    'title'       => __( 'Menu Settings', 'digital-products' ),
    'priority'    => 32,
    'capability'     => 'edit_theme_options',
    'panel' => 'digital_products_general'
    ) );
  $wp_customize->add_setting(
    'logo_position',
    array(
      'default' => 'pull-left',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field',
      )
    );
  $wp_customize->add_control(
    'logo_position',
    array(
      'section' => 'menu_settings',
      'label'      => __('Logo Position', 'digital-products'),
      'type'       => 'select',
      'choices' => array(
        'pull-left' => 'Left',
        'pull-right' => 'Right',
        ),
      )
    );  
  
  //Add Blog Settings
  $wp_customize->add_section( 'blog_settings' , array(
    'title'       => __( 'Blog Settings', 'digital-products' ),
    'description' => __( 'These settings work for default blog pages like 404, search and etc., but it will not work with "Posts page". You can change "Posts page" settings by page option.','digital-products' ),
    'priority'    => 32,
    'capability'     => 'edit_theme_options',
    'panel' => 'digital_products_general'
    ) );
  $wp_customize->add_setting(
    'blog_style',
    array(
      'default' => 'blog1',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field',
      )
    );
  $wp_customize->add_control(
    'blog_style',
    array(
      'section' => 'blog_settings',
      'label'      => __('Select Style', 'digital-products'),
      'type'       => 'select',
      'choices' => array(
        'blog1'  => __('Blog Style 1','digital-products'),
        'blog2'  => __('Blog Style 2','digital-products'),
        'blog3'  => __('Blog Style 3','digital-products'),
        ),
      )
    );
  $wp_customize->add_setting(
    'sidebar_style',
    array(
      'default' => 'no_sidebar',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field',
      )
    );
  $wp_customize->add_control(
    'sidebar_style',
    array(
      'section' => 'blog_settings',
      'label'      => __('Sidebar Style', 'digital-products'),
      'type'       => 'select',
      'choices' => array(
        'no_sidebar'  => __('No Sidebar','digital-products'),
        'right_sidebar'  => __('Right Sidebar','digital-products'),
        'left_sidebar'  => __('Left Sidebar','digital-products'),
        ),
      )
    );
  //Add Blog Settings
  $wp_customize->add_section( 'single_blog_settings' , array(
    'title'       => __( 'Single Blog Settings', 'digital-products' ),
    'priority'    => 32,
    'capability'     => 'edit_theme_options',
    'panel' => 'digital_products_general'
  ) );
  $wp_customize->add_setting(
    'single_sidebar_style',
    array(
      'default' => 'right_sidebar',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field',
      )
    );
  $wp_customize->add_control(
    'single_sidebar_style',
    array(
      'section' => 'single_blog_settings',
      'label'      => __('Sidebar Style', 'digital-products'),
      'type'       => 'select',
      'choices' => array(
        'no_sidebar'  => __('No Sidebar','digital-products'),
        'right_sidebar'  => __('Right Sidebar','digital-products'),
        'left_sidebar'  => __('Left Sidebar','digital-products'),
        ),
      )
    );
  /** Add PreLoader **/
  $wp_customize->add_setting(
    'preloader',
    array(
      'default' => '1',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field',
      'priority' => 20,
      )
    );
  $wp_customize->add_section( 'preloader_section' , array(
    'title'       => __( 'Preloader', 'digital-products' ),
    'priority'    => 32,
    'capability'     => 'edit_theme_options',
    'panel' => 'digital_products_general'
    ) );
  $wp_customize->add_control(
    'preloader',
    array(
      'section' => 'preloader_section',                
      'label'   => __('Preloader','digital-products'),
      'type'    => 'radio',
      'choices'        => array(
        "1"   => esc_html__( "On ", 'digital-products' ),
        "2"   => esc_html__( "Off", 'digital-products' ),
        ),
      )
    );
  $wp_customize->add_setting( 'custom_preloader', array(
    'sanitize_callback' => 'absint',
    'capability'     => 'edit_theme_options',
    'priority' => 40,
    ));
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_preloader', array(
    'label'    => __( 'Upload Custom Preloader', 'digital-products' ),
    'section'  => 'preloader_section',
    'settings' => 'custom_preloader',
    ) ) );
  /** End Preloader **/
//All our sections, settings, and controls will be added here
  $wp_customize->add_section(
    'digital_products_social_links',
    array(
      'title' => __('Social Accounts', 'digital-products'),
      'priority' => 120,
      'description' => __('Enter the URL of your social accounts. Leave it empty to hide the icon.', 'digital-products'),
      'panel' => 'footer'
      )
    );
  $digital_products_social_icon = array();
  for($i=1;$i <= 6;$i++):  
    $digital_products_social_icon[] =  array( 'slug'=>sprintf('digital_products_social_icon%d',$i),   
      'default' => '',   
      'label' => sprintf(esc_html__( 'Social Account %s', 'digital-products' ),$i),   
      'priority' => sprintf('%d',$i) );  
  endfor;  
  foreach($digital_products_social_icon as $digital_products_social_icons){
    $wp_customize->add_setting(
      $digital_products_social_icons['slug'],
      array(
        'default' => '',
        'capability'     => 'edit_theme_options',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        )
      );
    $wp_customize->add_control(
      $digital_products_social_icons['slug'],
      array(
        'section' => 'digital_products_social_links',
        'label'      =>   $digital_products_social_icons['label'],
        'priority' => $digital_products_social_icons['priority'],
        'input_attrs' => array(
            'placeholder' => __( 'fa-facebook' , 'digital-products' ),
        )
      )
    );
  }
  $digital_products_social_icon_link = array();

  for($i=1;$i <= 6;$i++):  
    $digital_products_social_icon_link[] =  array( 'slug'=>sprintf('digital_products_social_icon_link%d',$i),   
      'default' => '',   
      'label' => sprintf(esc_html__( 'Social Link %s', 'digital-products' ),$i),   
      'priority' => sprintf('%d',$i) );  
  endfor;
  foreach($digital_products_social_icon_link as $digital_products_social_icons){
    $wp_customize->add_setting(
      $digital_products_social_icons['slug'],
      array(
        'default' => '',
        'capability'     => 'edit_theme_options',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        )
      );
    $wp_customize->add_control(
      $digital_products_social_icons['slug'],
      array(
        'section' => 'digital_products_social_links',
        'priority' => $digital_products_social_icons['priority'],
        'input_attrs' => array(
            'placeholder' => esc_url( 'http://facebook.com'),
        )
        )
      );
  }
/*
 * Multiple logo upload code
 */
$wp_customize->add_setting(
  'digital_products_dark_logo',
  array(
    'default' => '',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'absint',
    )
  );
$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'digital_products_dark_logo', array(
  'section'     => 'title_tagline',
  'label'       => __( 'Upload Dark Logo (300 x 70)' ,'digital-products'),
  'flex_width'  => true,
  'flex_height' => true,
  'width'       => 120,
  'height'      => 50,
  'priority'    => 10,
  'default-image' => '',
  ) ) );
$wp_customize->add_setting(
  'logo_height',
  array(
    'default' => '',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'absint',
    )
  );
$wp_customize->add_control(
  'logo_height',
  array(
    'section' => 'menu_settings',
    'label'      => __('Enter Logo Size', 'digital-products'),
    'description' => __("Use if you want to increase or decrease logo size (optional) Don't include `px` in the string. e.g. 20 (default: 10px)",'digital-products'),
    'type'       => 'text',
    )
  );
$wp_customize->add_setting(
  'fixed_header',
  array(
    'default' => '0',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
  );
$wp_customize->add_control(
  'fixed_header',
  array(
    'section' => 'menu_settings',
    'label'      => __('Fixed Header', 'digital-products'),
    'type'       => 'select',
    'choices' => array(
      '1' => 'Yes',
      '0' => 'No',
      ),
    )
  );
//Remove Background Image Section
$wp_customize->add_setting(
  'theme_color',
  array(
    'default' => '#0e76bc',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'theme_color',
    array(
      'label'      => __('Theme Color ', 'digital-products'),
      'section' => 'color',
      'priority' => 10
      )
    )
  );
$wp_customize->add_setting(
  'secondary_color',
  array(
    'default' => '#000000',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'secondary_color',
    array(
      'label'      => __('Secondary Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
//Menu Background Color
$wp_customize->add_setting(
  'menu_background_color',
  array(
    'default' => '',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menu_background_color',
    array(
      'label'      => __('Menu Background Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Menu Text Color
$wp_customize->add_setting(
  'menu_text_color',
  array(
    'default' => '#ffffff',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menu_text_color',
    array(
      'label'      => __('Menu Text Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Menu Text hover Color
$wp_customize->add_setting(
  'menu_text_hover_color',
  array(
    'default' => '#ffffff',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menu_text_hover_color',
    array(
      'label'      => __('Menu Text Hover Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Menu dropdown Color
$wp_customize->add_setting(
  'menu_dropdown_color',
  array(
    'default' => '',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menu_dropdown_color',
    array(
      'label'      => __('Menu Dropdown Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Menu Background Color (Scroll)
$wp_customize->add_setting(
  'menu_background_color_scroll',
  array(
    'default' => '#ffffff',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menu_background_color_scroll',
    array(
      'label'      => __('Menu Background Color (after scroll)', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Menu Text Color scroll
$wp_customize->add_setting(
  'menu_text_color_scroll',
  array(
    'default' => '#000000',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menu_text_color_scroll',
    array(
      'label'      => __('Menu Text Color(after scroll)', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Menu Text hover Color after scroll
$wp_customize->add_setting(
  'menu_text_hover_color_scroll',
  array(
    'default' => '#000000',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menu_text_hover_color_scroll',
    array(
      'label'      => __('Menu Text Hover Color(after scroll)', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Menu dropdown color after scroll
$wp_customize->add_setting(
  'menu_dropdown_color_scroll',
  array(
    'default' => '#000000',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menu_dropdown_color_scroll',
    array(
      'label'      => __('Menu Dropdown Color(after scroll)', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Body Background Color
$wp_customize->add_setting(
  'body_background_color',
  array(
    'default' => '#ffffff',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'body_background_color',
    array(
      'label'      => __('Body Background Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Body Text Color
$wp_customize->add_setting(
  'body_text_color',
  array(
    'default' => '#424242',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'body_text_color',
    array(
      'label'      => __('Body Text Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Body Title Color
$wp_customize->add_setting(
  'body_heading_color',
  array(
    'default' => '#282828',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'body_heading_color',
    array(
      'label'      => __('Body Title Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Footer Background Color
$wp_customize->add_setting(
  'footer_background_color',
  array(
    'default' => '#f7f7f7',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'footer_background_color',
    array(
      'label'      => __('Footer Background Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Footer Text Color
$wp_customize->add_setting(
  'footer_text_color',
  array(
    'default' => '#2c3e55',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'footer_text_color',
    array(
      'label'      => __('Footer Text Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Footer Link Color
$wp_customize->add_setting(
  'footer_link_color',
  array(
    'default' => '#2c3e55',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'footer_link_color',
    array(
      'label'      => __('Footer Link Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Footer Link Hover Color
$wp_customize->add_setting(
  'footer_link_hover_color',
  array(
    'default' => '#0e76bc',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'footer_link_hover_color',
    array(
      'label'      => __('Footer Link Hover Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
    //Copyright Background Color
$wp_customize->add_setting(
  'copyright_background_color',
  array(
    'default' => '#e1e1e1',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'copyright_background_color',
    array(
      'label'      => __('Copyright Background Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
//Copyright Text Color
$wp_customize->add_setting(
  'copyright_text_color',
  array(
    'default' => '#4d4d4d',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'copyright_text_color',
    array(
      'label'      => __('Copyright Text Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
//Copyright Link Color
$wp_customize->add_setting(
  'copyright_link_color',
  array(
    'default' => '#4d4d4d',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'copyright_link_color',
    array(
      'label'      => __('Copyright Link Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );
//Copyright Link Hover Color
$wp_customize->add_setting(
  'copyright_link_hover_color',
  array(
    'default' => '#0e76bc',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
  );
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'copyright_link_hover_color',
    array(
      'label'      => __('Copyright Link Hover Color', 'digital-products'),
      'section' => 'color',
      'priority' => 11
      )
    )
  );




//Footer Section
$wp_customize->add_panel(
  'footer',
  array(
    'title' => __( 'Footer', 'digital-products' ),
    'description' => __('Footer options','digital-products'),
    'priority' => 35, 
    )
  );
$wp_customize->add_section( 'footer_widget_area' , array(
  'title'       => __( 'Footer Widget Area', 'digital-products' ),
  'priority'    => 135,
  'capability'     => 'edit_theme_options',
  'panel' => 'footer'
  ) );
$wp_customize->add_section( 'footer_social_section' , array(
  'title'       => __( 'Social Settings', 'digital-products' ),
  'description' => balanceTags( 'In first input box, you need to add FONT AWESOME shortcode which you can find <a target="_blank" href="https://fortawesome.github.io/Font-Awesome/icons/">here</a> and in second input box, you need to add your social media profile URL.' , true),
  'priority'    => 135,
  'capability'     => 'edit_theme_options',
  'panel' => 'footer'
  ) );
$wp_customize->add_section( 'footer_copyright' , array(
  'title'       => __( 'Footer Copyright Area', 'digital-products' ),
  'priority'    => 135,
  'capability'     => 'edit_theme_options',
  'panel' => 'footer'
  ) );
$wp_customize->add_setting(
  'hide_footer_widget_bar',
  array(
    'default' => '1',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    'priority' => 20, 
    )
  );
$wp_customize->add_control(
  'hide_footer_widget_bar',
  array(
    'section' => 'footer_widget_area',                
    'label'   => __('Hide Widget Area','digital-products'),
    'type'    => 'select',
    'choices'        => array(
      "1"   => esc_html__( "Show", 'digital-products' ),
      "2"   => esc_html__( "Hide", 'digital-products' ),
      ),
    )
  );
$wp_customize->add_setting(
  'footer_widget_style',
  array(
    'default' => '3',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    'priority' => 20, 
    )
  );
$wp_customize->add_control(
  'footer_widget_style',
  array(
    'section' => 'footer_widget_area',                
    'label'   => __('Select Widget Area','digital-products'),
    'type'    => 'select',
    'choices'        => array(
      "1"   => esc_html__( "2 column", 'digital-products' ),
      "2"   => esc_html__( "3 column", 'digital-products' ),
      "3"   => esc_html__( "4 column", 'digital-products' )
      ),
    )
  );
$wp_customize->add_setting(
  'footer_style',
  array(
    'default' => '3',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    'priority' => 20, 
    )
  );
$wp_customize->add_control(
  'footer_style',
  array(
    'section' => 'footer_widget_area',                
    'label'   => __('Select Widget Area','digital-products'),
    'type'    => 'select',
    'choices'        => array(
      "style1"   => esc_html__( "style 1", 'digital-products' ),
      "style2"   => esc_html__( "style 2", 'digital-products' ),
      ),
    )
  );
$wp_customize->add_setting(
  'footer_background_image',
  array(
    'default' => '',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'absint',
    )
  );
$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'footer_background_image', array(
  'section'     => 'footer_widget_area',
  'label'       => __( 'Upload Footer Background Image' ,'digital-products'),
  'flex_width'  => true,
  'flex_height' => true,
  'width'       => 120,
  'height'      => 50,
  'priority'    => 10,
  'default-image' => '',
  ) ) );
//Footer Section
$wp_customize->add_panel(
  'footer',
  array(
    'title' => __( 'Footer', 'digital-products' ),
    'description' => __('Footer options','digital-products'),
    'priority' => 120, 
    )
  );
$wp_customize->add_section( 'footer_widget_area' , array(
  'title'       => __( 'Footer Widget Area', 'digital-products' ),
  'priority'    => 135,
  'capability'     => 'edit_theme_options',
  'panel' => 'footer'
  ) );

$wp_customize->add_section( 'footer_social_section' , array(
  'title'       => __( 'Social Settings', 'digital-products' ),
  'description' => balanceTags( 'In first input box, you need to add FONT AWESOME shortcode which you can find <a target="_blank" href="https://fortawesome.github.io/Font-Awesome/icons/">here</a> and in second input box, you need to add your social media profile URL.' , true),
  'priority'    => 135,
  'capability'     => 'edit_theme_options',
  'panel' => 'footer'
  ) );
$wp_customize->add_section( 'footer_copyright' , array(
  'title'       => __( 'Footer Copyright Area', 'digital-products' ),
  'priority'    => 135,
  'capability'     => 'edit_theme_options',
  'panel' => 'footer'
  ) );
$wp_customize->add_setting(
  'copyright_style',
  array(
    'default' => 'style1',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    'priority' => 20, 
    )
  );
$wp_customize->add_control(
  'copyright_style',
  array(
    'section' => 'footer_copyright',                
    'label'   => __('Choose Style','digital-products'),
    'type'    => 'select',
    'choices'        => array(
      "style1"   => esc_html__( "Style 1", 'digital-products' ),
      "style2"   => esc_html__( "Style 2", 'digital-products' ),
      ),
    )
  );
$wp_customize->add_setting(
  'copyright_area_text',
  array(
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'wp_kses_post',
    'priority' => 20, 
    )
  );
$wp_customize->add_control(
  'copyright_area_text',
  array(
    'section' => 'footer_copyright',                
    'label'   => __('Enter Copyright Text','digital-products'),
    'type'    => 'textarea',
    )
  );
// Text Panel Starts Here 
require get_template_directory() . '/inc/fonts.php';
$wp_customize->add_section( 'typography_text' , array(
  'title'       => __( 'Typography', 'digital-products' ),
  'priority'    => 135,
  'capability'     => 'edit_theme_options',
  'panel' => 'styling'
  ) );
// Text Font Type
$wp_customize->add_setting(
  'text_font_type',
  array(
    'default' => __('Open Sans', 'digital-products'),
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
  );
$text_font_choices = customizer_library_get_font_choices();
$wp_customize->add_control(
  'text_font_type',
  array(
    'section' => 'typography_text',
    'label'      => __('Select Body Font Family', 'digital-products'),
    'type'       => 'select',
    'choices' => $text_font_choices,
    )
  );


//Menu Font Type
$wp_customize->add_setting(
  'menu_font_type',
  array(
    'default' => __('select', 'digital-products'),
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
  );

$wp_customize->add_control(
  'menu_font_type',
  array(
    'section' => 'typography_text',
    'label'      => __('Select Menu Font Family', 'digital-products'),
    'type'       => 'select',
    'choices' => $text_font_choices,
    )
  );

// Heading Font Type
$wp_customize->add_setting(
  'heading_font_type',
  array(
    'default' => __('Montserrat', 'digital-products'),
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
  );
//$text_font_choices = customizer_library_get_font_choices();
$wp_customize->add_control(
  'heading_font_type',
  array(
    'section' => 'typography_text',
    'label'      => __('Select Heading Font Family', 'digital-products'),
    'type'       => 'select',
    'choices' => $text_font_choices,
    )
  );
$wp_customize->add_setting( 'h1_font_size', array(
  'default'        => 42,
  'sanitize_callback' => 'sanitize_text_field',
  'capability'     => 'edit_theme_options',
  ) );
$wp_customize->add_control( 'h1_font_size', array(
  'label'   => __('H1 Font Size','digital-products'),
  'section' => 'typography_text',
  'type'    => 'text',
  ) );
$wp_customize->add_setting( 'h2_font_size', array(
  'default'        => 36,
  'sanitize_callback' => 'sanitize_text_field',
  'capability'     => 'edit_theme_options',
  ) );
$wp_customize->add_control( 'h2_font_size', array(
  'label'   => __('H2 Font Size','digital-products'),
  'section' => 'typography_text',
  'type'    => 'text',
  ) ); 
$wp_customize->add_setting( 'h3_font_size', array(
  'default'        => 30,
  'sanitize_callback' => 'sanitize_text_field',
  'capability'     => 'edit_theme_options',
  ) );
$wp_customize->add_control( 'h3_font_size', array(
  'label'   => __('H3 Font Size','digital-products'),
  'section' => 'typography_text',
  'type'    => 'text',
  ) ); 
$wp_customize->add_setting( 'h4_font_size', array(
  'default'        => 24,
  'sanitize_callback' => 'sanitize_text_field',
  'capability'     => 'edit_theme_options',
  ) );
$wp_customize->add_control( 'h4_font_size', array(
  'label'   => __('H4 Font Size','digital-products'),
  'section' => 'typography_text',
  'type'    => 'text',
  ) ); 
$wp_customize->add_setting( 'h5_font_size', array(
  'default'        => 20,
  'sanitize_callback' => 'sanitize_text_field',
  'capability'     => 'edit_theme_options',
  ) );
$wp_customize->add_control( 'h5_font_size', array(
  'label'   => __('H5 Font Size','digital-products'),
  'section' => 'typography_text',
  'type'    => 'text',
  ) );
$wp_customize->add_setting( 'h6_font_size', array(
  'default'        => 16,
  'sanitize_callback' => 'sanitize_text_field',
  'capability'     => 'edit_theme_options',
  ) );
$wp_customize->add_control( 'h6_font_size', array(
  'label'   => __('H6 Font Size','digital-products'),
  'section' => 'typography_text',
  'type'    => 'text',
  ) );
$wp_customize->add_setting( 'normal_font_size', array(
  'default'        => 14,
  'sanitize_callback' => 'sanitize_text_field',
  'capability'     => 'edit_theme_options',
  ) );
$wp_customize->add_control( 'normal_font_size', array(
  'label'   => __('Normal Text Font Size','digital-products'),
  'section' => 'typography_text',
  'type'    => 'text',
  ) );
$wp_customize->add_setting( 'menu_font_size', array(
  'default'        => 14,
  'sanitize_callback' => 'sanitize_text_field',
  'capability'     => 'edit_theme_options',
  ) );
$wp_customize->add_control( 'menu_font_size', array(
  'label'   => __('Menu Text Font Size','digital-products'),
  'section' => 'typography_text',
  'type'    => 'text',
  ) ); 
$wp_customize->add_panel(
  'styling',
  array(
    'title' => __( 'Styling', 'digital-products' ),
    'description' => __('styling options','digital-products'),
    'priority' => 31, 
    )
  );
$wp_customize->add_section( 'color' , array(
  'title'       => __( 'Colors', 'digital-products' ),
  'priority'    => 31,
  'capability'     => 'edit_theme_options',
  'panel' => 'styling'
  ) );

}
add_action( 'customize_register', 'digital_products_customize_register' );

function digital_products_custom_scripts(){  
  wp_enqueue_style( 'digital-products-style', get_stylesheet_uri() );
  $custom_css='';

  $custom_css .='body{
    font-family: '.esc_attr(get_theme_mod('text_font_type','Hind')).', sans-serif;
  }
  .sow-headline,h1 a,h1,h2 a,h2,h3 a,h3,h4 a,h4,h5 a,h5,h6 a,h6,p.title,.button-base a,
  .footer-box .widget-title {
   font-family: '.esc_attr(get_theme_mod('heading_font_type','Montserrat')).', sans-serif;
  }
  .sow-headline,h1 a,h1,h2 a,h2,h3 a,h3,h4 a,h4,h5 a,h5,h6 a,h6,p.title,.button-base a,
  .blog-content .title-data a,.title-data a.blogTitle,.main-sidebar h5 {
    color: '.esc_attr(get_theme_mod('body_heading_color','#282828')).';
  }
  .blog-content .readMore{ color: '.esc_attr(get_theme_mod('secondary_color','#2c3e55')).';
  border-color: '.esc_attr(get_theme_mod('secondary_color','#2c3e55')).';
  }  
  #cssmenu {
  font-family: '.esc_attr(get_theme_mod('menu_font_type','Montserrat')).', sans-serif;
  }
  h1, .h1{
    font-size: '.esc_attr(get_theme_mod('h1_font_size','42')).'px;
  }
  h2,.h2{
    font-size: '.esc_attr(get_theme_mod('h2_font_size','36')).'px;
  }
  h3,.h3{
    font-size: '.esc_attr(get_theme_mod('h3_font_size','30')).'px;
  }
  h4,.h4,.title-data a h1,.title-data a.blogTitle{
    font-size: '.esc_attr(get_theme_mod('h4_font_size','24')).'px;
  }
  h5,.h5{
    font-size: '.esc_attr(get_theme_mod('h5_font_size','20')).'px;
  }
  h6,.h6{
    font-size: '.esc_attr(get_theme_mod('h6_font_size','16')).'px;
  }
  p, span, li, a,.package-header h4 span,.main-sidebar ul li a{
    font-size: '.esc_attr(get_theme_mod('normal_font_size','14')).'px;
  }
  #cssmenu ul li a{
    font-size: '.esc_attr(get_theme_mod('menu_font_size','14')).'px;
  }
  body{
    background: '.esc_attr(get_theme_mod('body_background_color', '#ffffff')).';
  }
  body, p, time,ul, li{
    color: '.esc_attr(get_theme_mod('body_text_color','#424242')).';
  }
  ';  
  /* Preloader */
  if(get_theme_mod('preloader') == 2) :
    $custom_css .='.preloader-block .preloader-custom-gif, .preloader-block .preloader-gif,.preloader-block{ background:none !important; }';
  endif;
  if(get_theme_mod('custom_preloader') != '' && get_theme_mod('preloader') != 2 ) : 
    $custom_css .='.preloader-block .preloader-custom-gif, .preloader-block .preloader-gif{  background: url('.esc_url(get_theme_mod('custom_preloader')).'); background-repeat: no-repeat; }';
  endif; 
  /* end Preloader */
  /*Digital Products Color System*/
  $custom_css .='.site-title,
  .site-description,
  #cssmenu > ul > li > a,
  #cssmenu ul ul li a,
  .themesnav #cssmenu>ul>li.current_page_item>a:after,.themesnav #cssmenu>ul>li>a:after{
    color: '.esc_attr(get_theme_mod('menu_text_color','#ffffff')).';
  }
  #cssmenu #menu-button.menu-opened::after,
  #cssmenu #menu-button.menu-opened::before,
  #cssmenu #menu-button::before,
  #cssmenu #menu-button::after{
    border-color: '.esc_attr(get_theme_mod('menu_text_color','#ffffff')).';
  }
  #cssmenu > ul > li:hover > a, #cssmenu > ul > li:hover > a, #cssmenu > ul > li.active > a, #cssmenu ul ul li:hover > a, #cssmenu ul ul li a:hover,
  .themesnav #cssmenu>ul>li.current_page_item:hover>a:after,.themesnav #cssmenu>ul>li:hover>a:after {
    color: '.esc_attr(get_theme_mod('menu_text_hover_color','#ffffff')).';
  }
  .themesnav #cssmenu.style1>ul>li.current_page_item>a:before,
  .themesnav #cssmenu.style1>ul>li>a:before{
    border-color: '.esc_attr(get_theme_mod('menu_text_hover_color','#ffffff')).';
  }
  .fixed-header #cssmenu.style1>ul>li.current_page_item>a:before, .fixed-header #cssmenu.style1>ul>li>a:before,
  .headerChange #cssmenu.style1>ul>li.current_page_item>a:before, .headerChange #cssmenu.style1>ul>li>a:before{
    border-color: '.esc_attr(get_theme_mod('menu_text_hover_color_scroll','#ffffff')).';
  }
  .themesnav #cssmenu.style2 > ul > li:hover > a:before,
  .themesnav #cssmenu.style2 > ul > li.current_page_item > a:before,
  .themesnav #cssmenu.style3 > ul > li:hover > a:before,
  .themesnav #cssmenu.style3 > ul > li.current_page_item > a:before{
    background: '.esc_attr(get_theme_mod('menu_text_hover_color','#ffffff')).';
  }
  .fixed-header #cssmenu > ul > li:hover > a,
  .fixed-header #cssmenu > ul > li:hover > a,
  .fixed-header #cssmenu > ul > li.active > a,
  .fixed-header #cssmenu ul ul li:hover > a,
  .fixed-header #cssmenu ul ul li a:hover{
    color: '.esc_attr(get_theme_mod('menu_text_hover_color_scroll','#ffffff')).';
  }
  .fixed-header #cssmenu.style1>ul>li.current_page_item:hover>a:after,.fixed-header #cssmenu.style1>ul>li:hover>a:after{
    border-color: '.esc_attr(get_theme_mod('menu_text_hover_color_scroll','#ffffff')).';
  }

  .fixed-header #cssmenu #menu-button.menu-opened::after,
  .fixed-header #cssmenu #menu-button.menu-opened::before,
  .fixed-header #cssmenu #menu-button::before,
  .fixed-header #cssmenu #menu-button::after{
    border-color: '.esc_attr(get_theme_mod('menu_text_hover_color_scroll','#ffffff')).';
  }  
  /* style - 2 */
  .fixed-header #cssmenu.style2 > ul > li:hover > a:before{
    border-color: '.esc_attr(get_theme_mod('menu_text_hover_color_scroll','#ffffff')).';
  }
  .fixed-header #cssmenu.style2 > ul > li:hover > a:before,
  .fixed-header #cssmenu.style2 > ul > li.current_page_item > a:before{
    background: '.esc_attr(get_theme_mod('menu_text_hover_color_scroll','#ffffff')).';
  }
  /* style - 3 */
  .headerChange #cssmenu.style3 > ul > li:hover > a:before,
  .fixed-header #cssmenu.style3 > ul > li:hover > a:before,
  .fixed-header #cssmenu.style3 > ul > li:hover > a:before,
  .fixed-header #cssmenu.style3 > ul > li.current_page_item > a:before{
    background: '.esc_attr(get_theme_mod('menu_text_hover_color_scroll','#ffffff')).';
  }
  /* style - 4 */
  .themesnav #cssmenu.style4 > ul > li:hover > a,
  .themesnav #cssmenu.style4 > ul > li.current_page_item > a{color: '.esc_attr(get_theme_mod('menu_text_hover_color','#ffffff')).';  }
  .fixed-header #cssmenu.style4 > ul > li:hover > a,
  .fixed-header #cssmenu.style4 > ul > li.current_page_item > a{color: '.esc_attr(get_theme_mod('menu_text_hover_color_scroll','#ffffff')).';}
  /* style - 5 */
  .themesnav #cssmenu.style5>ul>li.current_page_item>a{
    color: '.esc_attr(get_theme_mod('menu_text_hover_color','#ffffff')).';
  }
  .fixed-header #cssmenu.style5>ul>li.current_page_item>a{
    color: '.esc_attr(get_theme_mod('menu_text_hover_color_scroll','#ffffff')).';
  }
  #cssmenu.style5 .submenu-button::after, #cssmenu.style5 .submenu-button::before{background: '.esc_attr(get_theme_mod('menu_text_hover_color_scroll','#ffffff')).';}
  /* style - 5 end */ 
  a:hover,a:hover h3,.blog-content a.btn-light:hover,.title-data a.blogTitle:hover,.title-data a:hover h1,.page-numbers.current{
    color: '.esc_attr(get_theme_mod('theme_color','#0e76bc')).';
  }
  .comment .comment-reply-link, .comment-reply-title small a,.button.openModal,.blog-content a.btn-light:hover,
  .blog-style-two .page-numbers.current, .blog-style-two .page-numbers:hover {
    color: '.esc_attr(get_theme_mod('theme_color','#0e76bc')).';
    border-color: '.esc_attr(get_theme_mod('theme_color','#0e76bc')).';
  }
  .comment .comment-reply-link:hover, .comment-reply-title small a:hover,.button.openModal:hover{
    background: '.esc_attr(get_theme_mod('theme_color','#0e76bc')).';
  }
  a.readMore:hover, .blog-content .readMore:hover{
    color: '.esc_attr(get_theme_mod('theme_color','#0e76bc')).';
    border-color: '.esc_attr(get_theme_mod('theme_color','#0e76bc')).';
  }
  #cssmenu .submenu-button::after,
  #cssmenu .submenu-button::before {
    background-color: '.esc_attr(get_theme_mod('menu_text_color_scroll','#ffffff')).';
  } 
  .home  .themesnav{
      background-color: transparent;
  }
  ';
  if(get_theme_mod('menu_background_color') == '') : 
    $custom_css .='.themesnav{
      background-color: transparent;
    }';
      if(!is_front_page()) : 
    $theme_color = get_theme_mod('menu_background_color','#ffffff');
    $rgba_theme_color = digital_products_hex_to_rgba($theme_color,1);
    endif;
  else :
    $theme_color = get_theme_mod('menu_background_color');
    $rgba_theme_color = digital_products_hex_to_rgba($theme_color,1);
    $custom_css .='.themesnav{
      background: '.esc_attr(get_theme_mod('menu_background_color')).';
    }';
   endif;
  if(get_theme_mod('menu_dropdown_color') == '') : 
    $custom_css .='.themesnav #cssmenu ul ul li a, .themesnav #cssmenu.style5>ul .current_page_item:hover a,
    .themesnav #cssmenu.style5>ul>li:hover a, .themesnav #cssmenu.style5>ul .current_page_item a{
      background: '.esc_attr(digital_products_hex_to_rgba(get_theme_mod('menu_background_color','#ffffff'),0.3)).';
    }';
  else:
    $custom_css .='.themesnav #cssmenu ul ul li a, .themesnav #cssmenu.style5>ul .current_page_item:hover a,
    .themesnav #cssmenu.style5>ul>li:hover a, .themesnav #cssmenu.style5>ul .current_page_item a{
      background: '.esc_attr(get_theme_mod('menu_dropdown_color')).';
    }';
  endif;
  $home_fixed_class = (get_theme_mod('menu_background_color_scroll') == '')?'#ebebeb': esc_attr(get_theme_mod('menu_background_color_scroll'));
    $custom_css .='.header-logo .custom-logo, .header-logo .logo-dark,
      .themesnav.headerChange .logo-light{
        max-height: '.esc_attr(get_theme_mod('logo_height','45')).'px;
      }
      .home-fixed-class {
        background: '.$home_fixed_class.' ;
      }';
    $theme_color = get_theme_mod('menu_background_color_scroll','#ffffff');
    $rgba_theme_color = digital_products_hex_to_rgba($theme_color,1);

    $fixed_header = ($theme_color == '')?'#ebebeb':esc_attr($rgba_theme_color);
    $custom_css .='.fixed-header,.home .fixed-header{
      background: '.$fixed_header.';
    }
    .fixed-header #cssmenu ul ul li a,
    .fixed-header #cssmenu.style5>ul .current_page_item:hover a,
    .fixed-header #cssmenu.style5>ul>li:hover a, .fixed-header #cssmenu.style5>ul .current_page_item a,
    .headerChange #cssmenu ul ul li a,
    .headerChange #cssmenu.style5>ul .current_page_item:hover a,
    .headerChange #cssmenu.style5>ul>li:hover a, .headerChange #cssmenu.style5>ul .current_page_item a{
      background: '.esc_attr(digital_products_hex_to_rgba(get_theme_mod('menu_background_color_scroll','#ffffff'),1)).';
    }
    .navbar-fixed-top.fixed-header{
      background-color: '.esc_attr(get_theme_mod('menu_background_color_scroll','#ffffff')).';
    }
    .fixed-header .site-title,.fixed-header .site-description,.fixed-header #cssmenu > ul > li > a,.fixed-header #cssmenu ul ul li a,
    .fixed-header #cssmenu>ul>li.current_page_item>a:after,.fixed-header #cssmenu>ul>li>a:after{
      color: '.esc_attr(get_theme_mod('menu_text_color_scroll','#000')).';
    }
    .page-numbers.current,.leave_form input:focus, .leave_form input:hover, .leave_form textarea:focus, .leave_form textarea:hover,.comment-form input:focus, .comment-form textarea:focus,
    .search-field:hover:focus,.page-numbers:hover,.btn-default:focus, .btn-default:hover, .button.blog_read:focus, .button.blog_read:hover{
      border-color: '.esc_attr(get_theme_mod('theme_color','#0e76bc')).'
    }
    .blog-style-one .main-sidebar .tagcloud>a:hover{background-color: '.esc_attr(get_theme_mod('theme_color','#0e76bc')).'}
    .blog-style-two .main-sidebar ul li a:hover, .blog-style-one .main-sidebar ul li a:hover{color: '.esc_attr(get_theme_mod('theme_color','#0e76bc')).'}
    .footer-box1{
      background: '.esc_attr(get_theme_mod('footer_background_color','#f7f7f7')).';
    }
    .footer-box1 div,.footer-box1 .widget-title,.footer-box1 p,.footer-box1 div,.footer-box1 h1,.footer-box1 h2,.footer-box1 h3,.footer-box1 h4,.footer-box1 h5,.footer-box1 h6 {
      color: '.esc_attr(get_theme_mod('footer_text_color','#2c3e55')).' !important;
    }
    .footer-box1 .footer-widget ul li a,.footer-widget .tagcloud a,.footer-box1 .footer-widget a.social_icons{
      color:'.esc_attr(get_theme_mod('footer_link_color','#2c3e55')).';
    }
    .footer-box1 .footer-widget ul li a:hover,.footer-box1 .footer-widget a.social_icons:hover{
      color:'.esc_attr(get_theme_mod('footer_link_hover_color','#0e76bc')).';
    }
    .footer-box1 .tagcloud > a:hover{
      background:'.esc_attr(get_theme_mod('footer_link_hover_color')).';
    }
    .under-footer{
      background:'.esc_attr(get_theme_mod('copyright_area_background_color')).';
    }
    
    .themesnav.headerChange #cssmenu #menu-button::before,
    .themesnav.headerChange #cssmenu ul ul li a,
    .themesnav.headerChange #cssmenu #menu-button::after{
      border-color: '.esc_attr(get_theme_mod('menu_text_color_scroll','#000000')).';
    }
    .themesnav.headerChange #cssmenu ul ul li a,    
    .themesnav.headerChange #cssmenu>ul>li.current_page_item>a:after,.themesnav.headerChange #cssmenu>ul>li>a:after{
      color: '.esc_attr(get_theme_mod('menu_text_color_scroll','#000000')).';
    }
    .themesnav.headerChange #cssmenu ul ul li:hover a,
    .themesnav.headerChange #cssmenu > ul > li:hover > a,.themesnav.headerChange #cssmenu ul ul li:hover a,
    .fixed-header #cssmenu>ul>li.current_page_item:hover>a:after,.fixed-header #cssmenu>ul>li:hover>a:after,
    .themesnav.headerChange #cssmenu>ul>li.current_page_item:hover>a:after,.themesnav.headerChange #cssmenu>ul>li:hover>a:after{
      color: '.esc_attr(get_theme_mod('menu_text_hover_color_scroll','#000000')).';
    }
    .themesnav.headerChange #cssmenu ul ul li a{
      border-color: '.esc_attr(get_theme_mod('menu_text_hover_color_scroll','#00000')).';
    }
    .footer-wrap{
      background: '.esc_attr(get_theme_mod('copyright_background_color','#e1e1e1')).';
    }
    .footer-box{
      background:'.esc_attr(get_theme_mod('footer_background_color','#f7f7f7')).';
    }
    .footer-box div,.footer-box .widget-title,.footer-box p,.footer-box div,.footer-box h1,.footer-box h2,.footer-box h3,.footer-box h4,.footer-box h5,.footer-box h6,
    .footer-box .footer-widget ul li,.footer-box .calendar_wrap caption {
      color: '.esc_attr(get_theme_mod('footer_text_color','#000000')).' !important;
    }
    .footer-box .footer-widget ul li a,.footer-widget .tagcloud a,.footer-box a,.footer-box td a,
    .footer-box .widget-title a{
      color:'.esc_attr(get_theme_mod('footer_link_color','#000000')).';
    }
    .footer-box a:hover,
    .footer-box .widget-title a:hover{
      color:'.esc_attr(get_theme_mod('footer_link_hover_color','#0e76bc')).';
    }
    .footer-box .footer-widget ul li a:hover{
      color:'.esc_attr(get_theme_mod('footer_link_hover_color','#0e76bc')).';
    }
    .footer-box .tagcloud>a{
      border-color: '.esc_attr(get_theme_mod('footer_link_color','#0e76bc')).';
    }
    .footer-box .tagcloud > a:hover{
      background:'.esc_attr(get_theme_mod('footer_link_hover_color','#0e76bc')).';
      color :#fff;
    }
    .footer-wrap .copyright p,.footer-wrap, .footer-wrap p{
      color: '.esc_attr(get_theme_mod('copyright_text_color', '#000')).';
    }
    .footer-wrap a,.footer-wrap.style2 .footer-nav ul li a{
      color: '.esc_attr(get_theme_mod('copyright_link_color', '#000')).';
    }
    .footer-wrap .copyright a:hover,.footer-wrap a:hover,.footer-wrap.style2 .footer-nav ul li a:hover,.footer-wrap.style2 .copyright a:hover,.footer-wrap.style1 .copyright a:hover{
      color: '.esc_attr(get_theme_mod('copyright_link_hover_color', '#5164cf')).';
    }';

    if(wp_get_attachment_url(get_theme_mod('footer_background_image'))!=''):
      $custom_css .= '.footer-box{
        background: url('.esc_url(wp_get_attachment_url(get_theme_mod('footer_background_image'))).');
        background-size: cover;
      }';
    endif;

    $custom_css .= '.back-to-top a,
    .btn-default:focus, .btn-default:hover, .button.blog_read:focus, .button.blog_read:hover,
    .main-sidebar .tagcloud>a:hover{
      background: '.esc_attr(get_theme_mod('theme_color')).'
    }
    .sow-contact-form .sow-submit-styled input[type="submit"].sow-submit,
    input[type="submit"],.contact-me.darkForm input[type=submit],
    .contact-me.lightForm input[type=submit], button[type=submit],
    input[type=submit],#commentform input[type=submit], .comment .comment-reply-link {      
      border-color: '.esc_attr(get_theme_mod('theme_color','#0e76bc')).';      
      color: '.esc_attr(get_theme_mod('theme_color','#0e76bc')).';
      text-shadow: 0 0 0 rgba(0,0,0,0);
      max-width: 100%;
      text-align: center;
      line-height: 1;
    }
    .sow-contact-form .sow-submit-styled input[type="submit"]:hover.sow-submit, input[type="submit"]:hover,.contact-me.darkForm input[type=submit]:hover, .contact-me.lightForm input[type=submit]:hover, button[type=submit]:hover, input[type=submit]:hover,#commentform input[type=submit]:hover{
      background: '.esc_attr(get_theme_mod('theme_color','#0e76bc')).'
    }';

    $theme_color = get_theme_mod('menu_background_color_scroll','#ffffff');
    $rgba_theme_color = digital_products_hex_to_rgba($theme_color,get_theme_mod('mobile_transparent'));

    $custom_css .= '@media only screen and (max-width:1024px) {      
      #cssmenu ul{
        background: '.esc_attr($rgba_theme_color).';
      }
      .site-title, .site-description, #cssmenu > ul > li > a, #cssmenu ul ul li a{
        color: '.esc_attr(get_theme_mod('menu_text_color_scroll','#000')).'
      }
      #cssmenu > ul > li:hover > a, #cssmenu > ul > li:hover > a, #cssmenu > ul > li.active > a, #cssmenu ul ul li:hover > a, #cssmenu ul ul li a:hover {
        color: '.esc_attr(get_theme_mod('menu_text_hover_color_scroll','#ffffff')).';
      }
      .themesnav #cssmenu ul ul li a,.fixed-header #cssmenu ul ul li a{
        background: transparent;
      }
      .themesnav #cssmenu.style1>ul>li.current_page_item>a:before, .themesnav #cssmenu.style1>ul>li>a:before{
        border-color: transparent;
      }
      /* style - 5 */
      .themesnav #cssmenu.style5>ul>li:hover a{background: rgba(221, 189, 139, 0);}
      .themesnav #cssmenu.style5>ul>li.current_page_item>a,.fixed-header #cssmenu.style5>ul>li.current_page_item>a{
       color: '.esc_attr(get_theme_mod('menu_text_hover_color_scroll','#ffffff')).';
      }';
      
      if(get_theme_mod('menu_dropdown_color') == '') :
          $custom_css .= '.themesnav #cssmenu.style5>ul li.current_page_item a:hover ,
          .themesnav #cssmenu.style5>ul>li a:hover , .themesnav #cssmenu.style5>ul li.current_page_item a,.themesnav #cssmenu.style5 ul ul li a:hover{
            background: '.esc_attr(get_theme_mod('menu_dropdown_color_scroll','#ffffff')).';
          }';
      else:
          $custom_css .= '.themesnav #cssmenu.style5>ul li.current_page_item a:hover ,
          .themesnav #cssmenu.style5>ul>li a:hover , .themesnav #cssmenu.style5>ul li.current_page_item a,.themesnav #cssmenu.style5 ul ul li a:hover
          {
            background: '.esc_attr(get_theme_mod('menu_dropdown_color_scroll')).';
          }';
      endif;
    $custom_css .= '}';
    if(get_header_image()):
      $custom_css .= '.heading-image {
       background:rgba(0, 0, 0, 0) url("'.esc_url(get_header_image()).'") repeat scroll 0 0;
      }';
    endif; 
    $custom_css .= '.heading-image {
      background: '.esc_url(get_theme_mod('theme_color','#0e76bc')).';
    }';

  wp_add_inline_style('digital-products-style',$custom_css);
}