<?php
/*
 * default footer file
 */
$flag = 0;
for($i=1; $i<=6; $i++) :
    if(get_theme_mod('digital_products_social_icon'.$i) != '' && get_theme_mod('digital_products_social_icon_link'.$i) != '' ):
        $flag = 1;
    endif;
endfor;
$footer_widget_style = get_theme_mod('footer_widget_style',3);
$hide_footer_widget_bar = get_theme_mod('hide_footer_widget_bar',1); ?>
    <footer>
        <div class="back-to-top">
            <a class="go-top" href="javascript:void(0);"><i class="fa fa-angle-up"></i></a>
        </div>
        <?php if(($hide_footer_widget_bar == 1) || ($hide_footer_widget_bar == '')) : 
            $footer_widget_style = $footer_widget_style+1;
            $footer_column_value = floor(12/($footer_widget_style)); ?>
            <div class="footer-box <?php echo esc_attr(get_theme_mod('footer_style')); ?>">
                <div class="container">
                    <div class="row">
                        <?php $k = 1;
                        for( $i=0; $i<$footer_widget_style; $i++) {
                            if (is_active_sidebar('footer-'.$k)) { ?>
                                <div class="col-md-<?php echo esc_attr($footer_column_value); ?> col-sm-<?php echo esc_attr($footer_column_value); ?> col-xs-12"><?php dynamic_sidebar('footer-'.$k); ?></div>
                            <?php }
                            $k++;
                        } ?>
                    </div>
                    <div class="footerBottom">
                        <?php if(is_active_sidebar('footer-5')) : ?>
                            <div class='col-xs-12 marginPaddingDefault'>
                                <?php dynamic_sidebar('footer-5'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif;
        if(get_theme_mod('hide_copyright_area',1) != 2) :
            if(get_theme_mod('copyright_style','style1') == 'style1') : ?>
                <div class="footer-wrap <?php echo esc_attr(get_theme_mod('copyright_style')); ?>">
                    <div class="container">
                        <div class="row">
                        <div class="col-md-4 col-xs-12 col-sm-4 section1">
                            <div class="copyright fadeIn animated">
                                <?php if(get_theme_mod('copyright_area_text') != '') : ?>
                                    <p><?php echo wp_kses_post(get_theme_mod('copyright_area_text')); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-4 section2">
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-4 section3">
                            <div class="footer-social-icon fadeIn animated">
                                <?php if($flag != 0): ?>
                                    <ul>
                                        <?php for($i=1; $i<=6; $i++) :
                                        if(get_theme_mod('digital_products_social_icon'.$i) != '' && get_theme_mod('digital_products_social_icon_link'.$i) != '' ): ?>
                                            <li>
                                                <a href="<?php echo esc_url(get_theme_mod('digital_products_social_icon_link'.$i)); ?>" class="fb" title="" target="_blank">
                                                    <i class="fa <?php echo esc_attr(get_theme_mod('digital_products_social_icon'.$i)); ?>"></i>
                                                </a>
                                            </li>
                                        <?php endif;
                                        endfor; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            <?php endif;
            if(get_theme_mod('copyright_style','style1') == 'style2') : ?>
                <div class="footer-wrap <?php echo esc_attr(get_theme_mod('copyright_style')); ?>">
                    <div class="container">
                        <div class="row">
                        <?php if(get_theme_mod('footer_logo') != '') : ?>
                            <div class="footer-logo fadeIn animated">
                                <?php $footer_logo=get_theme_mod('footer_logo'); $footer_logo=wp_get_attachment_url($footer_logo);?>
                                <img class="img-responsive" src="<?php echo esc_url($footer_logo); ?>" alt="<?php esc_attr_e('Footer Logo','digital-products'); ?>">
                            </div>
                        <?php endif;  ?>
                        <div class="footer-social-icon fadeIn animated">
                            <ul>
                                <?php for($i=1; $i<=6; $i++) :
                                    if(get_theme_mod('digital_products_social_icon'.$i) != '' && get_theme_mod('digital_products_social_icon_link'.$i) != '' ): ?>
                                        <li>
                                            <a href="<?php echo esc_url(get_theme_mod('digital_products_social_icon_link'.$i)); ?>" class="fb" title="" target="_blank">
                                                <i class="fa <?php echo esc_attr(get_theme_mod('digital_products_social_icon'.$i)); ?>"></i>
                                            </a>
                                        </li>
                                    <?php endif;
                                endfor; ?>
                            </ul>
                        </div>
                        <div class="copyright fadeIn animated">
                            <?php if(get_theme_mod('copyright_area_text') != '') : ?>
                                <p><?php echo wp_kses_post(get_theme_mod('copyright_area_text')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    </div>
                </div>
            <?php endif;
            endif; ?>
    </footer>
<?php wp_footer(); ?>
</body>
</html>