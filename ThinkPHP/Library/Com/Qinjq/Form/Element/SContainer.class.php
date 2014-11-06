<?php
namespace Com\Qinjq\Form\Element;
use Com\Qinjq\Form\Element\SElement;
class SContainer extends SElement{

	/**
	 * 是否自闭合标签
	 * @var boolean
	 */
	protected $selfCloseTag	=	FALSE;
	
	/**
	 * 元素
	 * @var array
	 */
	protected $element	=	array();
	
	/**
	 * 子元素
	 * @var array
	 */
	protected $child	=	array();
	
	/**
	 * 是否为容器
	 * @var boolean
	 */
	protected $container	=	TRUE;
	
	/**
	 * add element
	 * @param array $params 元素参数
	 * @return SElement
	 */
	function addElement($type,$config=array(),$attr=array(),$param=array()) {
		$element	=	$this->createElement($type,$config,$attr,$param);
		$key = $config['key'];
		$this->element[$key]	=	$element;
		return $element;
	}
	
	/**
	 * add child
	 * @return SElement
	 */
	function addChild($type,$config=array(),$attr=array(),$param=array()) {
		$config['parent']	=	$this;
		$config['form']		=	$this->form;
		$element			=	$this->form->addElement($type,$config,$attr,$param);
		$key = $config['key'];
		$this->child[$key]	=	$element;
		$this->element[$key]=	$element;
// 		$this->form->element[$key]=$element;
		return $element;
	}
	/**
	 * 创建一个元素
	 * @param string $type
	 * @param array $param
	 * @return SElement
	 */
	function createElement($type,$config=array(),$attr=array(),$param=array()) {
		if (!isset($attr['name']) and isset($config['key'])) {
			$attr['name']	=	$config['key'];
		}
		$clsName = 'Com\Qinjq\Form\Element\S'.ucfirst($type);
		$obj	=	new $clsName;
		$obj->config($config);
		$obj->attr($attr);
		$obj->param($param);
		return	$obj;
	}
	
	
	function getElement($key=NULL) {
		if ($key===NULL)
			return $this->element;
		return isset($this->element[$key])?$this->element[$key]:NULL;
	}
	
	function getChild($key=NULL) {
		if ($key===NULL)
			return $this->child;
		return isset($this->child[$key])?$this->child[$key]:NULL;
	}
	
	/**
	 * 删除子元素（不删除所包含的元素）
	 * @param string $key
	 * @return multitype:
	 */
	function removeChild($key) {
		if (isset($this->child[$key])) {
			$child	=	$this->child[$key];
			unset($this->child[$key]);
			return $child;
		}
	}
	
	/**
	 * 删除元素（同时删除子元素）
	 * @param string $key
	 * @return SElement
	 */
	function removeElement($key) {
		if (isset($this->element[$key])) {
			$ele	=	$this->element[$key];
			unset($this->element[$key]);
			$this->removeChild($key);
			return $ele;
		}
	}
	
	function renderChild() {
		$ret	=	'';
		usort($this->child, function($a,$b){
			$aW = $a->config('weight');
			$bW = $b->config('weight');
			if ($aW==$bW) {
				return 0;
			}
			return $aW-$bW>0?1:-1;
		});
		foreach ($this->child as $ele) {
			$ret	.=	$ele->render();
		}
		return $ret;
	}
	
	function setAllDefaultRender($render) {
		$this->setDefaultRender($render);
		foreach ($this->element as $value) {
			$value->setDefaultRender($render);
		}
	}
	
	function setChildRender($render) {
		foreach ($this->child as $value) {
			$value->setRender($render);
		}
	}
	
	function setAllRender($render,$config) {
		$this->setRender($render,$config);
		foreach ($this->element as $v){
			$v->setRender($render,$config);
		}
	}
}
