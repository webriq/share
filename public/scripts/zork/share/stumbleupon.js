/**
 * Sharing functionalities
 * @package zork
 * @subpackage share
 * @author Sipos Zoltán, Kristof Matos <kristof.matos@megaweb.hu>
 */
( function ( global, $, js )
{
    "use strict";

    if ( typeof js.share.stumbleUpon !== "undefined" )
    {
        return;
    }

    var suInited = false,
        suLoaded = false,
        suStack  = new Array(),
        suLoader = function(element){
            new global.STMBLPN.Widget(
            {
                type:   'badge',
                id:     element.attr('id'),
                layout: element.attr('layout'),
                location: element.attr('location')
            }).render();
        },
        suInit = function ( element ) {
            $.getScript(document.location.protocol + '//platform.stumbleupon.com/1/widgets.js', function()
            {
                for(var i in suStack){
                    suLoader( suStack[i] );
                }
                suLoaded = true;
            });
        };

    global.Zork.Share.prototype.stumbleUpon = function ( element )
    {
        element = $( element );

        element.attr('id' , 'stumble-upon-element-' + element.parents('div.paragraph-container').first().data('paragraphId') );

        element.css({"display":"inline-block","margin-top":"1px"});

        if ( ! suInited )
        {
            suInited = true;
            suInit( element );
        }

        if(suLoaded)
        {
            suLoader(element);
        }
        else
        {
            suStack.push(element);
        }
    };

    global.Zork.Share.prototype.stumbleUpon.isElementConstructor = true;

} ( window, jQuery, zork ) );
