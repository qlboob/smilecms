<!DOCTYPE html>
<html class="bg-black">
<head>
<meta charset="UTF-8">
<title>管理员登录</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
			<link href="<?php echo __ROOT__;?>/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
			<link href="<?php echo __ROOT__;?>/skin/adminlte/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
			<link href="<?php echo __ROOT__;?>/skin/adminlte/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>
<body class="bg-black">
<div class="form-box" id="login-box">
<div class="header">登录</div>
<form action="?" method="post">
<div class="body bg-gray">
					<img src="<?php echo U('Wcadmin/Login/qrcode');?>" id="qrcodeimg" />
</div>
</form>
</div>
		<script src="<?php echo __ROOT__;?>/js/jquery.min.js"></script>
		<script src="<?php echo __ROOT__;?>/skin/wcadmin/js/login.js"></script>
</body>
</html>