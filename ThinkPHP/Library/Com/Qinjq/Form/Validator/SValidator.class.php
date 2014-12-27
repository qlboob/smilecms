<?php

namespace Com\Qinjq\Form\Validator;

use Com\Qinjq\Form\Dataflow\SDataBase;
abstract class SValidator extends SDataBase{
	/**
	 * @var string 错误信息
	 */
	protected $msg='';
	
	/**
	 * @var 被验证显示的标题
	 */
	protected $title;
	
	/**
	 * @var string 被验证的值
	 */
	protected $value;
	
	/**
	 * @var 被验证的所有值
	 */
	protected $data;
	
	/**
	 * @var array 参数
	 */
	protected $param = array();
	
	/**
	 * 验证的字段
	 * @var string
	 */
	protected $field;
	
	/**
	 * @var bool 存在key才验证
	 */
	protected $existValidate = TRUE;
	
	/**
	 * @var bool 空字符串不为空验证
	 */
	protected $notEmptyValidate = TRUE;
	
	protected $target;
	
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
	
	function param($key,$value=NULL) {
		if (is_array($key)) {
			$this->param = array_merge($this->param,$key);
		}elseif (NULL===$value){
			return isset($this->param[$key])?$this->param[$key]:NULL;
		}else {
			$this->param[$key] = $value;
		}
	}
	
	/**
	 * 设置被验证的表单数据
	 * @param array $data
	 */
	function setData(array $data) {
		$this->value = self::getArrVal($data, $this->field);
		$this->data = $data;
	}
	
	/**
	 * 外部调用验证
	 * @return boolean
	 */
	function run() {
		if (null===$this->value) {
			$ret = $this->existValidate;
		}elseif (''===$this->value){
			$ret = $this->notEmptyValidate;
		}else {
			$ret = $this->validate($this->value,$this->data);
		}
		return $ret;
	}
	
	/**
	 * 验证函数
	 * @param mixed $value 被验证的值
	 * @param array $data 表单所有数据
	 */
	abstract function validate($value,$data);
	
	/**
	 * 得到错误信息
	 * @return string
	 */
	function getError() {
		if ($this->msg and FALSE===stripos($this->msg, '{$')) {
			return preg_replace_callback('#\{$(.+?)\}#', array($this,'replace'), $this->msg);
		}
		return $this->msg;
	}
	
	function replace($matches) {
		$ret = '';
		$key = $matches[1];
		$arrKey = explode('.', $key);
		$firstKey = array_shift($arrKey);
		if (isset($this->$firstKey)) {
			$ret = $this->$firstKey;
			foreach ($arrKey as $k){
				if (isset($ret[$k])) {
					$ret = $ret[$k];
				}else {
					$ret='';
					break;
				}
			}
		}
		return $ret;
	}
}
