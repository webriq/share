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
     * @param \Share\Model\Paragraph\Structure\Share $paragraph
     * @return string
     */
    public function render(ShareParagraph $paragraph)
    {
        $html = array();

        $serviceLocator = $this->view->getHelperPluginManager()
                                     ->getServiceLocator();

        $locale = $serviceLocator->get('translator')->getLocale();

        if( is_array($paragraph->sorted) )
        {
            $html[] ='<ul class="share-buttons">';
            foreach($paragraph->sorted as $service)
            {
                if( !empty($service) )
                {
                    $html[] = '<li>';
                    $adapter = $serviceLocator
                                    ->get('Grid\Share\Model\Service\AdapterFactory')
                                    ->factory($service);
                    $adapter->setView($this->view);
                    $adapter->setLocale($locale);
                    $adapter->setUrl($paragraph->getContentUrl());
                    $html[] = $adapter->renderButton();
                    $html[] = '</li>';
                }
            }
            $html[] = '</ul>';
        }

        return implode($html);
    }

    public function __invoke(ShareParagraph $paragraph)
    {
        return $this->render($paragraph);
    }
}
