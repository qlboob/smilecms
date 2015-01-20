<?php

namespace Wcadmin\Model;
use Think\Model;
class TodolistModel extends Model{
	
	/**
	 * 安排洗车
	 */
	function plan() {
		$today = strtotime('today');
		$tomorrow = strtotime('tomorrow');
		$lists = D('Appointment')->where("apm_time between $today and $tomorrow")->select();
// 		$this->startTrans();
		if ($lists) {
			foreach ($lists as $v){
				$apData = array(
					'car_id'=>$v['car_id'],
					'tdl_ctime'=>$today,
					'apm_id'=>$v['apm_id']
				);
				if (!$this->where($apData)->find()) {
					$this->add($apData);
				}
			}
		}
		$lists = D('Car')->where("car_endtime>=$today")->select();
		$mon = date('N');
		if ($lists) {
			foreach ($lists as $v){
				$wash = FALSE;#加入洗车
				$lastNum = preg_replace('!.+(\d)\D*$!', '$1', $v['car_no']);
				if ($mon<6 && ($mon==$lastNum || $mon+5==$lastNum) ) {
					#限号日洗车
					$wash = TRUE;
				}else {
					if ($today-$v['car_lastwashtime']>24*3600*4) {
						$wash = TRUE;
					}
				}
				if ($wash) {
					$data = array(
						'car_id'=>$v['car_id'],
						'tdl_ctime'=>$today,
					);
					if (!$this->where($data)->find()) {
						$this->add($data);
					}
				}
			}
		}
	}
}