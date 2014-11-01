<?php

namespace Com\Qinjq\Form\Render;

abstract class SRender {
	
	
	protected $element;
	
	function __construct($config) {
		foreach ($config as $k=>$v){
			$this->$k=$v;
		}
	}
	
	/**
	 * 得到渲染后的内容
	 */
	abstract function getContent();
	
	function __toString(){
		return $this->element->getPreLineHtml().$this->getContent().$this->element->getEndLineHtml();
	}
	function setElement($element) {
		$this->element = $element;
	}
}