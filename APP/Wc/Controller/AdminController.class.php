<?php
namespace Wc\Controller;
use Think\Controller;
class AdmController extends Controller {

	function name() {
		$wx = new \Com\Qinjq\Wechat\SWechat(C('wx'));
		if (isset($_GET['code'])) {
			$info = $wx->getOauthAccessToken();
			if (!$info) {
				return;
			}
			$openid = $info['openid'];
			$userInfo = $wx->getUserInfo($openid);
			if (!$userInfo) {
				return ;
			}
			$wxuserM = D('Wxuser');
			$userM = D('User');
			$uid = $wxuserM->openid2uid($openid);
			if (!$userM->find($uid)) {
				#没有增加用户，先增加用户
				$userM->add(array(
					'usr_id'=>$uid,
					'usr_nick'=>$userInfo['nickname'],
				));
			}
			$wxUserInfo = $wxuserM->find($openid);
			$wxUserInfo['wx_nick'] = $userInfo['nickname'];
			$wxuserM->save($wxUserInfo);
			$this->success('增加信息成功');
		}else {
			$jumpUrl = $wx->getOauthRedirect('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'','snsapi_userinfo');
			header("Location: $jumpUrl");
			exit();;
		}
	}
	
}
