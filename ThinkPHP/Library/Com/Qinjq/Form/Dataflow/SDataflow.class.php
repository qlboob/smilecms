<?php

namespace Com\Qinjq\Form\Dataflow;

class SDataflow {
	
	/**
	 * @var array 表单中所允许的字段
	 */
	private $field = array();
	
	/**
	 * @var array 表单中的验证器
	 * 字段->验证类型->验证器内容
	 */
	private $validator = array();
	
	private $error;
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
	
	function run($data) {
		$data = $this->filterField($data);
		return $this->validate($data);
	}
	
	function filterField($data) {
		if ($this->field) {
			foreach ($data as $k =>$v){
				if (isset($this->field[$k])) {
					$fnc = $this->field[$k];
					if (!$fnc($v)) {
						unset($data[$k]);
					}
				}else {
					unset($data[$k]);
				}
			}
		}
		return $data;
	}
	
	function validate($data) {
		foreach ($data as $k=>$v){
			if (!isset($this->validator[$k])) {
				continue;
			}
			foreach ($this->validator[$k] as $type=>$config){
				$className = 'Com\Qinjq\Form\Validator\S'.ucfirst($type).'Validator';
				$validator = new $className();
				$validator->config($config);
				$validator->setData($data);
				if (!$validator->run()) {
					$this->error = $validator->getError();
					return false;
				};
			}
		}
		return TRUE;
	}
	
}