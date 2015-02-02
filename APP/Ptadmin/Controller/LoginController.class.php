<?php
namespace Ptadmin\Controller;
use Think\Controller;

class LoginController extends Controller{

	function index() {
		if (IS_GET) {
			$this->display();
		}else {
			$result = D('User')->login(i('post.name'),i('post.password'));
			if ($result and 1==$result['ugp_id']) {
				$_SESSION['uid'] = $result['usr_id'];
				$this->redirect(MODULE_NAME.'/Index/index');
			}else {
				$this->display();
			}
		}
	}
}
