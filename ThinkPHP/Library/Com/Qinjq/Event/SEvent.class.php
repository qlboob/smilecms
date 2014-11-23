<?php

namespace Com\Qinjq\Event;


use Think\Hook;
class SEvent{	

	function app_init($params ){
		$siteIds = getSiteIds();
		$tags = D('Event')->where(array(
			'evt_status'=>1,
			'sit_id'=>array('in',$siteIds), 
		))->cache()->field('distinct evt_tag as tag')->select();
		if ( $tags ) {
			foreach($tags as $tag){
				Hook::add($tag['tag'],'Com\Qinjq\Event\SEvent');
			}
		}
		$this->_call(__FUNCTION__,$params);
	}

	function __call($tag,$params){
		$this->_call($tag,$params[0]);
	}
	private function _call($tag,$params) {
		$arrSiteIds = getSiteIds();
		$evts = D('Event')->where(array('sit_id'=>array('in',$arrSiteIds),'evt_status'=>1,'evt_tag'=>$tag))->cache()->select();
		if ($evts) {
			usort($evts, function ($a,$b){
				if ($a['weight'] == $b['weight']) {
					return 0;
				}
				return ($a['weight'] < $b['weight']) ? -1 : 1;
			});
			foreach ($evts as $evt) {
				$clsName = $evt['evt_class'];
				$param = array();
				if ($evt['evt_param']) {
					$param = unserialize($evt['evt_param']);
				}
				$obj = new $clsName($param);
				if (method_exists($obj, $tag)) {
					$obj->$tag($params);
				}else {
					$obj->run($params);
				}
			}
		}
	}
}
