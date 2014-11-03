<?php
namespace Com\Qinjq\Form\Validator;
use Com\Qinjq\Form\Validator\SValidator;
class SRegularValidator  extends SValidator{

	protected $msg	=	'请输入正确的{$title}格式';
	
	
	function validate($value) {
		$regular = $this->param('regular');
		foreach (array('!','#','/','~') as $v){
			if (FALSE==strpos($regular, $v)) {
				$regular = $v.$regular.$v;
			}
		}
		return preg_match($regular, $this->value);
	}
	

	
}
