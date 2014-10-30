<?php

function getSiteIds() {
	$arrSiteIds = array(0);
	$siteId = C('userConfig.siteId');
	if ($siteId) {
		$arrSiteIds[] = $siteId;
	}
	return $arrSiteIds;
}

function SS($name,$fn,$options=null){
	$data = $fn;
	if (is_callable($fn)) {
		$data = $fn();
	}
	S($name,$data,$options);
}

function sexplode($str) {
	$str	=	trim($str,' ,');
	$arr	=	explode(',', $str);
	array_walk($arr, 'trim');
	return array_filter($arr,'strlen');
}

function getPathInfo() {
	$pathInfo	=	C('PATH_INFO');
	if ($pathInfo) return $pathInfo;
	$pathInfo	=	$_SERVER['PATH_INFO'];
	$pathArr	=	explode('/', $pathInfo);
	$pathArr	=	array_filter($pathArr,'strlen');
	$pathArr	=	array_values($pathArr);
	switch (count($pathArr)) {
		case 0: // index page
			$path	=	implode('/', array(GROUP_NAME,MODULE_NAME,ACTION_NAME));
			break;
		case 1:
			if (in_array(strtolower($pathArr[0]), explode(',',strtolower(C('APP_GROUP_LIST'))))) {
				$path	=	implode('/', array($pathArr[0],MODULE_NAME,ACTION_NAME));// only group name in path info
			}else {
				$path	=	$pathArr[0].'/'.ACTION_NAME;// only module name (default group name)
			}
			break;
		case 2:
			if (in_array(strtolower($pathArr[0]), explode(',',strtolower(C('APP_GROUP_LIST'))))) {
				$path	=	implode('/', array(GROUP_NAME,MODULE_NAME,ACTION_NAME));
			}else {
				$path	=	implode('/', $pathArr);
			}
			break;
		default:
			$path	=	implode('/', $pathArr);
			break;
	}
	C('PATH_INFO',$path);
	return $path;
}

/**
 * 是否可执行（事件和区块）
 * @param array $param
 * @return boolean
 */
function isExecutable($param,$pref='') {
	if ($pref) {
		$filterParam = array();
		$len = strlen($pref);
		foreach ($param as $k=>$v){
			if (0===strpos($k, $pref)) {
				$k = substr($k, $len);
			}
			$filterParam[$k] = $v;
		}
		$param = $filterParam;
	}
	$match	=	!empty($param['visibility']);
	$page	=	trim($param['page']);
	$flagPage=	NULL;
	if ($page) {
		$lines	=	preg_split("/\r\n?/", $page,-1,PREG_SPLIT_NO_EMPTY);
		$pathInfo = getPathInfo();
		foreach ($lines as $value) {
			if (FALSE!==($pos=strpos($value, ' '))) { //如果中间有空格，取空格之前的部份
				$value	=	substr($value, 0,$pos);
			}
			$value	=	str_replace(array('*','|'), array('.*?','\|'), $value);
			if (preg_match("|^{$value}|i", $pathInfo)) {
				if ($match){
					$flagPage	=	TRUE; // include the page
				} else {
					$flagPage	=	FALSE;
				}
				break;
			}
		}
	}
	if (is_null($flagPage)) {
		$flagPage	=	!$match;
	}
	$condition	=	!empty($param['and']);
	if ($condition && !$flagPage) {
		return FALSE;
	}elseif (!$condition && $flagPage){
		return TRUE;
	}
	$code		=	trim(!empty($param['php'])?$param['php']:'');
	if ($code) {
		$lambda		=	createFunction($code,array('return'=>1));//用creat_function来避免语法错误
		$flagCode	=	$lambda && $lambda();
		return $condition?$flagCode && $flagPage:$flagCode || $flagPage;
	}
	return $flagPage;
}


/**
 * 得到代码所产生的函数名
 * @param string $code 代码
 * @param array $param 相关参数
 * @return boolean|string
 */
function createFunction($code,$param=array()) {
	$code	=	trim($code);
	if(empty($code)){
		return FALSE;
	}
	if(FALSE===stripos($code, 'return') && !empty($param['return'])){
		$code	=	"return $code";
	}
	if (!in_array(substr($code, -1), array(';','}'))) {
		$code	.=	';';
	}
	return create_function(empty($param['arg'])?'':$param['arg'], $code);
}