<?php
namespace Wc\Controller;
use Think\Controller;
use Think\Log;
class CronController extends Controller {
	/**
	 * 通知接口
	 */
	function notify() {
		$wxPay = new \Com\Qinjq\Wechat\SPay(array_merge(C('wx'),C('wxpay')));
		$result = $wxPay->notify();
		if($result){
			$orderId = $result['out_trade_no'];
			$model = D('Wcadmin/Order');
			$model->pay($orderId);
			if($model->effect($orderId)){
				$wxPay->notifyOk();
				Log::record("effect success $orderId");
			}else {
				Log::record("effect error $orderId");
			}
// 			Log::record(var_export($result,TRUE));
		}
	}
}