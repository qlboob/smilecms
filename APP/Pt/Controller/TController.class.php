<?php
namespace Pt\Controller;
use Think\Controller;
class TController extends Controller {
	
	function cookie() {
		$cookie=$cookie = new \Com\Qinjq\Wechat\SCookie();;
		if ($_GET['openid']) {
			$cookie->setOpenId($_GET['openid']);
		}
		if ($_GET['uid']) {
			$cookie->setUid($_GET['uid']);
		}
		$cookie->write();
	}
	
	function session() {
		foreach ($_GET['session'] as $k =>$v){
			$_SESSION[$k]=$v;;
		}
		var_dump($_SESSION);
	}
	function x() {
		var_dump(get_defined_constants());
	}
}