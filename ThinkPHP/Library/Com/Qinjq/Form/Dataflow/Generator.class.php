<?php

namespace Com\Qinjq\Form\Dataflow;

/**
 * 产生表单数据流配置文件
 * @author lukeqin
 *
 */
class Generator {
	private $form;
	private $result = array(
		'field'=>array(),
		'validator'=>array(),
		'convert'	=>array(),
		'fill'	=>array(),
	);
	function __construct($form) {
		$this->form = $form;
	}
	
	function run() {
		foreach (array('field','validator',/*'convert','fill'*/) as $v){
			$method = 'deal'.$v;
			$this->$method();
		}
		return $this->result;
	}
	
	function eachField($callback,$ele=NULL) {
		if (NULL===$ele) {
			$ele = $this->form;
		}
		$child = $ele->config('child');
		if ($child) {
			foreach ($child as $v){
				if (!$v->config('display')) {
					continue;
				}
				if ($v->config('container')) {
					$this->eachField($callback,$v);
				}else {
					call_user_func($callback,$v);
				}
			}
		}
	}
	
	function dealField() {
		$this->eachField(array($this,'dealFieldCallback'));
	}
	
	function dealFieldCallback($ele) {
		$name = $ele->attr('name');
		$fnc = 'is_string';
		$cls = get_class($name);
		if ('Com\Qinjq\Form\Element\SCheckboxes'==$cls or 'Com\Qinjq\Form\Element\SSelect'==$cls and 'multiple'==$ele->attr('multiple')) {
			//数组
			$fnc = 'is_array';
		}
		$this->result['field'][$name] = $fnc;
	}
	
	function dealValidator() {
		$this->eachField(array($this,'dealValidatorCallback'));
	}
	function dealValidatorCallback($ele) {
		$validator = $ele->config('validator');
		if ($validator) {
			$name = $ele->attr('name');
			$this->result['validator'][$name] = array();
			foreach ($validator as $v){
				$clsName = get_class($v);
				$onlyCls = end(explode('\\', $clsName));
				$type = strtolower(substr($onlyCls, 1,-8));
				$this->result['validator'][$name][$type] = $this->getObjVars($v);
			}
		}
	}
	
	function getObjVars($obj) {
		$ret = array();
		//反射得到类的属性
		$class = new \ReflectionClass(get_class($obj));
		$property = $class->getProperties();
		foreach ($property as $v){
			$p = $v->name;
			$ret[$p] = $obj->config($p);
		}
		return $ret;
	}
}