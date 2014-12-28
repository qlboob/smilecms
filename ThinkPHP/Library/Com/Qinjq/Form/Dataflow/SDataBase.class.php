<?php

namespace Com\Qinjq\Form\Dataflow;

class SDataBase {
	protected $param = array();
	
	function param($key,$value=NULL) {
		if (is_array($key)) {
			$this->param = array_merge($this->param,$key);
		}elseif (NULL===$value){
			return isset($this->param[$key])?$this->param[$key]:NULL;
		}else {
			$this->param[$key] = $value;
		}
	}
	
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
	
	/**
	 * 得到数组key的值
	 * @param array $data
	 * @param string $key 数组的key 可能是 x[y][z]形式
	 * @return NULL|unknown
	 */
	static function getArrVal($data,$key) {
		$keyArr = self::getKeyArr($key);
		foreach ($keyArr as $k){
			if (isset($data[$k])) {
				$data = $data[$k];
			}else {
				return NULL;
			}
		}
		return $data;
	}
	
	static function setArrVal(&$data,$key,$value){
		$keyArr = self::getKeyArr($key);
		$cloneData = &$data;
		$lastKey = array_pop($keyArr);
		foreach ($keyArr as $k){
			if (!isset($cloneData[$k])) {
				$cloneData[$k] = array();
			}
			$cloneData = &$cloneData[$k];
		}
		$cloneData[$lastKey] = $value;
	}
	
	static function unsetArrKey(&$data,$key) {
		$keyArr = self::getKeyArr($key);
		$cloneData = &$data;
		$lastKey = array_pop($keyArr);
		foreach ($keyArr as $k){
			if (isset($cloneData[$k])) {
				$cloneData = &$cloneData[$k];
			}else {
				return;
			}
		}
		unset($cloneData[$lastKey]);
	}
	
	static function getKeyArr($key) {
		$keyArr = array();
		$keyArr = explode('[', $key);
		foreach ($keyArr as $k=>$v){
			$keyArr[$k] = trim($v,']');
		}
		return $keyArr;
	}
}
