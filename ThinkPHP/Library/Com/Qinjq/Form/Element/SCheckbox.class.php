<?php

namespace Com\Qinjq\Form\Element;

use Com\Qinjq\Form\Element\SElement\SInput;

class SCheckbox extends SInput{
	
	protected $additionParam	=	array('value'=>1);
	protected $attr	=	array('type'=>'checkbox');
	
	protected $defaultCheck	=	FALSE;
	
	function renderInput() {
		if ($this->attr('checked')) {
			return parent::getInputHtml();
		}
		$ret	=	"<{$this->tag}".$this->buildAttr();
		$echoVar	=	$this->getEchoVar();
		if ($echoVar) {
			if ($this->defaultCheck) {
				$ret	.=	sprintf('<?php if(!isset($%s)||$%s)echo \' checked="checked"\'?>',$echoVar,$echoVar);
			}
			$ret	.=	sprintf('<?php if(isset($%s)&&$%s)echo \' checked="checked"\'?>',$echoVar,$echoVar);
		}
		return $ret.' />';
	}
}