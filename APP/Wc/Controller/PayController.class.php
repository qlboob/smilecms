<?php
namespace Wc\Controller;
use Think\Log;
class PayController extends WcpageController {
	
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
		$data = $this->_keyFilter($_POST,array('car_owner','car_tel','vlg_id','ctp_id','prd_id','car_no','car_color','car_model','car_location','car_remark','tc_id'));
		#计算支付金额
		$money = D('Price')->where(array('ctp_id'=>$data['ctp_id'],'prd_id'=>$data['prd_id'],'tc_id'=>$data['tc_id']))->getField('prc_money');
		if (!$money) {
			$this->error('没有所所选择的套餐');
		}else {
			$data = array_merge($data,array(
				'usr_id'=>$uid,
				'ord_ctime'=>$time,
				'ord_mtime'=>$time,
				'ord_money'=>$money,
			));
			#生成本地和微信订单
			$orderId = D('Order')->add($data);
			$wxPay = new \Com\Qinjq\Wechat\SPay(array_merge(C('wx'),C('wxpay')));
			$wxorder = array(
							'body'=>'washcarfee',
							'out_trade_no'=>$orderId,
							'total_fee'=>$money,
							'notify_url'=>'http://'.$_SERVER['HTTP_HOST'].U(MODULE_NAME.'/Cron/notify'),
							'openid'=>$this->cookie->getOpenId(),
						);
			$payJsParam = $wxPay->getJsPayParam($wxorder);
			Log::record(var_export($wxorder,TRUE));
			if ($payJsParam) {
				$this->assign('payJsParam',$payJsParam);
				$this->assign($data);
				$this->setJsSign();
				$this->display();
			}else {
				exit('下单失败');
				$this->error('下单失败');
			}
			
		}
	}
	
	
	
}