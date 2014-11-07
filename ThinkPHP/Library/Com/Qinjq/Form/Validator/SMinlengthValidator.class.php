<?php
namespace Com\Qinjq\Form\Validator;
use Com\Qinjq\Form\Validator\SMaxlengthValidator;
class SMinlengthValidator extends SMaxlengthValidator{
	
	
	protected $msg	=	'{$title}的最小长度是{$target}';
	function validate($value) {
		$length = $this->strLeng($value);
		return $this->target<=$length;
	}


	
}
