<?php

namespace Com\Qinjq\Form\Fill;

use Com\Qinjq\Form\Dataflow\SDataBase;
abstract class SFill extends SDataBase{
	protected $field;
	protected $content;
	abstract function run($data);
	
	function config($key,$value=NULL) {
		if (is_array($key)) {
			foreach ($key as $k => $v) {
				$this->config($k,$v);
			}
		}elseif (NULL===$value){
			return isset($this->$key)?$this->$key:NULL;
		}else {
			$this->$key = $value;
		}
	}
	
	function fill(&$data) {
		self::setArrVal($data, $this->field, $this->run($data));
		return $data;
	}
}