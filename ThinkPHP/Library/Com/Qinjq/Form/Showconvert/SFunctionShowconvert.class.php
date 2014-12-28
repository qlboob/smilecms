<?php

namespace Com\Qinjq\Form\Showconvert;

class SFunctionShowconvert extends SShowconvert{
	public function getContent() {
		$fn = $this->config('content');		
		$echoVal = '$'.$this->element->getEchoVar();
		
		if (FALSE===strpos($fn, '(')) {
			$fn .= '('.$echoVal.')';
		}
		$fn = str_replace('###', $echoVal, $fn);
		$ret = "<?php if(isset($echoVal)){ $echoVal=$fn; } ?>";
		return $ret;
	}

}