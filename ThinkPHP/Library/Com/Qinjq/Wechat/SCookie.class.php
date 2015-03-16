<?php

namespace Com\Qinjq\Wechat;

class SCookie {
	private $uid='';
	private $openId;
	
	function __construct() {
		if (isset($_COOKIE['s']) and $this->sign($_COOKIE['uid'], $_COOKIE['openid'])==$_COOKIE['s']) {
			$this->uid = $_COOKIE['uid'];
			$this->openId = $_COOKIE['openid'];
		}
	}
	
	
	private function sign($uid,$openId) {
		return md5(md5($uid).'_ss_'.md5($openId));
	}
	
	function write($openId=NULL,$uid=NULL) {
		if (NULL===$uid) {
			$uid = $this->uid;
		}
		if (NULL===$openId) {
			$openId = $this->openId;
		}
		$expired = time()+7*24*3600;
		$w = array(
			'uid'=>$uid,
			'openid'=>$openId,
			's'=>$this->sign($uid, $openId),
		);
		foreach ($w as $k => $v) {
			setcookie($k,$v,$expired,'/');
		}
	}
	
	
	function getUid() {
		return $this->uid;
	}
	
	function getOpenId() {
		return $this->openId;
	}
	
	function setUid($uid) {
		$this->uid = $uid;
	}
	
	function setOpenId($openId) {
		$this->openId = $openId;
	}
}