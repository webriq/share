<?php
namespace Grid\Share\View\Helper\Button;

use Zend\View\Helper\AbstractHelper;

/**
 * Share button viewHelper  
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Tumblr extends AbstractHelper implements ButtonInterface
{
   /**
     * Renders button html
     * 
     * @param string $url
     * @param string $locale
     * @return string
     */
    public function getHtml( $url, $locale )
    {      
        return <<<SCRIPT
<a data-js-type="js.share.tumblr" href="http://www.tumblr.com/share" title="{$this->view->translate('share.form.checkbox.tumblr.share')}" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:129px; height:20px; background:url('http://platform.tumblr.com/v1/share_3.png') top left no-repeat transparent;">{$this->view->translate('share.form.checkbox.tumblr.share')}</a>
SCRIPT;
    }

}
