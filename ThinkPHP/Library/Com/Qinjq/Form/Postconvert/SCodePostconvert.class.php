<?php

namespace Com\Qinjq\Form\Postconvert;
use Com\Qinjq\Form\Postconvert\SPostconvert;

/**
 * 使用代码转换，代码中使用return
 * @author lukeqin
 *
 */
class SCodePostconvert extends SPostconvert{
	
	public function run($val, $data) {
		//TODO 使用文件缓存函数，再次使用直接include
		$fun = create_function('$val,$data', $this->content);
		return $fun($val,$data);
	}

}
