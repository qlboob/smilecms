<?php

namespace Wcadmin\Controller;

use Wcadmin\Controller\DevController;
class OrderController extends DevController{
	
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
			$success = $model->save(array(
				'ord_id'=>$id,
				'ord_state'=>1,
				'ord_payee'=>$_SESSION['usr_id'],
			));
			$success?$this->success('收款成功'):$this->error('收款失败');
		}
	}
}