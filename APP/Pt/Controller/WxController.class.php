<?php

namespace APP\Pt\Controller;

use Think\Controller;
use \Wechat;
class WxController extends Controller{
	
	
	function index() {
		$wx = new \Com\Qinjq\Wechat\SWechat(C('wx'));
		$wx->valid();
		$type = $wx->getRev()->getRevType();
		switch($type) {
			case Wechat::MSGTYPE_TEXT:
				$wx->text("hello, I'm wechat")->reply();
				exit;
				break;
			case Wechat::MSGTYPE_EVENT:
				break;
			case Wechat::MSGTYPE_IMAGE:
				break;
			default:
				$wx->text("help info")->reply();
		}
	}
}
