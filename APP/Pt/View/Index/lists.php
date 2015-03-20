<?php $htmlHeadTitle='求购信息列表';?>

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
		<div class="panel">
			<div class="panel-body">
				<?php foreach($typeLists as $k=>$v){?>
					<a href="<?php echo U(MODULE_NAME.'/'.CONTROLLER_NAME.'/lists',array('typeid'=>$k));?>"><span class="label label-info"><?php echo htmlspecialchars($v);?></span></a>
				<?php }?>
			</div>
		</div>
		<?php if($lists){?>
			<ul class="list-unstyled">
				<?php foreach($lists as $k=>$v){?>
					<li>
						<a href="<?php echo U(MODULE_NAME.'/'.CONTROLLER_NAME.'/view',array('id'=>$v['ifm_id']));?>"><?php echo htmlspecialchars($v["ifm_title"]);?></a>
					</li>
				<?php }?>
			</ul>
		<?php }else{ ?>
			<div class="alert alert-danger" role="alert">暂时没有求购信息</div>
		<?php }?>
		<?php if($page){?>
			<div class="pull-right"><?php echo $page;?>
</div>
		<?php }?>
	</div>

		

	</body>
</html>