<?php

namespace Com\Qinjq\Form\Fill;

abstract class SFill {
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
		$data[$this->field] = $this->run($data);
	}
}