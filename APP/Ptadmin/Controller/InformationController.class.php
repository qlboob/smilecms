<?php

namespace Ptadmin\Controller;
#TODO Del
// include_once __dir__.'/PtadminController.class.php';
// use Ptadmin\Controller\PtadminController;
class InformationController extends PtadminController{
	
	
	protected function _bd_edit($eventParam) {
		$id = $eventParam->data['ifm_id'];
		$picLists = D('Infopic')->where(array('ifm_id'=>$id))->select();
		if ($picLists) {
			$html = '';
			foreach ($picLists as $v){
				$html .= <<<EOF
				<img src="{$v['ifm_path']}" />
EOF;
			}
			$eventParam->data['picList'] = $picLists;
		}else {
			$eventParam->data['picList'] = '无图片';
		}
	}
}
