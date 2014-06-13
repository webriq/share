<?php

return array(
    
    'router' => array(
        'routes' => array(
            'Grid\Share\Paragraph' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/app/:locale/share',
                    'defaults' => array(
                        'controller' => 'Grid\Share\Controller\Paragraph',
                        'action'     => 'index',
                    ),
                ),
            ),
            'Grid\Share\Email' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/app/:locale/share/email',
                    'defaults' => array(
                        'controller' => 'Grid\Share\Controller\Email',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),  
    
    'controllers' => array(
        'invokables' => array(
            'Grid\Share\Controller\Paragraph' => 'Grid\Share\Controller\ParagraphController',
            'Grid\Share\Controller\Email'     => 'Grid\Share\Controller\EmailController',
        ),
    ),
    'factory' => array(
        'Grid\Paragraph\Model\Paragraph\StructureFactory' => array(
            'adapter' => array(
                'share' => 'Grid\Share\Model\Paragraph\Structure\Share',
            ),
        ),
        'Grid\Share\Model\Service\AdapterFactory' => array(
            'dependency' => array(
                'Grid\Share\Model\Service\AdapterDefault'
            ),
            'adapter'    => array(
                'email'       => 'Grid\Share\Model\Service\Email',
                'facebook'    => 'Grid\Share\Model\Service\Facebook',
                'facebookshare' => 'Grid\Share\Model\Service\FacebookShare',
                'googleplus'  => 'Grid\Share\Model\Service\Googleplus',
                'linkedin'    => 'Grid\Share\Model\Service\Linkedin',
                'pinterest'   => 'Grid\Share\Model\Service\Pinterest',
                'reddit'      => 'Grid\Share\Model\Service\Reddit',
                'stumbleupon' => 'Grid\Share\Model\Service\Stumbleupon',
                'tumblr'      => 'Grid\Share\Model\Service\Tumblr',
                'twitter'     => 'Grid\Share\Model\Service\Twitter',
            ),
        ),
        'Grid\Core\Model\Settings\StructureFactory' => array(
            'dependency'    => 'Grid\Core\Model\Settings\StructureAbstract',
            'adapter'       => array(
                'share-microcontent' => 'Grid\Share\Model\Settings\Structure\Microcontent',
            ),
        ),
    ),
    'form' => array(
        
        'Grid\Core\Settings\Share' => array(
            'type'          => 'Grid\Core\Form\Settings',
            'attributes'    => array(
                'data-js-type' => 'js.form.fieldsetTabs',
            ),
            'fieldsets' => array(
                'share-microcontent'   => array(
                    'spec'  => array(
                        'name'      => 'microcontent',
                        'options'   => array(
                            'label'         => 'share.form.settings.microcontent.legend',
                            'description'   => 'share.form.settings.microcontent.description',
                        ),
                        'elements'  => array(
                            'enable'    => array(
                                'spec'  => array(
                                    'type'  => 'Zork\Form\Element\Checkbox',
                                    'name'  => 'enable',
                                    'options'   => array(
                                        'label'       => 'share.form.settings.microcontent.share.enable',
                                        'description' => 'share.form.settings.microcontent.share.enable.description',
                                    ),
                                ),
                            ),
                            'articleButtons'    => array(
                                'spec'  => array(
                                    'type'  => 'Grid\Share\Form\Element\ShareCheckboxGroup',
                                    'name'  => 'articleButtons',
                                    'options'   => array(
                                        'label' => 'share.form.settings.microcontent.buttons.article',
                                        'value_options'   => array(
                                            'facebook'    => 'share.form.checkbox.facebookshare',
                                            'twitter'     => 'share.form.checkbox.twitter',
                                            'googleplus'  => 'share.form.checkbox.googleplus',
                                            'linkedin'    => 'share.form.checkbox.linkedin',                                      
                                        ),
                                    ),                                    
                                ),
                            ),
                            'imageButtons'    => array(
                                'spec'  => array(
                                    'type'  => 'Grid\Share\Form\Element\ShareCheckboxGroup',
                                    'name'  => 'imageButtons',
                                    'options'   => array(
                                        'label' => 'share.form.settings.microcontent.buttons.image',
                                        'value_options'   => array(
                                            'facebook'    => 'share.form.checkbox.facebookshare',
                                            'twitter'     => 'share.form.checkbox.twitter',
                                            'googleplus'  => 'share.form.checkbox.googleplus',
                                            'linkedin'    => 'share.form.checkbox.linkedin',
                                            'pinterest'   => 'share.form.checkbox.pinterest',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        
        'Grid\Share\Email' => array(
            'type'      => 'Grid\Share\Form\Email',
            'elements'  => array(
                'shareUrl' => array(
                    'spec' => array(
                        'type' => 'Zork\Form\Element\Hidden',
                        'name' => 'shareUrl',
                    )
                ),
                'senderEmail' => array(
                    'spec' => array(
                        'type'  => 'Zork\Form\Element\Email',
                        'name'  => 'senderEmail',
                        'options'   => array(
                            'label'     => 'share.form.email.senderemail',
                            'required'  => true,
                        ),
                    ),
                ),
                'senderName' => array(
                    'spec' => array(
                        'type'  => 'Zork\Form\Element\Text',
                        'name'  => 'senderName',
                        'options'   => array(
                            'label'     => 'share.form.email.sendername',
                            'required'  => false,
                        ),
                    ),
                ),
                'recipientEmail' => array(
                    'spec' => array(
                        'type'  => 'Zork\Form\Element\Email',
                        'name'  => 'recipientEmail',
                        'options'   => array(
                            'label'     => 'share.form.email.recipientemail',
                            'required'  => true,
                        ),
                    ),
                ),
                'recipientName' => array(
                    'spec' => array(
                        'type'  => 'Zork\Form\Element\Text',
                        'name'  => 'recipientName',
                        'options'   => array(
                            'label'     => 'share.form.email.recipientname',
                            'required'  => false,
                        ),
                    ),
                ),
                'message' => array(
                    'spec' => array(
                        'type'  => 'Zork\Form\Element\Textarea',
                        'name'  => 'message',
                        'options'   => array(
                            'label'     => 'share.form.email.message',
                            'required'  => false,
                        ),
                    ),
                ),
                'captcha' => array(
                    'spec' => array(
                        'type'  => 'Zork\Form\Element\Captcha',
                        'name'  => 'captcha',
                        'options'   => array(
                            'label'     => 'share.form.email.captcha',
                            'required'  => true,
                        ),
                    ),
                ),
                'send' => array(
                    'spec' => array(
                        'type'  => 'Zork\Form\Element\Submit',
                        'name'  => 'send',
                        'attributes'    => array(
                            'value'     => 'share.form.email.submit',
                        ),
                    ),
                ),
                'cancel' => array(
                    'spec' => array(
                        'type' => 'Zork\Form\Element\Submit',
                        'name' => 'cancel',
                        'attributes' => array(
                            'value' => 'share.form.email.close'
                        ),
                    )
                )
            ),
        ),
        'Grid\Paragraph\CreateWizard\Start' => array(
            'elements'  => array(
                'type'  => array(
                    'spec'  => array(
                        'options'   => array(
                            'options'   => array(
                                'social'    => array(
                                    'options'   => array(
                                        'share' => 'paragraph.type.share',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'Grid\Paragraph\Meta\Edit' => array(
            'fieldsets' => array(
                
                'share' => array(
                    'spec' => array(
                        'name'      => 'share',
                        'options'   => array(
                            'label'     => 'paragraph.type.share',
                            'required'  => false,
                        ),
                        'elements'  => array(
                            'sorted' => array(
                                'spec'  => array(
                                    'type'      => 'Grid\Share\Form\Element\ShareCheckboxGroup',
                                    'name'      => 'sorted',
                                    'options'   => array(
                                        'text_domain'=> 'share',
                                        'label'      => 'paragraph.form.share.services',
                                        'value_options'   => array(
                                            'facebook'    => 'share.form.checkbox.facebook',
                                            'facebookshare' => 'share.form.checkbox.facebookshare',
                                            'googleplus'  => 'share.form.checkbox.googleplus',
                                            'twitter'     => 'share.form.checkbox.twitter',
                                            'pinterest'   => 'share.form.checkbox.pinterest',
                                            'linkedin'    => 'share.form.checkbox.linkedin',
                                            'tumblr'      => 'share.form.checkbox.tumblr',
                                            'stumbleupon' => 'share.form.checkbox.stumbleupon',
                                            'reddit'      => 'share.form.checkbox.reddit',
                                            'email'       => 'share.form.checkbox.email',
                                        ),
                                    ),
                                ),

                            ),
                        ),
                    ),
                ),

                'image' => array(
                    'spec' => array(
                        'elements'  => array(
                            'microcontentShare'  => array(
                                'spec'  => array(
                                    'type'      => 'Zork\Form\Element\Select',
                                    'name'      => 'microcontentShare',
                                    'options'   => array(
                                        'label'     => 'share.microcontent.enable.share.image',
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
                
            ),
        ),
        
    ),

    'translator' => array(
        'translation_file_patterns' => array(
            'share' => array(
                'type'          => 'phpArray',
                'base_dir'      => __DIR__ . '/../languages/share',
                'pattern'       => '%s.php',
                'text_domain'   => 'share',
            ),
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'shareButtons'           => 'Grid\Share\View\Helper\ShareButtons',
            'shareButtonEmail'       => 'Grid\Share\View\Helper\Button\Email',
            'shareButtonFacebook'    => 'Grid\Share\View\Helper\Button\Facebook',
            'shareButtonFacebookShare' => 'Grid\Share\View\Helper\Button\FacebookShare',
            'shareButtonGoogleplus'  => 'Grid\Share\View\Helper\Button\Googleplus',
            'shareButtonLinkedin'    => 'Grid\Share\View\Helper\Button\Linkedin',
            'shareButtonPinterest'   => 'Grid\Share\View\Helper\Button\Pinterest',
            'shareButtonReddit'      => 'Grid\Share\View\Helper\Button\Reddit',
            'shareButtonStumbleupon' => 'Grid\Share\View\Helper\Button\Stumbleupon',
            'shareButtonTumblr'      => 'Grid\Share\View\Helper\Button\Tumblr',
            'shareButtonTwitter'     => 'Grid\Share\View\Helper\Button\Twitter',
            'formShareCheckboxGroup' => 'Grid\Share\Form\View\Helper\FormShareCheckboxGroup',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'grid/paragraph/render/share' => __DIR__ . '/../view/grid/paragraph/render/share.phtml',
            'grid/share/paragraph/index'  => __DIR__ . '/../view/grid/paragraph/render/share.phtml',
            'grid/share/email/index'      => __DIR__ . '/../view/grid/share/email/index.phtml',
            'grid/share/email/message'    => __DIR__ . '/../view/grid/share/email/message.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'head_defaults' => array(
            'headScript' => array(
                'shareJs' => array(
                    'src'       => '/scripts/zork/share.js',
                    'type'      => 'text/javascript',
                ),
            ),
        ),
    ),
    'modules'   => array(
        'Grid\Share'  => array(
            'pinterest' => array(
                'width'  => array( 'min' => '100'),
                'height' => array( 'min' => '100'),
                'scale'  => array( 'max' => '5' ),
            ),
            'facebook' => array(
                'languages' => include __DIR__ . '/facbook-languages.php'
            ),
        ),
        'Grid\Paragraph' => array(
            'customizeMapForms' => array(
                'share' => array(
                    'element' => 'general',
                ),
            ),
        ),
        'Grid\Core'  => array(
            
            'settings' => array(
                'share' => array(
                    'textDomain'    => 'share',
                    'fieldsets'     => array(
                        'microcontent'       => 'share-microcontent',
                    ),
                ),
                'share-microcontent' => array(
                    'textDomain'    => 'share',
                    'elements'      => array(
                        'enable'    => array(
                            'key'   => 'modules.Grid\Share.settings.microcontent.enable',
                            'type'  => 'ini',
                        ),
                        'articleButtons'    => array(
                            'key'   => 'modules.Grid\Share.settings.microcontent.articleButtons',
                            'type'  => 'ini',
                        ),
                        'imageButtons'    => array(
                            'key'   => 'modules.Grid\Share.settings.microcontent.imageButtons',
                            'type'  => 'ini',
                        ),
                    ),
                ),
            ),
            
            'navigation'    => array(
               'settings'  => array(
                    'pages' => array(
                        'service'   => array(
                            'label'         => 'admin.navTop.service',
                            'textDomain'    => 'admin',
                            'order'         => 7,
                            'uri'           => '#',
                            'parentOnly'    => true,
                            'pages'         => array(
                                'share'    => array(
                                    'label'         => 'admin.navTop.settings.share',
                                    'textDomain'    => 'admin',
                                    'order'         => 1,
                                    'route'         => 'Grid\Core\Settings\Index',
                                    'resource'      => 'settings.share',
                                    'privilege'     => 'edit',
                                    'params'        => array(
                                        'section'   => 'share',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        
    ),
);
