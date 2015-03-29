<?php
namespace Wc\Controller;
use Think\Controller;
use Think\Log;

class WcpageController extends Controller {
	
	protected $cookie;
	
	protected $wc;
	
	protected $authUserInfoType='snsapi_base';
	function _initialize() {
		$this->cookie=$cookie = new \Com\Qinjq\Wechat\SCookie();
		//TODO 删除
// 		return;
		$openId = $cookie->getOpenId();
// 		return ;
		$this->wc = $wx = new \Com\Qinjq\Wechat\SWechat(C('wx'));
		if (isset($_GET['code'])) {
			$info = $wx->getOauthAccessToken();
			$openId = $info['openid'];
			$cookie->setOpenId($openId);
			$uid = D('Wxuser')->openid2uid($openId);
			$cookie->setUid($uid);
			$cookie->write();
		}
		if (!$openId) {
			$jumpUrl = $wx->getOauthRedirect('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'',$this->authUserInfoType);
// 			var_dump($jumpUrl);
// 			exit('|');
// 			Log::record('jumpurl :'.$jumpUrl,"ERR",true);
			header("Location: $jumpUrl");
			exit();
		}
	}
	
	protected function setJsSign() {
		$sign = $this->wc->getJsSign('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
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