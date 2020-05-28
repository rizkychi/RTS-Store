jQuery(document).ready(function(e) {
    
    if(jQuery('.footer-wrap').hasClass('style1')){
    	if(jQuery( ".section3" ).has("ul").length){
    		jQuery( ".section2" ).append('<p class="credits">'+digital_products_script.power_text+'<a href="'+digital_products_script.credits_link+'" target="_blank">'+digital_products_script.credits_text+'</a></p>');
    	} else{
    		jQuery( ".section3" ).append('<p class="credits">'+digital_products_script.power_text+'<a href="'+digital_products_script.credits_link+'" target="_blank">'+digital_products_script.credits_text+'</a></p>');
    	}
    } else{
    	jQuery( ".footer-wrap .copyright" ).append('<p class="credits">'+digital_products_script.power_text+'<a href="'+digital_products_script.credits_link+'" target="_blank">'+digital_products_script.credits_text+'</a></p>');
    }
}),
function(e) {
    e.fn.appear = function(t, n) {
        var i = e.extend({
            data: void 0,
            one: !0,
            accX: 0,
            accY: 0
        }, n);
        return this.each(function() {
            var n = e(this);
            if (n.appeared = !1,
            !t)
                return void n.trigger("appear", i.data);
            var s = e(window)
              , r = function() {
                if (!n.is(":visible"))
                    return void (n.appeared = !1);
                var e = s.scrollLeft()
                  , t = s.scrollTop()
                  , r = n.offset()
                  , a = r.left
                  , u = r.top
                  , o = i.accX
                  , d = i.accY
                  , l = n.height()
                  , c = s.height()
                  , f = n.width()
                  , p = s.width();
                u + l + d >= t && t + c + d >= u && a + f + o >= e && e + p + o >= a ? n.appeared || n.trigger("appear", i.data) : n.appeared = !1
            }
              , a = function() {
                if (n.appeared = !0,
                i.one) {
                    s.unbind("scroll", r);
                    var a = e.inArray(r, e.fn.appear.checks);
                    a >= 0 && e.fn.appear.checks.splice(a, 1)
                }
                t.apply(this, arguments)
            };
            i.one ? n.one("appear", i.data, a) : n.bind("appear", i.data, a),
            s.scroll(r),
            e.fn.appear.checks.push(r),
            r()
        })
    }
    ,
    e.extend(e.fn.appear, {
        checks: [],
        timeout: null,
        checkAll: function() {
            var t = e.fn.appear.checks.length;
            if (t > 0)
                for (; t--; )
                    e.fn.appear.checks[t]()
        },
        run: function() {
            e.fn.appear.timeout && clearTimeout(e.fn.appear.timeout),
            e.fn.appear.timeout = setTimeout(e.fn.appear.checkAll, 20)
        }
    }),
    e.each(["append", "prepend", "after", "before", "attr", "removeAttr", "addClass", "removeClass", "toggleClass", "remove", "css", "show", "hide"], function(t, n) {
        var i = e.fn[n];
        i && (e.fn[n] = function() {
            var t = i.apply(this, arguments);
            return e.fn.appear.run(),
            t
        }
        )
    })
}(jQuery),
function(e) {
    "use strict";
    e.fn.counterUp = function(t) {
        e.extend({
            time: 400,
            delay: 10
        }, t);
        return this.each(function() {
            e(this)
        })
    }
}(jQuery),
/* start Mobile Menu */
(function ($) {
    $.fn.menumaker = function (options) {
        var cssmenu = $(this),
            settings = $.extend({ title: "", format: "dropdown", sticky: false }, options);
        return this.each(function () {
            cssmenu.prepend('<div id="menu-button"></div>');
            jQuery(this).find("#menu-button").on('click', function () {
                jQuery(this).toggleClass('menu-opened');
                var mainmenu = jQuery(this).next('ul');
                if (mainmenu.hasClass('open')) {
                    mainmenu.removeClass('open');
                } else {
                    mainmenu.addClass('open');
                    if (settings.format === "dropdown") {
                        mainmenu.find('ul').addClass('open');
                    }
                }
            });
            cssmenu.find('li ul').parent().addClass('has-sub');
            multiTg = function () {
                cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                cssmenu.find('.submenu-button').on('click', function () {
                    jQuery(this).toggleClass('submenu-opened');
                    if (jQuery(this).siblings('ul').hasClass('open')) {
                        jQuery(this).siblings('ul').removeClass('open').hide();
                    } else {
                        jQuery(this).siblings('ul').addClass('open').show();
                    }
                });
            };
            if (settings.format === 'multitoggle') multiTg();
            else cssmenu.addClass('dropdown');
            if (settings.sticky === true) cssmenu.css('position', 'fixed');
            resizeFix = function () {
                if (jQuery(window).width() > 1024) {
                    cssmenu.find('ul').show();
                }
                if (jQuery(window).width() <= 1024) {
                    cssmenu.find('ul').removeClass('open');
                }
            };
            resizeFix();
            return jQuery(window).on('resize', resizeFix);
        });
    };
})(jQuery),
function(e) {
    jQuery(document).ready(function() {
        jQuery(document).ready(function() {
            jQuery("#cssmenu").menumaker({
                title: "",
                format: "multitoggle"
            }),
            jQuery("#cssmenu").prepend("<div id='menu-line'></div>");
            var t, n, i, s, r = !1, a = 0, u = jQuery("#cssmenu #menu-line");
            jQuery("#cssmenu > ul > li").each(function() {
                jQuery(this).hasClass("active") && (t = jQuery(this),
                r = !0)
            }),
            r === !1 && (t = jQuery("#cssmenu > ul > li").first()),
            s = n = t.width(),
            i = a = (t.position())?t.position().left:'',
            u.css("width", n),
            u.css("left", a),
            jQuery("#cssmenu > ul > li").hover(function() {
                t = e(this),
                n = t.width(),
                a = t.position().left,
                u.css("width", n),
                u.css("left", a)
            }, function() {
                u.css("left", i),
                u.css("width", s)
            })
        });
        var t = jQuery(window).width();
        jQuery("#cssmenu ul ul li").mouseenter(function() {
            var e = jQuery(this).find(".sub-menu").length;
            if (e > 0) {
                var n = jQuery(this).find(".sub-menu").width()
                  , i = jQuery(this).find(".sub-menu").parent().offset().left + n;
                n + i > t ? (jQuery(this).find(".sub-menu").removeClass("submenu-left"),
                jQuery(this).find(".sub-menu").addClass("submenu-right")) : (jQuery(this).find(".sub-menu").removeClass("submenu-right"),
                jQuery(this).find(".sub-menu").addClass("submenu-left"))
            }
        })
    })
}(jQuery),
jQuery(document).ready(function() {
    jQuery("div").hasClass("sow-slider-base") && jQuery("div").removeClass("heading-hide"),
    jQuery(".menu-options").click(function() {
       
    }),    
    jQuery(".counter").counterUp({
        delay: 10,
        time: 1e3
    }),
    jQuery("div").hasClass("panel-grid") && jQuery("div").removeClass("sm_pages"),
    jQuery(".back-to-top a").click(function(e) {
        jQuery("html, body").animate({
            scrollTop: 0
        }, 800),
        e.preventDefault
    })
}),
jQuery(window).scroll(function() {
    1 == digital_products_script.fixed_header && (jQuery(window).scrollTop() > 50 ? (jQuery(".themesnav").addClass("fixed-header", 1e3, "easeInOutSine"),
    jQuery(".default-heading").removeClass("default-heading-fixed", 1e3, "easeInOutSine")) : jQuery(".themesnav").removeClass("fixed-header", 1e3, "easeInOutSine"),
    jQuery(".themesnav").addClass("home-fixed-class", 1e3, "easeInOutSine"),
    jQuery(".themesnav").addClass("fixed-header", 1e3, "easeInOutSine")),
    jQuery(this).scrollTop() < 50 && (jQuery(".themesnav").removeClass("home-fixed-class", 1e3, "easeInOutSine"),
    jQuery(".themesnav").removeClass("fixed-header", 1e3, "easeInOutSine")),
    jQuery(this).scrollTop() > 600 ? (jQuery(".back-to-top").show(),
    jQuery(".back-to-top a").fadeIn()) : jQuery(".back-to-top a").fadeOut()
}),
jQuery(window).load(function() {
    jQuery(".preloader-block").delay(400).fadeOut(500),jQuery("#page_effect").delay(400).fadeIn(400);
}),
function(e, t) {
    "function" == typeof define && define.amd ? define(t) : "object" == typeof exports ? module.exports = t : e.fluidvids = t()
}(this, function() {
    "use strict";
    var e = {
        selector: ["iframe"],
        players: ["www.youtube.com", "player.vimeo.com"]
    }
      , t = [".fluidvids {", "width: 100%; max-width: 100%; position: relative;", "}", ".fluidvids-item {", "position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;", "}"].join("")
      , n = document.head || document.getElementsByTagName("head")[0]
      , i = function(t) {
        return new RegExp("^(https?:)?//(?:" + e.players.join("|") + ").*$","i").test(t)
    }
      , s = function(e) {
        return parseInt(e[0], 10) / parseInt(e[1], 10) * 100 + "%"
    }
      , r = function(e) {
        if (i(e.src) && !e.getAttribute("data-fluidvids")) {
            var t = document.createElement("div");
            e.parentNode.insertBefore(t, e),
            e.class_name += "fluidvids-item",
            e.setAttribute("data-fluidvids", "loaded"),
            t.class_name += "fluidvids",
            t.style.padding_top = s(e.height < e.width ? [e.height, e.width] : [e.width, e.height]),
            t.appendChild(e)
        }
    }
      , a = function() {
        var e = document.createElement("div");
        e.innerHTML = "<p>x</p><style>" + t + "</style>",
        n.appendChild(e.childNodes[1])
    };
    return e.render = function() {
        for (var t = document.querySelectorAll(e.selector.join()), n = t.length; n--; )
            r(t[n])
    }
    ,
    e.init = function(t) {
        for (var n in t)
            e[n] = t[n];
        e.render(),
        a()
    }
    ,
    e
}),
function(e) {
    e.fn.countdown = function(t, n) {
        function i() {
            eventDate = Date.parse(r.date) / 1e3,
            currentDate = Math.floor(e.now() / 1e3),
            eventDate <= currentDate && (n.call(this),
            clearInterval(interval)),
            seconds = eventDate - currentDate,
            days = Math.floor(seconds / 86400),
            seconds -= 60 * days * 60 * 24,
            hours = Math.floor(seconds / 3600),
            seconds -= 60 * hours * 60,
            minutes = Math.floor(seconds / 60),
            seconds -= 60 * minutes,
            1 == days ? s.find(".timeRefDays").text("day") : s.find(".timeRefDays").text("days"),
            1 == hours ? s.find(".timeRefHours").text("hour") : s.find(".timeRefHours").text("hours"),
            1 == minutes ? s.find(".timeRefMinutes").text("minute") : s.find(".timeRefMinutes").text("minutes"),
            1 == seconds ? s.find(".timeRefSeconds").text("second") : s.find(".timeRefSeconds").text("seconds"),
            "on" == r.format && (days = String(days).length >= 2 ? days : "0" + days,
            hours = String(hours).length >= 2 ? hours : "0" + hours,
            minutes = String(minutes).length >= 2 ? minutes : "0" + minutes,
            seconds = String(seconds).length >= 2 ? seconds : "0" + seconds),
            isNaN(eventDate) ? clearInterval(interval) : (s.find(".days").text(days),
            s.find(".hours").text(hours),
            s.find(".minutes").text(minutes),
            s.find(".seconds").text(seconds));
            if(currentDate <= eventDate ){
                BeforeLaunch();
            }else {
                AfterLaunch();
            }
        }
        var s = e(this)
          , r = {
            date: null,
            format: null
        };
        t && e.extend(r, t),
        i(),
        interval = setInterval(i, 1e3)
    }
}(jQuery);
/*Counter start*/
function BeforeLaunch(dateTime) {
    jQuery('.before_launch').show();
    jQuery('.after_launch').hide();
}

