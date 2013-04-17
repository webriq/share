<?php
namespace Grid\Share\Model\Service;

use Grid\Share\Model\Service\AdapterDefault as ServiceAdapterShare;

/**
 * Share service adapter 
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Twitter extends ServiceAdapterShare
{
    /**
     * Name of helper of display
     * 
     * @var string $_helper
     */
    protected $_helper = 'shareButtonTwitter';

}
