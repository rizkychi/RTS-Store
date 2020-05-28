<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Digital Products Wordpress Theme
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) { 
	return;
} ?>
<div class="col-md-4 col-sm-4 col-xs-12 main-sidebar filter_category">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
