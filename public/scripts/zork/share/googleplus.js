/**
 * Sharing functionalities
 * @package zork
 * @subpackage share
 * @author Sipos Zoltán, Kristof Matos <kristof.matos@megaweb.hu>
 */
( function ( global, $, js )
{
    "use strict";

    if ( typeof js.share.googlePlus !== "undefined" )
    {
        return;
    }

    var googleInited = false,
        googleInit = function ( locale ) {
            global.___gcfg = {lang: locale};
            $.getScript('https://apis.google.com/js/plusone.js', function() {
                global.gapi.plusone.go();
            });
        };
    /**
     * @class Google Map dashborad
     * @memberOf global.Zork.Paragraph.prototype.dashboard
     */
    global.Zork.Share.prototype.googlePlus = function ( element )
    {
        element = $( element );
        if ( ! googleInited )
        {
            googleInited = true;
            googleInit( element.data('locale') );
        }

        if(typeof(global.gapi)!="undefined" && typeof(global.gapi.plusone)!="undefined" && typeof(global.gapi.plusone.go)=='function')
        {
            global.gapi.plusone.go();
        }
    };

    global.Zork.Share.prototype.googlePlus.isElementConstructor = true;

} ( window, jQuery, zork ) );
