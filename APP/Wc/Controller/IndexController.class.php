<?php
namespace Wc\Controller;
class IndexController extends WcpageController {
	
	
	function _initialize() {
		parent::_initialize();
		
	}
	
	function index() {
		$uid = $this->cookie->getUid();
		$userInfo = D('User')->find($uid);
		if ($userInfo) {
			$method = 'index'.$userInfo['ugp_id'];
		}else {
			#没有下过单的用户
			$method='index0';
		}
		$this->$method();
	}
	
	private function index0() {
		;
	}
	
	#管理员
	private function index1() {
		echo '管理员功能正在策划中。。。';
	}
	
	#洗车工的界面
	private function index2() {
		echo '正在开发中';
	}
	
	#未付费
	/*private */function index3() {
		$orderInfo = D('Order')->where(array('usr_id'=>$this->cookie->getUid()))->order('ord_mtime')->find();
		if ($orderInfo) {
			$this->assign($orderInfo);
		}
		$this->display('add');
	}
	
	private function index4() {
		$this->appointment();
	}
	
	#过期用户，去续费
	private function index5() {
		;
	}
	
	/**
	 * 预约洗车
	 */
	function appointment() {
		$time = time();
		if (IS_GET) {
			$timeOption = array();
			$startTime = $time+2*3600;
			while(count($timeOption)<20){
				$hour=date('G',$startTime);
				if (in_array($hour, array(9,10,11,12,13,14,15,16,17,18))) {
					$timeOption[$startTime] = date('n月j日G点',$startTime);
				}
				$startTime += 3600;
			}
			$this->assign('timeOption',$timeOption);
			$this->assign('appointment');
			$this->display('appointment');
		}else {
			$data = $this->_keyFilter($_POST, array('apm_time','apm_remark','apm_washinner'));
			$uid = $this->cookie->getUid();
			$carId = D('Car')->where(array('usr_id'=>$uid))->getField('car_id');
			$data = array_merge($data,array(
				'usr_id'=>$uid,
				'apm_ctime'=>$time,
				'car_id'=>$carId,	
			));
			if(D('Appointment')->add($data)){
				$this->display('appointmentsuccess');
			}else {
				$this->error('系统忙，请稍后再试。');
			}
		}
	}
}