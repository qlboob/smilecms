<?php
namespace Com\Qinjq\Form\Element;
use Com\Qinjq\Form\Element\SContainer;
use Think\Hook;
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
	
	function __construct() {
		$this->form = $this;
		parent::__construct();
	}
	
	function __toString(){
		$formName = $this->attr('name');
		if ($this->phpCode) {
			$phpcode	=	$this->phpCode;
		}else {
			$eventPram = array('form'=>$this);
			Hook::listen('before_form_render',$eventPram);
			$this->decorate();//执行修饰器
			$phpcode	=	$this->render();
			$eventPram['phpCode'] = $phpcode;
			Hook::listen('after_form_render', $eventPram);
		}
		$htmlContent	=	$this->toHtml($phpcode);
		return $htmlContent;
	}
	
	static function create($formId){
		$form = new self();
		$fns = self::configForm($form,$formId);
		if ($fns) {
			foreach ($fns as $fn) {
				list($fnc,$args) = $fn;
				call_user_func_array(array(&$form,$fnc), $args);
			}
		}
		return $form;
	}

	private static function configForm($form,$formId,$formIds=array(),$fns= array()){
		$formIds[] = $formId;
		$formDbData = D('Form')->find($formId);
		if ( $formDbData['frm_parent'] ) {
			//处理父表单的信息
			$parentIds = sexplode($formDbData['frm_parent']);
			foreach ($parentIds as $parentId) {
				if ( in_array($parentId,$formIds) ) {
					continue;
				}
				$fns = self::configForm($form,$parentId,$formIds,$fns);
			}
		}
		#from表上信息
		if ( $formDbData['frm_table'] ) {
			$form->config('table',$formDbData['frm_table']);
		}
		if ( $formDbData['frm_attr'] ) {
			$form->attr(unserialize($formDbData['frm_attr']));
		}
		if ( $formDbData['frm_param'] ) {
			$form->param(unserialize($formDbData));
		}

		#加入字段信息
		$formFieldDbData = D('Formfield')->where("frm_id=$formId and ffd_display=1")->getField('ffd_id,ffd_name,ffd_label,ffd_type,ffd_attr,ffd_param,ffd_weight,ffd_parent');
		if ( $formFieldDbData ) {
			self::initField($form, $formFieldDbData);
			/*
			foreach($formFieldDbData as $fieldId => $v){
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
			}*/
		}
		
		#加入渲染器
		$renderData = D('Formrender')->find($formId);
		if ($renderData) {
			$renderConfig = array();
			if ($renderData['fmr_param']) {
				$renderConfig = unserialize($renderData['fmr_param']);
			}
			$fns[] = array('setAllDefaultRender',array($renderData['fmr_type'],$renderConfig));
		}
		
		#加入修饰器
		$decoratorData = D('Formdecorator')->where(array('frm_id'=>$formId,'ffd_id'=>0))->select();
		if ($decoratorData) {
			foreach ($decoratorData as $v){
					$param = array();
					if ($v['fdr_param']) {
						$param = unserialize($v['fdr_param']);
					}
					$form->addDecorator($v['fdr_type'],$param);
				}
		}
		
		return $fns;
	}
	
	static function initField($form,&$formFieldDbData,$id=0) {
		foreach($formFieldDbData as $fieldId => &$v){
			if ($id and $fieldId!=$id) {
				//指定渲染id
				continue;
			}
			$parentId = $v['ffd_parent'];
			if ($parentId>0) {
				if(empty($formFieldDbData[$parentId]['ele'])){
					self::initField($form, $formFieldDbData,$parentId);
				}
				$parentEle = $formFieldDbData[$parentId]['ele'];
			}else {
				$parentEle = $form;
			}
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
			$ele = $parentEle->addChild($v['ffd_type'],$fieldConfig,$fieldAttr,$fieldParam);
			$v['ele'] = $ele;
			$ele->config('form',$form);
			//添加验证器
			$validatorDb = D('Formvalidator')->where(array('ffd_id'=>$v['ffd_id']))->select();
			if ($validatorDb) {
				foreach ($validatorDb as $validatorItem){
					$validatorConfig = array(
						'target'=> $validatorItem['fvd_target'],
					);
					if ($validatorItem['fvd_msg']) {
						$validatorConfig['msg'] = $validatorItem['fvd_msg'];
					}
					//TODO 没有李增加参数信息
					$ele->addValidator($validatorItem['fvd_type'],$validatorConfig);
				}
			}
			//添加修饰器
			$decoratorDb = D('Formdecorator')->where(array('ffd_id'=>$v['ffd_id']))->select();
			if ($decoratorDb) {
				foreach ($decoratorDb as $v){
					$param = array();
					if ($v['fdr_param']) {
						$param = unserialize($v['fdr_param']);
					}
					$ele->addDecorator($v['fdr_type'],$param);
				}
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
		if (APP_DEBUG) {
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
