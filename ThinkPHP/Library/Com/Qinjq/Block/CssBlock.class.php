<?php

namespace Com\Qinjq\Block;
use Com\Qinjq\Block\SBlock;

class CssBlock extends SBlock{
	function render($path=''){
		$path||	$path	=	$this->blk_param['path'];
		if (is_file(APP_PATH.'/..'.$path)) {
			$path	=	__ROOT__.$path;
		}
		$ret	=	<<<OEF
<link type="text/css" href="$path" rel="stylesheet" />
OEF;
		return trim($ret);
	}

}
