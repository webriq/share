/**
 * Sharing functionalities
 * @package zork
 * @subpackage share
 * @author Sipos Zoltán, Kristof Matos <kristof.matos@megaweb.hu>
 */
( function ( global, $, js )
{
    "use strict";

    if ( typeof js.share.reddit !== "undefined" )
    {
        return;
    }

    global.Zork.Share.prototype.reddit = function ( element )
    {
        element = $( element );

        var url = encodeURI(element.data('url'));

        var styled_submit = '<a style="color: #369; text-decoration: none;" href="http://www.reddit.com/submit?url='+
                url + '&amp;amp;title=" target="_new">';
        var unstyled_submit = '<a href="http://www.reddit.com/submit?url='+
                url+'&amp;title=" target="http://www.reddit.com/submit?url=http%3A%2F%2Ftzhl&amp;amp;title=">';
        var write_string = '<span class="reddit_button" style="';
        write_string += '">';
        write_string += unstyled_submit + '<img style="height: 20px; width: 78px;vertical-align:top;" src="http://www.redditstatic.com/spreddit10.gif">' + "</a>";
        write_string += unstyled_submit;
        write_string += '</a>';
        write_string += '</span>';

        element.html(write_string);
    };

    global.Zork.Share.prototype.reddit.isElementConstructor = true;

} ( window, jQuery, zork ) );
