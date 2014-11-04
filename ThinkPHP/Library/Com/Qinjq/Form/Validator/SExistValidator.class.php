<?php

namespace Com\Qinjq\Form\Validator;

use Com\Qinjq\Form\Validator\SValidator;
class SExistValidator extends SValidator{
	
	protected $existValidate=FALSE;
	
	protected $msg = '{$title}必须填写';
	
	public function validate($value, $data) {
		return FALSE;
	}

}