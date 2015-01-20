<?php
namespace Wcadmin\Controller;
use Think\Controller;

class CronController extends Controller {

	function runOrder() {
		$lists = D('Order')->where('ord_state=1')->select();
		if ($lists) {
			foreach ($lists as $v){
				D('Order')->effect($v['ord_id']);
			}
		}
	}
	
	function runTodo() {
		D('Todolist')->plan();
	}
}