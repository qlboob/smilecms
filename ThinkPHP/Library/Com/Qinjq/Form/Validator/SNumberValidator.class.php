<?php
namespace Com\Qinjq\Form\Validator;

use Com\Qinjq\Form\Validator\SRegularValidator;
class SNumberValidator extends SRegularValidator{
	
	protected $message	=	'{value} 不是小数';
	
	protected $param	=	array(
		'regular'	=>	'^[\-\+]?(([0-9]+)([\.,]([0-9]+))?|([\.,]([0-9]+))?)$',
	);
	
}
