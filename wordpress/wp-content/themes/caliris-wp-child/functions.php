<?php


function caliris_wp_child_enqueue_styles() {  
    wp_enqueue_style( 'caliris-main-theme-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'caliris-child-main-theme-style',get_stylesheet_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'caliris_wp_child_enqueue_styles', 11);

function caliris_child_lang_setup() {
    load_child_theme_textdomain( 'caliris-wp', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'caliris_child_lang_setup' );

?>