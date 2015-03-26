<?php
namespace Wcadmin\Controller;

class IndexController extends DevController{
	
	function index() {
		$today = strtotime('today');
		#任务完成情况
		$completeCnt = array(
			0,0
		);
		$group = D('Todolist')->field('count(*) as CNT, tdl_state')->where(array('tdl_ctime'=>$today))->group('tdl_state')->select();
		foreach ($group as $v){
			if ($v['tdl_state']>0){
				$completeCnt[1] += $v['CNT'];
			}else {
				$completeCnt[0]  += $v['CNT'];
			}
		}
		
		#订单
		$orderM = D('Order');
		$where = array(
			'ord_state'=>array('gt',0),
			'ord_mtime'=>array('gt',$today),
		);
		$cnt = $orderM->where($where)->count();
		$sum = $orderM->where($where)->sum('ord_money');
		$where['ord_state'] = 0;
		$noPayCnt = $orderM->where($where)->count();
		$completeSum = array_sum($completeCnt);
		
		#用户
		$userCnt = array(3=>0,4=>0,5=>0);
		$userList = D('User')->where('ugp_id>2')->group('ugp_id')->field('ugp_id,count(*) as cnt')->select();
		if ($userList) {
			foreach ($userList as $v){
				$userCnt[$v['ugp_id']]+= $v['cnt'];
			}
		}
		$userSum = array_sum($userCnt);
		
		$this->assign(array(
			'completeCnt'=>$completeCnt,
			'completaRate'=>$completeSum?sprintf('%2.2f',$completeCnt[1]/$completeSum*100):0,
			'orderCnt'=>$cnt,
			'orderSum'=>$sum,
			'noPayCnt'=>$noPayCnt,
				
			'userCnt'=>$userCnt,
			'userSum'=>$userSum,
				
			'today'=>$today,
		));
		$this->display();
	}

}