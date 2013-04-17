/**
 * Social interface functionalities
 * @package zork
 * @subpackage social
 * @author Sipi, Kristof Matos <kristof.matos@megaweb.hu>
 */
( function ( global, $, js )
{
    "use strict";

    if ( typeof js.share !== "undefined" )
    {
        return;
    }

    js.style('/styles/modules/Share/share.css');

    /**
     * @class User module
     * @constructor
     * @memberOf Zork
     */
    global.Zork.Share = function ()
    {
        this.version = "1.0";
        this.modulePrefix = [ "zork", "share" ];
    };

    global.Zork.prototype.share = new global.Zork.Share();

} ( window, jQuery, zork ) );
