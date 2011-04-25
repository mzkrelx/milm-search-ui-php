<?php
define('SEARCH_SEAVER_PATH', 'http://localhost:8080/milm-search/rest/mails');
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

class SystemUtil
{
    /**
     * アプリケーションの初期処理
     */
    static function init() {
        set_include_path(implode(PATH_SEPARATOR, array(
            realpath(realpath(dirname(__FILE__)) . '/../application'),
            realpath(realpath(dirname(__FILE__)) . '/../application/models'),
            realpath(realpath(dirname(__FILE__)) . '/../library'),
            get_include_path(),
        )));

        require_once '../library/Zend/Loader/Autoloader.php';
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->setFallbackAutoloader(true);
    }
}
