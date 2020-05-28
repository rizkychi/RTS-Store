<?php
/**
*   The Header template for our theme
*/
?>
<!doctype html>
<html <?php language_attributes(); ?> >
<head>        
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <meta charset="<?php bloginfo( 'charset' ); ?>" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif;
    wp_head();  ?>
</head>
<body <?php body_class();?>>
    <div class="preloader-block"><span class="preloader-gif"></span> </div>    
    <div class="master-header" >
        <header>
            <nav class="themesnav <?php if( !is_front_page() && !is_home() && !is_page() && !is_archive() && !is_single() && !is_search() && !is_404()){ echo esc_attr('headerChange'); } ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 top-menu">
                            <?php if(get_bloginfo( 'description' ) != "") : ?>
                                <?php if( !get_theme_mod( 'logo' )) : ?>
                                    <div class="logocustomsection"> 
                                <?php endif;
                                endif; ?>
                            <div class="header-logo pull-left">
                                <?php $attachment_meta = digital_products_get_attachment(get_theme_mod('custom_logo'));
                                    $logo_image = '';
                                    if (has_custom_logo()) {                                         
                                        the_custom_logo();
                                    } 
                                    $digital_products_dark_logo=get_theme_mod('digital_products_dark_logo');
                                    $sell_ebooks_dark_logo=wp_get_attachment_url($digital_products_dark_logo);
                                    if($digital_products_dark_logo == ''){
                                            $custom_logo_id = get_theme_mod( 'custom_logo' );
                                            $digital_products_dark_logo = wp_get_attachment_url( $custom_logo_id , 'full' );
                                    }                                    
                                    if($digital_products_dark_logo != ''){ ?>
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home" itemprop="url">
                                            <img class="img-responsive logo-dark" src="<?php echo esc_url($digital_products_dark_logo); ?>" title="<?php echo esc_attr($attachment_meta['title']); ?>" alt="<?php echo esc_attr($attachment_meta['alt']); ?>" >
                                        </a>
                                    <?php }  
                                   if (display_header_text()==true){
                                        echo '<div class="logo-light title_tagline"><a href="'.esc_url(home_url('/')).'" rel="home"><h4 class="custom-logo">'.esc_html(get_bloginfo('name')).'</h4></a><h6 class="custom-logo">'.get_bloginfo('description').'</h6></div>';
                                        echo '<div class="logo-dark title_tagline"><a href="'.esc_url(home_url('/')).'" rel="home"><h4 class="logo-dark">'.esc_html(get_bloginfo('name')).'</h4></a><h6 class="logo-dark">'.get_bloginfo('description').'</h6></div>';
                                    } ?>
                            </div>
                             <div id='cssmenu' class='pull-right style2'>
                                <?php 
                                    $defaults = array(
                                        'theme_location' => 'primary',
                                        'container'       => false,
                                        'menu_id' => 'menu-main-menu',
                                    );
                                    wp_nav_menu($defaults);                                        
                                 ?>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
</div>