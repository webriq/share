/**
 * Sharing functionalities
 * @package zork
 * @subpackage share
 * @author Sipos Zoltán, Kristof Matos <kristof.matos@megaweb.hu>
 */
( function ( global, $, js )
{
    "use strict";

    if ( typeof js.share.facebook !== "undefined" )
    {
        return;
    }

    var fbInited = false,
        fbInit = function ( locale ) {
            $('body').prepend('<div id="fb-root"></div>');
            $.getScript('http://connect.facebook.net/'+locale+'/all.js', function() {
                global.FB.init({status: true, cookie: true, xfbml: true});
            });
        };

    global.Zork.Share.prototype.facebook = function ( element )
    {
        element = $( element );

        if ( ! fbInited )
        {
            fbInited = true;
            fbInit( element.data('locale') );
        }

        if(typeof(global.FB)!='undefined' && typeof(global.FB.XFBML)!='undefined' && typeof(global.FB.XFBML.parse)=='function')
        {
            global.FB.init({status: true, cookie: true, xfbml: true});
        }
    };

    global.Zork.Share.prototype.facebook.isElementConstructor = true;

} ( window, jQuery, zork ) );
