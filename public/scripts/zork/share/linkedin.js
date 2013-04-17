/**
 * Sharing functionalities
 * @package zork
 * @subpackage share
 * @author Sipos Zoltán, Kristof Matos <kristof.matos@megaweb.hu>
 */
( function ( global, $, js )
{
    "use strict";
    
    if ( typeof js.share.linkedIn !== "undefined" )
    {
        return;
    }
    
    var linkedInInited = false,
        linkedInInit = function ( ) {
            $.getScript('//platform.linkedin.com/in.js');
        };
    
    global.Zork.Share.prototype.linkedIn = function ( element )
    {
        element = $( element );

        if ( ! linkedInInited )
        {
            linkedInInited = true;
            linkedInInit();
        }
        
        if(typeof(global.IN)!='undefined' && typeof(global.IN.parse)=='function')
        {
            global.IN.parse(element.parent()[0]);
        }
    };
    
    global.Zork.Share.prototype.linkedIn.isElementConstructor = true;
    
} ( window, jQuery, zork ) );
