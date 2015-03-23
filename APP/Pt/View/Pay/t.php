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
		
	<button id="t" class="btn btn-primary">click</button>

		
	<script type="text/javascript" src="<?php echo $rootPath;?>/js/jquery.min.js"></script>
	<script type="text/javascript">
		$('#t').click(function(){
			alert(1111);
		});</script>


	</body>
</html>