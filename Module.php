<?php

namespace Grid\Share;

use Zork\Stdlib\ModuleAbstract;
use Zend\ModuleManager\ModuleManager;

/**
 * Grid\Share\Module
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Module extends ModuleAbstract
{
    /**
     * Module base-dir
     *
     * @const string
     */
    const BASE_DIR = __DIR__;

    /**
     *
     * @var \Zend\ModuleManager\ModuleManager $moduleManager
     */
    protected $moduleManager;
    
    /**
     * 
     * @param \Zend\ModuleManager\ModuleManager $moduleManager
     */
    public function init(ModuleManager $moduleManager)
    {
        $this->moduleManager = $moduleManager;
    }

    /**
     * 
     * @return array
     */
    public function getConfig()
    {
        return $this->extendConfig(parent::getConfig());  
    }
    
    /**
     * Is module loaded
     *
     * @param   string  $module
     * @return  bool
     */
    protected function isModuleLoaded( $module )
    {
        return in_array( $module, $this->moduleManager->getModules() );
    }
    
    /**
     * 
     * @param array $config
     * @return array
     */
    protected function extendConfig($config)
    {
        if( $this->isModuleLoaded('Grid\ContentList') )
        {
            $config['form']['Grid\Paragraph\Meta\Edit']['fieldsets'] = array_merge(
                    $config['form']['Grid\Paragraph\Meta\Edit']['fieldsets'],
                    $this->getParagraphEditFormExtend('contentList')
            );
        }
        return $config;
    }
    
    /**
     * 
     * @param string $fieldsetId
     * @return array
     */
    protected function getParagraphEditFormExtend($fieldsetId)
    {
        return array( 
            $fieldsetId => array(
                'spec' => array(
                    'elements'  => array(
                        'microcontentShare'  => array(
                            'spec'  => array(
                                'type'      => 'Zork\Form\Element\Select',
                                'name'      => 'microcontentShare',
                                'options'   => array(
                                    'label'     => 'share.microcontent.enable.share.'.$fieldsetId,
                                    'required'  => false,
                                    'value_options'   => array(
                                        ''        => 'share.microcontent.enable.share.useglobal',
                                        'enable'  => 'share.microcontent.enable.share.enable',
                                        'disable' => 'share.microcontent.enable.share.disable',
                                    ),
                                ),
                            ),
                            'flags' => array(
                                'priority' => -1000,
                            ),
                        ),
                    ),
                ),
            ),
        );
    }
    
}
