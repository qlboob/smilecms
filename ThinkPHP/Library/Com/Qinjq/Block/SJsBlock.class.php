<?php

namespace Com\Qinjq\Block;
use Com\Qinjq\Block\SBlock;

class SJsBlock extends SBlock{
	function render($path=''){
		$path||	$path	=	$this->blk_param['path'];
		if (is_file(APP_PATH.'/..'.$path)) {
			$path	=	__ROOT__.$path;
		}
		$ret	=	<<<OEF
<script type="text/javascript" src="$path"></script>
OEF;
		return trim($ret);
	}
}