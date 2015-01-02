<?php
namespace Dev\Controller;
use Dev\Controller\DevController;

class IndexController extends DevController{
    public function index(){
    	$this->display();
    }
    
    function test() {
    	echo APP_PATH,__APP__,',',__ROOT__,MODULE_NAME;
    }
}