function AfterLaunch(dateTime) {
    jQuery('.before_launch').hide();
    jQuery('.after_launch').show();
}
(function (e) {
    "use strict";
    e.fn.counterUp = function (t) {
        var n = e.extend({
            time: 2000,
            delay: 200
        }, t);
        return this.each(function () {
            var t = e(this),
                r = n,
                i = function () {
                    var e = [],
                        n = r.time / r.delay,
                        i = t.text(),
                        s = /[0-9]+,[0-9]+/.test(i);
                    i = i.replace(/,/g, "");
                    var o = /^[0-9]+$/.test(i),
                        u = /^[0-9]+\.[0-9]+$/.test(i),
                        a = u ? (i.split(".")[1] || []).length : 0;
                    for (var f = n; f >= 1; f--) {
                        var l = parseInt(i / n * f);
                        u && (l = parseFloat(i / n * f).toFixed(a));
                        if (s)
                            while (/(\d+)(\d{3})/.test(l.toString())) l = l.toString().replace(/(\d+)(\d{3})/, "$1,$2");
                        e.unshift(l)
                    }
                    t.data("counterup-nums", e);
                    t.text("0");
                    var c = function () {
                        t.text(t.data("counterup-nums").shift());
                        if (t.data("counterup-nums").length) setTimeout(t.data("counterup-func"), r.delay);
                        else {
                            delete t.data("counterup-nums");
                            t.data("counterup-nums", null);
                            t.data("counterup-func", null)
                        }
                    };
                    t.data("counterup-func", c);
                    setTimeout(t.data("counterup-func"), r.delay)
                };
            t.waypoint(i, {
                offset: "100%",
                triggerOnce: !0
            })
        })
    }
})(jQuery);
/*Counter end*/