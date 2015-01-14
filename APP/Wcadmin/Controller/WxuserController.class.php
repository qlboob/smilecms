<?php

namespace Wcadmin\Controller;

use Wcadmin\Controller\DevController;
class WxuserController extends DevController{
	function index() {
		$block = new \Com\Qinjq\Block\SAdminListBlock();
		$block->param('tableClass','table table-hover');
		$block->param('tables','wxuser,user');
		$block =  $block->getContent();
		$this->display(array_merge($_GET,array('table'=>$block)));
	}
	
}
