<?php

namespace Com\Qinjq\Form\Validator;

use Com\Qinjq\Form\Validator\SRegularValidator;

class SDateValidator extends SRegularValidator{
	
	protected $param = array(
		'regular'	=>	'^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$',
	);

}