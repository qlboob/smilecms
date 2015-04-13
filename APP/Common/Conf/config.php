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
		//正式
		'appid'=>'wxa0728c2c4ceffcc6',
		'token'=>'qw12mnbiihToken',
		'appsecret'=>'8497a23972ca8927866f30c37b47e622',
		'encodingaeskey'=>'vuT2nNbomVsCL8QNzhos68FX0fzXLd0d9xABrkrqUDE',
	),
	//支付配置
	'wxpay'=>array(
		'mchid'=>'1236124302',
		'paykey'=>'d9804c3d60061e3ab68eb403516c3920',
	),
	'LOG_LEVEL'=>'DEBUG',
);