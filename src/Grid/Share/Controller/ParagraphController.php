<?php

namespace Grid\Share\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Share controller
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class ParagraphController extends AbstractActionController
{
    /**
     *  Draws share buttons by given list
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $servLocator    = $this->getServiceLocator();
        $locale         = $servLocator->get('translator')->getLocale();
        $paragraphModel = $servLocator->get('Grid\Paragraph\Model\Paragraph\Model');

        $paragraph = $paragraphModel->setLocale( $locale )
                           ->create( array( 'type' => 'share' ) );

        $paragraph->setContentUrl($this->params()->fromQuery('url'));
        $paragraph->sorted = explode('|' , $this->params()->fromQuery('services'));

        $view = new ViewModel();

        $view->setVariable('paragraph', $paragraph);

        $view->setTerminal( true );

        return $view;
    }
}
