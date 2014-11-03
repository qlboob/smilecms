<?php
namespace Dev\Controller;
use Dev\Controller\DevController;

class FormfieldController extends DevController{
	
	
    public function index(){
    	$m = D('Formfield');
    	$data = $m->select();
    	$this->display(array('lists'=>$data));
    }
}