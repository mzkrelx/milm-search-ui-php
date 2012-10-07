<?php
return array (
    'controllers' => array (
        'invokables' => array (
            'Admin\Controller\Index' => 'Admin\Controller\IndexController' ,
            'Ml' => 'Admin\Controller\MlController' ,
        ),
    ),

    'router' => array (
        'routes' => array (

            'admin-ml' => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/admin/ml',
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
                    'has-id-action' => array(
                        'type'    => 'Segment',
                        'options' => array (
                            'route' => '[/:action][/:id]' ,
                            'constraints' => array (
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+' ,
                            ),
                            'defaults' => array (
                                'action' => 'show',
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

    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'admin/index/index'       => __DIR__ . '/../view/admin/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array (
            'admin' => __DIR__ . '/../view' ,
        ),
    ),

);
