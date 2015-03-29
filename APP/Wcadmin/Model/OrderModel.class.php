<?php

namespace Wcadmin\Model;
use Think\Model;
class OrderModel extends Model{
	
	/**
	 * 订单生效，对于已经支付的订单
	 * @param integer $id 订单ID
	 */
	function effect($id) {
		$data = $this->find($id);
		if (!$data or 1!=$data['ord_state']) {
			return FALSE;
		}
		
		$periodM = D('Period');
		$addDays = $periodM->getAddDay($data['prd_id']);
		$carM = D('Car');
		$addTimeLogM = D('Addtimelog');
		$existCar = $carM->where(array('car_no'=>$data['car_no']))->find();
		
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
		if (!$this->save(array('ord_id'=>$id,'ord_state'=>2))) {
			#订单生效
			$this->rollback();
			return FALSE;
		}
		#增加续期记录
		$newStartTime = max(strtotime('tomorrow'),$existCar['car_endtime']);
		$newEndTime = $newStartTime + $addDays*24*3600;
		$addTimeData = array(
			'car_id'=>$existCar['car_id'],
			'ord_id'=>$id,
			'prd_id'=>$data['prd_id'],
			'atl_oldendtime'=>$existCar['car_endtime'],
			'atl_newendtime'=>$newEndTime,
			'atl_ctime'=>time(),
		);
		if (!$addTimeLogM->add($addTimeData)) {
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
		$this->commit();
		return TRUE;
	}
}
