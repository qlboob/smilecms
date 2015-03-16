<?php

namespace Pt\Model;
use Think\Model;
class WxuserModel extends Model{
	
	
	function openid2uid($openId) {
		$uid = $this->where(array('wxu_openid'=>$openId))->getField('usr_id');
		if(!$uid){
			$uid = $this->add(array(
					'wxu_groupid'=>0,
					'wxu_openid'=>$openId,
			));
		}
		return $uid;
	}
}
