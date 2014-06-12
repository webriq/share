<?php

namespace Grid\Share\Model\Microcontent;

use Zork\Rpc\CallableTrait;
use Zork\Rpc\CallableInterface;
use Grid\Core\Model\Settings\Model As SettingsModel;

/**
 * Rpc
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Rpc implements CallableInterface
{
    
    use CallableTrait;
    
    /**
     *
     * @var \Grid\Core\Model\Settings\Model
     */
    protected $settingsModel;

    /**
     * 
     * @param \Grid\Core\Model\Settings\Model $settingsModel
     */
    public function __construct(SettingsModel $settingsModel )
    {
        $this->settingsModel = $settingsModel;
    }
    
    /**
     * Gets microcontent share settings
     * 
     * @return array
     */
    public function getSettings()
    {
        $structure = $this->getSettingsModel()->find('share-microcontent');
        return $structure->settings;
    }
    
    /**
     * 
     * @return \Grid\Core\Model\Settings\Model
     */
    protected function getSettingsModel() 
    {
        return $this->settingsModel;
    }


    
}
