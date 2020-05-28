<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Digital Products Wordpress Theme
 */ ?>
<div class="blog-wrapper">
    <div class="section">
        <div class="container">
            <div id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>
                <div class=""></div>
                <div class="col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
                    <div class="blog-content-area">
                        <?php if(have_posts()) :
                            while ( have_posts() ) : the_post(); ?>
                            <div class="blog-content">
                                <div class="title-data">
                                    <a href="<?php the_permalink();?>"><h3><?php the_title(); ?></h3></a>
                                   <p><?php echo sprintf('<time datetime="%1$s">%2$s</time>', esc_attr(get_the_date('c')), esc_html(get_the_date('F d, Y'))); ?></p>
                                </div>
                                <?php if ( has_post_thumbnail() ) : ?>
                                <div class="blog-images">
                                    <?php the_post_thumbnail('',array( 'alt' => esc_attr(get_the_title()), 'class' => esc_attr('img-responsive','digital-products'))); ?>
                                </div>
                            <?php endif;
                            the_excerpt(); ?>
                                <a href="<?php the_permalink();?>" class="btn-light"><?php esc_html_e('Read More','digital-products'); ?><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        <?php endwhile; endif;
                        the_posts_pagination( array(
                            'mid_size' => 10,
                            'Previous' => __( 'Back', 'digital-products' ),
                            'Next' => __( 'Onward', 'digital-products' ),
                        ) ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>