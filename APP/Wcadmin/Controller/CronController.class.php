<?php
namespace Wcadmin\Controller;
use Think\Controller;

class CronController extends Controller {

	/**
	 * 订单生效
	 */
	function runOrder() {
		$lists = D('Order')->where('ord_state=1')->select();
		if ($lists) {
			foreach ($lists as $v){
				D('Order')->effect($v['ord_id']);
			}
		}
	}
	
	/**
	 * 安排任务
	 */
	function runTodo() {
		D('Todolist')->plan();
	}
	
	/**
	 * 关闭同一个人的订单,有的订单已经支付了的情况
	 */
	function closeSameOrder() {
		$orderM = D('Order');
		$lists = $orderM->where(array('ord_state'=>array('gt',0),'ord_mtime'=>array('gt',time()-24*3600)))->select();
		if (!$lists) {
			return;
		}
		$time = time();
		$between = array($time-12*3600,$time-2*3600);
		foreach ($lists as $v){
			$orderM->where(array('ord_state'=>0,'ord_mtime'=>array('between',$between),'usr_id'=>$v['usr_id']))->save(array('ord_state'=>-1));
		}
	}
	
	/**
	 * 用户过期
	 */
	function usertimeout() {
		$time = time();
		
		$carM = D('Car');
		$UserM = D('User');
		#设置车的状态
		$carM->where('car_endtime<'.$time)->save(array('car_state'=>0));
		#前三天过期的查询出来
		$userIds = $carM->where(array('car_endtime'=>array('between',array($time-3*24*3600,$time))))->getField('usr_id');
		if ($userIds) {
			$userIds = array_unique($userIds);
			foreach ($userIds as $uid){
				if (!$carM->where(array('usr_id'=>$uid,'car_state'=>1))->find()) {
					#如果没有其它车的情况 下，直接改用户组
					$UserM->where(array('usr_id'=>$uid,'upg_id'=>4))->save(array('upg_id'=>5));
				}
			}
		}
	}
	
	function sendMsgComplete() {
		$today = strtotime('today');
		$lists = D('Todolist')->where("tdl_state=1 AND tdl_ctime>=$today ")->select();
		$wx = new \Com\Qinjq\Wechat\SWechat(C('wx'));
		$todoimgM = D('Todoimg');
		$wxuserM = D('Wxuser');
		$carM = D('Car');
		if (!$lists) {
			return FALSE;
		}
		foreach ($lists as $v){
			$imgLists = $todoimgM->where("tdl_id={$v['tdl_id']} and tdi_retry<5")->select();
			$mimeMap = array(
				'image/jpeg'=>'jpg',
				'image/jpg'=>'jpg',
				'image/png'=>'png',
				'image/bmp'=>'bmp',
			);
			$sendMsg = TRUE;
			if(!$imgLists){
				continue;
			}
			foreach ($imgLists as $imgInfo){
				if ($imgInfo['tdi_path']) {
					continue;
				}
				$content = $wx->getMedia($imgInfo['tdi_id']);
				if ($content) {
					$ext = $mimeMap[$wx->lastHttpStatus['content_type']];
					$filename = uniqid('wximg_').'.'.$ext;
					$filePath = THINK_PATH.'../upload/img/'.$filename;
					file_put_contents($filePath, $content);
					$todoimgM->save(array(
						'tdi_path'=>$filename,
						'tdi_id'=>$imgInfo['tdi_id'],
					));
				}else {
					$sendMsg = FALSE;
					++$imgInfo['tdi_retry'];
					$todoimgM->save($imgInfo);
				}
			}
			if ($sendMsg) {
				$uid = $carM->where("car_id={$v['car_id']}")->getField('usr_id');
				$openId = $wxuserM->where("usr_id={$uid}")->getField('wx_id');
				#发送微信模板消息;
				$result = $wx->sendTemplateMessage(array(
					'template_id'=>'VLPCdrIqtXlL9iEOCDxkQ8VLTzqPPt2BJ54k85-EOiE',
					'touser'=>$openId,
					'url'=>'http://'.$_SERVER['HTTP_HOST'].U('Wc/Index/view',array('id'=>$v['tdl_id'])),
					'topcolor'=>'#FF0000',
					'data'=>array(
						'name'=>array(
							'value'=>'张某',
							'color'=>'#173177'
						),
					),
				));
				if ($result) {
					D('Todolist')->where('tdl_id='.$v['tdl_id'])->save(array('tdl_state'=>2));
				}
			}
		}
	}

