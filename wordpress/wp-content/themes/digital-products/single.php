<?php
/*
* Single Post template file
*/
get_header();
$sidebar_style = get_theme_mod('single_sidebar_style','right_sidebar');

if($sidebar_style == 'no_sidebar'){
    $column_classes = 'col-md-10 col-sm-12 col-xs-12 col-md-offset-1';
} else{
    $column_classes = 'col-md-8 col-sm-8 col-xs-12';
} ?>
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
<div class="blog-wrapper">
    <div class="section">
        <div class="container">
            <div id="post-<?php the_ID(); ?>" <?php post_class('row blog-style-one'); ?>>
                <div class=""></div>
                <?php if($sidebar_style == 'left_sidebar'){ get_sidebar(); } ?>
                <div class="<?php echo esc_attr($column_classes); ?>">
                    <div class="blog-content-area fadeIn">
                        <?php if(have_posts()) :
                            while ( have_posts() ) : the_post(); ?>
                            <div class="blog-content">
                                <div class="title-data fadeIn">
                                    <h1><?php the_title(); ?></h1>
                                   <p><?php echo sprintf('<time datetime="%1$s">%2$s</time>', esc_attr(get_the_date('c')), esc_html(get_the_date('F d, Y'))); ?></p>
                                </div>
                                <?php if ( has_post_thumbnail() ) : ?>
                                 <div class="single-blog-images">
                                    <?php the_post_thumbnail('',array( 'alt' => esc_attr(get_the_title()), 'class' => esc_attr('img-responsive','digital-products'))); ?>
                                </div>
                                <?php endif;
                                the_content(); ?>                                
                            </div>
                            <?php comments_template('', true);
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'digital-products' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                                'next_or_number' => 'next_and_number',
                                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'digital-products' ) . ' </span>%',
                                'separator'   => '<span class="screen-reader-text">, </span>',
                            ) );
                            endwhile;
                            wp_reset_postdata();
                            endif; ?>
                    </div>
                </div>
                <?php if($sidebar_style == 'right_sidebar'){ get_sidebar(); } ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();