<?php

namespace Common\Model;

use Think\Model;

class FormModel extends Model{
	function _initialize(){
		$this->tablePrefix=C('SYS_DB_PREFIX');
	}
}