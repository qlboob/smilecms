<?php
namespace Wc\Controller;
use Think\Log;
class WcmsgController extends WcpageController {
	
	

	function index() {
		$wx = new \Com\Qinjq\Wechat\SWechat(C('wx'));
		$wx->valid();
		$type = $wx->getRev()->getRevType();
		switch($type) {
			case \Wechat::MSGTYPE_TEXT:
				$url = U(MODULE_NAME.'/Index/index');
				$text = <<<EOF
		5月5日正式开业，敬请期待
EOF;
				$wx->text(trim($text))->reply();
				break;
			case \Wechat::MSGTYPE_EVENT:
				$url = U(MODULE_NAME.'/Index/index');
				$text = <<<EOF
		<a href="http://{$_SERVER['HTTP_HOST']}$url">我要洗车</a>
EOF;
				$wx->text($text)->reply();
				break;
			case \Wechat::MSGTYPE_IMAGE:
				break;
			default:
				$wx->text("help info")->reply();
		};
	}
	
	
}