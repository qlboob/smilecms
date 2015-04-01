<?php 
	$htmlHeadTitle='爱车照片';
?>

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
		<?php foreach($lists as $k=>$v){?>
			<div class="row">
				<img src="<?php echo $rootPath;?>/upload/img/<?php echo $v["tdi_path"];?>" style="width:100%" />
			</div>
		<?php }?>
	</div>

		

	</body>
</html>