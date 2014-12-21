<?php
namespace Dev\Controller;
use Dev\Controller\DevController;

class ModelfieldController extends DevController{
	
	function add() {
		if (IS_GET) {
			parent::add();
		}else {
			//初始化变量
			$modelFieldM	=	D('Modelfield');
			$formFieldM		=	D('Formfield');
			$modelM			=	D('Model');
			$siteM			=	D('Site');
			$post			=	I('post.');
			$modelData		=	$modelM->find($post['mdl_id']);
			$siteData		=	$siteM->find($modelData['sit_id']);
			$post['mdf_name']=	$post['ffd_name'];
			$post['frm_id']	=	$modelData['frm_id'];
			
			//增加表字段（更改数据库表结构）
			$table		=	$siteData['sit_table_pre'].$modelData['mdl_table'];
			$datatype	=	$post['mdl_datatype'];
			$isNull		=	isset($post['validator']['required'])?'NOT NULL':'NULL';
			$defaultVal	=	$post['param']['defaultValue']?"DEFAULT '{$post['param']['defaultValue']}'":'';
			$unsigned	=	''!==$post['validator']['min'] && $post['validator']['min']>=0 && (''===$post['validator']['max'] || $post['validator']['max']>0)?'UNSIGNED':'';
			$sql		=	"ALTER TABLE `$table` ADD `{$post['ffd_name']}` $datatype $unsigned $isNull $defaultVal";
			if($post['validator']['unique']){ //增加唯一索引
				$sql	.=	",ADD UNIQUE(`{$post['mdf_name']}`)";
			}
			if(FALSE===$modelFieldM->execute($sql)){
				$this->error('增加表字段失败');
			}
			#插入模型字段
			$modelFieldM->create($post);
			if(!$modelFieldM->add()){
				$this->error('插入模型字段失败');
			}
			#增加表彰字段
			$formFieldM->addOrEditWithValidator($post);
			
			$this->success('ok');
		}
	}
}