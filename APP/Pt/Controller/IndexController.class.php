<?php
namespace Pt\Controller;
use Think\Controller;
class IndexController extends Controller {
	
	function _initialize() {
		$cookie = new \Com\Qinjq\Wechat\SCookie();
		$openId = $cookie->getOpenId();
		$wx = new \Com\Qinjq\Wechat\SWechat(C('wx'));
		if (isset($_GET['code'])) {
			$info = $wx->getOauthAccessToken();
			$openId = $info['openid'];
			$cookie->setOpenId($openId);
			$uid = D('Wxuser')->openid2uid($openId);
			$cookie->setUid($uid);
			$cookie->write();
		}
		if (!$openId) {
			$jumpUrl = $wx->getOauthRedirect('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'','snsapi_base');
			header("Location: $jumpUrl");
			exit();
		}
	}
	
    public function index(){
    	
    }
}