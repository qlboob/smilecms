<?php
namespace Com\Qinjq\Form\Validator;
use Com\Qinjq\Form\Validator\SValidator;

class SMinValidator extends SValidator{
	
	
	protected $message	=	'{$title}的最小值是{$target}';
	function validate() {
		return $this->target<=$this->value;
	}


	
}
