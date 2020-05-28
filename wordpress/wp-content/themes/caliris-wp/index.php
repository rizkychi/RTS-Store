<?php get_header(); ?>
<div id="content" class="site-content">    
    <?php
    global $post;

    $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
    query_posts('post_type=post&paged=' . $page);

    if (have_posts()) :
        echo '<div class="blog-holder block center-relative">';
        require get_parent_theme_file_path('loop-index.php');        
        echo '</div><div class="clear"></div><div class="block center-relative center-text more-posts-index-holder"><a target="_self" class="more-posts">' . esc_html__('Load More', 'caliris-wp') . '</a><a class="more-posts-loading">' . esc_html__('Load More', 'caliris-wp') . '</a><a class="no-more-posts">' . esc_html__('Load More', 'caliris-wp') . '</a></div>';
    endif;
    echo '<div class="clear"></div>';
    ?>   
</div>

<?php get_footer(); ?>