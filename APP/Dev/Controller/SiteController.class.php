<?php
namespace Dev\Controller;
use Dev\Controller\DevController;
class SiteController extends DevController{
	
	function switchcookie() {
		setcookie('_sit_id',$_GET['id'],time()+999*260,'/');
		$this->success('切换成功');
	}
}
