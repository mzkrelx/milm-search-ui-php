<?php
namespace General\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MlProposalController extends AbstractActionController
{
    public function attentionAction()
    {
    }

    public function addAction()
    {
//         $form = new MlProposalForm();
//         $form->get('submit')->setValue('確認');

//         $request = $this->getRequest();
//         if ($request->isPost()) {
//             $mlProposal = new MlProposal();
//             $form->setInputFilter($mlProposal->getInputFilter());
//             $form->setData($request->getPost());

//             if($form->isValid()){
//                 $mlProposal->exchangeArray($form->getData());
//                 // Core に アクセスして登録処理

//                 return $this->redirect()->toRoute('ml-proposal/added');
//             }
//         }
//         return array('form' => $form);
    }

    public function confirmAction()
    {

    }
}
