<?php
namespace Com\Qinjq\Form\Validator;
use Com\Qinjq\Form\Validator\SValidator;
class SMaxValidator extends SValidator{
	
	
	protected $msg	=	'{$title}的最大值是{$target}';
	function validate($value,$data) {
		return $this->target>=$value;
	}


	
}
