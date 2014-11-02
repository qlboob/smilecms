<?php

namespace Common\Model;

use Think\Model;

class FormfieldModel extends Model{
	function _initialize(){
		$this->tablePrefix=C('SYS_DB_PREFIX');
	}
}