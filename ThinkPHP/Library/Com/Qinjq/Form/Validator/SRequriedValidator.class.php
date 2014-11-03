<?php

namespace Com\Qinjq\Form\Validator;

use Com\Qinjq\Form\Validator\SValidator;
class SRequriedValidator extends SValidator{
	
	protected $notEmptyValidate=FALSE;
	public function validate($value, $data) {
		return FALSE;
	}

}