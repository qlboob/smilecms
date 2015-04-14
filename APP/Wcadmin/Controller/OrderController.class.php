<?php

namespace Wcadmin\Controller;

use Wcadmin\Controller\DevController;
class OrderController extends DevController{
	
	function _before_index() {
		if (!empty($_REQUEST['ord_mtime_gt_'])) {
			$_REQUEST['ord_mtime_egt_']=strtotime($_REQUEST['ord_mtime_egt_']);
		}
		if (!empty($_REQUEST['ord_mtime_lt_'])) {
			$_REQUEST['ord_mtime_lt_']=strtotime($_REQUEST['ord_mtime_lt_'])+3600*24;
		}
	}
	
	/**
	 * 线下收款
	 */
	function getmoney() {
		$model = D('Order');
		$id = $_GET['id'];
		$info = $model->find($id);
		if (!$info) {
			$this->error('订单不存在');
		}elseif ($info['ord_state']>0){
			$this->error('订单已经支付');
		}else {
			$success = $model->where(array('ord_mtime'=>$_GET['ord_mtime'],'ord_id'=>$id))
				->save(array(
				'ord_state'=>1,
				'ord_payee'=>$_SESSION['usr_id'],
				'ord_paytime'=>time(),
			));
			if ($success) {
				$model->effect($id);
				$this->success('收款成功');
			}else {
				$this->error('收款失败');
			}
		}
	}
}