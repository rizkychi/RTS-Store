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
} ?>
<section>
    <div class="container">
        <div id="post-<?php the_ID(); ?>" <?php post_class('row blog-style-three'); ?>>
            <?php if($sidebar_style == 'left_sidebar'){ get_sidebar(); } ?>
            <div class="<?php echo esc_attr($column_classes); ?>">
                <div class="blog-block">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article class="post-publish">
                            <div class="post-head">
                                <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>"><?php the_title(); ?></a></h3>
                                <div class="entry-meta">
                                <span class="author"> 
                                    <?php esc_html_e('By ','digital-products');  the_author_link(); ?>
                                </span>
                                <?php $digital_products_num_comments = get_comments_number();
                                if($digital_products_num_comments != 0){ ?>
                                    <span class="post-date"><?php the_date(); ?>
                                        <a href="#"><?php echo esc_html($digital_products_num_comments); esc_html_e(' Comments','digital-products'); ?></a>
                                    </span>
                                <?php } ?>
                                </div>
                            </div>
                            <?php if(has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>" class="post-media">
                                    <?php the_post_thumbnail('digital-products-thumbnail-image', array('class' => 'img-responsive')); ?>
                                </a>
                            <?php endif; ?>
                            <div class="post-content"><?php the_excerpt(); ?></div>
                             <div class="post-footer">
                                <?php $digital_products_categories = get_the_category(); ?>
                                <div class="post-category">
                                    <a href="#" title="category">
                                    <i class="fa fa-folder-open-o" aria-hidden="true"></i><?php if(isset($digital_products_categories[0]->name)){ echo esc_html($digital_products_categories[0]->name); } ?></a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile;
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
</section>