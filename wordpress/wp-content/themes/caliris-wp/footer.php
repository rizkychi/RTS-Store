<!--Footer-->

<?php
$allowed_html_array = caliris_allowed_html();
?>

<?php if ((get_theme_mod('caliris_footer_mail') != '') || (get_theme_mod('caliris_footer_tel') != '') || is_active_sidebar('footer-sidebar') || (get_option('caliris_footer_logo') !== '' && get_option('caliris_footer_logo') !== false) || get_theme_mod('caliris_footer_social_content') != '' || get_theme_mod('caliris_footer_copyright_content') != ''): ?>
    <footer id="contact" class="footer">
        <div class="footer-content center-relative content-1170">
            <?php if (get_theme_mod('caliris_footer_mail') != ''): ?>
                <div class="footer-mail">            
                    <?php
                    if (get_theme_mod('caliris_footer_mail') != ''):
                        echo wp_kses(__(get_theme_mod('caliris_footer_mail') ? get_theme_mod('caliris_footer_mail') : '<a href="#">hello@yoursite.com</a>', 'caliris-wp'), $allowed_html_array);
                    endif;
                    ?>               
                </div>
            <?php endif; ?>

            <?php if (get_theme_mod('caliris_footer_tel') != ''): ?>
                <div class="footer-number">            
                    <?php
                    if (get_theme_mod('caliris_footer_tel') != ''):
                        echo wp_kses(__(get_theme_mod('caliris_footer_tel') ? get_theme_mod('caliris_footer_tel') : '<a href="#">987.654.321</a>', 'caliris-wp'), $allowed_html_array);
                    endif;
                    ?>               
                </div>
            <?php endif; ?>

            <?php if (is_active_sidebar('footer-sidebar')) : ?>
                <ul id="footer-sidebar">
                    <?php dynamic_sidebar('footer-sidebar'); ?>
                </ul>
            <?php endif; ?>  

            <?php if (get_option('caliris_footer_logo') !== '' && get_option('caliris_footer_logo') !== false): ?>
                <img class="footer-logo" src="<?php echo esc_url(get_option('caliris_footer_logo', get_template_directory_uri() . '/images/icon_plus.png')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
            <?php endif; ?>

            <?php if (get_theme_mod('caliris_footer_social_content') != ''): ?>
                <div class="social-holder">
                    <?php
                    echo wp_kses(__(get_theme_mod('caliris_footer_social_content') ? get_theme_mod('caliris_footer_social_content') : '<a href="#"><span class="fa fa-twitter"></span></a><a href="#"><span class="fa fa-facebook"></span></a><a href="#"><span class="fa fa-behance"></span></a><a href="#"><span class="fa fa-dribbble"></span></a>', 'caliris-wp'), $allowed_html_array);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (get_theme_mod('caliris_footer_copyright_content') != ''): ?>
                <div class="copyright-holder">
                    <?php
                    echo wp_kses(__(get_theme_mod('caliris_footer_copyright_content') ? get_theme_mod('caliris_footer_copyright_content') : '2017 caliris WordPress Theme by CocoBasic.', 'caliris-wp'), $allowed_html_array);
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </footer>
<?php endif; ?>
</div>

<?php wp_footer();
?>
</body>
</html>