<?php
namespace Grid\Share\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Grid\Share\Model\Paragraph\Structure\Share as ShareParagraph;

/**
 * Share buttons viewHelper
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class ShareButtons extends AbstractHelper
{
    /**
     * Returns buttons html
     *
     * @param string $url
     * @param string[] $serviceList array of service names
     * 
     * @return string
     */
    public function render($url,$serviceList)
    {
        $html = array();
        
        $serviceLocator = $this->view->getHelperPluginManager()
                                     ->getServiceLocator();

        $locale = $serviceLocator->get('translator')->getLocale();

        if( is_array($serviceList) && !empty($serviceList) )
        {
            $html[] ='<ul class="share-buttons">';
            foreach($serviceList as $service)
            {
               
                if( !empty($service) )
                {
                    $html[] = '<li>';
                    $adapter = $serviceLocator
                                    ->get('Grid\Share\Model\Service\AdapterFactory')
                                    ->factory($service);
                    $adapter->setView($this->view);
                    $adapter->setLocale($locale);
                    $adapter->setUrl($url);
                    $html[] = $adapter->renderButton();
                    $html[] = '</li>';
                }
            }
            $html[] = '</ul>';
        }

        return implode($html);
    }

    /**
     * 
     * @param string $url
     * @param string[] $serviceList array of service names
     * 
     * @return type
     */
    public function __invoke($url,$serviceList)
    {
        return $this->render($url,$serviceList);
    }
}
