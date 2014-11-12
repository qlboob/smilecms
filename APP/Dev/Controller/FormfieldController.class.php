<?php
namespace Dev\Controller;
use Dev\Controller\DevController;

class FormfieldController extends DevController{

	function add() {
		if (IS_GET) {
			parent::add();
		}else {
			D('Formfield')->addOrEditWithValidator(I('post.'));
			$this->success('成功');
		}
	}
	
	function edit(){
		if (IS_GET) {
			$data	=	$this->_getDao()->getAssignData(I('get.id'));
			$form	=	$this->getForm();
			$form->assign($_GET);
			$form->assign($data);
			$this->assign('form',(string)$form);
			$this->display('Default/add');
		}else {
			D('Formfield')->addOrEditWithValidator(I('post.'));
			$this->success('成功');
		}
	}
	
	function sort() {
		$fromM = D('Form');
		$fieldM	=	D('Formfield');
		$id = I('get.id');
		$formData = $fromM->find($id);
		
		if (IS_GET) {
			
		};
	}
}