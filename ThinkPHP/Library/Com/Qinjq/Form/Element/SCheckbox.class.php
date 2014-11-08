<?php

namespace Com\Qinjq\Form\Element;

use Com\Qinjq\Form\Element\SInput;

class SCheckbox extends SInput{
	
	protected $additionParam	=	array('value'=>1);
	protected $attr	=	array('type'=>'checkbox');
	
	function renderInput() {
		if ($this->attr('checked')) {
			return parent::getInputHtml();
		}
		$ret	=	"<{$this->tag}".$this->buildAttr();
		$echoVar	=	$this->getEchoVar();
		if ($echoVar) {
			if ($this->param('defalutCheck')) {
				$ret	.=	sprintf('<?php if(!isset($%s)||$%s)echo \' checked="checked"\'?>',$echoVar,$echoVar);
			}
			$ret	.=	sprintf('<?php if(isset($%s)&&$%s)echo \' checked="checked"\'?>',$echoVar,$echoVar);
		}
		return $ret.' />';
	}
}