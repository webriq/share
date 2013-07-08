/**
 * Sharing functionalities
 * @package zork
 * @subpackage share
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
( function ( global, $, js )
{
    "use strict";

    if ( typeof js.share.email !== "undefined" )
    {
        return;
    }

    /**
     * Opens email sending from
     */
    global.Zork.Share.prototype.email = function ( element )
    {
        js.style( "/styles/modules/Share/email.css" );
        element = $( element );

        var backendUrl = "/app/" + element.data( "locale" ) + "/share/email";

        if ( element.is( "a" ) )
        {
            element.addClass( "share-button-email" )
                   .css( {
                        "display": "inline-block",
                        "position": "relative",
                        "top": 0,
                        "left": 0,
                        "height": "14px",
                        "line-height": "14px",
                        "font-size": "11px",
                        "font-family": "Arial",
                        "padding": "2px 5px 2px 25px",
                        "margin": "0 5px 0 0",
                        "border": "1px solid #cacaca",
                        "background": 'url("/images/modules/Share/email_16x16.png") no-repeat scroll 3px center #F2F2F2',
                        "text-decoration": "none",
                        "color": "#555555",
                        "font-weight": "bold",
                        "-moz-border-radius": "3px",
                        "border-radius": "3px"
                    } );

            element.on( "click", function() {
                var dialog = null,
                    dialogClose = null,
                    dialogShow = function(content)
                    {
                        var id  = "js-share-email-" + js.generateId.number();

                        if ( Function.isFunction( dialogClose ) )
                        {
                            dialogClose();
                        }

                        dialog  =
                            $( '<div id="' + id + '" name="' + id + '" />' )
                            .css( {
                                "width"             : "350px",
                                "margin"            : "0px",
                                "padding"           : "0",
                                "border"            : "none",
                                "min-height"        : "100px",
                                "background-color"  : "#ffffff"
                            } )
                            .append(
                                $( "<div />" )
                                    .css( {
                                        "min-height": "100px",
                                        "background": '#fff url("/images/scripts/loading.gif") no-repeat center center'
                                    } )
                            )
                            .html( content );

                        js.core.parseDocument( dialog );

                        var form = dialog.find( "form" );

                        if ( form.length )
                        {
                            form.find( "input[name=cancel]" )
                                .on( "click", function () { dialogClose(); return false; } );
                            form.on( "submit", submitEvent);
                        }
                        else
                        {
                            dialog.find( "button.result-close" )
                                  .on( "click", function () { dialogClose(); } );
                            setTimeout( function () { dialogClose(); }, 5000 );
                        }

                        dialogClose = js.core.layer( dialog );

                    },//end of dialogShow
                    submitEvent = function()
                    {
                        var form =  $(this);

                        dialog.children()
                              .css( "background", '#fff url("/images/scripts/loading.gif") no-repeat center center' )
                              .children()
                              .css( "opacity", "0.0" );

                        $.post( backendUrl, form.serializeArray(), function ( result ) {
                            dialogShow( result );
                        } );

                        return false;
                    }//end of submitEvent
                ;

                $.ajax( {
                    "url": backendUrl,
                    "data": {
                        "shareUrl": element.data( "shareUrl" )
                    }
                } )
                .done( function ( result ) {
                    dialogShow( result );
                } );

                return false;
            } );

        }
    };

    global.Zork.Share.prototype.email.isElementConstructor = true;

} ( window, jQuery, zork ) );
