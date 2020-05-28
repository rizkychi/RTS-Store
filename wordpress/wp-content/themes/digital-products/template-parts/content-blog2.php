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
 <div class="blog-wrapper">
    <div class="blog-section">
        <div class="container">
            <div id="post-<?php the_ID(); ?>" <?php post_class('row blog-style-two'); ?>>
                <div class=""></div>
                <?php if($sidebar_style == 'left_sidebar'){ get_sidebar(); } ?>
                <div class="<?php echo esc_attr($column_classes); ?>">
                    <div class="blog-content-area">
                        <div class="other-news">
                            <?php while ( have_posts() ) : the_post(); ?>
                            <div class="othernews-post">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <?php if ( has_post_thumbnail() ) { ?>
                                            <div class="col-sm-4">
                                                <div class="label-img">
                                                    <div class="othernews-post-image">
                                                        <?php the_post_thumbnail('digital-products-thumbnail-image'); ?>
                                                    </div>
                                                    <?php $digital_products_categories = get_the_category(); ?>
                                                    <div class="label">
                                                        <div class="row label-row">
                                                            <div class="col-sm-9 col-xs-9 label-column">
                                                                <span><?php if(isset($digital_products_categories[0]->name)){ echo esc_html($digital_products_categories[0]->name); } ?></span>
                                                            </div>
                                                            <?php $digital_products_num_comments = get_comments_number();
                                                            if($digital_products_num_comments != 0){ ?>
                                                            <div class="col-sm-3 col-xs-3">
                                                                <div class="comments">
                                                                    <i class="fa fa-comments  comments-icon"></i>
                                                                    <span class="comments-no" style="padding-left:7px;"><?php if(isset($digital_products_num_comments)){ echo esc_html($digital_products_num_comments); } ?></span>
                                                                </div>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="<?php if ( has_post_thumbnail() ){ echo 'col-sm-8'; } else{ echo 'col-sm-12'; } ?>">
                                                <div class="othernews-post-details">
                                                    <h4 class="othernews-post-title"><b><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></b></h4>
                                                    <div class="othernews-post-news">
                                                        <?php the_excerpt(); ?>
                                                        <a href="<?php the_permalink();?>" class="btn-light readMore"><?php esc_html_e('Read More','digital-products'); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile;
                            the_posts_pagination( array(
                            'mid_size' => 10,
                            'Previous' => __( 'Back', 'digital-products' ),
                            'Next' => __( 'Onward', 'digital-products' ),
                        ) ); ?>
                        </div>
                    </div>
                </div>
                <?php if($sidebar_style == 'right_sidebar'){ get_sidebar(); } ?>
            </div>
        </div>
    </div>
</div>