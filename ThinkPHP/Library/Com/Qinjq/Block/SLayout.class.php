<?php

/**
 * 布局
 * @author lukeqin
 *
 */
namespace Com\Qinjq\Block;

use Think\Hook;

class SLayout {
	
	/**
	 * 显示的区域
	 * @var array
	 */
	private static $regions	=	array();
	
	private static $addedBlock = array();
	
	private static $inited = false;
	
	static function init() {
		if (self::$inited) {
			return FALSE;
		}
		self::$inited = TRUE;
		$arrSiteIds = getSiteIds();
		$blocks =  D('Block')->where(array('sit_id'=>array('in',$arrSiteIds),'blk_status'=>1))/*->cache()*/->select();
		if ($blocks) {
			foreach ($blocks as $value) {
				if (isExecutable($value,'blk_')){
					self::addBlock($value);
				}
			}
		}
	}
	
	static function getContent($region) {
		self::init();
		$ret = '';
		if (!empty(self::$regions[$region])) {
			$blocks = self::$regions[$region];
			usort($blocks, function($a,$b){
				$aW = $a->blk_weight;
				$bW = $b->blk_weight;
				if ($aW==$bW){
					return 0;
				}
				return $aW<$bW?-1:1;
			});
			foreach ($blocks as $block){
				if ($block->content) {
					$blockContent=	$block->content;
				}else {
					$blockContent=	$block->getContent();
					$eventParam	=	array('block'=>$block,'content'=>&$blockContent);
					Hook::listen('BLOCK_REND',$eventParam);
				}
				$ret .= $blockContent;
			}
		}
		return $ret;
	}
	
	static function addBlock($block) {
		self::init();
		if (is_string($block)) {
			//通过唯一标识符添加区块;
			if (isset(self::$addedBlock[$block])) {
				return true;
			}else {
				$block = D('Block')->cache()->where(array('blk_identify'=>$block))->find();
			}
		}
		if (is_array($block)) {
			if($block['blk_dependence']){
				$dep = sexplode($block['blk_dependence']);
				foreach ($dep as $identify){
					self::addBlock($identify);
				}
			}
			$block = self::createBlock($block);
		}
		if (is_object($block)) {
			self::$regions[$block->blk_region][$block->blk_identify]	=	$block;;
			return TRUE;
		}
		return TRUE;
	}
	
	private static function createBlock(array $arr) {
		$blockCls	=	'Com\Qinjq\Block\S'.ucfirst($arr['blk_type']).'Block';
		self::$addedBlock[$arr['blk_identify']] = true;
		return new $blockCls($arr);
	}
}