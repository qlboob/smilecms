<?php

namespace Com\Qinjq\Form\Postconvert;
use Com\Qinjq\Form\Postconvert\SPostconvert;

class SFunctionPostconvert extends SPostconvert{
	public function run($val, $data) {
		$fun = $this->content;
		return $fun($val,$data);		
	}

}
