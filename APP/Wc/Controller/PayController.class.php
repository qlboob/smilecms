<?php
namespace Wc\Controller;
class PayController extends WcpageController {
	
	
	function _initialize() {
		parent::_initialize();
		
	}
	
	/**
	 * 确认订单并支付
	 */
	function index() {
		$uid = $this->cookie->getUid();
		$userInfo = D('User')->find($uid);
		if (!$userInfo) {
			#只有下单的时候才添加用户
			D('User')->add(array(
				'usr_id'=>$uid,
			));
		}
		
		#生成订单
		$time = time();
		$data = $this->_keyFilter($_POST,array('car_owner','car_tel','vlg_id','car_no','car_color','car_model','car_location','car_remark'));
		#计算支付金额
		$money = D('Price')->where(array('ctp_id'=>$data['ctp_id'],'prd_id'=>$data['prd_id']))->getField('prc_money');
		if ($money) {
			$this->error('没有所所选择的套餐');
		}else {
			$data = array_merge($data,array(
				'usr_id'=>$uid,
				'ord_ctime'=>$time,
				'ord_mtime'=>$time,
				'ord_money'=>$money,
			));
			$orderId = D('Order')->add($data);
			$this->assign($data);
			$this->display();
		}
	}
	
}