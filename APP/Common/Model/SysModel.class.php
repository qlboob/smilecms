<?php

namespace Common\Model;

use Think\Model;

class SysModel extends Model{
	function _initialize(){
		$this->tablePrefix=C('SYS_DB_PREFIX');
	}
}