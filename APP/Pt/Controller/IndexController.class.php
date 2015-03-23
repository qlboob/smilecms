<?php
namespace Pt\Controller;
use Think\Page;
class IndexController extends WcpageController {
	
	private $cookie;
	
	private $userGroupSeeType = array(
		2 => 4,#工厂看
		3 => 2,#原材料供应商看
	);
	
    
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
    		$wx = new \Com\Qinjq\Wechat\SWechat(C('wx'));
    		$sign = $wx->getJsSign('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    		$this->assign('sign',$sign);
    		$this->display();
    	}else {
    		$data = $this->_keyFilter($_POST, array('ifm_title','ifm_desc','ifm_tel','ift_id'));
    		$data['ugp_id']=$_SESSION['ugp_id'];
    		$data['usr_id']=$this->cookie->getUid();
    		$data['ifm_ctime'] = time();
    		$infoId = D('Information')->add($data);
    		if (!empty($_POST['wxid'])) {
    			$pic = array();
    			foreach ($_POST['wxid'] as $pid){
    				$pic[] = array(
    					'wxi_imgid'=>$pid,
    					'ifm_id'=>$infoId,
    				);
    			}
    			D('Wximg')->addAll($pic);
    		}
    		$this->success('发布功能，等待审核');
    	}
    }
    
    /**
     * 查看求购
     */
    function view() {
    	$info = D('Information')->where(array('ifm_id'=>$_GET['id']))->find();
    	if (0==$info['ifm_state']) {
    		#未审核不能查看
    		return;
    	}
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
    	$infotype = $this->userGroupSeeType[$_SESSION['ugp_id']];
    	if (!$infotype) {
    		$this->error('你不用查看求购信息');
    	}
    	$where = array(
    		'ugp_id'=>$infotype,
    		'ifm_state'=>1,
    		'ifm_ctime'=>array('gt',time()-3600*24*4),
    	);
    	$model = D('Information');
    	if (!empty($_GET['typeid'])) {
    		$where['ift_id'] = $_GET['typeid'];
    	}
    	//分页
    	$cnt = $model->where($where)->count();
    	if ($cnt) {
    		$this->assign('cnt',$cnt);
//     		$cnt=500;
    		$page = new Page($cnt,20);
	    	$lists = $model->where($where)->order('ifm_ctime DESC')->limit($page->firstRow,$page->listRows)->select();
	    	$this->assign('lists',$lists);
	    	$this->assign('page',$page->show());
    	}
    	
    	$typeLists = D('Infotype')->getField('ift_id,ift_name');
    	$this->assign('typeLists',$typeLists);
    	
    	$this->display();
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
    			'usr_realname','usr_tel','usr_company','usr_address','ugp_id'
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
    
    protected function _keyFilter($data,$keys) {
    	$ret = array();
    	foreach ($keys as $k){
    		if (isset($data[$k])) {
    			$ret[$k] = $data[$k];
    		}
    	}
    	return $ret;
    }
}