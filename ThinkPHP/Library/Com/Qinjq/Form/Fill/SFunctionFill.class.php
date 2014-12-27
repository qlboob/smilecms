<?php

namespace Com\Qinjq\Form\Fill;
use Com\Qinjq\Form\Fill\SFill;

/**
 * 使用函数名填充
 * @author lukeqin
 *
 */
class SFunctionFill extends SFill{
	public function run($data) {
		$fun = $this->content;
		if (strpos($fun, '(')>0) {
			list($fun,$argStr) = explode('(', $fun,2);
			$argStr = rtrim($argStr,')');
			$args = explode(',', $argStr);
			foreach ($args as $k=>$v){
				if ('$data'==$v) {
					$args[$k]= $data;
				}
			}
			return call_user_func_array($fun, $args);
		}
		return $fun();
	}

}