<?php

namespace Com\Qinjq\Form\Decorator;

abstract class SDecorator {
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
	
	/**
	 * 设置/得到 参数
	 * @param array|string $key
	 * @param string $value
	 * @return Ambigous <NULL, multitype:>
	 */
	function param($key,$value=NULL) {
		if (is_array($key)) {
			foreach ($key as $k => $v) {
				$this->param($k,$v);
			}
		}elseif (NULL === $value) {
			return isset($this->param[$key])?$this->param[$key]:NULL;
		}else {
			if (in_array($key, array('preLine','endLine','preInput','endInput'))) {
				$this->param[$key][]=$value;
			}else{
				$this->param[$key] = $value;
			}
		}
	}
}
