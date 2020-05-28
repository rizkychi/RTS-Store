<?php
/**
 * 404 page template file
 * */
get_header(); ?>
<div class="blog-wrapper">
    <div class="section">
        <div class="container">
            <div id="post-<?php the_ID(); ?>" <?php post_class('row'); ?> >
                <div class=""></div>
                <div class="col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e('Epic 404 - Article Not Found', 'digital-products') ?></h1>
                        <p><?php esc_html_e("This is embarassing. We can't find what you were looking for.", 'digital-products') ?></p>
                        <p><?php esc_html_e('Whatever you were looking for was not found, but maybe try looking again or search using the form below.', 'digital-products') ?></p>
                    </header>
                    <div class="page-content">
                        <?php
                        if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

                            <p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'digital-products' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

                        <?php elseif ( is_search() ) : ?>

                            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'digital-products' ); ?></p>
                            <?php
                                get_search_form();

                        else : ?>

                            <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'digital-products' ); ?></p>
                            <?php
                                get_search_form();

                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>