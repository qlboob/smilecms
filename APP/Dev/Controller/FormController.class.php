<?php
namespace Dev\Controller;
use Dev\Controller\DevController;

class FormController extends DevController{
	
	
    public function index(){
    	$m = D('Form');
    	$data = $m->select();
    	$this->display(array('lists'=>$data));
    }
}