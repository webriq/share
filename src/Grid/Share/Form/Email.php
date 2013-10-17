<?php

namespace Grid\Share\Form;

use Zork\Form\Form;
use Zork\Form\PrepareElementsAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

/**
 * Email sending form
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Email extends Form
         implements ServiceLocatorAwareInterface,
                    PrepareElementsAwareInterface
{

    use ServiceLocatorAwareTrait;

    /**
     * Prepare additional elements for the form
     *
     * @return void
     */
    public function prepareElements()
    {
        $auth = $this->getServiceLocator()
                     ->get( 'Zend\Authentication\AuthenticationService' );

        if ( $auth->hasIdentity() )
        {
            $this->remove('captcha');
        }
    }

}
