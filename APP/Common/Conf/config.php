<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'=> 'mysql'.(function_exists('mysqli_close')?'i':''),
	'DB_HOST'=>'127.0.0.1',
	'DB_NAME'               =>  'scms',          // 数据库名
	'DB_USER'               =>  'root',      // 用户名
	'DB_PWD'                =>  'root',          // 密码
	'DB_PREFIX'             =>  'smcs_',
	
	'TMPL_TEMPLATE_SUFFIX'  =>  '.php',     // 默认模板文件后缀
	'TMPL_FILE_DEPR'        =>  '/', //模板文件CONTROLLER_NAME与ACTION_NAME之间的分割符
	'TMPL_ENGINE_TYPE'      =>  'PHP',     // 默认模板引擎 以下设置仅对使用Think模板引擎有效
	'SYS_DB_PREFIX'				=>	's_',
	'DEFAULT_FILTER'		=>	'',
	
	#微信配置
	'wx'=>array(
		'token'=>'secretToken_',
		'encodingaeskey'=>'',
		'appid'=>'wxa3b1cf1802694830',
		'appsecret'=>'68a64399ede2a99e89f9a2222607a866',	
	),
);