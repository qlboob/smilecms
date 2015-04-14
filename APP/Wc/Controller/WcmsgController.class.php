<?php
namespace Wc\Controller;
use Think\Controller;
use Wechat;
class WcmsgController extends Controller {
	
	

	function index() {
		$wx = new \Com\Qinjq\Wechat\SWechat(C('wx'));
		$wx->valid();
		$type = $wx->getRev()->getRevType();
		$openId = $wx->getRevFrom();
		$uid = D('Wxuser')->openid2uid($openId);
		$userInfo = D('User')->find($uid);
		switch($type) {
			case Wechat::MSGTYPE_TEXT:
				$content = $wx->getRevContent();
				switch ($content){
					case '?':
					case '？':
						if ($userInfo) {
							if (2==$userInfo['ugp_id']) {
								$toPayUrl = 'http://'.$_SERVER['HTTP_HOST'].U('Wc/Worker/topaylist');
								$avater = 'http://'.$_SERVER['HTTP_HOST'].U('Wc/Adm/name');
								$text = <<<EOF
<a href="$toPayUrl">线下收款</a>
<a href="$avater">更新头像</a>	
EOF;
								$wx->text(trim($text))->reply();
							};
						}
						break;
					default:
						$url = U(MODULE_NAME.'/Index/index');
						$text = '5月5日正式开业，敬请期待';
						$wx->text(trim($text))->reply();
						break;
				}
				break;
			case Wechat::MSGTYPE_EVENT:
				$url = U(MODULE_NAME.'/Index/index');
				$text = <<<EOF
				5月5日正式开业，敬请期待
EOF;
				$wx->text(trim($text))->reply();
				break;
			case Wechat::MSGTYPE_IMAGE:
				break;
			default:
// 				$wx->text("help info")->reply();
		};
	}
	
	
}