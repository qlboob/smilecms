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
	
	/**
	 * @var string 表单所操作的数据库表名
	 */
	protected $tabel;	
	
	
	
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
	
	static function create($fromId){
		$form = new self();
		self::initForm($form,$formId);
		return $form;
	}

	private static function initForm($form,$formId,$formIds=array()){
		$formIds[] = $formId;
		$formDbData = D('Form')->find($fromId);
		if ( $formDbData['frm_parent'] ) {
			//处理父表单的信息
			$parentIds = sexplode($formDbData['frm_parent']);
			foreach ($parentIds as $parentId) {
				if ( in_array($parentId,$formIds) ) {
					continue;
				}
				self::initForm($form,$parentId,$formIds);
			}
		}
		#from表上信息
		if ( $fromDbData['frm_table'] ) {
			$form->config('table',$formDbData['frm_table']);
		}
		if ( $formDbData['frm_attr'] ) {
			$from->attr(unserialize($formDbData['frm_attr']));
		}
		if ( $formDbData['frm_param'] ) {
			$from->param(unserialize($formDbData));
		}

		#加入字段信息
		$formFieldDbData = D('Formfield')->where("frm_id=$formId and ffd_display=1")->select();
		if ( $formFieldDbData ) {
			foreach($formFieldDbData as $v){
				$fieldConfig = array(
					'label'=>$v['ffd_label'],
					'weight'=>$v['ffd_weight'],
					'key'	=>$v['ffd_name'],
				);
				$fieldParam = $fieldAttr = array();
				if ( $v['ffd_attr'] ) {
					$fieldAttr = unserialize($v['ffd_attr']);
				}
				if ( $v['ffd_param'] ) {
					$fieldParam = unserialize($v['ffd_param']);
				}
				$form->addChild($v['ffd_type'],$fieldConfig,$fieldAttr,$fieldParam);
				//TODO 添加验证器
			}
		}
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
