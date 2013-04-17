<?php
namespace Grid\Share\Model\Service;

use Grid\Share\Model\Service\AdapterDefault as ServiceAdapterShare;

/**
 * Share service adapter 
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Facebook extends ServiceAdapterShare
{
    /**
     * Name of helper of display
     * 
     * @var string $_helper
     */
    protected $_helper = 'shareButtonFacebook';
        
    /**
     * Facebook default locale
     * 
     * @var string
     */
    protected $_fbDefaultLocale = 'en_GB';
    
    /**
     * Actual system locale
     * 
     * @var string main system locale 
     */
    protected $_systemLocale = null;
    
    /**
     * Sets facebook locale by system locale
     * 
     * @return string facebook locale
     */
    public function setLocale($systemLocal)
    {
        if( $systemLocal != $this->_systemLocale )
        {
            $this->_systemLocale = $systemLocal;
            
            $serviceLocator = $this->_view->getHelperPluginManager()
                                          ->getServiceLocator(); 
            
            $config = $serviceLocator->get('Config');
            
            $fbLocales = $config['modules']['Grid\Share']['facebook']['languages'];
            
            $localeConverted = substr($systemLocal,0,2)
                                  .'_'
                                  .strtoupper( substr($systemLocal,0,2));
            
            if( in_array($systemLocal,$fbLocales) )
            {
                $this->_locale = $systemLocal;
            }
            elseif( in_array( $localeConverted ,$fbLocales ))
            {
                 $this->_locale = $localeConverted;
            }
            else
            {
                $this->_locale = $this->_fbDefaultLocale;
            }
        }
        return $this->_locale;
    }
}
