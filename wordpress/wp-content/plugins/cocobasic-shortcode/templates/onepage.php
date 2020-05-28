<?php
/*
  Template Name: OnePage
 */
?>

<?php get_header(); ?>
<div id="content" class="site-content center-relative">        
    <?php
    $args = array('post_type' => 'page', 'posts_per_page' => '-1', 'orderby' => 'menu_order', 'order' => 'ASC', 'meta_query' => array(array('key' => 'page_structure', 'value' => '2', 'compare' => '=')));
    $loop = new WP_Query($args);
    $allowed_html_array = cocobasic_allowed_plugin_html();
    if ($loop->have_posts()) :
        while ($loop->have_posts()) : $loop->the_post();
            $slug = $post->post_name;
            $curentPostID = $post->ID;
            if (get_post_meta($post->ID, "page_title_position", true) == 'right'):
                $title_position = 'float-right';
                $content_position = 'float-left';
            else:
                $title_position = 'float-left';
                $content_position = 'float-right';
            endif;


            $class = 'section ';
            if (get_post_meta($post->ID, "page_full_screen", true) == 'yes'):
                $class .= 'full-screen ';
            endif;

            if (get_page_template_slug($curentPostID) == 'page-split.php'):
                ?>
                <div id="<?php echo $slug; ?>" <?php post_class('section page-split'); ?>>                   
                    <div class="section-wrapper block content-1170 center-relative">  
                        <?php if (get_post_meta($curentPostID, "page_background_img_title", true) != ''): ?>
                            <div class="bg-holder <?php echo $title_position; ?>">                            
                                <img src="<?php echo esc_url(get_post_meta($curentPostID, "page_background_img_title", true)); ?>" alt="" />
                            </div>  
                        <?php endif; ?>                        
                        <div class="section-title-holder <?php echo $title_position; ?>" style="background-color: <?php echo sanitize_hex_color(get_post_meta($curentPostID, "page_background_color_title", true)) ? : '#F1576B'; ?>;">                              
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
            <?php else: // is Default Page   ?> 

                <div id="<?php echo $slug; ?>" <?php post_class($class . 'full-width'); ?>>                   
                    <div class="section-wrapper block content-1170 center-relative">                                                
                        <div class="content-wrapper">
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
                            <?php the_content(); ?>    
                        </div>
                        <div class="clear"></div>
                    </div>
                </div> 
            <?php
            endif;
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div>
<?php get_footer(); ?>