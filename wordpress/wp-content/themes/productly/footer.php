<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package productly
 */

?>

</div><!-- #content -->



<footer id="colophon" class="site-footer" role="contentinfo">

	<?php if ( is_active_sidebar( 'footer_widget_left') ||  is_active_sidebar( 'footer_widget_middle') ||  is_active_sidebar( 'footer_widget_right')  ) : ?>
	<div class="footer-widgets-wrapper">
		<div class="container">
				<div class="footer-widget-single">
					<?php dynamic_sidebar( 'footer_widget_left' ); ?>
				</div>
				<div class="footer-widget-single footer-widget-middle">
					<?php dynamic_sidebar( 'footer_widget_middle' ); ?>
				</div>
				<div class="footer-widget-single">
					<?php dynamic_sidebar( 'footer_widget_right' ); ?>
				</div>
		</div>
	</div>
<?php endif; ?>

<div class="site-info">
	<div class="container">
    <?php echo '&copy; '.date_i18n(__('Y','productly')); ?> <?php bloginfo( 'name' ); ?> <span><?php echo esc_html__( '- ', 'productly' ) ?><a href="<?php echo esc_url( 'http://vilhodesign.com/productly-theme/', 'productly' ) ?>"><?php echo esc_html__( 'Productly', 'productly' ) ?></a> <?php echo esc_html__( 'Powered', 'productly' ) ?>
	</div>
</div>

</footer>




</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
