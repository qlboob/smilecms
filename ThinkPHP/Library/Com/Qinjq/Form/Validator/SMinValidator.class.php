<?php
namespace Com\Qinjq\Form\Validator;
use Com\Qinjq\Form\Validator\SValidator;

class SMinValidator extends SValidator{
	
	
	protected $msg	=	'{$title}的最小值是{$target}';
	function validate($value,$data) {
		return $this->target<=$value;
	}


	
}
