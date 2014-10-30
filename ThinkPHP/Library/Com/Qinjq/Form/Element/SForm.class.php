<?php
namespace Com\Qinjq\Form\Element;
use Com\Qinjq\Form\Element\SContainer;
class SForm extends SContainer{
	
	protected $tag	=	'form';
	
	/**
	 * 生成html所需变量
	 * @var array
	 */
	protected $vars		=	array();
	protected $attr	=	array('method'=>'post','enctype'=>'multipart/form-data');
	
	
	
	/**
	 * 生成的php缓存代码
	 * @var string
	 */
	protected $phpCode;
	
	/*for cms attr*/
	
	
	
	
	function __toString(){
		$formName = $this->attr('name');
		$eventName = '%s,%s_'.$formName;
		if ($this->phpCode) {
			$phpcode	=	$this->phpCode;
		}else {
			dispatchEvent(str_replace('%s', 'form_pre_to_string', $eventName), (object)array('form'=>$this));
			
			$phpcode	=	$this->render();
			dispatchEvent(str_replace('%s', 'form_after_render', $eventName), (object)array('form'=>$this,'phpCode'=>&$phpcode));
			//设置缓存
			SS(getFormCacheKey($this->formId),$phpcode);
		}
		
		dispatchEvent(str_replace('%s', 'form_pre_to_html', $eventName), (object)array('form'=>$this));
		$htmlContent	=	$this->toHtml($phpcode);
		dispatchEvent(str_replace('%s', 'form_after_to_html', $eventName), (object)array('form'=>$this,'content'=>&$htmlContent));
		
		return $htmlContent;
	}
	
	
	/**
	 * 把PHP代码转换成HTML
	 * @param string $phpCode
	 * @return string
	 */
	private function toHtml($phpCode) {
		ob_start();
		extract($this->vars);
		if (C('APP_DEBUG')) {
			$cachePath	=	TEMP_PATH.'/tpl.'.md5($phpCode).'.t.php';
			if (!is_file($cachePath)) {
				file_put_contents($cachePath, $phpCode);
			}
			include $cachePath;
		}else {
			eval('?>'.$phpCode);
		}
		return ob_get_clean();
	}
	
	/**
	 * 设置变量
	 * @param mixed $key
	 * @param mixed $value
	 */
	function assign($key,$value='') {
		if (is_array($key)) {
			$this->vars	=	array_merge($this->vars,$key);
		}else
		$this->vars[$key]	=	$value;
	}
}
