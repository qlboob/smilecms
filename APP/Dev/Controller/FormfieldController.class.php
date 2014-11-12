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
		if (IS_GET) {
			$lists=$this->getFormField($id);
			usort($lists, function($a,$b){
				return $a['ffd_weight'] - $b['ffd_weight'];
			});
			$this->display(array('lists'=>$lists));
		}else {
			$maxLevel = 0;
			$sorted = I('param.sorted');
			$maxWeight = 50000;
			$ret = array();
			foreach ($sorted as $v){
				$maxLevel = max($v['level'],$maxLevel);
			}
			
			if (0==$maxLevel) {
				$intval = ceil($maxWeight/(count($sorted)+1));
				foreach ($sorted as $k => $v){
					$updateData = array(
						'ffd_id'=>$v['id'],
						'ffd_weight'=> $intval*($k+1),
					);
					$fieldM->save($updateData);
					$ret[] = $updateData;
				}
				echo json_encode($ret);
			}elseif (I('param.change')){
				#改父表单排序
				
			}else {
				;
			}
		}
	}
	
	private function getFormField($formId,$level=0) {
		$ret = array();
		$fromM = D('Form');
		$fieldM	=	D('Formfield');
		$formData = $fromM->find($formId);
		if ($formData['frm_parent']) {
			$parentIds = sexplode($formData['frm_parent']);
			foreach ($parentIds as $parentFormId){
				$parentFields = $this->getFormField($parentFormId,$level+1);
				$ret = array_merge($ret,$parentFields);
			}
		}
		$fieldList = $fieldM->where(array('frm_id'=>$formId,'ffd_type'=>array('not in',array('Hidden','PresentHidden'),'ffd_parent'=>0)))->select();
		if ($fieldList) {
			foreach ($fieldList as &$field){
				$field['level'] = $level;
			}
			$ret = array_merge($ret,$fieldList);
		}
		return $ret;
	}
}