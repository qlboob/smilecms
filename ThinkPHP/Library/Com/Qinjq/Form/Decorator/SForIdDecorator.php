<?php

namespace Com\Qinjq\Form\Decorator;
use Com\Qinjq\Form\Decorator\SDecorator;
class SForIdDecorator extends SDecorator{
	public function run($element) {
		if ($element->config('container')) {
			$child = $element->config('child');
			if ($child) {
				foreach ($child as $v){
					$this->run($v);
				}
			}
		}else {
			$id = $element->getId();
			$label = $element->config('label');
			if ($id and $label) {
				$element->labelAttr('id',$id);
				$element->attr('id',$label);
			}
		}
		
	}

}
