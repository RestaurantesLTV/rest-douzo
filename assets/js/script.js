/*
 * Custom scripts
*/
(function ($) {
    $(document).ready(function () {

        // Gallery
        if (jQuery("#gallery").length) {
            var interval, timeout;
            // Declare variables
            var totalImages = jQuery("#gallery img").length,
                imageWidth = 251.6;
            totalWidth = imageWidth * totalImages,
            visibleImages = Math.round(jQuery("#gallery .s-center").width() / imageWidth),
            visibleWidth = visibleImages * imageWidth,
            stopPosition = (visibleWidth - totalWidth);

            jQuery("#gallery .filmstrip").width(totalWidth);

            jQuery(".s-left").click(function () {
                if (jQuery("#gallery .filmstrip").position().left < 0 && !jQuery("#gallery .filmstrip").is(":animated")) {
                    jQuery("#gallery .filmstrip").animate({
                        left: "+=" + imageWidth + "px"
                    });
                }
                return false;
            });

            jQuery(".s-right").click(function () {
                if (jQuery("#gallery .filmstrip").position().left > stopPosition && !jQuery("#gallery .filmstrip").is(":animated")) {
                    jQuery("#gallery .filmstrip").animate({
                        left: "-=" + imageWidth + "px"
                    });
                }
                return false;
            });


            $("#images-collection img").first().addClass("active");

            function startInterval() {
                interval = setInterval(function () {
                    var active = $('#gallery img.active').next();
                    if (active.length < 1) active = $('#gallery img:first');
                    showClickedItem(active);
                }, 3000);
            }

            $('#gallery img').click(function () {
                if (interval) clearInterval(interval);
                if (timeout) clearTimeout(timeout);
                showClickedItem($(this));
                timeout = setTimeout(startInterval, 3000);
            });


            function showClickedItem(el) {
                var i = el.index();
                $('#gallery img.active').removeClass("active");
                $('#images-collection img.active').removeClass("active");

                el.addClass("active");
                $("#images-collection img").eq(i).addClass("active");
            }

            startInterval();

        }
        // ahow active parent
        var loc = window.location.href;
        $("#menu a").each(function () {
            if (loc.indexOf($(this).attr("href")) != -1) {
                $(this).parent('li').addClass("test");
                $(this).parent('li').parent('ul').parent('li').addClass("current");
            }
        });
        

        //frontpage slider
        $("#top-header-slider > div.slide").first().addClass("active");

        setInterval(function () {
            var $active = $('#top-header-slider > div.slide.active');
            var $next = ($('#top-header-slider > div.slide.active').next().length > 0) ? $('#top-header-slider > div.slide.active').next() : $('#top-header-slider > div.slide:first');
            $active.removeClass('active');
            $next.addClass('active');
        }, 3000);

        //clear input fileds
        $("input").focus(function () {
            var cleared = 0;
            if ($(this).val() == $(this).attr("name")) {
                $(this).val("");
                cleared = 1;
            }
            $(this).blur(function () {
                if ($(this).val() == "" && cleared) {
                    $(this).val($(this).attr("name"));
                }
            });
        });

        //multiine titles
        if (lms && lms.admin && lms.admin.uid) return;
        jQuery('#front-pages h2').each(function (i, el) {
            var t = jQuery.trim(jQuery(el).text()),
                i = t.indexOf(' '),
                st = t.substr(0, i),
                et = t.substr(i);
            jQuery(el).html('<span class="first-word">' + st + '</span>' + et);
        });
    });

})(jQuery);

(function($){
        $(window).load(function(){
            $(".menu-cat .rest").mCustomScrollbar();
            $("#sidebar").stickyfloat({duration: 400});
            $("#sidebar .menu a[rel='pageScroll2Id']").mPageScroll2id();
        });
    })(jQuery);