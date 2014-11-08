<?php
namespace Dev\Controller;
use Dev\Controller\DevController;

class FormController extends DevController{
	
	
    /*public function index(){
    	$m = D('Form');
    	$searchStr = I('get.searchStr');
    	if ($searchStr) {
    		$m->where(array(
    			'_complex'=>array(
    				'frm_title'	=>	array('LIKE',"%$searchStr%"),
    				'frm_table'	=>	array('LIKE',"%$searchStr%"),
    				'frm_id'	=>	$searchStr,
    				'_logic' => 'or',
    			)
    		));
    	}
    	$data = $m->select();
    	$this->display(array('lists'=>$data));
    }*/
}