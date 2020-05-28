<?php get_header(); ?>
<div  <?php post_class('member-item-wrapper center-relative'); ?>>
    <?php
    global $post;

    if (isset($_POST["action"]) && ($_POST["action"] === 'team_ajax')):
        if ($member_query->have_posts()) :
            while ($member_query->have_posts()) : $member_query->the_post();
                echo '<div class="member-content">';
                the_content();
                echo '</div>';
            endwhile;
        endif;
    else:
        if (have_posts()) :
            while (have_posts()) : the_post();
                echo '<div class="member-content">';
                the_content();
                echo '</div>';
            endwhile;
        endif;
    endif;
    ?>
</div>
<?php get_footer(); ?>