	/**
	 * 发送洗车完成的消息（无图片）
	 */
	function sendWashComplete(){
		$today = strtotime('today');
		$lists = D('Todolist')->where("tdl_state=1 AND tdl_ctime>=$today ")->select();
		$wx = new \Com\Qinjq\Wechat\SWechat(C('wx'));
		$wxuserM = D('Wxuser');
		$carM = D('Car');
		if (!$lists) {
			return FALSE;
		}
		foreach ($lists as $v){
			$uid = $carM->where("car_id={$v['car_id']}")->getField('usr_id');
			$openId = $wxuserM->where("usr_id={$uid}")->getField('wx_id');
			#发送微信模板消息;
			$result = $wx->sendTemplateMessage(array(
				'template_id'=>'VLPCdrIqtXlL9iEOCDxkQ8VLTzqPPt2BJ54k85-EOiE',
				'touser'=>$openId,
				//'url'=>'http://'.C('host').U('Wc/Index/view',array('id'=>$v['tdl_id'])),
				'topcolor'=>'#FF0000',
				'data'=>array(
					'name'=>array(
						'value'=>'张某',
						'color'=>'#173177'
					),
				),
			));
			if ($result) {
				D('Todolist')->where('tdl_id='.$v['tdl_id'])->save(array('tdl_state'=>2));
			}
		}
	}
	
	/**
	 * 提醒洗车内
	 */
	function washinner() {
		$wx = new \Com\Qinjq\Wechat\SWechat(C('wx'));
		$wxuserM = D('Wxuser');
		$today = strtotime('today');
		$todoM = D('Todolist');
		$lists = $todoM->where(array('tdl_ctime'=>$today,'apm_id'=>0))->select();
		if (!$lists) {
			return;
		}
		foreach ($lists as $v){
			$lastWash = $todoM->where(array('car_id'=>$v['car_id'],'tdl_ctime'=>array('gt',$today)))->order('tdl_id DESC')->find();
			if ($lastWash and 0==$lastWash['tdl_innerwash']) {
				//TODO 上次也没有洗车内，提醒洗车内;
				$uid = D('Car')->where("car_id={$v['car_id']}")->getField('usr_id');
				$openId = $wxuserM->where("usr_id={$uid}")->getField('wx_id');
				$result = $wx->sendTemplateMessage(array(
					'template_id'=>'VLPCdrIqtXlL9iEOCDxkQ8VLTzqPPt2BJ54k85-EOiE',
					'touser'=>$openId,
					'url'=>'http://'.$_SERVER['HTTP_HOST'].U('Wc/Index/view',array('id'=>$v['tdl_id'])),
					'topcolor'=>'#FF0000',
					'data'=>array(
						'name'=>array(
							'value'=>'张某',
							'color'=>'#173177'
						),
					),
				));
				
			}
		}
	}
	
	/**
	 * 提醒续费
	 */
	function rebuy() {
		$today = strtotime('today');
		$wx = new \Com\Qinjq\Wechat\SWechat(C('wx'));
		$wxuserM = D('Wxuser');
		$lists = D('Car')->where(array('car_endtime'=>$today+3600*24*3))->select();
		if (!$lists) {
			return;
		}
		foreach ($lists as $v){
			$openId = $wxuserM->where("usr_id={$v['usr_id']}")->getField('wx_id');
			$result = $wx->sendTemplateMessage(array(
				'template_id'=>'VLPCdrIqtXlL9iEOCDxkQ8VLTzqPPt2BJ54k85-EOiE',
				'touser'=>$openId,
				'url'=>'http://'.C('HOST').U('Wc/Index/view',array('id'=>$v['tdl_id'])),
				'topcolor'=>'#FF0000',
				'data'=>array(
					'name'=>array(
						'value'=>'张某',
						'color'=>'#173177'
					),
				),
			));
			
		}
	}
	
	function menu() {
		$wx = new \Com\Qinjq\Wechat\SWechat(C('wx'));
		return;
		$data = array(
			'button'=>array(
				array(
					'type'=>'view',
					'name'=>'我要洗车',
					'url'=>'http://'.C('HOST').U('Wc/Index/index'),
				),
			),
		);
		$wx->createMenu($data);
		;
	}
}
