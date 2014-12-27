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
					if($extendM->create()){
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
}