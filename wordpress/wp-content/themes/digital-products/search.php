<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Digital Products Wordpress Theme
 */

get_header(); ?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>
			<div class="heading-image">
			    <div class="image-layer">
			        <div class="container">
			            <div class="row">
			                <div class="col-md-12 col-sm-12 col-xs-12">
			                    <div class="title">
			                        <h1><?php printf( esc_html__( 'Search Results for : %s', 'digital-products' ), get_search_query() ); ?></h1>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			<?php
			/* Start the Loop */
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				$blog_style = get_theme_mod('blog_style','blog1');
				//get_template_part( 'template-parts/content', 'search' );
				get_template_part('template-parts/content',$blog_style);
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>
		</main><!-- #main -->
	</section><!-- #primary -->
<?php
get_footer();