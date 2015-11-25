
require.config({

    baseUrl: URL_BIN_DIR + "QUI",

    paths: {
       "qui": URL_OPT_DIR + "bin/qui/qui",
       "locale": URL_VAR_DIR + "locale/bin",
       "controls": URL_BIN_DIR + "QUI/controls"
   },

    waitSeconds: 0,
    catchError: true,

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

    ToggleButton.addEvent("click", function () {
        var LiLeft = this.getParent().getParent();
        var NavSubLeft = LiLeft.getElement("div");

        console.log(NavSubLeft);
        console.log(NavSubLeft.getSize());

        /*
         * Wenn menü ZU:
         */
        if (NavSubLeft.scrollHeight.toInt() < 1) {
            /*NavSubLeft.setStyles({
                height      : 0,
                opacity     : 0,
                overflow    : "hidden"
            });*/

            console.log(NavSubLeft.getElement("ul"));
            console.log(NavSubLeft.getElement("ul").getSize());

            /*NavSubLeft.setStyle("display", "block");*/

            moofx(NavSubLeft).animate({
                height: "100%",
                /*height: NavSubLeft.getElement("ul").getSize().y,*/
                opacity: 1,
                display: "block"
            }, {
                  duration: 500,
                  callback: function () {

                      /*NavSubLeft.setStyles({
                           height      : NavSubLeft.getElement("ul").getSize().y,
                           opacity     : 1,
                           overflow    : "hidden"
                       });*/

                      NavSubLeft.removeClass("quiqqer-navigation-close");
                      NavSubLeft.addClass("quiqqer-navigation-open");

                  }.bind(this)
              });
            this.addClass("fa-nav-levels-rotate");
            return;
        }

        /*
         * Wenn menü AUF:
         */

        NavSubLeft.setStyle("overflow", "hidden");

        console.log(NavSubLeft.getElement("ul"));
        console.log(NavSubLeft.getElement("ul").getSize());

        moofx(NavSubLeft).animate({
            height: 0,
            opacity: 0
        }, {
            duration: 500,
            callback: function () {

                NavSubLeft.removeClass("quiqqer-navigation-open");
                NavSubLeft.addClass("quiqqer-navigation-close");

                NavSubLeft.setStyles({
                    display: "none",
                    overflow: "hidden",
                    height: 0
                });

            }.bind(this)
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
