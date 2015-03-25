<?php
namespace Wcadmin\Controller;
use Think\Controller;

class LoginController extends Controller{

	function index() {
		$this->display();
	}
	
	function qrcode() {
		$id = session_id();
		D('Qrlogin')->add(array(
			'rql_id'=>$id,
			'rql_ctime'=>time(),
		),array(),TRUE);
		require VENDOR_PATH.'phpqrcode/qrlib.php' ;
		\QRcode::png('http://'.$_SERVER['HTTP_HOST'].U('Wcadmin/Login/in',array('id'=>$id)),false,QR_ECLEVEL_L,6);
	}
	
	function login() {
		$ret = array();
		$model = D('Qrlogin');
		$id = session_id();
		$data = $model->find($id);
		if ($data && $data['usr_id']) {
			$_SESSION['usr_id'] = $data['usr_id'];
			$model->delete($id);
			$ret['code']=0;
		}else {
			$ret['code']=1;
		}
		echo json_encode($ret);
	}
	
	function in() {
		D('Qrlogin')->save(array(
			'rql_id'=>$_GET['id'],
			'usr_id'=>1,
		));
	}
	function s() {
		var_dump($_SESSION);
	}
}
