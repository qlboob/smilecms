<?php
namespace Dev\Controller;
use Think\Controller;
use Think\Hook;
use Com\Qinjq\Block\SLayout;
class DevController extends Controller {
	protected $model	=	array();
	
	protected $formId;
	
	protected $succssMsg;
	
	protected $callback	=	array(
			'beforeDisplay'	=>	'_bd_{ACTION}',
			'beforeGetDao'	=>	'_bgd_{ACTION}',
			'afterGetDao'	=>	'_agd_{ACTION}',
	
			'afterUpdate'	=>	'_au_{ACTION}',
			'afterDelete'	=>	'_ad_{ACTION}',
			'afterInsert'	=>	'_ai_{ACTION}',
	
			'beforeDispaly'	=>	'_bd_{ACTION}',
			'ok'			=>	'success',
	
			'afterFindData'	=>	'_afd_{ACTION}',
	);
	
	
	/**
	 * 得到表单
	 * @return SForm
	 */
	protected function getForm(){
		if($this->formId){
			$formId = $this->formId;
		}else{
			$table 	=	strtolower(parse_name(CONTROLLER_NAME,0));
			$table	=	ltrim($table,'_');
			$formId	=	D('Model')->where("mdl_table = '$table'")->getField('frm_id');
		}
		return \Com\Qinjq\Form\Element\SForm::create($formId);
	}
	
	protected function getTable($table='') {
		$table||$table	=	strtolower(parse_name(CONTROLLER_NAME));
		$ret	=	array($table);
		while ($parentId=D('Model')->where("mdl_table='$table'")->getField('mdl_parent')) {
			$table	=	D('Model')->where("mdl_id=$parentId")->getField('mdl_table');
			array_unshift($ret,$table);
		}
		return $ret;
	}
	
	protected function _aop($key, &$params=NULL) {
		$action = $this->callback [$key];
		if (FALSE !== strpos ( $action, '{ACTION}' )) {
			$action = str_replace ( '{ACTION}', ACTION_NAME, $action );
		}
		if (method_exists ( $this, $action )) {
			$this->$action ( $params );
		} elseif (function_exists ( $action )) {
			call_user_func ( $action, $params );
		}
	}
	
	/**
	 * get dao
	 * @param string $table
	 * @return Model
	 */
	protected function _getDao($table='') {
		$table||$table	=	$this->getActionName();
		$table			=	parse_name($table,1);//这里统一用大写形式
		if (!empty($this->model[$table])) {
			$table	=	$this->model[$table];
		}
		$this->_aop('beforeGetDao',$table);
		$dao	=	D($table);
		$this->_aop('afterGetDao',$dao);
		return $dao;
	}
	
	protected function _find() {
		$table	=	$this->getTable();
		$firstM	=	$this->_getDao(array_shift($table));
		$firstM->alias('M');
		$pk		=	$firstM->getPk();
		foreach ($table as $tab) {
			$tabName	=	D($tab)->getTableName();
			$firstM->join("INNER JOIN $tabName ON M.$pk=$tabName.$pk");
		}
		$editpk = empty($_REQUEST['id'])?$_REQUEST[$pk]:$_REQUEST['id'];
		$where	=	array("M.$pk"=>$editpk);
		$data	=	$firstM->where($where)->find();
		return $data;
	}
	
	//公共方法
	
	
	
	function add(){
		if(IS_GET){
			$form	=	$this->getForm();
			$form->assign($_GET);
			$eventParam	=	array('form'=>$form);
			$this->_aop('beforeDisplay',$eventParam);
			$this->assign('form',(string)$form);
			$this->display('Default/add');
		}else{
			$table		=	$this->getTable();
			$firstTable	=	array_shift($table);
			$firstM	=	$this->_getDao($firstTable);
			if($firstM->create()){
				$insertId	=	$firstM->add();
				foreach ($table as $tab) {
					$extendM = $this->_getDao($tab);
					if($extendM->create()){
						$field	=	$firstM->getDbFields();
						$pk		=	$field['_pk'];
						$extendM->$pk	=	$insertId;
						$extendM->add();
					}
				}
				$eventParam = (object)array('id'=>$insertId,'model'=>isset($extendM)?$extendM:$firstM);
				Hook::listen('after_insert', $eventParam);
				$this->_aop('afterInsert',$eventParam);
			}
			$this->_aop('ok',$this->succssMsg);
		}
	}
	
	
	function edit() {
		if (IS_GET) {
			$table	=	$this->getTable();
			$firstM	=	$this->_getDao(array_shift($table));
			$firstM->alias('M');
			$pk		=	$firstM->getPk();
			foreach ($table as $tab) {
				$tabName	=	D($tab)->getTableName();
				$firstM->join("INNER JOIN $tabName ON M.$pk=$tabName.$pk");
			}
			$editpk = empty($_REQUEST['id'])?$_REQUEST[$pk]:$_REQUEST['id'];
			$where	=	array("M.$pk"=>$editpk);
			$data	=	$firstM->where($where)->find();
			$eventParam = array('data'=>&$data);
			$this->_aop('afterFindData',$eventParam);
				
			$form	=	$this->getForm();
			$eventParam=	(object)array('data'=>&$data,'form'=>$form,'id'=>$editpk,'model'=>isset($tabName)?D($tab):$firstM);
			Hook::listen('before_edit_display', $eventParam);
			$this->_aop('beforeDispaly',$eventParam);
			$form->assign($_GET);
			$form->assign($data);
			$this->assign('form',(string)$form);
			$this->display('Default/add');
		}else {
			$table		=	$this->getTable();
			foreach ($table as $tab) {
				$model	=	$this->_getDao($tab);
				$model->create();
				$model->save();
			}
			$eventParam	=	(object)array('model'=>$model,'id'=>$_REQUEST[$model->getPk()]);
			Hook::listen('after_edit_update', $eventParam);
			$this->_aop('afterUpdate',$eventParam);
			$this->_aop('ok',$this->succssMsg);
		}
	}
	
	function delete() {
		$table	=	$this->getTable();
		$firstM	=	$this->_getDao(array_shift($table));
		$pk		=	$firstM->getPk();
		$where	=	array($pk=>array('IN',$_REQUEST['id']));
		$firstM->where($where)->delete();
		foreach ($table as $tab) {
			$model	=	$this->_getDao($tab);
			$model->where($where)->delete();
		}
		$eventParam	=	array('model'=>isset($model)?$model:$firstM,'id'=>$_REQUEST['id']);
		Hook::listen('after_delete', (object)$eventParam);
		$this->_aop('afterDelete',$eventParam);
		$this->_aop('ok',$this->succssMsg);
	}
	
	function index() {
		$modelName = D('Model')->where(array('mdl_table'=>strtolower(CONTROLLER_NAME)))->getField('mdl_name');
		$block = new \Com\Qinjq\Block\SAdminListBlock();
		$block->param('tableClass','table table-hover');
    	$block =  $block->getContent();
		$this->display('Default/index',array('table'=>$block,'modelName'=>$modelName));
	}
	
	protected function display($templateFile='',$charset='',$contentType='',$content='',$prefix='') {
		if (is_array($charset) or is_object($charset)) {
			$this->assign($charset);
			$charset = '';
		}elseif (is_array($templateFile) or is_object($templateFile)){
			$this->assign($templateFile);
			$templateFile='';
		}
		parent::display($templateFile,$charset,$contentType,$content,$prefix);
	}
}