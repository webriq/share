<?php
namespace Grid\Share\View\Helper\Button;

use Zend\View\Helper\AbstractHelper;

/**
 * Share button viewHelper  
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Googleplus extends AbstractHelper implements ButtonInterface
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
<div data-js-type="js.share.googlePlus" data-locale="{$locale}" class="g-plusone" data-size="medium"  data-width="100"></div>
SCRIPT;
    }

}

