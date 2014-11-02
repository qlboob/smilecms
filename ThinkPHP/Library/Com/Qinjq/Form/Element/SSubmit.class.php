<?php

namespace Com\Qinjq\Form\Element;
use Com\Qinjq\Form\Element\SElement;

class SSubmit extends SElement{
	protected $tag = 'button';
	protected $additionAttr = array(
		'type'=>'submit',
		'value'=>'提交',
	);
	protected $selfCloseTag = FALSE;
}