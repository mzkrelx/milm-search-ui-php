<?php
// module/Admin/conﬁg/module.config.php:
 return array (
     'controllers' => array (
         'invokables' => array (
             'Admin\Controller\Index' => 'Admin\Controller\IndexController' ,
         ),
     ),

     'router' => array (
         'routes' => array (
             'admin' => array (
                 'type' => 'segment' ,
                 'options' => array (
                     'route' => '/admin[/:action][/:id]' ,
                     'constraints' => array (
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*' ,
                         'id' => '[0-9]+' ,
                     ),
                     'defaults' => array (
                         'controller' => 'Admin\Controller\Index' ,
                         'action' => 'index' ,
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

     'home' => array (
         'type' => 'Zend\Mvc\Router\Http\Literal' ,
         'options' => array (
             'route' => '/' ,
             'defaults' => array (
                 'controller' => 'Admin\Controller\Index' ,    // Admin\Controller\AdminController ではない
                 'action' => 'index' ,
             ),
         ),
     ),
);
