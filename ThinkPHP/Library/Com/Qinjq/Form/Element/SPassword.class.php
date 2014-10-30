<?php

namespace Com\Qinjq\Form\Element;
use Com\Qinjq\Form\Element\SInput;
class SPassword extends SInput{
	protected $additionParam=	array(
		'value'=>'',
	);
	protected $attr	=	array('type'=>'password');
}