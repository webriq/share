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
        js.style('/styles/modules/Share/email.css');

        element = $( element );

        var backendUrl = '/app/' + element.attr('data-locale') + '/share/email';

        if(element[0].tagName.toLowerCase()=='a')
        {
            element.addClass('share-button-email');
            element.css(
            {
                display: 'block',
                position: 'relative',
                top: 0,
                left: 0,
                height: '14px',
                lineHeight: '14px',
                fontSize: '11px',
                fontFamily: 'Arial',
                padding: '2px 5px 2px 25px',
                margin: '0 5px 0 0',
                border: 'solid 1px #cacaca',
                background: 'url(/images/modules/Share/email_16x16.png) no-repeat scroll 3px center #F2F2F2',
                textDecoration: 'none',
                color: '#555555',
                fontWeight: 'bold',
                '-moz-border-radius': '3px',
                'border-radius': '3px'
            });

            element.on('click',function() {
                var dialog = null ,
                    dialogClose = null,
                    dialogShow = function(content)
                    {
                        var id  = "js-share-email-" + js.generateId.number();

                        if( Function.isFunction(dialogClose) ){ dialogClose(); }

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
                                $('<div/>')
                                .css('min-height','100px')
                                .css('background','#fff url(/images/scripts/loading.gif) no-repeat center center')
                            )
                            .html( content );

                        js.core.parseDocument(dialog);

                        var form = dialog.find('form');

                        if( form[0] )
                        {
                            form.find('input[name=cancel]')
                                .on('click',function(){ dialogClose(); return false } );
                            form.on('submit',submitEvent);
                        }
                        else
                        {
                            dialog
                                .find('button.result-close')
                                .on('click',function(){ dialogClose(); });
                            setTimeout(function(){ dialogClose(); },5000);

                        }
                        dialogClose = js.core.layer( dialog );

                    },//end of dialogShow
                    submitEvent = function()
                    {
                        var form =  $(this);

                        dialog.children().css('background','#fff url(/images/scripts/loading.gif) no-repeat center center').children().css('opacity','0.0');

                        $.post(backendUrl,form.serializeArray(),function(result)
                        {
                            dialogShow(result);
                        });

                        return false;
                    }//end of submitEvent
                ;

                $.ajax(
                {
                    url: backendUrl,
                    data: {"shareUrl": element.attr('data-share-url')}
                })
                .done( function ( result )
                {
                    dialogShow(result);
                });

                return false;
            });

        }
    };

    global.Zork.Share.prototype.email.isElementConstructor = true;

} ( window, jQuery, zork ) );
