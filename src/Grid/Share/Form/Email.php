<?php

namespace Grid\Share\Form;

use Zork\Form\Form;
use Zork\Form\PrepareElementsAwareInterface;
use Zend\Authentication\AuthenticationService;
use Zork\Authentication\AuthenticationServiceAwareTrait;

/**
 * Email sending form
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Email extends Form
         implements PrepareElementsAwareInterface
{

    use AuthenticationServiceAwareTrait;

    /**
     * Constructor
     *
     * @param   AuthenticationService   $authenticationService
     */
    public function __construct( AuthenticationService $authenticationService )
    {
        $this->setAuthenticationService( $authenticationService );
    }

    /**
     * Prepare additional elements for the form
     *
     * @return void
     */
    public function prepareElements()
    {
        $auth = $this->getAuthenticationService();

        if ( $auth->hasIdentity() )
        {
            $this->remove('captcha');
        }
    }

}
