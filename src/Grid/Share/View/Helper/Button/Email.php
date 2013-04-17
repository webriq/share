<?php
namespace Grid\Share\View\Helper\Button;

use Zend\View\Helper\AbstractHelper;

/**
 * Share button viewHelper  
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Email extends AbstractHelper implements ButtonInterface
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
<a  href="javascript:void(0)"
    data-js-type="js.share.email"
    data-share-url="$url"
    data-js-stylesheet="/styles/modules/Share/email.css"
    data-locale="$locale">{$this->view->translate('share.button.text','share')}</a>
SCRIPT;
    }
    
}
