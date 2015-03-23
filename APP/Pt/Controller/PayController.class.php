<?php
namespace Pt\Controller;

use Com\Qinjq\Wechat\SPay;
class PayController extends WcpageController {
	
	function index() {
		$money = 99800;
		$desc = '开通会员';

		#生成内部订单
		$model = D('Order');
		$orderInfo = $model->where(array(
			'usr_id'=>$this->cookie->getUid(),
			'ord_state'=>0,
			'ord_mtime'=>array('gt',time()-24*3600),
		))->find();
		if ($orderInfo) {
			$orderId = $orderInfo['ord_id'];
			$model->save(array(
				'ord_id'=>$orderId,
				'ord_mtime'=>time(),
			));
		}else {
			$orderId = $model->add(array(
				'usr_id'=>$this->cookie->getUid(),
				'ord_ctime'=>time(),
				'ord_mtime'=>time(),
				'ord_money'=>$money,
				'ord_desc'=>$desc,
			));
		}
		$wcPay = new SPay($this->getWcPayConfig());
		$this->setJsSign();
		$jsPayParm = $wcPay->getJsPayParam(array(
			'body'=>$desc,
			'out_trade_no'=>$orderId,
			'total_fee'=>$money,
		));
		$this->assign('jsPayParam',$jsPayParm);
		$this->display();
	}
	
	/**
	 * 微信支付通知
	 */
	function notify_mm() {
		$wcPay = new SPay($this->getWcPayConfig());
		$info = $wcPay->notify();
		if ($info) {
			$orderM = D('Order');
			$userM = D('User');
			$innerOrderInfo=$orderM->find($info['out_trade_no']);
			$time = time();
			if ($innerOrderInfo) {
				#检查订单状态
				switch (intval($innerOrderInfo['ord_state'])) {
					case 0:
						#设置支付状态
						$success = $orderM->save(array(
							'ord_id'=>$innerOrderInfo['ord_id'],
							'ord_state'=>1,
							'ord_paytime'=>$time,
							'ord_mtime'=>$time,
						));
						if (!$success) {
							$this->notifyToWc(FALSE);
						}
					case 1:
						#设置订单的支付状态和过期时间
						$orderM->startTrans();
						$success = $orderM->save(array(
							'ord_id'=>$innerOrderInfo['ord_id'],
							'ord_state'=>2,
						));
						if (!$success) {
							$orderM->rollback();
							$this->notifyToWc(FALSE);
						}
						$userInfo = $userM->find($innerOrderInfo['usr_id']);
						if ($userInfo) {
							$this->notifyToWc(FALSE);
						}
						$newTimeout = max($userInfo['usr_timeout'],$time)+365*24*3600;
						$success = $userM->save(array(
							'usr_id'=>$userInfo['usr_id'],
							'usr_pay'=>1,
							'usr_timeout'=>$newTimeout,
						));
						if (!$success) {
							$orderM->rollback();
							$this->notifyToWc(FALSE);
						}else {
							$orderM->commit();
							$this->notifyToWc();
						}
					break;
					default:
						$this->notifyToWc();
					break;
				}
			}
		}
	}
	
	/**
	 * 微信通知的返回
	 * @param string $sucess
	 */
	private function notifyToWc($sucess = true) {
		$wcPay = new SPay();
		if ($sucess) {
			$arr = array('return_code'=>'SUCCESS','return_msg'=>'OK');
		}else {
			$arr = array('return_code'=>'FAIL','return_msg'=>'error');
		}
		exit($wcPay->arrayToXml($arr));
	}
	
	private function getWcPayConfig() {
		$config = array(C('wc'),C('wcPay'));
	}
}