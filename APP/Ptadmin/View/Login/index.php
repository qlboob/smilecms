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
<div class="form-group">
<input type="text" name="name" class="form-control" placeholder="请输入用户名"/>
</div>
<div class="form-group">
<input type="password" name="password" class="form-control" placeholder="请输入密码"/>
</div>          
</div>
<div class="footer">                                                               
<button type="submit" class="btn bg-olive btn-block">登录</button>  
</div>
</form>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>