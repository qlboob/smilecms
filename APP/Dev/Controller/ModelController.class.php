<?php
namespace Dev\Controller;
use Dev\Controller\DevController;

class ModelController extends DevController{
	
	
	function add() {
		if (IS_GET) {
			parent::add();
		}else {
			$modelModel	=	D('Model');
			$modelFieldModel = D('ModelField');
			$formModel	=	D('Form');
			$post		=	I('post.');
			if ($post['mdl_parent']) {
				$parentData			=	$modelModel->find($post['mdl_parent']);
				$parentFormId		=	$parentData['frm_id'];
				$post['mdf_name']	=	D($parentData['mdl_table'])->getPk();
				$post['frm_parent']	=	$parentData['frm_id'];
				$parentFormData		=	$formModel->find($parentData['frm_id']);
				$post['frm_table']	=	implode(',', sexplode($parentFormData.','.$post['mdl_table']));//加入其它父表单
				$autoInc			=	'';
			}else {
				$post['frm_table']	=	$post['mdl_table'];
				$autoInc			=	'AUTO_INCREMENT';
			}
			$post['frm_title']		=	$post['mdl_name'];
			$formModel->create($post);
			$post['frm_id']			=	$formModel->add();
			
			if (empty($post['mdl_parent'])) {
				//增加表单字段
				$formfieldData	=	array(
					'ffd_name'	=>	$post['mdf_name'],
					'frm_id'	=>	$post['frm_id'],
					'ffd_type'	=>	'Hidden',
				);
				D('Formfield')->add($formfieldData);
			}
			$modelModel->create($post);
			//增加模型
			$post['mdl_id']	=	$modelModel->add();
			//增加模型字段
			$modelFieldModel->create($post);
			$modelFieldModel->add();
			//创建数据表
			$tablePre = D('Site')->where(array('sit_id'=>$post['sit_id']))->getField('sit_table_pre');
			$sql	=	"
				CREATE TABLE `{$tablePre}{$post['mdl_table']}` (
					`{$post['mdf_name']}` int unsigned NOT NULL {$autoInc} PRIMARY KEY
				) DEFAULT CHARSET=utf8
			";
			$modelModel->execute($sql);
			$this->redirect('Dev/Modelfield/add',array('mdl_id'=>$post['mdl_id']));
		}
	}
}