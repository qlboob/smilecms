<?php
namespace Com\Qinjq\Form\Validator;
use Com\Qinjq\Form\Validator\SValidator;
class SRegularValidator  extends SValidator{

	protected $msg	=	'请输入正确的{$title}格式';
	
	
	function validate($value,$data) {
		$regular = $this->target;
		/*foreach (array('/','!','#','~') as $v){
			if (FALSE==strpos($regular, $v)) {
				$regular = $v.$regular.$v;
				break;
			}
		}*/
		$regular = "/$regular/";
		return preg_match($regular, $value);
	}
	

	function config($key,$value=NULL){
		if ($value==='') {
			return FALSE;
		}else {
			return parent::config($key,$value);
		}
	}
}
