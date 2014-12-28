<?php
namespace Com\Qinjq\Form\Validatoradapter;
use Com\Qinjq\Form\Validatoradapter\SValidatoradapter;
class SPosabsoluteValidatoradapter extends SValidatoradapter{
	
	
	function run($form){
		$fields = $form->config('element');
		$used = false;
		if ($fields) {
			$fields[] = $form;
		}else {
			$fields = array($form);
		}
		
		foreach ($fields as $ele){
			$validators = $ele->config('validator');
			if ($validators) {
				$used = true;
				foreach ($validators as $validator){
					$validatorClsName = get_class($validator);
					$arrClsName = explode('\\', $validatorClsName);
					$validatorName = substr(end($arrClsName), 1,-9);
					$method = 'add'.$validatorName.'Validator';
					if (method_exists($this, $method)) {
						$target = $validator->config('target');
						$this->$method($ele,$validator,$target);
					}
				}
			}
		}
		if ($used) {
			$form->addClass('jve');
		}
	}
	
	function addValdateClass($ele,$class) {
		$classAttr	=	$ele->attr('class');
		$classAttr	||	$classAttr	=	'';
		if (strpos($classAttr, 'validate[')===FALSE){
			$classAttr	.=	" validate[$class]";
		}else {
			$classAttr	=	preg_replace('#validate\[(.+)\]#i', "validate[\$1,$class]", $classAttr);
		}
		$ele->attr('class',trim($classAttr));
	}
	
	function addRequiredValidator($formEle,$validator) {
		$this->addValdateClass($formEle, 'required');
	}
	
	function addMaxValidator($formEle,$validator,$target) {
		
		$this->addValdateClass($formEle, "max[{$target}]");
	}
	
	function addMinValidator($formEle,$validator,$target) {
		$this->addValdateClass($formEle, "min[{$target}]");
	}
	function addIntegerValidator($formEle,$validator) {
		$this->addValdateClass($formEle, 'custom[integer]');
	}
	
	function addMaxlengthValidator($formEle,$validator,$target) {
		$this->addValdateClass($formEle, "maxSize[{$target}]");
	}
	
	function addMinlengthValidator($formEle,$validator,$target) {
		$this->addValdateClass($formEle, "minSize[{$target}]");
	}
	
	function addNumberValidator($formEle,$validator) {
		$this->addValdateClass($formEle, 'custom[number]');
	}
	
	function addEmailValidator($formEle,$validator) {
		$this->addValdateClass($formEle, 'custom[email]');
	}
	function addDateValidator($formEle,$validator){
		$this->addValdateClass($formEle,'custom[date]');
	}
	function addDatetimeValidator($formEle,$validator){
		$this->addValdateClass($formEle,'custom[datetime]');
	}
	function addEqualValidator($formEle,$validator,$target) {
		$this->addValdateClass($formEle, "equals[{$$target}]");
	}
	/*
	function addUniqueValidator($formEle,$validator,$target) {
		if(!$formEle->attr('ajaxunique')){
			$formEle->attr('ajaxunique',U('Public-PositionValidator/unique'));
		}else{
				
		}
		$this->addValdateClass($formEle, "ajax[ajaxunique]");
	}
	
	function addRegularValidator($formEle,$validator,$target) {
		//TODO 解决正则问题
		$formEle->attr('validatereg',"$target");
		$this->addValdateClass($formEle, "funcCall[regularValidate]");
	}*/
}
