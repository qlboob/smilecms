<?php
namespace Com\Qinjq\Form\Validator;
use Com\Qinjq\Form\Validator\SValidator;
class SMaxlengthValidator extends SValidator{
	
	protected $name		=	'最长长度';
	
	protected $msg	=	'{$title}的最大长度是{$target}';
	
	function validate($value) {
		$length = $this->strLeng($value);
		return $this->target>=$length;
	}


	private function strLeng($str) {
		if (function_exists('mb_strlen')) {
			return mb_strlen($str,'utf8');
		}else {
			$i = 0;
		    $count = 0;
		    $len = strlen($str);
		    while ($i < $len) {
		        $chr = ord($str[$i]);
		        $count ++;
		        $i ++;
		        if ($i >= $len)
		            break;
		        if ($chr & 0x80) {
		            $chr <<= 1;
		            while ($chr & 0x80) {
		                $i ++;
		                $chr <<= 1;
		            }
		        }
		    }
		    return $count;;
		}
	}
}
