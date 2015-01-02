<?php
namespace Dev\Controller;
use Dev\Controller\DevController;

class BlockController extends DevController{
	
	
	function sort() {
		$model = D('Block');
		$lists = $model->where(array('blk_region'=>I('param.region')))->order('blk_weight ASC')->select();
		if (IS_GET) {
			$this->display(array('lists'=>$lists));
		}else {
			foreach (I('param.sorted') as $k=>$id){
				$model->save(array(
					'blk_id'=>$id,
					'blk_weight'=>$k*2,
				));
			}
			echo json_encode(array(
				'code'=>0
			));
		}
	}
}