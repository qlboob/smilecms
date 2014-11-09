<?php

namespace Com\Qinjq\Form\Element;
use Com\Qinjq\Form\Element\SMultiple;

class SBoxes extends SMultiple{
	protected $additionAttr	=	array('id'=>'');
	
	protected $additionParam = array(
		'sep'	=>	' ',
		'callback'=>'implode',
		'noAttr'=>	array('name','type','value','checked'),
	);
	
	function renderInput() {
		$tag		=	$this->tag;
		$options	=	$this->getOptionValue();
		$ret		=	'';
		$name		=	$this->attr('name');
		if ($this->tag=='checkbox') {
			substr($name, -2)=='[]' || $name.='[]';
		}
		$container	=	uniqid('$__C');
		$echov		=	$this->getEchoVar();
		$defaultValue=	$this->param('defaultValue');
		$filterFun	=	$this->param('filterFun');
		if ($echov) {
			$echov	=	'$'.$echov;
		}
		if ($echov && $defaultValue) {
			if ('$'==substr($defaultValue, 0,1)) {
				$ret	.=	"<?php !isset($echov)&&isset($defaultValue)&&$echov=$defaultValue;";
			}else {
				$ret	.=	"<?php isset($echov)||$echov='{$defaultValue}';";
			}
		}
		$otherAttr	=	$this->buildAttr();
		$ret		.=	sprintf('%s=array();foreach(%s as $k=>$v){',$container,$options);
		$ret		.=	str_replace('%s', $echov, 'if(isset(%s)&&($k==%s||(is_array(%s)&&in_array($k,%s)))){');
		$ret		.=	sprintf("%s[]='<label><input type=%s name=%s value=%s checked=\"checked\"%s />%s</label>';",
				$container,
				sprintf('"%s"',$this->tag), //type
				sprintf('"%s"',$name), //name
				"\"'.$filterFun(\$k).'\"",//value
				$otherAttr,//other attr
				"'.$filterFun(\$v).'"//text
		);
		$ret		.=	'}else{';
		$ret		.=	sprintf(" %s[]='<label><input type=%s name=%s id=%s value=%s%s />%s</label>';",
				$container,
				sprintf('"%s"',$name), //name
				"\"'.$filterFun(\$k).'\"",//value
				$otherAttr,//other attr
				"'.$filterFun(\$v).'"//text
		);
		$ret		.=	'}}';
		$ret		.=	sprintf('echo %s(\'%s\',%s);?>',$this->param('callback'),addcslashes($this->param('sep'), "'"),$container);
		return $ret;
	}
}