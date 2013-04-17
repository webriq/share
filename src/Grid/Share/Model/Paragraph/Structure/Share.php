<?php

namespace Grid\Share\Model\Paragraph\Structure;

use Grid\Paragraph\Model\Paragraph\Structure\AbstractLeaf;

/**
 * Share paragraph structure
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Share extends AbstractLeaf
{
    /**
     * Paragraph type
     *
     * @var string
     */
    protected static $type = 'share';

    /**
     * Paragraph-render view-open
     *
     * @var string
     */
    protected static $viewOpen = 'grid/paragraph/render/share';

    /**
     * List of services
     * @var array
     */
    public $sorted = null;

    /**
     * URL to share
     * @var string
     */
    private $_contentUrl = null;

    /**
     * Gets URL to share
     *
     * @return string
     */
    public function getContentUrl()
    {
        if( is_null($this->_contentUrl) )
        {
            $this->_contentUrl = $this->serviceLocator->get('Request')->getUri()->normalize();
        }
        return $this->_contentUrl;
    }

    /**
     * Sets URL to share
     *
     * @param string $value
     * @return \Share\Model\Paragraph\Structure\Share
     */
    public function setContentUrl($value)
    {
        $this->_contentUrl = $value;
        return $this;
    }

    /**
     * Returns list of services
     * @return array|null
     */
    public function getSorted()
    {
        return $this->sorted;
    }
}
