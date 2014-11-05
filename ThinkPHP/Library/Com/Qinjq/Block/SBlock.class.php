<?php

namespace Com\Qinjq\Block;

abstract class SBlock {
	protected $param = array();
	
	/**
	 * 初始化
	 */
	function _init() {
		;
	}
	
	/**
	 * construct
	 * @param array $param 区块参数
	 */
	function __construct($param=array()) {
		$this->_init();
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
	
	function param($key,$value=NULL) {
		if (is_array($key)) {
			foreach ($key as $k => $v) {
				$this->param($k,$v);
			}
			$this->param = array_merge($this->param,$key);
		}elseif (NULL === $value) {
			return isset($this->param[$key])?$this->param[$key]:NULL;
		}else {
			$this->param[$key] = $value;
		}
	}
	
	function __get($key) {
		if (isset($this->param[$key])) {
			return $this->param[$key];
		}
		return NULL;
	}
	abstract function render();
	
	function getContent(){
		if ($this->blk_cachetime>0) {
			$cacheKey = 'sblock/id/'.$this->blk_param['blk_identify'];
			$content = S($cacheKey);
			if (null === $content) {
				$content = $this->render();
				S($cacheKey,$content,$this->blk_cachetime);
			}
		}else {
			$content = $this->render();
		}
		return $content;
	}
}
