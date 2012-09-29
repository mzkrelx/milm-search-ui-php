<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MlController extends AbstractActionController
{
    /**
     * 管理用のMLの一覧を表示するアクションです。
     */
    public function listAction()
    {
        var_dump('admin-listAction');
    }

    /**
     * 管理用のML詳細を表示するアクションです。
     */
    public function showAction()
    {
        var_dump('admin-showAction');
        $id = (int)$this->params()->fromRoute('id', 0);

        return array (
            'id' => $id ,
        );
    }

    /**
     * 管理用のML編集画面を表示、または編集処理をするアクションです。
     */
    public function editAction()
    {
        var_dump('admin-editAction');
        $id = (int)$this->params()->fromRoute('id', 0);

        return array (
            'id' => $id ,
        );
    }
}
