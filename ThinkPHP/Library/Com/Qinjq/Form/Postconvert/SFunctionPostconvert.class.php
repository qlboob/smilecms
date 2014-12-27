<?php

namespace Com\Qinjq\Form\Postconvert;
use Com\Qinjq\Form\Postconvert\SPostconvert;

class SFunctionPostconvert extends SPostconvert{
	public function run($val, $data) {
		$fun = $this->content;
		if (strpos($fun, '(')>0) {
			list($fun,$argStr) = explode('(', $fun,2);
			$argStr = rtrim($argStr,')');
			$args = explode(',', $argStr);
			foreach ($args as $k=>$v){
				switch ($v) {
					case '$value':
						$args[$k] = $val;
						break;
					case '$data':
						$args[$k] = $data;
				}
			}
			return call_user_func_array($fun, $args);
		}
		return $fun($val);
	}

}
