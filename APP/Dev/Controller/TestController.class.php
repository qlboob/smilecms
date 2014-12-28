<?php
namespace Dev\Controller;
use Dev\Controller\DevController;
use Com\Qinjq\Form\Dataflow\SDataflow;
use Think\Hook;
class TestController extends DevController{
	
	function add(){
		if(IS_GET){
			$form	=	$this->getForm();
			$form->assign($_GET);
			$eventParam	=	array('form'=>$form);
			$this->_aop('beforeDisplay',$eventParam);
			$this->assign('form',(string)$form);
			$this->display('Default/add');
		}else{
			$data = I('post.');
			$dataFlow = new SDataflow();
			$formId	=	$this->getFormId();
			$config = require COMMON_PATH."Form/Dataflowconfig/{$formId}.php";
			$dataFlow->config($config);
			$data = $dataFlow->run($data);
			if (FALSE===$data) {
				$this->error($dataFlow->config('error'));
			}
			$table		=	$this->getTable();
			$firstTable	=	array_shift($table);
			$firstM	=	$this->_getDao($firstTable);
			if($firstM->create($data)){
				$insertId	=	$firstM->add();
				foreach ($table as $tab) {
					$extendM = $this->_getDao($tab);
					if($extendM->create($data)){
						$field	=	$firstM->getDbFields();
						$pk		=	$field['_pk'];
						$extendM->$pk	=	$insertId;
						$extendM->add();
					}
				}
				$eventParam = (object)array('id'=>$insertId,'model'=>isset($extendM)?$extendM:$firstM);
				Hook::listen('after_insert', $eventParam);
				$this->_aop('afterInsert',$eventParam);
			}
			$this->_aop('ok',$this->succssMsg);
		}
	}
	
	function edit() {
		if (IS_GET) {
			$table	=	$this->getTable();
			$firstM	=	$this->_getDao(array_shift($table));
			$firstM->alias('M');
			$pk		=	$firstM->getPk();
			foreach ($table as $tab) {
				$tabName	=	D($tab)->getTableName();
				$firstM->join("INNER JOIN $tabName ON M.$pk=$tabName.$pk");
			}
			$editpk = empty($_REQUEST['id'])?$_REQUEST[$pk]:$_REQUEST['id'];
			$where	=	array("M.$pk"=>$editpk);
			$data	=	$firstM->where($where)->find();
			$eventParam = array('data'=>&$data);
			$this->_aop('afterFindData',$eventParam);
	
			$form	=	$this->getForm();
			$eventParam=	(object)array('data'=>&$data,'form'=>$form,'id'=>$editpk,'model'=>isset($tabName)?D($tab):$firstM);
			Hook::listen('before_edit_display', $eventParam);
			$this->_aop('beforeDispaly',$eventParam);
			$form->assign($_GET);
			$form->assign($data);
			$this->assign('form',(string)$form);
			$this->display('Default/add');
		}else {
			$data = I('post.');
			$dataFlow = new SDataflow();
			$formId	=	$this->getFormId();
			$config = require COMMON_PATH."Form/Dataflowconfig/{$formId}.php";
			$dataFlow->config($config);
			$data = $dataFlow->run($data);
			if (FALSE===$data) {
				$this->error($dataFlow->config('error'));
			}
			$table		=	$this->getTable();
			foreach ($table as $tab) {
				$model	=	$this->_getDao($tab);
				$model->create($data);
				$model->save();
			}
			$eventParam	=	(object)array('model'=>$model,'id'=>$_REQUEST[$model->getPk()]);
			Hook::listen('after_edit_update', $eventParam);
			$this->_aop('afterUpdate',$eventParam);
			$this->_aop('ok',$this->succssMsg);
		}
	}
}