<?php

namespace Common\Model;


class SiteModel extends SysModel{
	
	function getSelectList() {
		$ret = $this->getField('sit_id,sit_name');
		if (empty($ret)) {
			$ret = array();
		}
		return array_merge(array(0=>''),$ret);
	}
}