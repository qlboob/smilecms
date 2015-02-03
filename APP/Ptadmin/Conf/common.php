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


function getWxUserGroupOption($key=NULL) {
	$data = array(
		1=>'工厂',
		2=>'商家',
		3=>'原材料供应商',
		4=>'管理员',
	);
	return getOption($data,$key);
}
function getOrderStateOption($key=NULL) {
	return getOption(array('未支付','已支付','已生效'),$key);
}
function getYesNoOption($key=NULL) {
	return getOption(array('否','是'),$key);
}

function getInformationStateOption($key=NULL) {
	return getOption(array(
		-1=>'未通过',
		0=>'待审核',
		1=>'已审核',
		2=>'已成交',
	),$key);
}
function getInformationTypeOption($key=NULL){
	return getOption(array(
		1=>'商家求购',
		2=>'工厂求购',
	), $key);
}
function div100($money) {
	if ($money and '0'!==$money) {
		return $money/100;
	};
}
function multi100($yuan) {
	return $yuan*100;
}
