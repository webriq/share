<?php
namespace Grid\Share\View\Helper\Button;

use Zend\View\Helper\AbstractHelper;

/**
 * Share button viewHelper  
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Pinterest extends AbstractHelper implements ButtonInterface
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
        $serviceLocator = $this->view->getHelperPluginManager()
                                     ->getServiceLocator(); 
        $config = $serviceLocator->get('Config');
        $pinterestConfig = $config['modules']['Grid\Share']['pinterest'];

        return <<<SCRIPT
<a href="$url"
    data-js-type="js.share.pinIt"
    data-js-link-type="callback"
    data-js-width="820"
    data-js-height="400"
    data-js-callback="js.share.pinIt"
    data-js-background-color="#fff"
    data-js-color="#cd2a31"
    data-min-width="{$pinterestConfig['width']['min']}"
    data-min-height="{$pinterestConfig['height']['min']}"
    data-max-scale="{$pinterestConfig['scale']['max']}"
    class="pin-it-button"
    count-layout="horizontal"
><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
SCRIPT;
    }

}
