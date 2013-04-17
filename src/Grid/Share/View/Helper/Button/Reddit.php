<?php
namespace Grid\Share\View\Helper\Button;

use Zend\View\Helper\AbstractHelper;

/**
 * Share button viewHelper  
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Reddit extends AbstractHelper implements ButtonInterface
{
   /**
     * Renders button html
     * 
     * @param string $url
     * @param string $locale
     * @return string
     */
    public function getHtml( $url, $locale )
    {
        $url = urlencode($url);
        return <<<SCRIPT
<span data-js-type="js.share.reddit" data-url="$url" >&nbsp;</span>
SCRIPT;
    }

}
