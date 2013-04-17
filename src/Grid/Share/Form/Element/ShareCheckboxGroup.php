<?php

namespace Grid\Share\Form\Element;

use Zork\Form\Element\MultiCheckboxGroup;

/**
 * MultiCheckboxGroup element
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class ShareCheckboxGroup extends MultiCheckboxGroup
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type'          => 'Grid\Share\Form\ShareCheckboxGroup',
        'data-js-type'  => 'js.share.sortableCheckboxGroup',
        'class'         => 'share-form-checkboxes',
    );

    /**
     * Sets checkboxes order by selection
     * @param mixed $value
     */
    public function setValue($value) 
    {
        if( is_array($value) )
        {
            $defaultOptionsList = $this->getValueOptions();
            $sortedOptionsList  = array();
            
            foreach( $value as $optionKey )
            {
                if( key_exists($optionKey, $defaultOptionsList) )
                {
                    $sortedOptionsList[ $optionKey ] = $defaultOptionsList[ $optionKey ];
                    unset($defaultOptionsList[$optionKey]);
                }
            }
            $sortedOptionsList = array_merge($sortedOptionsList,$defaultOptionsList);
            
            $this->setValueOptions($sortedOptionsList);
        }
        
        parent::setValue($value);
    }
}
