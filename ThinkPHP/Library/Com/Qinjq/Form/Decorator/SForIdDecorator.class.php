<?php

namespace Com\Qinjq\Form\Decorator;
use Com\Qinjq\Form\Decorator\SDecorator;
/**
 * 给表单元素的label增加for属性
 * 给表单元素的input增加id属性
 * @author lukeqin
 *
 */
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
				$element->labelAttr('for',$id);
				$element->attr('id',$id);
			}
		}
		
	}

}
