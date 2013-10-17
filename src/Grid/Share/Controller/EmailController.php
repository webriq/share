<?php


namespace Grid\Share\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zork\Mail\Message;
use Zork\Mail\ServiceFactory;

/**
 * Share controller
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class EmailController extends AbstractActionController
{
    /**
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $sentSuccess    = null;
        $request        = $this->getRequest();
        $postdata       = $request->getPost();
        $serviceLocator = $this->getServiceLocator();
        $form           = $serviceLocator->get('Form')->get('Grid\Share\Email');
        $translator     = $serviceLocator->get('translator');
        $auth           = $serviceLocator->get('Zend\Authentication\AuthenticationService');

        if ( $request->isPost() )
        {
            $form->setData( $postdata );

            if ( $form->isValid() )
            {
                $data  = $form->getData();

                $renderer = $serviceLocator->get('ViewRenderer');

                $messageView = new ViewModel();
                $messageView->setTemplate('grid/share/email/message');
                $messageView->setVariables(array(
                    'senderName'    => $data['senderName'],
                    'recipientName' => $data['recipientName'],
                    'shareUrl'      => $data['shareUrl'],
                    'message'       => $data['message'],
                ));

                $bodyHtml = $renderer->render($messageView);

                $mail = new Message();
                $mail->setBody($bodyHtml);
                $mail->setFrom($data['senderEmail'], $data['senderName']);
                $mail->addTo($data['recipientEmail'],$data['recipientName']);
                $mail->setSubject($translator->translate('share.email.message.subject','share'));

                $mailServiceFactory = new ServiceFactory();
                $mailSender = $mailServiceFactory->createService($serviceLocator);
                $mailSender->send($mail);

                $sentSuccess = true;
            }
        }
        else
        {
            $prefillData = array
            (
                'shareUrl' => $this->params()->fromQuery('shareUrl')
            );
            if( $auth->hasIdentity() )
            {
                $prefillData['senderEmail'] = $auth->getIdentity()->email;
                $prefillData['senderName']  = $auth->getIdentity()->displayName;
            }
            $form->setData($prefillData);
        }

        $view = new ViewModel();
        $view->setVariable('form', $form);
        $view->setVariable('sentResultSuccess', $sentSuccess);
        $view->setTerminal( true );
        return $view;
    }
}