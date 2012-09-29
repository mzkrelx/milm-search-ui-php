<?php
// module/Admin/conﬁg/module.config.php:
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

    'view_manager' => array (
        'template_path_stack' => array (
            'admin' => __DIR__ . '/../view' ,
        ),
    ),

);
