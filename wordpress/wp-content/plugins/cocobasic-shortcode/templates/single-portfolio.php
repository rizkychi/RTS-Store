<?php get_header(); ?>
<div  <?php post_class('portfolio-item-wrapper center-relative'); ?>>
    <?php
    global $post;

    if (isset($_POST["action"]) && ($_POST["action"] === 'portfolio_ajax_content_load')):
        if ($portfolio_query->have_posts()) :
            while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                echo '<div class="portfolio-content">';
                the_content();
                echo '</div>';
            endwhile;
        endif;
    else:
        if (have_posts()) :
            while (have_posts()) : the_post();
                echo '<div class="portfolio-content">';
                the_content();
                echo '</div>';
            endwhile;
        endif;

    endif;
    ?>
</div>
<?php get_footer(); ?>