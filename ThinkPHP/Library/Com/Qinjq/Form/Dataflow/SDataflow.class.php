<?php

namespace Com\Qinjq\Form\Dataflow;

class SDataflow extends SDataBase{
	
	/**
	 * @var array 表单中所允许的字段
	 */
	private $field = array();
	
	/**
	 * @var array 表单中的验证器
	 * 字段->验证类型->验证器内容
	 */
	private $validator = array();

	private $convert = array();
	
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
		$validateResult =  $this->validate($data);
		if ( !$validateResult ) {
			return $validateResult;
		}
		$data = $this->fill($data);
		return $this->convert($data);
	}
	
	function filterField($data) {
		$ret = array();
		if ($this->field) {
			foreach ($this->field as $field=>$fun){
				$value = self::getArrVal($data, $field);
				if ($fun($value)) {
					self::setArrVal($ret, $field, $value);
				}
			}
		}
		return $ret;
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

	function convert($data){
		if ( $this->convert ) {
			foreach($this->convert as $field => $item){
				foreach($item as $type=>$config){
					$className = 'Com\Qinjq\Form\Postconvert\S'.ucfirst($type).'Postconvert';
					$convertObj = new $className();
					$convertObj->config($config);
					$convertObj->convert($data);
				}
			}
		}
		return $data;
	}
	
	function fill($data){
		if ( $this->fill ) {
			foreach($this->fill	 as $field=>$item){
				foreach($item as $type=>$config){
					$className = 'Com\Qinjq\Form\Fill\S'.ucfirst($type).'Fill';
					$fillObj = new $className();
					$fillObj->config($config);
					$fillObj->fill($data);
				}
			}
		}
		return $data;
	}
}
