<?php
namespace Wc\Controller;
use Think\Page;
class WorkerController extends WcpageController {
	
	
	function _initialize() {
		parent::_initialize();
		$uid = $this->cookie->getUid();
		if (2!=C('groupid')) {
			$userInfo = D('User')->find($uid);
			if (2!=$userInfo['ugp_id']) {
				exit('no access');
			}
		}
		
	}
	
	function todolist() {
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
		$this->display('Worker/todolist');
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
			$washContent = array(
				'tdl_id'=>$id,
				'tdl_state'=>1,
			);
			if (empty($_REQUEST['tdl_innerwash'])) {
				$washContent['tdl_innerwash']=1;
			}
			$success2= $todoM->save($washContent);
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
	
	/**
	 * 未付款列表
	 */
	function topaylist() {
		$lists = D('Order')->where(array('ord_mtime'=>array('gt',time()-12*3600),'ord_state'=>0))->select();
		$this->assign('lists',$lists);
		$this->display();
	}
	
	/**
	 * 线下收款
	 */
	function pay() {
		$model = D('Wcadmin/Order');
		if($model->pay($_GET['id'],$this->cookie->getUid())){
			$model->effect($_GET['id']);
			$this->success('收款成功');
		}else {
			$this->error('收款失败');
		}
	}
	
}
