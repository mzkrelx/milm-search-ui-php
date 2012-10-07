<?php
namespace Admin;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        $config = include __DIR__ . '/config/module.config.php';
        $requestUri = $_SERVER["REQUEST_URI"];

        // enabling module layouts by uri
        if (strpos($requestUri, strtolower(__NAMESPACE__)) !== 1) {
            unset($config['view_manager']);
        }
        return $config;
    }

}