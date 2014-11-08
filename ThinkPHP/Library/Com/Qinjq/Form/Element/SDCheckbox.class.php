<?php
namespace Com\Qinjq\Form\Element;
use Com\Qinjq\Form\Element\SCheckbox;

class SDCheckbox extends SCheckbox{
	protected $additionAttr	=	array('type'=>'checkbox','value'=>1);
	
	function renderInput() {
		$ret	=	'<input name="'.$this->attr('name').'" type="hidden" value="0" />';
		$ret	.=	parent::renderInput();
		return $ret;
	}
}