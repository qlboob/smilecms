<?php
namespace Wcadmin\Controller;
use Think\Controller;

class LoginController extends Controller{

	/**
	 * 登录页
	 */
	function index() {
		if (IS_AJAX) {
			$ret = array();
			$model = D('Qrlogin');
			$id = session_id();
			$data = $model->find($id);
			if ($data && $data['usr_id']) {
				$_SESSION['usr_id'] = $data['usr_id'];
				$model->delete($id);
				$ret['code']=0;
				$ret['data'] = array(
					'url'=>U(MODULE_NAME.'/Index/index'),
				);
			}else {
				$ret['code']=1;
			}
			echo json_encode($ret);
		}else {
			$this->display();
		}
	}
	
	/**
	 * 登录二维码图片生成
	 */
	function qrcode() {
		$id = session_id();
		$time = time();
		$model = D('Qrlogin');
		$model->add(array(
			'qrl_id'=>$id,
			'qrl_ctime'=>$time,
		),array(),TRUE);
		require VENDOR_PATH.'phpqrcode/qrlib.php' ;
		\QRcode::png('http://'.$_SERVER['HTTP_HOST'].U('Wc/Index/webqrlogin',array('id'=>$id)),false,QR_ECLEVEL_L,6);
		if (mt_rand(0, 100)>95) {
			#删除过期的二维码
			$model->where('qrl_ctime<'.($time-5*60))->delete();
		}
	}
		
	function s() {
		var_dump($_SESSION);
	}
	
	/**
	 * 微信跳转过来的直接登录
	 */
	function wcjump() {
		$info = D('Qrlogin')->find($_GET['id']);
		if ($info and $info['usr_id']> 0 and time()-10<$info['qrl_ctime']) {
			$_SESSION['usr_id'] = $info['usr_id'];
			$this->redirect(MODULE_NAME.'/Index/index');
		}
	}
}
