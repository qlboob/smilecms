<?php
namespace Com\Qinjq\Form\Validator;
use Com\Qinjq\Form\Validator\SValidator;

/**
 * 唯一性验证
 * @author Luke.qin
 *
 */
class SUniqueValidator extends SValidator{
	
	
	protected $message	=	'{$title} {$value}已经存在';
	
	function validate($value,$data) {
		$uniquField	=	$this->getUniqueField();
		if(!empty($uniquField['PRIMARY'])){
			$pkField	=	$uniquField['PRIMARY'];
			unset($uniquField['PRIMARY']);
		}
		$table = $this->getTable();
		if ($table) {
			$model	=	D($table);
			foreach ($uniquField as $column) {
				if (!in_array($this->field, $column))continue;
				$where	=	array();
				foreach ($column as $col){
					$where[$col]	=	isset($this->allValue[$col])?$this->allValue[$col]:NULL;
				}
				$item	=	$model->where($where)->find();
				if (!$item) {
					continue;
				}
				if (isset($pkField)) {
					foreach ($pkField as $pk) {
						if (!isset($data[$pk])||$data[$pk]!=$item[$pk]) {
							return FALSE;
						}
					}
				}else {
					return FALSE;
				}			
			}
		}
		return TRUE;
	}
	
	
	/**
	 * 得到所要验证唯一字段所在的表
	 * @return string
	 */
	protected function getTable() {
		$formId	=	$this->data['_formid'];
		$table	=	D('Form')->where(array('frm_id'=>$formId))->getField('frm_table');
		$table	=	sexplode($table);
		foreach ($table as $tab) {
			$dbField	=	D($tab)->getDbFields();
			if (in_array($this->field, $dbField,TRUE)){
				return $tab;
			}
		}
	}
	
	/**
	 * 得到唯一索引的字段
	 * @return string
	 */
	protected function getUniqueField() {
		$table		=	$this->getTable();
		$okIndex	=	array();
		$find		=	FALSE;
		if ($table) {
			$model		=	D($table);
			$tableName	=	$model->getTableName();
			$index		=	$model->query("SHOW KEYS FROM $tableName");
			foreach ($index as $i){
				if (!$i['Non_unique']){
					$okIndex[$i['Key_name']][]	=	$i['Column_name'];
					$i['Column_name']==$this->field && $find=true;
				}
			}
		}
		$find || $okIndex['no_find_index'][]	=	$this->field;
		return $okIndex;
	}

}