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
	
	
}