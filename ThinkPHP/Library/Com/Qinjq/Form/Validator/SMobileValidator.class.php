<?php

namespace Com\Qinjq\Form\Validator;
use Com\Qinjq\Form\Validator\SRegularValidator;
class SMobileValidator extends SRegularValidator{
	protected $msg = '请输入正确的手机号码';
	
	protected $target = '^1[34578]\d{9}$';
}
