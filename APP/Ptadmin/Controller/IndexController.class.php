<?php

namespace Ptadmin\Controller;

use Think\Controller;
class IndexController extends Controller{
	function index() {
		$this->redirect(MODULE_NAME.'/Customer/index');
	}
	
	function test() {
		echo D('User')->encrypt(i('get.str'));
	}
}
