<?php

namespace Grid\Share\Form;

use Zork\Form\Form;
use Zork\Form\PrepareElementsAwareInterface;
use Zend\Authentication\AuthenticationService;

/**
 * Email sending form
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Email extends Form
         implements PrepareElementsAwareInterface
{

    /**
     * Prepare additional elements for the form
     *
     * @return void
     */
    public function prepareElements()
    {
        $auth = new AuthenticationService;

        if ( $auth->hasIdentity() )
        {
            $this->remove('captcha');
        }

    }

}
