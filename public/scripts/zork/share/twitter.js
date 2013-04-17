/**
 * Sharing functionalities
 * @package zork
 * @subpackage share
 * @author Sipos Zoltán, Kristof Matos <kristof.matos@megaweb.hu>
 */
( function ( global, $, js )
{
    "use strict";

    if ( typeof js.share.twitter !== "undefined" )
    {
        return;
    }

    var twitterInited = false,
        twitterInit = function ( locale ) {
            $.getScript('//platform.twitter.com/widgets.js', function()
            {
                global.twttr.widgets.load();
            });
        };

    global.Zork.Share.prototype.twitter = function ( element )
    {
        element = $( element );
        if ( ! twitterInited )
        {
            twitterInited = true;
            twitterInit( element.data('locale') );
        }

        if(typeof(global.twttr)=='object' && typeof(global.twttr.widgets)=='object' && typeof(global.twttr.widgets.load)=='function')
        {
            global.twttr.widgets.load();
        }
    };

    global.Zork.Share.prototype.twitter.isElementConstructor = true;

} ( window, jQuery, zork ) );
