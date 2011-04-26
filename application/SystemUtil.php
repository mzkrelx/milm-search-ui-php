<?php
require_once '../library/Zend/Debug.php';
/**
 * デバッグ用関数
 *
 * @param mixed $var デバッグしたい変数
 * @param string $label デバッグ表示の際のラベル
 */
function d($var, $label = null) {
    Zend_Debug::dump($var, $label);
}

/**
 * アプリケーションの初期処理
 */
function init() {
    set_include_path(implode(PATH_SEPARATOR, array(
        realpath(realpath(dirname(__FILE__)) . '/../application'),
        realpath(realpath(dirname(__FILE__)) . '/../library'),
        get_include_path(),
    )));

    require_once '../library/Zend/Loader/Autoloader.php';
    $autoloader = Zend_Loader_Autoloader::getInstance();
    $autoloader->setFallbackAutoloader(true);

    $config = new Zend_Config_Ini(realpath(dirname(__FILE__)) . '/../config/system.ini', 'production');
    define('SERVER_URL', $config->server->url);
    define('SYSTEM_TITLE', $config->system->title);
}
