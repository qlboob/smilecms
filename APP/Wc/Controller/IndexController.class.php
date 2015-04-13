<?php
namespace Wc\Controller;
use Think\Page;
class IndexController extends WcpageController {
	
	
	function _initialize() {
		parent::_initialize();
		
	}
	
	function index() {
		$uid = $this->cookie->getUid();
		$userInfo = D('User')->find($uid);
		$method='index3';
		if ($userInfo) {
			C('groupid',$userInfo['ugp_id']);
			$method = 'index'.$userInfo['ugp_id'];
		}
		$this->$method();
	}
	
	#管理员
	private function index1() {
		$this->admin();
		$completeCnt = array(
			0,0
		);
		$group = D('Todolist')->field('count(*) as CNT, tdl_state')->where(array('tdl_ctime'=>strtotime('today')))->group('tdl_state')->select();
		foreach ($group as $v){
			if ($v['tdl_state']>0){
				$completeCnt[1] += $v['CNT'];
			}else {
				$completeCnt[0]  += $v['CNT'];
			}
		}
		echo "已经完成".$completeCnt[1].'/'.array_sum($completeCnt);
	}
	
	#洗车工的界面
	private function index2() {
		R('Worker/todolist');
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
		$this->index3();
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
	
	function admin() {
		$uid = $this->cookie->getUid();
		$userInfo = D('User')->find($uid);
		if (1==$userInfo['ugp_id']) {
			$uuid = md5(uniqid(mt_rand(), true));
			D('Qrlogin')->add(array(
				'qrl_id'=>$uuid,
				'qrl_ctime'=>time(),
				'usr_id'=>$uid,
			),array(),true);
			$host = $_SERVER['HTTP_HOST'];
// 			$host = 'first.cdwashcar.com';
			header("Location: http://$host".U('Wcadmin/Login/wcjump',array('id'=>$uuid)));
			exit();
		};
	}
	
	function webqrlogin() {
		$uid = $this->cookie->getUid();
		$userInfo = D('User')->find($uid);
		if (1==$userInfo['ugp_id']) {
			D('Qrlogin')->save(array(
				'qrl_id'=>$_GET['id'],
				'usr_id'=>$uid,
			));
		}
	}
	
	/**
	 * 查看洗车后的照片
	 */
	function view() {
		$id = intval($_GET['id']);
		$todoInfo = D('Todolist')->find($id);
		$carInfo = D('Car')->find($todoInfo['car_id']);
		if ($carInfo['usr_id']!=$this->cookie->getUid()) {
			return;
		}
		$lists = D('Todoimg')->where(array('tdl_id'=>$id))->select();
		$this->assign('lists',$lists);
		$this->display();
	}
	function test() {
		$this->setJsSign();
		$this->display();
	}
}
