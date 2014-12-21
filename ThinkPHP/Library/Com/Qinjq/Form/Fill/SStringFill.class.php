<?php

namespace Com\Qinjq\Form\Fill;
use Com\Qinjq\Form\Fill\SFill;

/**
 * 自动填充字符串
 * @author lukeqin
 *
 */
class SStringFill extends SFill{
	public function run($data) {
		return $this->content;
	}

}