<?php
namespace Pt\Controller;
use Think\Controller;

class WcpageController extends Controller {
	
	protected $cookie;
	
	protected $wc;
	
	function _initialize() {
		$this->cookie=$cookie = new \Com\Qinjq\Wechat\SCookie();
		$openId = $cookie->getOpenId();
// 		return ;
		$this->wc = $wx = new \Com\Qinjq\Wechat\SWechat(C('wc'));
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
		if (!empty($_SESSION['usr_state'])) {
			$userInfo = D('User')->find($cookie->getUid());
			if ($userInfo) {
				$_SESSION['usr_state'] = $userInfo['usr_state'];
				$_SESSION['usr_pay'] = $userInfo['usr_pay'];
				$_SESSION['ugp_id'] = $userInfo['ugp_id'];
			}
		}
	}
	
	protected function setJsSign() {
		$sign = $this->wx->getJsSign('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    	$this->assign('sign',$sign);;
	}
	
	protected function _keyFilter($data,$keys) {
		$ret = array();
		foreach ($keys as $k){
			if (isset($data[$k])) {
				$ret[$k] = $data[$k];
			}
		}
		return $ret;
	}
}