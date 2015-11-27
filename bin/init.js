require.config({

    baseUrl: URL_BIN_DIR + "QUI",

    paths: {
        "qui"     : URL_OPT_DIR + "bin/qui/qui",
        "locale"  : URL_VAR_DIR + "locale/bin",
        "controls": URL_BIN_DIR + "QUI/controls"
    },

    waitSeconds: 0,
    catchError : true,

    map: {
        "*": {
            "css": URL_OPT_DIR + "bin/qui/qui/lib/css.js"
        }
    }
});

window.addEvent("domready", function () {
    "use strict";

    // Load QUI
    require(["qui/QUI"], function (QUI) {
        QUI.addEvent("onError", function (msg, url, linenumber) {
            console.error(msg);
            console.error(url);
            console.error("LineNo: " + linenumber);
        });
    });

    /*
     * Left nav:
     * open or close the sub nav
     */

    var ToggleButton = document.getElements(".fa-nav-levels");
    var SubNavDiv = document.getElements(".quiqqer-sub-nav-div");

    ToggleButton.addEvent("click", function () {
        var LiLeft = this.getParent().getParent();
        var NavSubLeft = LiLeft.getElement("div");

        /*
         * Wenn menü ZU ist:
         */
        if (!NavSubLeft.getSize().y.toInt()) {

            NavSubLeft.setStyles({
                height  : 0,
                opacity : 0,
                overflow: "hidden",
                display : "block"
            });

            moofx(NavSubLeft).animate({
                height : NavSubLeft.getElement("ul").getSize().y.toInt(),
                opacity: 1
            }, {
                duration: 250,
                callback: function () {
                    moofx(NavSubLeft).animate({
                        height: "100%"
                    });
                }
            });
            this.addClass("fa-nav-levels-rotate");
            return;
        }

        /*
         * Wenn menü AUF ist:
         */
        NavSubLeft.setStyle("overflow", "hidden");

        moofx(NavSubLeft).animate({
            height : 0,
            opacity: 0
        }, {
            duration: 250,
            callback: function () {
                moofx(NavSubLeft).animate({
                    height: 0
                });
            }
        });
        this.removeClass("fa-nav-levels-rotate");
    });


    /*
     * Mobile nav:
     * open or close the sub nav
     */
    var Nav = document.id("navigation");
    var NavButton = document.getElement("nav.nav-box");
    var NavButtonDropDown = document.getElements(".fa-chevron-down");

    NavButtonDropDown.addEvent("click", function () {
        var Li = this.getParent();
        var NavSub = Li.getElement(".page-header-navigation-sub");
        if (NavSub.getStyle("height").toInt() < 1) {
            NavSub.addClass("nav-toggle-sub");
            this.addClass("fa-chevron-down-rotate-mobile");
        } else {
            NavSub.removeClass("nav-toggle-sub");
            this.removeClass("fa-chevron-down-rotate-mobile");
        }
    });

    NavButton.addEvent("click", function () {
        if (Nav.getStyle("height").toInt() < 1) {
            Nav.addClass("nav-toggle");
        } else {
            Nav.removeClass("nav-toggle");
        }

    });

});
