/**
 * Sortable checkbox list
 * 
 * @package zork
 * @subpackage share
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */

( function ( global, $, js )
{
    "use strict";

    if ( typeof js.share.sortableCheckboxGroup !== "undefined" )
    {
        return;
    }
    
    /**
     * Generates sortable checkbox list
     *
     * @memberOf Zork.Form.Element
     */
    global.Zork.Share.prototype.sortableCheckboxGroup = function ( element )
    {

        element = $( element );
        element.sortable();
    };

    global.Zork.Share.prototype.sortableCheckboxGroup.isElementConstructor = true;

} ( window, jQuery, zork ) );
