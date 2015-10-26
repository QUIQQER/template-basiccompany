
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


    // opne or close menu
    var Nav = document.id('navigation');
    var NavButton = document.getElement('nav.nav-box');

    NavButton.addEvent('click', function() {

        if (Nav.getStyle('height').toInt() < 1 ) {
            Nav.addClass('nav-toggle');
        }

        else {
            Nav.removeClass('nav-toggle');
        }
    });
});