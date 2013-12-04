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

    global.Zork.Share.prototype.facebook = function ( element )
    {
        js.require( 'js.facebook' ).xfbml( element );
    };

    global.Zork.Share.prototype.facebook.isElementConstructor = true;

} ( window, jQuery, zork ) );
