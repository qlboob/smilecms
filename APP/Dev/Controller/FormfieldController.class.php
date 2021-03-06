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
			
			$level=I('param.change')?$maxLevel:0 ;
			$intval = ceil($maxWeight/(count($sorted)+1));
			$this->sortLevel(0, $maxWeight, $sorted, $ret, $level);
			foreach ($ret as $v){
				if (isset($v['newWeight'])) {
					$updateData = array(
						'ffd_id'=>$v['id'],
						'ffd_weight'=> $v['newWeight'],
					);
					$fieldM->save($updateData);
				}
			}
			echo json_encode($ret);
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
	
	/**
	 * @param integer $minWeight 可以使用最小的排序值
	 * @param integer $maxWeight 可以使用排序的最大值
	 * @param array $sorted
	 * @param array $ret
	 * @param integer $level
	 */
	private function sortLevel($minWeight,$maxWeight,&$sorted,&$ret,$level) {
		$toSort = array();
		foreach ($sorted as &$v){
			if ($level==$v['level']){
				if (isset($v['newWeight'])) {
					#已经设置了排序值，不用再参与排序
					continue;
				}
				#只有当前层级参才与排序
				$toSort[] = &$v;
			}elseif ($level < $v['level']){
				#发现有比当前排序层级更高的
				if ($toSort) {
					#把已经找到当前层级元素，均匀排序
					$intval = ceil(($v['weight']-$minWeight)/(count($toSort)+1));
					foreach ($toSort as $i => &$item){
						$newWeight = $minWeight + ($i+1)*$intval;
						$item['newWeight']=$item['weight'] = $newWeight;
						$ret[$item['id']] = $item;
					}
					#剩余元素继续排序
					$this->sortLevel($v['weight'], $newWeight, $sorted, $ret,$level);
					return ;
				}else {
					#改变最小的排序值，因为后面的排序值不能比这个值小
					$minWeight = $v['weight'];
				}
			}
		}
		if ($toSort) {
			$intval = ceil(($maxWeight-$minWeight)/(count($toSort)+1));
			foreach ($toSort as $i => &$item){
				$newWeight = $minWeight + ($i+1)*$intval;
				$item['newWeight']=$item['weight'] = $newWeight;
				$ret[$item['id']] = $item;
			}
		}
		if ($level>0) {
			#下一层级排序
			$this->sortLevel($minWeight, $maxWeight, $sorted, $ret, $level-1);
		}
	}
}
