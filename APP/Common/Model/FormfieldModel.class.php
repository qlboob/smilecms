<?php

namespace Common\Model;


class FormfieldModel extends SysModel{
	
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
		if (!empty($data['ffd_id'])) {
			$this->save($fieldData);
			$fieldId	=	$data['ffd_id'];
		}else {
			$fieldId	=	$this->add($fieldData);
		}
		
		//验证器
		$validatorKey = 'validator';
		$validatorModel=	D('Formvalidator');
		$checkbox = array('required','exisit');#处理checkbox类型的验证器
		foreach ($checkbox as $v){
			$where = array(
				'ffd_id'	=>	$fieldId,
				'ffd_type'	=>	$v,
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
		$reg	=	array('ip','date','email','integer','number','url','regular');
		if (''===$data[$validatorKey]['reg']||('custom'===$data[$validatorKey]['reg']&&''===$data[$validatorKey]['regular'])) {
			//不使用正则
			$validatorModel->where(array('ffv_type'=>array('in',$reg),'ffd_id'=>$fieldId))->delete();
		}else {
			$existRegularValidator=$validatorModel->where(array('ffv_type'=>array('in',$reg),'ffd_id'=>$fieldId))->find();
			if($existRegularValidator){
				if ('custom'===$data[$validatorKey]['reg']) {
					$validatorModel->ffv_type='regular';
					$validatorModel->ffv_target=$data[$validatorKey]['regular'];
				}else {
					$validatorModel->ffv_type=$data[$validatorKey]['reg'];
				}
				$validatorModel->save();
			}else {
				$validatorModel->add(array(
						'ffd_id'=>$fieldId,
						'ffv_type'=>'custom'===$data[$validatorKey]['reg']?'regular':$data[$validatorKey]['reg'],
						'ffv_target'=>$data[$validatorKey]['regular'],
				));
			}
		}
		//其它参数形式
		$input		=	array('maxlength','minlength','min','max');
		foreach ($input as $v){
			$inputWhere = array('ffd_id'=>$fieldId,'ffv_type'=>$v);
			if (empty($data[$validatorKey][$v])) {
				$validatorModel->where($inputWhere)->delete();
			}else {
				//如果存在该验证器，则修改
				if ($validatorModel->where($inputWhere)->find()) {
					$validatorModel->ffv_target=$data[$validatorKey][$v];
					$validatorModel->save();
				}else {
					$validatorModel->add(array(
							'ffd_id'=>$fieldId,
							'ffv_type'=>$v,
							'ffv_target'=>$data[$validatorKey][$v]
					));
				}
			}
		}
	}
}