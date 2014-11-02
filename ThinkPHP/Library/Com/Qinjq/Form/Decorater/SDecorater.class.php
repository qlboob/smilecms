<?php

namespace Com\Qinjq\Form\Decorater;

abstract class SDecorater {
	protected $element;
	
	function __construct($config=array()) {
		$this->config($config);
	}
	
	function config($key,$value=NULL) {
		if (is_array($key)) {
			foreach ($key as $k=>$v){
				$this->config($k,$v);
			}
		}elseif (null === $value){
			return $this->$key;
		}else {
			$this->$key = $value;
		}
	}
	
	function setElement($element) {
		$this->element = $element;
	}
	
	abstract function run($element) {
		;
	}
}
