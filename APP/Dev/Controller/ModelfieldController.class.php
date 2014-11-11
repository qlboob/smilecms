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
			
		}
	}
}