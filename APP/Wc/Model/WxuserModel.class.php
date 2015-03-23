<?php

namespace Wc\Model;
use Think\Model;
class WxuserModel extends Model{
	
	
	function openid2uid($openId) {
		$uid = $this->where(array('wx_id'=>$openId))->getField('usr_id');
		if(!$uid){
			$uid = D('Uid')->add(array('uid'=>null));
			$this->add(array(
				'wx_id'=>$openId,
				'usr_id'=>$uid,
			));
		}
		return $uid;
	}
}
