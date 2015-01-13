<?php
function getOption($data,$key=NULL) {
	if (NULL===$key) {
		return $data;
	}
	return isset($data[$key])?$data[$key]:NULL;
}

function getUserGroupOption($key=NULL) {
	$data = D('Usergroup')->getField('ugp_id,ugp_name');
	return getOption($data,$key);
}