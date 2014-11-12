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
	
	private function getFormField($formId,$level=0) {
		$ret = array();
		$fromM = D('Form');
		$fieldM	=	D('Formfield');
		$formData = $fromM->find($formId);
		if ($formData['frm_parent']) {
			$parentIds = sexplode($formData['frm_parent']);
			foreach ($parentIds as $parentFormId){
				
			}
		}
		$fieldList = $fieldM->where(array('frm_id'=>$formId))->select();
		if ($fieldList) {
			foreach ($fieldList as &$field){
				$field['level'] = $level;
			}
			$ret = array_merge($ret,$fieldList);
		}
		return $ret;
	}
}