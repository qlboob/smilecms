<?php
namespace Dev\Controller;
use Dev\Controller\DevController;

class ParamController extends DevController{
    public function index(){
    	$this->display();
    }
    
    function edit() {
    	$table = i('get.table');
    	$table = ucfirst($table);
    	$id = i('get.id');
    	$model = D($table);
    	$fields = $model->getDbFields();
    	foreach ($fields as $field){
    		if ('_param'==substr($field, -6)) {
    			$col = $field;
    		}
    	}
		if (IS_GET) {
			$data = $model->find($id);
			$this->editDisplay($data?$data[$col]:'');
		}else {
			$param = i('post.param');
			$ret = array();
			if ($param) {
				for ($i=0,$len=count($param['key']);$i<$len;$i++){
					$key	=	$param['key'][$i];
					$value	=	$param['value'][$i];
					if ('' === $key) {
						continue;
					}
					$ret[$key] = $value;
				}
			}
			if (empty($ret)) {
				$ret= '';
			}else {
				$ret = serialize($ret);
			}
			$model->save(array($model->getPk()=>$id,$col=>$ret));
			$this->editDisplay($ret);
		}
		
    }
    
    private function editDisplay($data,$template=''){
    	$lines = array(
    		''=>'',
    	);
    	if ($data) {
    		$lines = unserialize($data);
    	}
		$showData = array('lists'=>$lines);
		if ( $template ) {
			$this->display($template,$showData);
		}else{
			$this->display($showData);
		}
    }

	function ser( ){
		$table = i('get.table');
		$id = i('get.id');
		$col = i('get.col');
		$model = D(ucfirst($table));
		if ( IS_GET ) {
			$data = $model->find($id);
			$this->editDisplay($data?$data[$col]:'','edit');
		}else{
			$param = i('post.param');
			$result = array();
			if ( $param ) {
				for($i=0,$len=count($param['key']);$i<$len;++$i){
					$key = $param['key'][$i];
					$value = $param['value'][$i];
					if ( '' ===$key ) {
						continue;
					}
					$result[$key] = $value;
				}
			}
			if ( empty($result) ) {
				$ret='';
			}else{
				$ret = serialize($result);
			}
			$model->save(array(
				$model->getPk()	=> $id,
				$col => $ret,
			));
			$this->editDisplay($ret,'edit');
		}

	}
}
