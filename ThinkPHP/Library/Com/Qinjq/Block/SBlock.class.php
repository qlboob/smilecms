<?php

namespace Com\Qinjq\Block;

abstract class SBlock {
	protected $config = array();
	
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
	function __construct($config=array()) {
		if (!empty($config['blk_param'])) {
			$config['blk_param'] = unserialize($config['blk_param']);
		}
		$this->_init();
	}
	
	function __get($key) {
		if (isset($this->config[$key])) {
			return $this->config[$key];
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
