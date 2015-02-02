<?php

namespace Wcadmin\Controller;

use Wcadmin\Controller\DevController;
class TodolistController extends DevController{
	function index() {
		$block = new \Com\Qinjq\Block\SAdminListBlock();
		$block->param('tableClass','table table-hover');
		$block->param('tables','todolist,car');
		$block =  $block->getContent();
		$this->display(array_merge($_GET,array('table'=>$block)));
	}
	
	function edit() {
		$todoM = D('Todolist');
		$carM = D('Car');
		$info = $todoM->alias('T')->join($carM->getTableName()." AS C ON T.car_id=C.car_id")->where(array('T.tdl_id'=>$_GET['id']))->find();
		if ($info['apm_id']>0) {
			$info = array_merge($info,D('Appointment')->find($info['apm_id']));
		}
		$this->display($info);
	}
}
