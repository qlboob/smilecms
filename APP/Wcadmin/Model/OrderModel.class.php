<?php

namespace Wcadmin\Model;
use Think\Model;
class OrderModel extends Model{
	
	/**
	 * 订单生效，对于已经支付的订单
	 * @param integer $id 订单ID
	 * @param integer $payeeId 收款人ID
	 */
	function effect($id,$payeeId=NULL) {
		$data = $this->find($id);
		if (!$data or 1!=$data['ord_state']) {
			return FALSE;
		}
		
		$periodM = D('Wcadmin/Period');
		$addDays = $periodM->getAddDay($data['prd_id']);
		$carM = D('Car');
		$addTimeLogM = D('Addtimelog');
		$existCar = $carM->where(array('car_no'=>$data['car_no']))->find();
		$taocanlogM = D('Taocanlog');
		
		$this->startTrans();
		if (!$existCar) {
			#以前没有使用的情况下，先写入车辆信息
			$carM->create($data);
			$carId = $carM->add();
			if (!$carId) {
				$this->rollback();
				return FALSE;
			}
			$existCar = $carM->find($carId);
		}
		$newOrder = array('ord_id'=>$id,'ord_state'=>2);
		if ($payeeId) {
			$newOrder['ord_payee'] = $payeeId;
		}
		if (!$this->save($newOrder)) {
			#订单生效
			$this->rollback();
			return FALSE;
		}
		#增加套餐记录
		$newStartTime = max(strtotime('tomorrow'),$existCar['car_endtime']);
		$newEndTime = $newStartTime + $addDays*24*3600;
		$addTaocanLogData = array(
			'car_id'=>$existCar['car_id'],
			'usr_id'=>$data['usr_id'],
			'tc_id'=>$data['tc_id'],
			'ord_id'=>$id,
			'tcl_starttime'=>$newStartTime,
			'tcl_endtime'=>$newEndTime,
			'tcl_ctime'=>time(),
		);
		if (!$taocanlogM->add($addTaocanLogData)) {
			$this->rollback();
			return FALSE;
		}
		
		#更改车辆状态和服务结束时间
		if (!$carM->save(array('car_id'=>$existCar['car_id'],'car_endtime'=>$newEndTime,'car_state'=>1))) {
			$this->rollback();
			return FALSE;
		}
		#更改用户组，用户信息
		if ( !D('User')->save(array('usr_id'=>$data['usr_id'],'ugp_id'=>4,'usr_nick'=>$data['car_owner'])) ) {
			$this->rollback();
			return FALSE;
		}
		return $this->commit();
	}
	
	function pay($id,$payeeId=NULL) {
		$time = time();
		$info = array('ord_state'=>1,'ord_paytime'=>$time,'ord_mtime'=>$time);
		if ($payeeId) {
			$info['ord_payee']=$payeeId;
		}
		return $this->where(array('ord_id'=>$id,'ord_state'=>0))->save($info);
	}
}
