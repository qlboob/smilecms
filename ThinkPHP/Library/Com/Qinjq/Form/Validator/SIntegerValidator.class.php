<?php

namespace Com\Qinjq\Form\Validator;

use Com\Qinjq\Form\Validator\SRegularValidator;

class SIntegerValidator extends SRegularValidator{
	
	protected $msg = '{$value}不是整数';
	
	protected $target = 	'^[\-\+]?([1-9]\d*|0)+$';

}