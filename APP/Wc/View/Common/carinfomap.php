<?php 
	$vlgOption = D('Village')->where('vlg_state=1')->getField('vlg_id,vlg_name');
	$ctpOption = D('Cartype')->where('ctp_state=1')->getField('ctp_id,ctp_name');
	$loctionOption = array('地面','负1楼','负2楼','负3楼');
	$loctionOption = array_combine($loctionOption,$loctionOption);
	$prdOption = D('Period')->where('prd_state=1')->getField('prd_id,prd_name');
	$tcLists = D('Taocan')->getField('tc_id,tc_name,tc_desc');
	$tcOption = $tcDescOption = array();
	foreach ($tcLists as $k=>$v){ $tcOption[$k]=$v['tc_name']; $tcDescOption[$k]=$v['tc_desc'] ;}
?>