<?php
namespace Wcadmin\Controller;
use Think\Controller;

class CronController extends Controller {

	/**
	 * 订单生效
	 */
	function runOrder() {
		$lists = D('Order')->where('ord_state=1')->select();
		if ($lists) {
			foreach ($lists as $v){
				D('Order')->effect($v['ord_id']);
			}
		}
	}
	
	/**
	 * 安排任务
	 */
	function runTodo() {
		D('Todolist')->plan();
	}
	
	/**
	 * 关闭同一个人的订单,有的订单已经支付了的情况
	 */
	function closeSameOrder() {
		$orderM = D('Order');
		$lists = $orderM->where(array('ord_state'=>array('gt',0),'ord_mtime'=>array('gt',time()-24*3600)))->select();
		if (!$lists) {
			return;
		}
		$time = time();
		$between = array($time-12*3600,$time-2*3600);
		foreach ($lists as $v){
			$orderM->where(array('ord_state'=>0,'ord_mtime'=>array('between',$between),'usr_id'=>$v['usr_id']))->save(array('ord_state'=>-1));
		}
	}
}