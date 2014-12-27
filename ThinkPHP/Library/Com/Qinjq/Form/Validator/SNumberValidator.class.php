<?php
namespace Com\Qinjq\Form\Validator;

use Com\Qinjq\Form\Validator\SRegularValidator;
class SNumberValidator extends SRegularValidator{
	
	protected $msg	=	'{value} 不是小数';
	
	protected $target	=	'^[\-\+]?(([0-9]+)([\.,]([0-9]+))?|([\.,]([0-9]+))?)$';
	
}
