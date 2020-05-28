<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>        
        <meta charset="<?php bloginfo('charset'); ?>" />        
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />       
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="site-wrapper">             
            <div class="doc-loader">
                <?php if (get_option('caliris_preloader') !== ''): ?>
                    <img src="<?php echo esc_url(get_option('caliris_preloader', get_template_directory_uri() . '/images/preloader.gif')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                <?php endif; ?>
            </div>       

            <header class="header-holder">             
                <div class="menu-wrapper center-relative relative">             
                    <div class="header-logo">
                        <?php
                        if (get_option('caliris_header_logo') !== ''):
                            if ((is_page()) && (get_post_meta($post->ID, "page_show_title", true) == 'no')):
                                ?>
                                <h1 class="site-logo">
                                    <a href="<?php echo esc_url(site_url('/')); ?>">
                                        <img src="<?php echo esc_url(get_option('caliris_header_logo', get_template_directory_uri() . '/images/logo.png')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                                    </a>        
                                </h1>                                                                        
                            <?php else: ?>                    
                                <a href="<?php echo esc_url(site_url('/')); ?>">
                                    <img src="<?php echo esc_url(get_option('caliris_header_logo', get_template_directory_uri() . '/images/logo.png')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                                </a>               
                            <?php endif; ?>                   
                        <?php endif; ?>                   
                    </div>

                    <div class="toggle-holder">
                        <div id="toggle" class="">
                            <div class="first-menu-line"></div>
                            <div class="second-menu-line"></div>
                            <div class="third-menu-line"></div>
                        </div>
                    </div>

                    <div class="menu-holder">
                        <?php
                        if (has_nav_menu("custom_menu")) {
                            wp_nav_menu(
                                    array(
                                        "container" => "nav",
                                        "container_class" => "",
                                        "container_id" => "header-main-menu",
                                        "fallback_cb" => false,
                                        "menu_class" => "main-menu sm sm-clean",
                                        "theme_location" => "custom_menu",                                        
                                        "items_wrap" => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        "walker" => new caliris_header_menu()
                                    )
                            );
                        } else {
                            echo '<nav id="header-main-menu" class="default-menu"><ul>';
                            wp_list_pages(array("depth" => "3", 'title_li' => ''));
                            echo '</ul>';
                            echo '</nav>';
                        }
                        ?>                       
                    </div>
                    <div class="clear"></div>   
                </div>
            </header>
