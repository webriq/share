/**
 * Sharing functionalities
 * 
 * @package zork
 * @subpackage share
 * @author Sipos Zoltán, Kristof Matos <kristof.matos@megaweb.hu>
 */

/**
 * 
 * @param {window} global
 * @param {jQuery} $
 * @param {Zork} js
 * @returns {undefined}
 */
( function ( global, $, js )
{
    "use strict";

    if ( typeof js.share.pinIt !== "undefined" )
    {
        return;
    }

    var imageSelector = 
        {
            dialogParams: 
            {
                width:  400,
                height: 360                
            },
            inited: false,
            dialog: false,
            content: $('<div>').css({"display":"none"}),
            show: function()
            {
                var Me = this,
                    dTitle = js.core.translate('share.pinterest.select.image.title')
                ;
                js.require('js.ui.dialog',function()
                {
                    if( Me.dialog ){ Me.close(); }
                    Me.dialog = js.ui.dialog( $.extend( Me.dialogParams, {
                                    title: dTitle,
                                    message: Me.content
                                }));
                    Me.content.css({"display":"block"});
                });
            },
            close: function()
            {
                var Me = this;
                js.ui.dialog.destroy(Me.dialog);
                Me.dialog = false;
            },
            init: function(buttonElement)
            {
                var Me = this;
                
                if( Me.inited ){ return; }   
                
                Me.inited = true;
                
                var
                    loaded   = 0,
                    images   = Me.findImages(),
                    shareUrl = encodeURI(buttonElement[0].href)
                ;
                
                $.each(images,function(idx,sourceImage)
                {
                    var image = new Image();
                    $(image).load(function()
                    {
                        loaded++;
                        var accept = true,
                            rate = (this.height>this.width)
                                    ?( this.height/this.width )
                                    :( this.width/this.height );

                        if(this.width < parseInt(buttonElement.data('minWidth')) )
                        {
                            accept = false;
                        }

                        if(this.height < parseInt(buttonElement.data('minHeight')) )
                        {
                            accept = false;
                        }

                        if( rate > parseFloat(buttonElement.data('maxScale')) )
                        {
                            accept = false;
                        }
                        if( accept )
                        {
                            Me.addItem(image, shareUrl);
                        }

                        if( loaded === images.length )
                        {
                            Me.parse();
                        }
                    });
                    image.src = sourceImage;
                });
                
            },
            addItem: function(image,shareUrl)
            {
                $(image).css({"max-height": '90px', "max-width" : '160px'});

                var Me = this,
                    item = $('<div/>')
                            .css(
                            {
                                "display": "inline-block",
                                "padding": "5px",
                                "margin": "0",
                                "width": "160px",
                                "height": "140px",
                                "text-align": "center"
                            })
                            .append($('<div/>').append(image))
                            .append
                            (
                                $('<a/>')
                                    .attr(
                                    {
                                        'href': 'http://pinterest.com/pin/create/button/?url='
                                                    + shareUrl
                                                    + '&media='
                                                    + encodeURI(image.src),
                                        'class': 'pin-it-button',
                                        'count-layout': 'horizontal'
                                    })
                                    .css(
                                    {
                                        display:  'inline-block'
                                    })
                                    .append(
                                        $('<img title="Pin It" />')
                                            .attr('src','//assets.pinterest.com/images/PinExt.png')
                                    )
                                    
                            );
                Me.content.append(item);
            },
            parse: function()
            {
                var Me = this;
                
                $('body').append(Me.content);

                $.ajax(
                {
                    url: 'http://assets.pinterest.com/js/pinit.js',
                    dataType: 'script',
                    cache:true,
                    success: function(){ }
                });
            },
            excludeUrl: function(url)
            {
                var siteUrl = global.location.protocol+'//'+global.location.host,
                    exp     = new RegExp('^'+siteUrl+'/(style|images|scripts)')
                ;
                return Boolean(url.match(exp));
            },
            urlIsANewImage: function(url, imageArray)
            {
                return /\.(?:jpg|jpeg|png|gif)$/i.test(url) && $.inArray(url,imageArray)===-1
                       && !(/\/sprite\/sprite_connect_v[0-9]+\.png$/.test(url));
            },
            findImages: function()
            {
                var Me = this,
                    imageArray = new Array()
                ;
                $('*').each(function()
                {
                    var url = null;
                    if( Me.urlIsANewImage(this.src, imageArray) )
                    {
                        url = this.src;
                    }
                    if( Me.urlIsANewImage(this.href, imageArray) )
                    {
                        url = this.href;
                    }
                    var cssImage = $(this).css('backgroundImage').replace(/^\s*url\("?/,'').replace(/"?\)$/,'');
                    if( Me.urlIsANewImage(cssImage, imageArray))
                    {
                        url = cssImage;
                    }
                    
                    if( url && !Me.excludeUrl(url) )
                    {
                        imageArray.push(url);
                    }
                    
                });
                return imageArray;
            }
        };

    global.Zork.Share.prototype.pinIt = function ( element )
    {
        element = $( element );
        imageSelector.init(element);
        element.on('click',function(){ imageSelector.show(); return false;} );
    };

    global.Zork.Share.prototype.pinIt.isElementConstructor = true;

} ( window, jQuery, zork ) );
