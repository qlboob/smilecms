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
		if ($userInfo) {
			$method = 'index'.$userInfo['ugp_id'];
		}else {
			#没有下过单的用户
			$method='index3';
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
		#待洗车辆列表
		$model = D('Todolist');
		$where = array(
			'tdl_ctime'=>strtotime('today'),
			'tdl_state'=>0,
		);
		if (!empty($_GET['vlg_id'])) {
			#小区
			$where['vlg_id']=$_GET['vlg_id'];
			$this->assign('vlg_id',$_GET['vlg_id']);
		}
		if (!empty($_GET['search'])) {
			#搜索
			$search = $_GET['search'];
			$where['_complex'] = array(
				'car_owner'=>array('LIKE',"%{$search}%"),
				'car_no'=>array('LIKE',"%{$search}%"),
				'car_tel'=>array('LIKE',"%{$search}%"),
				'_logic'=>'OR',
			);
			$this->assign('search',$_GET['search']);
		}
		$join = '__CAR__ ON __TODOLIST__.car_id=__CAR__.car_id';
		$cnt = $model->where($where)->join($join)->count();
		if ($cnt) {
			$page = new Page($cnt,20);
			$lists = $model->where($where)->join($join)->select();
			$this->assign('pageHtml',$page->show());
			$this->assign('lists',$lists);
		}
		$this->display('todolist');
	}

	function tododetail(){
		$id = intval($_GET['id']);
		$todoM = D('Todolist');
		if (IS_AJAX) {
			$ret = array('code'=>0,'msg'=>'上传成功');
			$todoimgM = D('Todoimg');
			$success = $todoimgM->add(array(
				'tdi_id'=>$_REQUEST['tdi_id'],
				'tdl_id'=>$id,
			));
			$success2= $todoM->save(array(
				'tdl_id'=>$id,
				'tdl_state'=>1,
			));
			if (!$success or !$success2) {
				$ret['code']=1;
				$ret['msg']='保存失败';
			}
			exit(json_encode($ret));
		}elseif (IS_GET) {
			$todoInfo = $todoM->find($id);
			$carInfo = D('Car')->find($todoInfo['car_id']);
			if ( $todoInfo['apm_id']>0 ) {
				$appointInfo = D('Appointment')->find($todoInfo['apm_id']);
				$this->assign($appointInfo);
			}
			$this->assign($todoInfo);
			$this->assign($carInfo);
			$this->setJsSign();
			$this->display( );
		}
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
