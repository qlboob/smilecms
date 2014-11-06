<?php

namespace Com\Qinjq\Form\Element;
use Com\Qinjq\Form\Element\SElement;
class SValue extends SElement{

	function renderInput() {
		return $this->getValuePHP();
	}
}