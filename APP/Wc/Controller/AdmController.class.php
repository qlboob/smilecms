<?php
namespace Wc\Controller;
use Think\Controller;
use Think\Log;
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
	function t() {
		$wxPay = new \Com\Qinjq\Wechat\SPay(array(
			'paykey'=>'e182ebbc166d73366e7986813a7fc5f2',
		));
		$jsParam = array(
			'appId'=>'wx98e78d22de880f6a',
			'timeStamp'=>'1428539333',
			'nonceStr'=>'3n1lr6wsx1yf5vvs196toa5115n3ow7e',
			'package'=>"prepay_id=wx2015040908285381bf081bcd0318484564",
			'signType'=>'MD5',
		);
		echo $wxPay->sign($jsParam);
	}
	function t2() {
		$wxPay = new \Com\Qinjq\Wechat\SPay(array(
			'paykey'=>C('wxpay.paykey'),
		));
		$jsParam = array (
  'appId' => 'wxa0728c2c4ceffcc6',
  'nonceStr' => 'o4o2pr2f4kwvgjot0905uh10r04q35cl',
  'package' => 'prepay_id=wx201504122209031b93bd9b1d0679631040',
  'signType' => 'MD5',
  'timeStamp' => '1428847743',
);
		var_dump($jsParam);
		echo $wxPay->sign($jsParam);
	}
	
	function t3() {
		$x = D('Wcadmin/Order');
		dump($x);
	}
	function log() {
		Log::record('hello');
	}
}
