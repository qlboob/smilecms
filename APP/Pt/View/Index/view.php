<?php $htmlHeadTitle='求购详情';?>

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
		<h3><?php echo htmlspecialchars($data["ifm_title"]);?></h3>
		<?php if($piclist){?>
			<?php foreach($piclist as $k=>$v){?>
				<div class="row">
					col-sm-12
						<div class="thumbnail">
							<img src="<?php echo $rootPath;?>/upload/img/<?php echo $v["ifp_path"];?>" />
						</div>
				</div>
			<?php }?>
		<?php }?>
		<?php if(1==$_SESSION['usr_pay']){?>
			<p class="lead">联系电话：<?php echo htmlspecialchars($data["ifm_tel"]);?></p>
		<?php }else{ ?>
			<p class="lead">联系电话：只有付费用户可见联系电话</p>
		<?php }?>
		<p class="lead"><?php echo htmlspecialchars($data["ifm_desc"]);?></p>
	</div>

		

	</body>
</html>