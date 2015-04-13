<?php $rootPath= __ROOT__;$json = array('sign'=>$sign);?>
<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>测试</title>
		<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" />
		
	</head>
	<body>
		<br />
		<button id="mybtn">he</button>
		<canvas class="" id="c"></canvas>
		<div id="show"></div>
		<br />
		<img id="nop" src="" />
		<script type="text/javascript">
		__initData = <?php echo json_encode($json);?>;
	</script>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/skin/wc/js/test.js"></script>


	</body>
</html>