/**
 * Sharing functionalities
 * @package zork
 * @subpackage share
 * @author Sipos Zoltán, Kristof Matos <kristof.matos@megaweb.hu>
 */
( function ( global, $, js )
{
    "use strict";

    if ( typeof js.share.pinIt !== "undefined" )
    {
        return;
    }

    var buttonElement,
        urlIsANewImage= function(url, imageArray)
        {
            return /\.(?:jpg|jpeg|png|gif)$/i.test(url) && $.inArray(url,imageArray)==-1
                   && !(/\/sprite\/sprite_connect_v[0-9]+\.png$/.test(url));
        },
        getImageArray= function(){
            var imageArray = new Array();
            $('*').each(function(){
                var url = null;
                if( urlIsANewImage(this.src, imageArray) )
                {
                    imageArray.push(this.src);
                }
                if( urlIsANewImage(this.href, imageArray) )
                {
                    imageArray.push(this.href);
                }
                var cssImage = $(this).css('backgroundImage').replace(/^\s*url\("?/,'').replace(/"?\)$/,'');
                if( urlIsANewImage(cssImage, imageArray))
                {
                    imageArray.push(cssImage);
                }
            });
            return imageArray;
        };

    global.Zork.Share.prototype.pinIt = function ( element )
    {
        element = $( element );
        if(element.is('a'))
        {
            element.on('click',function(){return false;});

            element.off('click').on('click',function() {
                js.require('js.ui.lightbox',function()
                {
                    buttonElement = element;
                    js.ui.lightboxOpen(element);
                });
                return false;
            });
        }
        else
        {
            element
                .css(
                {
                    height: '400px',
                    width: '820px',
                    overflow: 'auto'
                });

            var images = getImageArray();
            for(var i=0, length = images.length; i<length; i++ )
            {
                var image = new Image();

                $(image).load(function()
                {
                    if(this.width < parseInt(buttonElement.data('minWidth')) )
                    {
                        $(this).parent().remove();
                        return;
                    }

                    if(this.height < parseInt(buttonElement.data('minHeight')) )
                    {
                        $(this).parent().remove();
                        return;
                    }

                    var rate = (this.height>this.width)
                        ?( this.height/this.width )
                        :( this.width/this.height );

                    if( rate > parseFloat(buttonElement.data('maxScale')) )
                    {
                        $(this).parent().remove();
                        return;
                    }

                    $(this).css('marginTop',''+ Math.floor( ($(this).parent().height()-$(this).height())/2 ) + 'px' );
                });
                image.src = images[i];
                $(image).css(
                {
                    maxHeight: '190px',
                    maxWidth : '190px'
                });

                var item = $('<div></div>')
                    .css(
                    {
                        display: 'block',
                        position: 'relative',
                        padding: '5px',
                        margin: '0',
                        width: '190px',
                        height: '190px',
                        textAlign: 'center',
                        'float': 'left'
                    })
                    .append(image)
                    .append
                    (
                        $('<a></a>')
                            .attr(
                            {
                                'href': 'http://pinterest.com/pin/create/button/?url='
                                            + encodeURI(buttonElement[0].href)
                                            + '&media='
                                            + encodeURI(image.src),
                                'class': 'pin-it-button',
                                'count-layout': 'horizontal'
                            })
                            .css(
                            {
                                position: 'absolute',
                                display:  'block',
                                bottom:   '5px',
                                right:    '5px'
                            })
                            .append(
                                $('<img title="Pin It" />')
                                    .attr('src','//assets.pinterest.com/images/PinExt.png')
                            )
                    );

                element.append(item);

            }

            $.ajax(
            {
                url: 'http://assets.pinterest.com/js/pinit.js',
                dataType: 'script',
                cache:true,
                success: function()
                {
                    element.find('iframe')
                        .css(
                        {
                            position: 'absolute',
                            display:  'block',
                            bottom:   '5px',
                            right:    '5px'
                        })
                }
            });

        }
    };

    global.Zork.Share.prototype.pinIt.isElementConstructor = true;

} ( window, jQuery, zork ) );
