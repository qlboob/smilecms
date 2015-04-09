<?php

namespace Wcadmin\Model;
use Think\Model;
class TodolistModel extends Model{
	
	/**
	 * 安排洗车
	 */
	function plan() {
		#找出所有小区，是否是工业区
		$vlg2Type = D('Village')->getField('vlg_id,vlg_type');
		
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
				if ($mon<6 ) {
					if ($vlg2Type[$v['vlg_id']]>0 ) {
						if (in_array($lastNum, array($mon-1,$mon+5-1))) {
							#工业园，T+1洗车;
							$wash = TRUE;
						}
					}else {
						if (in_array($lastNum, array($mon-5,$mon,$mon+5))) {
							#小区，限号日洗车
							$wash = TRUE;
						}
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