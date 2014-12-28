<?php

namespace Com\Qinjq\Form\Postconvert;
use Com\Qinjq\Form\Dataflow\SDataBase;
/**
 * 表单提交的数据字段转换
 * @author lukeqin
 *
 */
abstract class SPostconvert extends SDataBase{
	protected $field;
	protected $content;
	
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
	

	abstract function run($val,$data);
	
	function convert(&$data) {
		$value = self::getArrVal($data, $this->field);
		if (NULL!==$value) {
			self::setArrVal($data, $this->field, $this->run($value, $data));
		}
		return $data;
	}
}