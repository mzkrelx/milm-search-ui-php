<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'General\Controller\Index'      => 'General\Controller\IndexController',
            'MlProposal' => 'General\Controller\MlProposalController',
            'Ml' => 'General\Controller\MlController',
        ),
    ),
    'router' => array(
        'routes' => array(

            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'General\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),

            'ml-proposal' => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/ml-proposal',
                    'constraints' => array(
                        'controller' => 'MlProposal',
                        'action'     => 'attention',
                    ),
                    'defaults' => array(
                        'controller' => 'MlProposal',
                        'action'     => 'attention',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'some-action' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'action' => 'attention',
                            ),
                        ),
                    ),
                ),
            ),

            'ml' => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/ml',
                    'constraints' => array(
                        'controller' => 'Ml',
                        'action'     => 'list',
                    ),
                    'defaults' => array(
                        'controller' => 'Ml',
                        'action'     => 'list',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'show-action' => array(
                        'type'    => 'Segment',
                        'options' => array (
                            'route' => '/show[/:id]' ,
                            'constraints' => array (
                                'id' => '[0-9]+' ,
                            ),
                            'defaults' => array (
                                'action' => 'show' ,
                            ),
                        ),
                    ),
                    'some-action' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'action' => 'list',
                            ),
                        ),
                    ),
                ),
            ),

        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'general/index/index'     => __DIR__ . '/../view/general/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
