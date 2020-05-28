<?php
/*
  Template Name: Page Scrolling
 */
?>

<?php get_header(); ?>

<div id="content" class="site-content">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            $curentPostID = $post->ID;

            if (get_post_meta($post->ID, "page_title_position", true) == 'right'):
                $title_position = 'float-right';
                $content_position = 'float-left';
            else:
                $title_position = 'float-left';
                $content_position = 'float-right';
            endif;
            ?>

            <div <?php post_class('section page-split'); ?>>                   
                <div class="section-wrapper block content-1170 center-relative">  
                    <?php if (get_post_meta($curentPostID, "page_background_img_title", true) != ''): ?>
                        <div class="bg-holder <?php echo $title_position; ?>">                            
                            <img src="<?php echo esc_url(get_post_meta($curentPostID, "page_background_img_title", true)); ?>" alt="" />
                        </div>  
                    <?php endif; ?>
                    <div class="section-title-holder <?php echo $title_position; ?>" style="background-color: <?php echo sanitize_hex_color(get_post_meta($curentPostID, "page_background_color_title", true)) ? : '#fff'; ?>;">                              
                        <div class="section-num">
                            <?php if (get_post_meta($curentPostID, "page_big_number", true) != ''): ?>
                                <span class="current-section-num">
                                    <?php echo esc_html(get_post_meta($curentPostID, "page_big_number", true)); ?>
                                </span>
                            <?php endif; ?>
                            <?php if (get_post_meta($curentPostID, "page_small_number", true) != ''): ?>
                                <span class="total-section-num">
                                    <?php echo esc_html(get_post_meta($curentPostID, "page_small_number", true)); ?>
                                </span>
                            <?php endif; ?>
                        </div>   
                        <?php if (get_post_meta($curentPostID, "page_show_title", true) != 'no'): ?>
                            <h2 class="entry-title">
                                <?php
                                if (get_post_meta($curentPostID, "page_custom_title", true) != '') {
                                    echo esc_html(get_post_meta($curentPostID, "page_custom_title", true));
                                } else {
                                    echo get_the_title();
                                }
                                ?>
                            </h2>
                        <?php endif; ?>
                        <?php if (get_post_meta($post->ID, "page_description", true) != ''): ?>
                            <p class="page-desc">
                                <?php echo do_shortcode(wp_kses(get_post_meta($post->ID, "page_description", true), $allowed_html_array)); ?>
                            </p>
                        <?php endif; ?>
                    </div>                        
                    <div class="section-content-holder <?php echo $content_position; ?>">
                        <div class="content-wrapper">                                
                            <?php the_content(); ?>    
                        </div>
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