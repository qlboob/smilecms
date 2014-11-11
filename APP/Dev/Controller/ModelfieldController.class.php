<?php
namespace Dev\Controller;
use Dev\Controller\DevController;

class ModelfieldController extends DevController{
	
	function add() {
		if (IS_GET) {
			parent::add();
		}else {
			//初始化变量
			$modelFieldM	=	D('Modelfield');
			$formFieldM		=	D('Formfield');
			$modelM			=	D('Model');
			$siteM			=	D('Site');
			$post			=	I('post.');
			$post['mdl_name']=	$post['ffd_name'];
			
			//增加表字段（更改数据库表结构）
// 			$table		=	$modelM->where(array('mdl_id'=>$post['mdl_id']))->getField('mdl_table');
			$modelData	=	$modelM->find($post['mdl_id']);
		}
	}
}