$(document).ready(function () {
    function loadPage(url, saveHistory) {
        $("#page-content").css("opacity", "0.5");

        $.get(url, function (html) {
            var page = $("<div>").append($.parseHTML(html, document, true));
            var content = page.find("#page-content");

            if (content.length === 0) {
                window.location.href = url;
                return;
            }

            page.find('link[rel="stylesheet"]').each(function () {
                var href = $(this).attr("href");

                if ($('head link[href="' + href + '"]').length === 0) {
                    $("head").append(this);
                }
            });

            $("#page-content").html(content.html()).css("opacity", "1");

            var title = page.find("title").text();

            if (title) {
                document.title = title;
            }

            if (saveHistory) {
                history.pushState({}, "", url);
            }

            setActiveLink(url);
        }).fail(function () {
            window.location.href = url;
        });
    }

    function setActiveLink(url) {
        $(".sidebar a.menu-item").removeClass("active");

        $(".sidebar a.menu-item").each(function () {
            if (this.href === url) {
                $(this).addClass("active");
            }
        });
    }

    $(".sidebar").on("click", "a.menu-item", function (e) {
        var url = this.href;

        if (!url || url.endsWith("#")) {
            return;
        }

        e.preventDefault();
        loadPage(url, true);
    });

    window.addEventListener("popstate", function () {
        loadPage(location.href, false);
    });

});
