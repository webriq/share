/**
 * Sharing functionalities
 * @package zork
 * @subpackage share
 * @author Sipos Zoltán, Kristof Matos <kristof.matos@megaweb.hu>
 */
( function ( global, $, js )
{
    "use strict";

    if ( typeof js.share.tumblr !== "undefined" )
    {
        return;
    }

    global.Zork.Share.prototype.tumblr = function ( element )
    {
        element = $( element );

        element.on('click',function(){
            global.open(element.attr('href'), 'tumblr', 'resizable=1,width=600,height=500,menubar=0,status=0,titlebar=0,toolbar=0')
            return false;
        });
    };

    global.Zork.Share.prototype.tumblr.isElementConstructor = true;

} ( window, jQuery, zork ) );
