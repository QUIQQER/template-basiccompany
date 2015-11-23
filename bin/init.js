
require.config({

    baseUrl : URL_BIN_DIR +'QUI',

    paths : {
        "qui"      : URL_OPT_DIR +'bin/qui/qui',
        "locale"   : URL_VAR_DIR +'locale/bin',
        "controls" : URL_BIN_DIR +'QUI/controls'
    },

    waitSeconds : 0,
    catchError  : true,

    map : {
        '*': {
            'css': URL_OPT_DIR +'bin/qui/qui/lib/css.js'
        }
    }
});


window.addEvent('domready', function()
{
    "use strict";

    // load QUI
    require(['qui/QUI'], function(QUI)
    {
        QUI.addEvent("onError", function(msg, url, linenumber)
        {
            console.error( msg );
            console.error( url );
            console.error( 'LineNo: '+ linenumber );
        });
    });


    /*
     * left nav:
     * open or close the sub nav
     */
    var ToggleButton = document.getElements('.fa-nav-levels');

    ToggleButton.addEvent('click', function () {
        var LiLeft = this.getParent().getParent();
        var NavSubLeft = LiLeft.getElement('div');

        if (NavSubLeft.scrollHeight.toInt() < 1) {

            NavSubLeft.setStyles({

                height: 0,
                                 opacity: 0,
                                     overflow: 'hidden'
                                 });

            console.log(NavSubLeft.getElement('ul'));
            console.log(NavSubLeft.getElement('ul').getSize());

            NavSubLeft.setStyle('display','inline');

            moofx(NavSubLeft).animate({
                opacity: 1,
                height: NavSubLeft.getElement('ul').getSize().y
              }, {
                duration: 1000,
                callback: function() {

                    NavSubLeft.removeClass('quiqqer-navigation-close');
                    NavSubLeft.addClass('quiqqer-navigation-open');

                    //NavSubLeft.addClass('quiqqer-navigation-open');
                    //NavSubLeft.setStyles({
                    //    height: null
                    //                     });
                    this.addClass('fa-nav-levels-rotate');

                }.bind(this)
            });

            return;
        }

        NavSubLeft.setStyle('overflow', 'hidden');

        moofx(NavSubLeft).animate({
            height: 0,
            opacity: 0
        }, {
            duration: 200,
            callback: function() {

                NavSubLeft.removeClass('quiqqer-navigation-open');
                NavSubLeft.addClass('quiqqer-navigation-close');

                NavSubLeft.setStyles({
                    display:'none',
                    overflow: null,
                    height: 0
                });

                this.removeClass('fa-nav-levels-rotate');
            }.bind(this)
        });
    });


    /*
     * mobile nav:
     * open or close the sub nav
     */
    var Nav = document.id('navigation');
    var NavButton = document.getElement('nav.nav-box');
    var NavButtonDropDown = document.getElements('.fa-chevron-down');

    NavButtonDropDown.addEvent('click', function() {
        var Li = this.getParent();
        var NavSub = Li.getElement('.page-header-navigation-sub');
        console.log(NavSub.getStyle('height').toInt());
        if (NavSub.getStyle('height').toInt() < 1 ) {
            NavSub.addClass('nav-toggle-sub');
            this.addClass('fa-chevron-down-rotate-mobile');
        } else {
            NavSub.removeClass('nav-toggle-sub');
            this.removeClass('fa-chevron-down-rotate-mobile');
        }
    });

    NavButton.addEvent('click', function() {
        if (Nav.getStyle('height').toInt() < 1 ) {
            Nav.addClass('nav-toggle');
        }

        else {
            Nav.removeClass('nav-toggle');
        }

    });


});