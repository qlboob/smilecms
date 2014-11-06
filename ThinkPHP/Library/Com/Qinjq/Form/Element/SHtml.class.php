<?php

namespace Com\Qinjq\Form\Element;
use Com\Qinjq\Form\Element\SElement;
class SHtml extends SElement{

	function renderInput() {
		return $this->param('html');
	}
}