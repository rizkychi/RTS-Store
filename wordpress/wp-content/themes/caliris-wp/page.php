<?php get_header(); ?>

<div id="content" class="site-content">
    <?php
    $allowed_html_array = caliris_allowed_html();
    if (have_posts()) :
        while (have_posts()) : the_post();
            $curentPostID = $post->ID;
            $class = 'section ';
            if (get_post_meta($post->ID, "page_full_screen", true) == 'yes'):
                $class .= 'full-screen ';
            endif;
            ?>

            <div <?php post_class($class . 'full-width'); ?>>                   
                <div class="section-wrapper block content-1170 center-relative">                                                
                    <div class="content-wrapper">
                        <?php if (get_post_meta($curentPostID, "page_show_title", true) != 'no'): ?>
                            <h1 class="entry-title">
                                <?php
                                if (get_post_meta($curentPostID, "page_custom_title", true) != '') {
                                    echo esc_html(get_post_meta($curentPostID, "page_custom_title", true));
                                } else {
                                    echo get_the_title();
                                }
                                ?>
                            </h1>
                        <?php endif; ?>
                        <?php if (get_post_meta($post->ID, "page_description", true) != ''): ?>
                            <p class="page-desc">
                                <?php echo do_shortcode(wp_kses(get_post_meta($post->ID, "page_description", true), $allowed_html_array)); ?>
                            </p>
                        <?php endif; ?>
                        <?php the_content(); ?>    
                    </div>
                    <div class="clear"></div>
                </div>
            </div> 
            <?php
            comments_template();
        endwhile;
    endif;
    ?>    
</div>

<?php get_footer(); ?>