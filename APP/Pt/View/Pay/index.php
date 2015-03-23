<?php $htmlHeadTitle='开通会员';?>


<?php $rootPath= __ROOT__;?>
<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title><?php echo htmlspecialchars($htmlHeadTitle);?></title>
		<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" />
		
	</head>
	<body>
		
	<div class="container-fluid">
		<div class="row">
			<div class="jumbotron">
				<h1>开通会员，支付<strong>998.00元</strong></h1>
				<p>开通会员后可以看到求购信息中的联系电话。</p>
				<p><button id="paynow" class="btn btn-primary btn-lg">立即支付
</button>
				</p>
			</div>
		</div>
	</div>

		
	<script type="text/javascript" src="<?php echo $rootPath;?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
		$json = array('jsPayParam'=>$jsPayParam);
		__initData = <?php echo json_encode($json);?>;
	</script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/skin/pt/js/pay.js"></script>


	</body>
</html>