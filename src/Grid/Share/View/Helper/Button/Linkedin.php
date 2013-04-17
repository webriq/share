<?php
namespace Grid\Share\View\Helper\Button;

use Zend\View\Helper\AbstractHelper;

/**
 * Share button viewHelper  
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Linkedin extends AbstractHelper implements ButtonInterface
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
<script data-js-type="js.share.linkedIn" type="IN/Grid\Share" data-url="$url" data-counter="right"></script>
SCRIPT;
    }

}
