<?php

namespace Ptadmin\Controller;

use Ptadmin\Controller\PtadminController;
class WxuserController extends PtadminController{
	function index() {
		$block = new \Com\Qinjq\Block\SAdminListBlock();
		$block->param('tableClass','table table-hover');
		$block->param('tables','wxuser,user');
		$block =  $block->getContent();
		$this->display(array_merge($_GET,array('table'=>$block)));
	}
	
}
