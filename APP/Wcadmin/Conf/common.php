<?php
function getOption($data,$key) {
	if (NULL===$key) {
		return $data;
	}
	return isset($data[$key])?$data[$key]:NULL;
}

function getUserGroupOption($key=NULL) {
	$data = D('Usergroup')->where('ugp_state=1')->getField('ugp_id,ugp_name');
	return getOption($data,$key);
}
function getCarTypeOption($key=NULL) {
	$data = D('Cartype')->where('ctp_state=1')->getField('ctp_id,ctp_name');
	return getOption($data,$key);
}
function getVillageOption($key=NULL) {
	$data = D('Village')->where('vlg_state=1')->getField('vlg_id,vlg_name');
	return getOption($data,$key);
}

function getPeriodOption($key=NULL){
	$data = D('Period')->where('prd_state=1')->getField('prd_id,prd_name');
	return getOption($data, $key);
}

function getWxUserGroupOption($key=NULL) {
	$data = array(
		1=>'普通用户',
		2=>'洗车工',
		3=>'管理员',
		4=>'付费用户',
	);
	return getOption($data,$key);
}
function getOrderStateOption($key=NULL) {
	return getOption(array('未支付','已支付','已生效'),$key);
}
function getYesNoOption($key=NULL) {
	return getOption(array('否','是'),$key);
}
function div100($money) {
	if ($money and '0'!==$money) {
		return $money/100;
	};
}
function multi100($yuan) {
	return $yuan*100;
}
