<?php
namespace Pt\Controller;
use Think\Controller;
class IndexController extends Controller {
	
	private $cookie;
	
	function _initialize() {
		$this->cookie=$cookie = new \Com\Qinjq\Wechat\SCookie();
		$openId = $cookie->getOpenId();
		$wx = new \Com\Qinjq\Wechat\SWechat(C('wx'));
		if (isset($_GET['code'])) {
			$info = $wx->getOauthAccessToken();
			$openId = $info['openid'];
			$cookie->setOpenId($openId);
			$uid = D('Wxuser')->openid2uid($openId);
			$cookie->setUid($uid);
			$cookie->write();
		}
		if (!$openId) {
			$jumpUrl = $wx->getOauthRedirect('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'','snsapi_base');
			header("Location: $jumpUrl");
			exit();
		}
		if (!empty($_SESSION['usr_state'])) {
			$userInfo = D('User')->find($cookie->getUid());
			if ($userInfo) {
				$_SESSION['usr_state'] = $userInfo['usr_state'];
				$_SESSION['usr_pay'] = $userInfo['usr_pay'];
				$_SESSION['ugp_id'] = $userInfo['ugp_id'];
			}
		}
	}
	
    public function index(){
    	
    }
    
    
    /**
     * 发布求购
     */
    function publish() {
    	if (isset($_SESSION['usr_state'])) {
    		if (0==$_SESSION['usr_state']) {
    			$this->error('你的资料正在审核，审核后方能发布信息');
    		}
    	}
    	if (IS_GET) {
    		$this->display();
    	}else {
    		$data = $this->_keyFilter($data, array('ifm_title','ifm_desc','ifm_tel','ift_id'));
    		$userGroup2type = array(
    			4=>1,
    			3=>2,
    				
    		);
    		$data['ifm_type']=$userGroup2type[$_SESSION['ugp_id']];
    		$data['usr_id']=$this->cookie->getUid();
    		$infoId = D('Information')->add($data);
    		if (!empty($_POST['wxid'])) {
    			$pic = array();
    			foreach ($_POST['wxid'] as $pid){
    				$pic[] = array(
    					'ifp_wxid'=>$pid,
    					'ifm_id'=>$infoId,
    				);
    			}
    			D('Infopic')->addAll($pic);
    		}
    		$this->success('发布功能，等待审核');
    	}
    }
    
    /**
     * 查看求购
     */
    function view() {
    	$info = D('Infomation')->find($_GET['id']);
    	$picList = D('Infopic')->where(array('ifm_id'=>$info['ifm_id']))->select();
    	$this->assign(array(
    		'data'=>$info,
    		'piclist'=>$picList,
    	));
    	$this->display();
    }
    
    /**
     * 求购列表
     */
    function lists() {
    	;
    }
    
    /**
     * 注册
     */
    function register() {
    	if (isset($_SESSION['usr_state'])) {
    		if (0==$_SESSION['usr_state']) {
    			$this->success('你的资料正在审核');
    		}else {
    			$this->error('你已经注册过了');
    		}
    	}
    	if (IS_GET) {
    		$this->display();
    	}else {
    		$allow = array(
    			'usr_realname','usr_tel','usr_company','usr_address',
    		);
    		$data = $this->_keyFilter($_POST, $allow);
    		$data['usr_name'] = 'wx_';
    		$data['usr_name'] .= $this->cookie->getOpenId();
    		$data['usr_id']=$this->cookie->getUid();
    		if (!in_array($data['ugp_id'], array(2,3,4))) {
    			return;
    		}
    		if(D('User')->add($data)){
    			$this->display('registersuccess');
    		}else {
    			$this->display('registererror');
    		}
    	}
    }
    
    private function _keyFilter($data,$keys) {
    	$ret = array();
    	foreach ($keys as $k){
    		if (isset($data[$k])) {
    			$ret[$k] = $data[$k];
    		}
    	}
    	return $ret;
    }
}