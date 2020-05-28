<?php
/**
 * Content Full Width Page template
 *
 */
get_header(); 
if(is_page() && !is_front_page()): ?>
<div class="heading-image">
    <div class="image-layer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
<div class="blog-wrapper">
    <div class="blog-section">
        <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'digital_products_blog_thumbnail_image', array( 'alt' => esc_attr(get_the_title()), 'class' => 'img-responsive' ) ); ?>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text"><?php the_content(); ?></div>
                    </div>
                </div>
            </div>
            <?php 
            wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages', 'digital-products' ) . ': </span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'digital-products' ) . ' </span>%',
            'separator'   => '<span class="screen-reader-text">, </span>',
            ) );
            endwhile;
            // Previous/next page navigation.
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'digital-products' ),
                'next_text'          => __( 'Next page', 'digital-products' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'digital-products' ) . ' </span>',
            ) );
            ?>
        </div>
        </div>    
    </div>
</div>
<?php get_footer(); ?>