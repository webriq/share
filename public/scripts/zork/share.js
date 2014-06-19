/**
 * Share interface functionalities
 * 
 * @package zork
 * @subpackage share
 * @author Sipi, Kristof Matos <kristof.matos@megaweb.hu>
 * 
 * @param {window} global
 * @param {jQuery} $
 * @param {Zork} js
 * @returns {void}
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
     * @class Share module
     * @constructor
     * @memberOf Zork
     */
    global.Zork.Share = function ()
    {
        this.version = "1.0";
        this.modulePrefix = [ "zork", "share" ];
    };

    global.Zork.prototype.share = new global.Zork.Share();

    $( document ).ready(function()
    {
        js.share.microcontent.parse();
    });
    
    var Microcontent = function(){};
        Microcontent.prototype._popup = null;
        Microcontent.prototype.popup = function(url,params)
        {
            var Me      = this,
                pparams = $.extend({
                            'width'  : 800,
                            'height' : 500,
                            'menubar': 0,
                            'status' : 0,
                            'toolbar': 0,
                            'fullscreen': 0
                         },params),
                specs  = $.param(pparams).replace(/&/g,',')             
            ;
            if( Me._popup ){ Me._popup.close(); }
            Me._popup = window.open(url,'share-popup',specs,true);
            return Me._popup;
        };
        Microcontent.prototype.settingsCache = null;
        Microcontent.prototype.getSettings = function()
        {
            var Me = this;
            if( Me.settingsCache===null )
            {
                Me.settingsCache = js.core.rpc( {"method": "Grid\\Share\\Model\\Microcontent\\Rpc::getSettings"} )(); 
            }
            return Me.settingsCache;
        };
        Microcontent.prototype.parse = function(element)
        {
            var Me = this;
            $('.microcontent',element).each(function(idx,item)
            {
                Me.bindShareBar(item);
            });
        };
        Microcontent.prototype.bindShareBar = function(element)
        {
            element = $(element);
            var Me = this,
                share = {
                    "url": element.data('microcontentUrl'),
                    "title": element.data('microcontentTitle'),
                    "image": element.data('microcontentImage'),
                    "description": element.data('microcontentDescription'),
                    "type": element.data('microcontentType')
                },
                enableShare = String(element.data('microcontentShare'))==='enable' 
                              || String(element.data('microcontentShare'))==='disable'
                              ? element.data('microcontentShare')==='enable'
                              : Boolean($.parseJSON(Me.getSettings().enable)),
                services = share.type === 'image'
                           ? Me.getSettings().imageButtons
                           : Me.getSettings().articleButtons,
                toggleTimeout = null,
                toggleDelay = 5000,
                wrapper = $('<div>').addClass('share toolbar '+(share.type === 'image'?'floating':''))
                                    .on('mouseenter',function(e){ toggle('open'); return false; })
                                    .on('mouseleave',function(e){ toggle('close'); return false; })
                            ,
                button  = $('<div>').addClass('share-button')
                                    .bind('click',function(){ toggle('open','click'); return false; })
                                    .appendTo(wrapper),
                toolbar = $('<ul>').addClass('buttons').appendTo(wrapper),

                toggle  = function(to,evt)
                {
                    if( toggleTimeout ){ clearTimeout(toggleTimeout); }
                    if( to === 'open' )
                    {
                        wrapper.addClass('open');
                        $('ul',wrapper).stop().hide().fadeIn(400);
                        if( evt==='click' )
                        {
                            setTimeout(function(){ toggle('close'); },toggleDelay);
                        }
                    }
                    else
                    {
                        $('ul',wrapper).stop().fadeOut(400,function(){ wrapper.removeClass('open'); });
                        
                    }
                }
            ;
            
            if( !enableShare || services.length<1 ){ return; }
            
            $.each( services, function(idx,service)
            {
                var item = $('<li>'),
                    button = GGButtons[service](share,Me)
                ;
                button.addClass("button "+service);
                item.append(button).appendTo(toolbar);
            });
            
            element.append(wrapper);
        };
        
    global.Zork.Share.prototype.microcontent = new Microcontent();
    
    
    var GGButtons = 
    {
        /**
         * 
         * @param {object} shareObject
         * @param {Microcontent} microcontentObject
         * @returns {element}
         */
        'facebook': function(shareObject,microcontentObject)
        {
            return $('<span>')
                .bind('click',function()
                {
                    var url = 'https://www.facebook.com/sharer/sharer.php',
                        params = {
                            "u": shareObject.url,
                            "popup": 1
                        }
                    ;
                    microcontentObject.popup( 
                        url+'?'+$.param(params),
                        {'width':680,'height': 380} 
                    );
                    return false;
                });
        },
        /**
         * @link https://developers.pinterest.com/pin_it/
         * @param {object} shareObject
         * @param {Microcontent} microcontentObject
         * @returns {element}
         */
        'pinterest': function(shareObject,microcontentObject)
        {
            return $('<span>')
                .bind('click',function()
                {
                    var url = 'http://www.pinterest.com/pin/create/button/',
                        params = {
                            "url": shareObject.url,
                            "media": shareObject.image,
                            "description": shareObject.description
                        }
                    ;
                    microcontentObject.popup( 
                        url+'?'+$.param(params),
                        {'width':680,'height': 380} 
                    );
                    return false;
                });
        },
        /**
         * 
         * @param {object} shareObject
         * @param {Microcontent} microcontentObject
         * @returns {element}
         */
        'twitter': function(shareObject,microcontentObject)
        {
            return $('<a>')
                .bind('click',function()
                {
                    var url = 'https://twitter.com/intent/tweet',
                        params = {
                            "url": shareObject.url,
                            "text": shareObject.description
                        }
                    ;

                    microcontentObject.popup( 
                        url+'?'+$.param(params),
                        {'width':600,'height': 540} 
                    );
                    return false;
                });
        },
        /**
         * @link https://developers.google.com/+/web/share/#sharelink
         * @param {object} shareObject
         * @param {Microcontent} microcontentObject
         * @returns {element}
         */
        'googleplus': function(shareObject,microcontentObject)
        {
            return $('<span>')
                .bind('click',function()
                {
                    var url = 'https://plus.google.com/share',
                        params = {
                            "url": shareObject.url
                        }
                    ;
                    microcontentObject.popup( 
                        url+'?'+$.param(params),
                        {'width':680,'height': 380} 
                    );
                    return false;
                });
        },
        /**
         * @link https://developer.linkedin.com/documents/share-linkedin
         * @param {object} shareObject
         * @param {Microcontent} microcontentObject
         * @returns {element}
         */
        'linkedin': function(shareObject,microcontentObject)
        {
            return $('<span>')
                .bind('click',function()
                {
                    var url = 'https://www.linkedin.com/shareArticle',
                        params = {
                            "mini": 'true',
                            "url": shareObject.url,
                            "title": shareObject.title,
                            "summary": shareObject.description
                        }
                    ;
                    microcontentObject.popup( 
                        url+'?'+$.param(params),
                        {'width':520,'height': 580} 
                    );
                    return false;
                });
        }
    };

} ( window, jQuery, zork ) );
