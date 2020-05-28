(function ($) {

    "use strict";

    // COLORS                         
    wp.customize('caliris_menu_color', function (value) {
        value.bind(function (to) {
            var inlineStyle, customColorCssElemnt;            

            inlineStyle = '<style class="custom-color-css1">';
            inlineStyle += 'body .site-wrapper .main-menu.sm-clean a { color: ' + to + '; }';                                    
            inlineStyle += '</style>';

            customColorCssElemnt = $('.custom-color-css1');

            if (customColorCssElemnt.length) {
                customColorCssElemnt.replaceWith(inlineStyle);
            } else {
                $('head').append(inlineStyle);
            }

        });
    });


    wp.customize('caliris_menu_hover_color', function (value) {
        value.bind(function (to) {
            var inlineStyle, customColorCssElemnt;            

            inlineStyle = '<style class="custom-color-css2">';
            inlineStyle += 'body .site-wrapper .sm-clean a:hover, body .site-wrapper .main-menu.sm-clean .sub-menu li a:hover, body .site-wrapper .sm-clean li.active a, body .site-wrapper .sm-clean li.current-page-ancestor > a, body .site-wrapper .sm-clean li.current_page_ancestor > a, body .site-wrapper .sm-clean li.current_page_item > a { color: ' + to + ' !important; }';                        
            inlineStyle += '</style>';

            customColorCssElemnt = $('.custom-color-css2');

            if (customColorCssElemnt.length) {
                customColorCssElemnt.replaceWith(inlineStyle);
            } else {
                $('head').append(inlineStyle);
            }

        });
    });


    wp.customize('caliris_global_color', function (value) {
        value.bind(function (to) {
            var inlineStyle, customColorCssElemnt;                                    
            
            inlineStyle = '<style class="custom-color-css3">';            
            inlineStyle += 'body .site-wrapper a, body .site-wrapper a:hover, .site-wrapper .navigation.pagination a:hover, .single .site-wrapper .entry-info .cat-links a:hover, .site-wrapper .tags-holder a, .single .site-wrapper .wp-link-pages, .site-wrapper .comment-form-holder a:hover, .site-wrapper .replay-at-author, body .site-wrapper .footer a:hover, .site-wrapper .blog-item-holder .cat-links ul a, .site-wrapper blockquote:not(.cocobasic-block-pullquote):before { color: ' + to + '; }';
            inlineStyle += '.site-wrapper blockquote:not(.cocobasic-block-pullquote), .single .site-wrapper .entry-info .cat-links a, .site-wrapper .tags-holder a, .site-wrapper .owl-theme .owl-dots .owl-dot.active span, .site-wrapper .owl-theme .owl-dots .owl-dot:hover span { border-color: ' + to + '; }';
            inlineStyle += '.blog .site-wrapper h1.entry-title, .blog .site-wrapper .more-posts, .blog .site-wrapper .no-more-posts, .blog .site-wrapper .more-posts-loading, .site-wrapper .navigation.pagination .current, .site-wrapper .tags-holder a:hover, .search .site-wrapper h1.entry-title, .archive .site-wrapper h1.entry-title, .site-wrapper a.button, .site-wrapper .sonar-emitter, .site-wrapper .sonar-wave, .site-wrapper .member-mask, .site-wrapper .grid-item a.item-link:after, .site-wrapper .more-posts-portfolio, .site-wrapper .no-more-posts-portfolio, .site-wrapper .more-posts-portfolio-loading { background-color: ' + to + '; }';                       
            inlineStyle += '</style>';

            customColorCssElemnt = $('.custom-color-css3');

            if (customColorCssElemnt.length) {
                customColorCssElemnt.replaceWith(inlineStyle);
            } else {
                $('head').append(inlineStyle);
            }

        });
    });
    
    
    wp.customize('caliris_news_color', function (value) {
        value.bind(function (to) {
            var inlineStyle, customColorCssElemnt;                        
            
            inlineStyle = '<style class="custom-color-css4">';            
            inlineStyle += '.site-wrapper .blog-item-holder-scode h4 a:hover, .site-wrapper .blog-item-holder-scode .cat-links ul a { color: ' + to + '; }';                        
            inlineStyle += '.site-wrapper .blog-holder-scode .more-posts-link { background-color: ' + to + '; }';                        
            inlineStyle += '</style>';

            customColorCssElemnt = $('.custom-color-css4');

            if (customColorCssElemnt.length) {
                customColorCssElemnt.replaceWith(inlineStyle);
            } else {
                $('head').append(inlineStyle);
            }

        });
    });

    
    wp.customize('caliris_footer_background', function (value) {
        value.bind(function (to) {
            var inlineStyle, customColorCssElemnt;                        
            
            inlineStyle = '<style class="custom-color-css5">';                        
            inlineStyle += '.site-wrapper .footer { background-color: ' + to + '; }';                        
            inlineStyle += '</style>';

            customColorCssElemnt = $('.custom-color-css5');

            if (customColorCssElemnt.length) {
                customColorCssElemnt.replaceWith(inlineStyle);
            } else {
                $('head').append(inlineStyle);
            }

        });
    });
        
        
    function cocobasic_hexToRGB(hex, alpha) {
        var r = parseInt(hex.slice(1, 3), 16),
                g = parseInt(hex.slice(3, 5), 16),
                b = parseInt(hex.slice(5, 7), 16);

        if (alpha) {
            return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
        } else {
            return "rgb(" + r + ", " + g + ", " + b + ")";
        }
    }

})(jQuery);