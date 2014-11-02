<?php

namespace Common\Model;

use Think\Model;

class FormrenderModel extends Model{
	function _initialize(){
		$this->tablePrefix=C('SYS_DB_PREFIX');
	}
}