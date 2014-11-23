<?php

namespace Com\Qinjq\Form\Validatoradapter;

abstract class SValidatoradapter {
	protected $param = array();
	protected $doIt = false;
	
	function param($key,$value=NULL) {
		if (is_array($key)) {
			$this->param = array_merge($this->param,$key);
		}elseif (NULL===$value){
			return isset($this->param[$key])?$this->param[$key]:NULL;
		}else {
			$this->param[$key] = $value;
		}
	}
	abstract function run($form);
	/*
	private function init($evt) {
		$form = $evt['form'];
		$formId = $form->config('dbId');
		$data=D('Formvalidatoradapter')->find($formId);
		if ($data) {
			$cls = get_class($this);
			$this->doIt = "S{$data['fva_type']}"==$cls;
			if ($this->doIt and $data['fva_param']) {
				$param = unserialize($data['fva_param']);
				if ($param) {
					$this->param = $param;
				}
			}
		}
	}
	
	function before_form_render($param) {
		$this->init($param);
		if ($this->doIt) {
			$this->before($param['form']);
		}
	}
	
	function after_form_render($param) {
		$this->init($param);
		if ($this->doIt) {
			$this->after($param['form']);
		}
	}
	
	abstract function before($form);
	
	abstract function after($form);
	*/
}