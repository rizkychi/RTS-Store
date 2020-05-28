(function ($) {

    "use stict";
    var count = 1;
    var portfolioPostsPerPage = $(".grid-item").length;
    var totalNumberOfPortfolioPages = Math.ceil(parseInt(ajax_var_portfolio.total) / portfolioPostsPerPage);


    //Hide Portfolio Load More Button
    showHidePortfolioLoadMoreButton();
    //Fix z-index
    zIndexSectionFix();
    //Member Content Load
    memberContentLoadOnClick();
    //Portfolio Item Load
    portfolioItemContentLoadOnClick();
    //Load more articles in Portfolio
    loadMorePortfolioOnClick();
    //PrettyPhoto initial    
    setPrettyPhoto();


    $(window).on('load', function () {
        isotopeSetUp();
        //Image slider
        imageSliderSettings();
    });


    function isotopeSetUp() {
        $('.grid').isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                columnWidth: '.grid-sizer',
                gutter: '.gutter-sizer'
            }
        });
    }

    function zIndexSectionFix() {
        var numSection = $(".page-template-onepage .section-wrapper").length + 2;
        $('.page-template-onepage').find('.section-wrapper').each(function () {
            $(this).css('zIndex', numSection);
            numSection--;
        });
    }

    function showHidePortfolioLoadMoreButton() {
        if (portfolioPostsPerPage < parseInt(ajax_var_portfolio.total)) {
            $('.more-posts-portfolio').css('visibility', 'visible');
            $('.more-posts-portfolio').animate({opacity: 1}, 1500);
        } else {
            $('.more-posts-portfolio').css('display', 'none');
        }
    }

    function imageSliderSettings() {
        $(".image-slider").each(function () {
            var id = $(this).attr('id');
            var auto_value = window[id + '_auto'];
            var hover_pause = window[id + '_hover'];
            var speed_value = window[id + '_speed'];
            var items_value = window[id + '_items'];
            auto_value = (auto_value === 'true') ? true : false;
            hover_pause = (hover_pause === 'true') ? true : false;
            $('#' + id).owlCarousel({
                loop: true,
                autoHeight: true,
                smartSpeed: 750,
                autoplay: auto_value,
                autoplayHoverPause: hover_pause,
                autoplayTimeout: speed_value,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    1024: {
                        items: items_value,
                    }
                }
            });
            $(this).on('mouseleave', function () {
                $(this).trigger('stop.owl.autoplay');
                $(this).trigger('play.owl.autoplay', [auto_value]);
            })
        });
    }

    function setPrettyPhoto() {
        $('a[data-rel]').each(function () {
            $(this).attr('rel', $(this).data('rel'));
        });
        $("a[rel^='prettyPhoto']").prettyPhoto({
            slideshow: false, /* false OR interval time in ms */
            overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            default_width: 1280,
            default_height: 720,
            deeplinking: false,
            social_tools: false,
            iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>'
        });
    }

    function memberContentLoadOnClick() {
        $('.member-holder a').on('click', function (e) {
            e.preventDefault();
            var memberID = $(this).data('id');
            $(this).find('.member-mask').addClass('animate-plus');
            $('html, body').animate({scrollTop: $('#team-holder').offset().top - 150}, 300);
            if ($("#mcw-" + memberID).length) //Check if is allready loaded
            {
                setTimeout(function () {
                    $('.member-holder').addClass('hide');
                    setTimeout(function () {
                        $("#mcw-" + memberID).addClass('show');
                        $('.team-load-content-holder').addClass('show');
                        $('.member-mask').removeClass('animate-plus');
                        $('.member-holder').hide();
                    }, 300);
                }, 300);
            } else {
                loadMemberContent(memberID);
            }
        });
    }

    function loadMemberContent(memberID) {
        $.ajax({
            url: ajax_var_team.url,
            type: 'POST',
            data: "action=team_ajax&member_id=" + memberID + "&security=" + ajax_var_team.nonce,
            success: function (html) {
                var getHtml = $(html).find(".member-item-wrapper").html();
                $('.team-load-content-holder').append('<div id="mcw-' + memberID + '" class="member-content-wrapper">' + getHtml + '</div>');
                if (!$("#mcw-" + memberID + " .close-icon").length) {
                    $("#mcw-" + memberID).prepend('<div class="close-icon"></div>');
                }
                $("#mcw-" + memberID).imagesLoaded(function () {
                    imageSliderSettings();
                    $(".site-content").fitVids(); //Fit Video                
                    $('.member-holder').addClass('hide');
                    setTimeout(function () {
                        $("#mcw-" + memberID).addClass('show');
                        $('.team-load-content-holder').addClass('show');
                        $('.member-mask').removeClass('animate-plus');
                        $('.member-holder').hide();
                    }, 300);
                    $('#team-holder .close-icon').on('click', function (e) {
                        $('.team-load-content-holder').addClass("viceversa");
                        $('.member-holder').css('display', 'block');
                        setTimeout(function () {
                            $('#mcw-' + memberID).removeClass('show');
                            $('.team-load-content-holder').removeClass('viceversa show');
                            $('.member-holder').removeClass('hide');
                        }, 300);
                        // setTimeout(function () {
                        //    $('html, body').animate({scrollTop: $('#team-holder').offset().top - 150}, 400);
                        // }, 500);
                    });
                });
            }
        });
        return false;
    }

    function portfolioItemContentLoadOnClick() {
        $('.ajax-portfolio').on('click', function (e) {
            e.preventDefault();
            var portfolioItemID = $(this).data('id');
            $(this).addClass('animate-plus');
            if ($("#pcw-" + portfolioItemID).length) //Check if is allready loaded
            {
                $('html, body').animate({scrollTop: $('#portfolio-wrapper').offset().top - 150}, 400);
                setTimeout(function () {
                    $('#portfolio-grid, .more-posts-portfolio-holder').addClass('hide');
                    setTimeout(function () {
                        $("#pcw-" + portfolioItemID).addClass('show');
                        $('.portfolio-load-content-holder').addClass('show');
                        $('.ajax-portfolio').removeClass('animate-plus');
                        $('#portfolio-grid, .more-posts-portfolio-holder').hide();
                    }, 300);
                }, 500);
            } else {
                loadPortfolioItemContent(portfolioItemID);
            }
        });
    }

    function loadPortfolioItemContent(portfolioItemID) {
        $.ajax({
            url: ajax_var_portfolio_content.url,
            type: 'POST',
            data: "action=portfolio_ajax_content_load&portfolio_id=" + portfolioItemID + "&security=" + ajax_var_portfolio_content.nonce,
            success: function (html) {
                var getPortfolioItemHtml = $(html).find(".portfolio-item-wrapper").html();
                $('.portfolio-load-content-holder').append('<div id="pcw-' + portfolioItemID + '" class="portfolio-content-wrapper">' + getPortfolioItemHtml + '</div>');
                if (!$("#pcw-" + portfolioItemID + " .close-icon").length) {
                    $("#pcw-" + portfolioItemID).prepend('<div class="close-icon"></div>');
                }
                $('html, body').animate({scrollTop: $('#portfolio-wrapper').offset().top - 150}, 400);
                setTimeout(function () {
                    $("#pcw-" + portfolioItemID).imagesLoaded(function () {
                        imageSliderSettings();
                        $(".site-content").fitVids(); //Fit Video
                        $('#portfolio-grid, .more-posts-portfolio-holder').addClass('hide');
                        setTimeout(function () {
                            $("#pcw-" + portfolioItemID).addClass('show');
                            $('.portfolio-load-content-holder').addClass('show');
                            $('.ajax-portfolio').removeClass('animate-plus');
                            $('#portfolio-grid').hide();
                        }, 300);
                        $('.close-icon').on('click', function (e) {
                            var portfolioReturnItemID = $(this).closest('.portfolio-content-wrapper').attr("id").split("-")[1];
                            $('.portfolio-load-content-holder').addClass("viceversa");
                            $('#portfolio-grid, .more-posts-portfolio-holder').css('display', 'block');
                            setTimeout(function () {
                                $('#pcw-' + portfolioReturnItemID).removeClass('show');
                                $('.portfolio-load-content-holder').removeClass('viceversa show');
                                $('#portfolio-grid, .more-posts-portfolio-holder').removeClass('hide');
                            }, 300);
                            setTimeout(function () {
                                $('html, body').animate({scrollTop: $('#p-item-' + portfolioReturnItemID).offset().top - 150}, 400);
                            }, 500);
                        });
                    });
                }, 500);
            }
        });
        return false;
    }


    function loadMorePortfolioOnClick() {
        $('.more-posts-portfolio:visible').on('click', function () {
            count++;
            loadPortfolioMoreItems(count, portfolioPostsPerPage);
            $('.more-posts-portfolio').css('display', 'none');
            $('.more-posts-portfolio-loading').css('display', 'block');
        });
    }

    function loadPortfolioMoreItems(pageNumber, portfolioPostsPerPage) {
        $.ajax({
            url: ajax_var_portfolio.url,
            type: 'POST',
            data: "action=portfolio_ajax_load_more&portfolio_page_number=" + pageNumber + "&portfolio_posts_per_page=" + portfolioPostsPerPage + "&security=" + ajax_var_portfolio.nonce,
            success: function (html) {
                var $newItems = $(html);
                $('.grid').append($newItems);

                $('.grid').imagesLoaded(function () {
                    $('.grid').isotope('appended', $newItems);

                    if (count == totalNumberOfPortfolioPages)
                    {
                        $('.more-posts-portfolio').css('display', 'none');
                        $('.more-posts-portfolio-loading').css('display', 'none');
                        $('.no-more-posts-portfolio').css('display', 'block');
                    } else
                    {
                        $('.more-posts-portfolio').css('display', 'block');
                        $('.more-posts-portfolio-loading').css('display', 'none');
                    }
                });

                portfolioItemContentLoadOnClick();
                setPrettyPhoto();
            }
        });
        return false;
    }
})(jQuery);