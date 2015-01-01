<?php

namespace Com\Qinjq\Block;

abstract class SBlock {
	
	/**
	 * 区块id
	 * @var integer
	 */
	public $blk_id;
	
	/**
	 * 区块标识
	 * @var string
	 */
	public $blk_identify;
	
	/**
	 * 显示顺序
	 * @var integer
	 */
	public $blk_weight;
	
	/**
	 * 其它参数
	 * @var array
	 */
	public $blk_param;
	
	/**
	 * 静态缓存时间（单位为秒）
	 * @var integer
	 */
	public $blk_cachetime;
	
	/**
	 * 显示区域
	 * @var string
	 */
	public $blk_region;
	
	/**
	 * 所依赖的区块
	 * @var array
	 */
	public $blk_dependence;
	
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
				$this->blk_param($k,$v);
			}
			$this->blk_param = array_merge($this->blk_param,$key);
		}elseif (NULL === $value) {
			return isset($this->blk_param[$key])?$this->blk_param[$key]:NULL;
		}else {
			$this->blk_param[$key] = $value;
		}
	}
	
	function __get($key) {
		if (isset($this->blk_param[$key])) {
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
