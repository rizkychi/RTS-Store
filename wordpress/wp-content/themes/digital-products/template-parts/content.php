<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Digital Products Wordpress Theme
 */ 
$sidebar_style = get_theme_mod('sidebar_style', 'no_sidebar');
if($sidebar_style == 'no_sidebar'){
    $column_classes = 'col-md-offset-2 col-md-8 col-sm-12 col-xs-12';
} else {
    $column_classes = 'col-md-8 col-sm-12 col-xs-12 blog-content-responsive';
}
?>
<div class="blog-wrapper">
    <div class="blog-section">
        <div class="container">
            <div id="post-<?php the_ID(); ?>" <?php post_class('row blog-style-one'); ?>>
                <div class=""></div>
                <?php if($sidebar_style == 'left_sidebar'){ get_sidebar(); } ?>
                <div class="<?php echo esc_attr($column_classes); ?>">
                    <div class="blog-content-area">
                        <?php if(have_posts()) :
                            while ( have_posts() ) : the_post(); ?>
                            <div class="blog-content">
                                <div class="title-data">
                                    <a class="blogTitle" href="<?php the_permalink();?>"><?php the_title(); ?></a>
                                   <p><?php echo sprintf('<time datetime="%1$s">%2$s</time>', esc_attr(get_the_date('c')), esc_html(get_the_date('F d, Y'))); ?></p>
                                </div>
                                <?php if ( has_post_thumbnail() ) : ?>
                                <div class="blog-images">
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'business_consultant_thumbnail_image', array( 'alt' => esc_attr(get_the_title()), 'class' => 'img-responsive') ); ?></a>
                                </div>
                            <?php endif; ?>
                                <?php the_excerpt(); ?>
                                <a href="<?php the_permalink();?>" class="btn-light readMore"><?php _e('Read More','digital-products'); ?></a>
                            </div>
                        <?php endwhile; wp_reset_postdata(); endif;
                        the_posts_pagination( array(
                            'mid_size' => 10,
                            'Previous' => __( 'Back', 'digital-products' ),
                            'Next' => __( 'Onward', 'digital-products' ),
                        ) ); ?>
                    </div>
                </div>
                <?php if($sidebar_style == 'right_sidebar'){ get_sidebar(); } ?>
            </div>
        </div>
    </div>
</div>