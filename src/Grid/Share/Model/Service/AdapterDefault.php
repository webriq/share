<?php
namespace Grid\Share\Model\Service;

use Zork\Model\Structure\StructureAbstract;
use Zork\Factory\AdapterInterface as FactoryAdapterInterface;
use Grid\Share\View\Helper\Button\ButtonInterface As ShareButtonInterface;

/**
 * Share service adapter abstract
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
abstract class AdapterDefault extends StructureAbstract
                  implements FactoryAdapterInterface
{
    /**
     * Name of the helper to call to render social partial of adapter.
     *
     * @var object
     */
    protected $_helper = '';

    /**
     * Contain the value of view property property.
     *
     * @var object
     */
    protected $_view = '';

    /**
     * Contain the value of url property.
     *
     * @var string
     */
    protected $_url = '';

    /**
     * Contain the value of locale property.
     *
     * @var string
     */
    protected $_locale = '';


    /**
     * Adapter accepts options
     *
     * @param array $options
     * @return bool
     */
    public static function acceptsOptions( array $options )
    {
        return false;
    }

    /**
     * Return a new instance of the adapter
     *
     * @param array $options;
     * @return Grid\Share\Model\Service\AdapterDefault
     */
    public static function factory( array $options = null )
    {
        return new static( $options );
    }


    /**
     * Renders button html
     *
     * @return string HTML code
     * @throw \Exception when viewHelper not valid
     */
    public function renderButton()
    {
        $viewHelper = $this->_view->plugin($this->_helper);
        if( !($viewHelper instanceof ShareButtonInterface) )
        {
            throw new \Exception('Grid\Share\Model\Service\Adapter _viewHelper
                                  must be instance of
                                  Grid\Share\View\Helper\Button\ButtonInterface');
        }
        return $viewHelper->getHtml( $this->getUrl(), $this->getLocale() );
    }

    /**
     * Getter of view object property.
     *
     * @return string
     *      The value of url property.
     */
    public function getView()
    {
        return $this->_view;
    }

    /**
     * Setter of view object property.
     *
     * @param string $view
     *          The value of view to set.
     * @return \Share\Model\Service\AdapterDefault
     */
    public function setView($view)
    {
        $this->_view = $view;
        return $this;
    }

    /**
     * Getter of url property.
     *
     * @return string
     *      The value of url propperty.
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * Setter of url property.
     *
     * @param string $url
     *          The value of url to set.
     * @return \Share\Model\Service\AdapterDefault
     */
    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }

    /**
     * Getter of locale property.
     *
     * @return string
     *      The value of locale propperty.
     */
    public function getLocale()
    {
        return $this->_locale;
    }

    /**
     * Setter of locale property.
     *
     * @param string $locale
     *          The value of locale to set.
     * @return \Share\Model\Service\AdapterDefault
     */
    public function setLocale($locale)
    {
        $this->_locale = $locale;
        return $this;
    }

}
