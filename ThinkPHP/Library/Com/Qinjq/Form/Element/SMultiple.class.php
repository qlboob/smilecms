<?php

namespace Com\Qinjq\Form\Element;
use Com\Qinjq\Form\Element\SElement;

/**
 * 多个备选
 * @author lukeqin
 *
 */
abstract class SMultiple extends SElement{
	
	protected function getOptionValue() {
		$options = $this->param('options');
		if (is_array($options)) {
			return var_export($options,TRUE);
		}
		if (0===stripos($options, 'return ')) {
			return substr($options, 7);
		}
		if (strpos($options,'|') || strpos($options, "\n")||strpos($this->options, "\r")){
			$arr	=	preg_split("#\r?\n#", $options,-1,PREG_SPLIT_NO_EMPTY);
			$options=	array();
			foreach ($arr as $item){
				if (strpos($item,'|')!==FALSE) {
					list($key,$val)	=	explode('|', $item,2);
					$options[$key]	=	$val;
				}else {
					$options[$item]	=	$item;
				}
			}
			//					return sprintf("unserialize('%s')",serialize($options));
			return var_export($options,TRUE);
		}
		return '$'.$options;
	}
}
