<?php
namespace General\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MlController extends AbstractActionController
{
    /**
     * MLの一覧を表示するアクションです。
     */
    public function listAction()
    {
        var_dump('listAction');
    }

    /**
     * ML詳細を表示するアクションです。
     */
    public function showAction()
    {
        var_dump('showAction');
        $id = (int)$this->params()->fromRoute('id', 0);

        return array (
            'id' => $id ,
        );
    }
}
