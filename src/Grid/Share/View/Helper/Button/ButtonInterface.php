<?php
namespace Grid\Share\View\Helper\Button;

/**
 * Interface for share service button viewHelper
 * 
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
interface ButtonInterface
{
    /**
     * Gets sharing service button HTML code
     * 
     * @param string $url 
     * @param string $locale 
     * @return string HTML code
     */
    public function getHtml( $url, $locale );

}
