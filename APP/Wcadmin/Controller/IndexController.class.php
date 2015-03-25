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
	}

}