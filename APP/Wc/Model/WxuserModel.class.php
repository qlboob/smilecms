<?php

namespace Wc\Model;
use Think\Model;
class WxuserModel extends Model{
	
	
	function openid2uid($openId) {
		$uid = $this->where(array('wx_id'=>$openId))->getField('usr_id');
		if(!$uid){
			$uidM = D('Uid');
			$uid = $uidM->add(array('uid'=>null));
			$this->add(array(
				'wx_id'=>$openId,
				'usr_id'=>$uid,
			));
			if (mt_rand(0, 100)>98) {
				$uidM->where('1=1')->delete();
			}
		}
		return $uid;
	}
}
