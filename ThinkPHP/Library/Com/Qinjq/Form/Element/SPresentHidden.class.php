<?php

namespace Com\Qinjq\Form\Element;
use Com\Qinjq\Form\Element\SHidden;
class SPresentHidden extends SHidden{
	
	function renderInput(){
		$ret = parent::renderInput();
		$echoVal = $this->getEchoVar();
		return "<?php if(isset(\${$echoVal})){?>$ret<?php }?>";
	}
}
