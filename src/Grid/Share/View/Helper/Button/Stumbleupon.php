<?php
namespace Grid\Share\View\Helper\Button;

use Zend\View\Helper\AbstractHelper;

/**
 * Share button viewHelper  
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Stumbleupon extends AbstractHelper implements ButtonInterface
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
        return <<<SCRIPT
<span data-js-type="js.share.stumbleUpon" layout="2" location="$url">&nbsp;</span>
SCRIPT;
    }

}
