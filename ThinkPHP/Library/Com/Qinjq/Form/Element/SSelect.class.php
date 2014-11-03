<?php

namespace Com\Qinjq\Form\Element;
use Com\Qinjq\Form\Element\SMultiple;

class SSelect extends SMultiple{
	
	protected $tag = 'select';
	function renderInput() {
		$first 			=	$this->param('first');
		$defaultValue	=	$this->param('defaultValue');
		$filterFun		=	$this->param('filterFun');
		$ret			=	'<select'.$this->buildAttr().'>';
		if($first)
			$ret		.=	'<option value="">'.$first.'</option>';
		$options	=	$this->getOptionValue();
		if ($options) {
			$echov	=	$this->getEchoVar();
			if ($echov && $defaultValue) {
				if ('$'==substr($defaultValue, 0,1)) {
					$ret	.=	"<?php !isset($echov)&&isset($defaultValue)&&$echov=$defaultValue;";
				}else {
					$ret	.=	"<?php isset($echov)||$echov='{$defaultValue}';";
				}
			}else {
				$ret	.=	'<?php ';
			}
			$ret	.=	sprintf('foreach(%s as $k=>$v){',$options);// foreach start
			if ($echov) {
				$echov	=	'$'.$echov;
				$ret	.=	str_replace('%s', $echov, 'if(isset(%s)&&($k==%s||(is_array(%s)&&in_array($k,%s)))){ ?>');
				$ret	.=	str_replace('%s',$filterFun,'<option selected="selected" value="<?php echo %s($k)?>"><?php echo %s($v)?></options>');
				$ret	.=	str_replace('%s',$filterFun,'<?php }else{?><option value="<?php echo %s($k)?>"><?php echo %s($v)?></options>');
				$ret	.=	'<?php }?>';
			}else {
				$ret	.=	str_replace('%s',$filterFun,' ?><option value="<?php echo %s($k)?>"><?php echo %s($v)?></options>');
			}
			$ret .= '<?php }?>';// foreach end
		}
		return $ret.'</select>';
	}
}
