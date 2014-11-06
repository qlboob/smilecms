<?php

namespace Com\Qinjq\Form\Render;

abstract class SRender {

	protected $output = array('','');
	
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
	
	protected function addOutPut($preStr,$endStr='') {
		$this->output[0] .= $preStr;
		$this->output[1] = $endStr.$this->output[1];
	}
	
	protected function output() {
		return implode('', $this->output);
	}
}