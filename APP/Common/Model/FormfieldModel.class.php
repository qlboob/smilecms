<?php

namespace Common\Model;


class FormfieldModel extends SysModel{
	
	protected $checkboxValidatorType = array('required','exisit','unique');
	
	protected $inputValidatorType = array('maxlength','minlength','min','max');
	
	protected $reg	=	array('ip','date','email','integer','number','url','regular');
	
	protected $validatorKey = 'validator';
	
	//处理表单字段的表单
	function addOrEditWithValidator($data) {
		//处理以前的参数
		$paramKey = 'param';
		if (!empty($data['ffd_id'])) {
			$fieldParam = $this->where("ffd_id={$data['ffd_id']}")->getField('ffd_param');
			if ($fieldParam) {
				$fieldParam = unserialize($fieldParam);
			}
		}
		empty($fieldParam)	&& $fieldParam	=	array();
		if (!empty($data[$paramKey])) {
			foreach ($data[$paramKey] as $k =>$v){
				$fieldParam[$k] = $v;
			}
		}
		
		//保存字段信息
		$fieldData	=	array_merge($data,array('ffd_param'=>serialize($fieldParam)));
		foreach ($fieldData as $k => $v) {
			if (is_array($v)) {
				unset($fieldData[$k]);
			};
		}
		$this->create($fieldData);
		if (!empty($data['ffd_id'])) {
			$this->save();
			$fieldId	=	$data['ffd_id'];
		}else {
			$fieldId	=	$this->add();
		}
		
		//验证器
		$validatorKey = $this->validatorKey;
		$validatorModel=	D('Formvalidator');
		foreach ($this->checkboxValidatorType as $v){
			#处理checkbox类型的验证器
			$where = array(
				'ffd_id'	=>	$fieldId,
				'fvd_type'	=>	$v,
				'frm_id'	=>	$data['frm_id'],
			);
			if (empty($data[$validatorKey][$v])) {
				$validatorModel->where($where)->delete();
			}else {
				if (!$validatorModel->where($where)->find()) {
					$validatorModel->add($where);
				}
			}
		}
		//正则
		$reg	=	$this->reg;
		if (''===$data[$validatorKey]['reg']||('custom'===$data[$validatorKey]['reg']&&''===$data[$validatorKey]['regular'])) {
			//不使用正则
			$validatorModel->where(array('fvd_type'=>array('in',$reg),'ffd_id'=>$fieldId))->delete();
		}else {
			$existRegularValidator=$validatorModel->where(array('fvd_type'=>array('in',$reg),'ffd_id'=>$fieldId))->find();
			if($existRegularValidator){
				if ('custom'===$data[$validatorKey]['reg']) {
					$validatorModel->fvd_type='regular';
					$validatorModel->fvd_target=$data[$validatorKey]['regular'];
				}else {
					$validatorModel->fvd_type=$data[$validatorKey]['reg'];
				}
				$validatorModel->save();
			}else {
				$validatorModel->add(array(
						'ffd_id'=>$fieldId,
						'fvd_type'=>'custom'===$data[$validatorKey]['reg']?'regular':$data[$validatorKey]['reg'],
						'fvd_target'=>$data[$validatorKey]['regular'],
						'frm_id'	=>	$data['frm_id'],
				));
			}
		}
		//其它参数形式
		$input		=	$this->inputValidatorType;
		foreach ($input as $v){
			$inputWhere = array('fvd_id'=>$fieldId,'fvd_type'=>$v);
			if (empty($data[$validatorKey][$v])) {
				$validatorModel->where($inputWhere)->delete();
			}else {
				//如果存在该验证器，则修改
				if ($validatorModel->where($inputWhere)->find()) {
					$validatorModel->fvd_target=$data[$validatorKey][$v];
					$validatorModel->save();
				}else {
					$validatorModel->add(array(
							'ffd_id'=>$fieldId,
							'fvd_type'=>$v,
							'fvd_target'=>$data[$validatorKey][$v],
							'frm_id'=>$data['frm_id'],
					));
				}
			}
		}
	}
	
	function getAssignData($id) {
		$data = $this->find($id);
		if ($data['ffd_param']) {
			$data['ffd_param']	=	unserialize($data['ffd_param']);
		}
		
		$validators = D('Formvalidator')->where(array('ffd_id'=>$id))->select();
		if ($validators) {
			$validator	=	array();
			foreach ($validators as $v){
				$validatorType = $v['fvd_type'];
				if (in_array($validatorType, $this->checkboxValidatorType)) {
					$validator[$validatorType] = 1;
				}elseif (in_array($validatorType, $this->inputValidatorType)){
					$validator[$validatorType] = $v['fvd_target'];
				}elseif (in_array($validatorType, $this->reg)){
					if ('regular'==$validatorType) {
						$validator['reg']	=	'custom';
						$validator['regular']=	$v['fvd_target'];
					}else {
						$validator['reg']	=$validatorType;
					}
				}
			}
			$data[$this->validatorKey] = $validator;
		}
		return $data;
	}
}