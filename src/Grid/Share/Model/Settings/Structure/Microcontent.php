<?php

namespace Grid\Share\Model\Settings\Structure;


use Grid\Core\Model\Settings\StructureAbstract;

/**
 * Microcontent
 *
 * @author Kristof Matos <kristof.matos@megaweb.hu>
 */
class Microcontent extends StructureAbstract
{
    /**
     * @const string
     */
    const ACCEPTS_SECTION   = 'share-microcontent';

    /**
     * Field: section
     *
     * @var int
     */
    protected $section      = self::ACCEPTS_SECTION;

    /**
     * default values
     * 
     * @var array 
     */
    protected $settings = array(
        'enable'         => true,
        'articleButtons' => array('facebook','twitter','googleplus','linkedin'),
        'imageButtons'   => array('facebook','twitter','googleplus','linkedin','pinterest'),
    );
    
}
