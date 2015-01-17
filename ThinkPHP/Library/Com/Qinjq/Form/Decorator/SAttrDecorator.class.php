<?php

namespace Com\Qinjq\Form\Decorator;
use Com\Qinjq\Form\Decorator\SDecorator;
class SAttrDecorator extends SDecorator{
	
	public function run($element) {
		if ($element->config('container')) {
			$child = $element->config('child');
			if ($child) {
				foreach ($child as $v){
					$this->run($v);
				}
			}
		}else {
			$element->attr($this->param);
		}		
	}

	
}