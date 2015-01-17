<?php

namespace Wcadmin\Model;
use Think\Model;
class PeriodModel extends Model{
	
	function getAddDay($id) {
		$data = $this->find($id);
		return $data['prd_day'];
	}
}