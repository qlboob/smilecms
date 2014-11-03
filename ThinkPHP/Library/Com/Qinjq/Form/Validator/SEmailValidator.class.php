<?php

namespace Com\Qinjq\Form\Validator;

use Com\Qinjq\Form\Validator\SRegularValidator;

class SEmailValidator extends SRegularValidator{
	
	protected $msg = '{$title}不是正确的邮箱格式';
	
	protected $param = array(
		'regular'	=>	'^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$',
	);

}