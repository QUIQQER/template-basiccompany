
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


    /*var ToggleButton = document.getElements('.fa-angle-double-down');

    console.log(ToggleButton);

    ToggleButton.addEvent('click', function () {
        var LiLeft = this.getParent().getParent();
        var NavSubLeft = LiLeft.getElement('ul');

        console.log(NavSubLeft);
        console.log(NavSubLeft.scrollHeight.toInt());
        if (NavSubLeft.scrollHeight.toInt() < 1) {
            NavSubLeft.addClass('quiqqer-navigation-toggle');
        }
        else {
            NavSubLeft.removeClass('quiqqer-navigation-toggle');
        }
    });*/


    // open or close menu
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