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
		return 	$fun($data);
	}

}