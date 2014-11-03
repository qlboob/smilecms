<?php

namespace Com\Qinjq\Form\Validator;

use Com\Qinjq\Form\Validator\SValidator;
class SExistValidator extends SValidator{
	
	protected $existValidate=FALSE;
	public function validate($value, $data) {
		return FALSE;
	}

}