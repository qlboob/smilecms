<?php $htmlHeadTitle='套餐';?>



<?php 
	use Com\Qinjq\Block\SLayout;
	foreach(array('head','closure') as $v){
		$regionVar = '_region'.ucfirst($v);
		$$regionVar = SLayout::getContent($v);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php echo $htmlHeadTitle;?></title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<?php echo $_regionHead;?>
		
	</head>
	<body class="skin-blue">
		<header class="header">
			<a class="logo" href="<?php echo U(MODULE_NAME.'/Index/index');?>">洗车系统管理后台</a>
			<nav class="navbar navbar-static-top" role="navigation">
				<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
			</nav>
		</header>
		<div class="wrapper row-offcanvas row-offcanvas-left">
			<aside class="left-side sidebar-offcanvas">
				<section class="sidebar">
					<div class="user-panel">
						<div class="pull-left image">
							<img src="<?php echo __ROOT__;?>/skin/adminlte/img/me.png" class="img-circle" alt="User Image" />
						</div>
						<div class="pull-left info">
							<p>Hello, Luke</p>
							<a href="#">
								<i class="fa fa-circle text-success"></i>
								在线
							</a>
						</div>
					</div>
					<ul class="sidebar-menu">
						<li<?php if('Index'==CONTROLLER_NAME){ ?> class="active"<?php } ?>>
							<a href="<?php echo U(MODULE_NAME.'/Index/index');?>">
								<i class="fa fa-dashboard"></i>
								<span>仪表盘</span>
							</a>
						</li>
						<li class="treeview<?php if(in_array(CONTROLLER_NAME,array('Order','Car','Todolist'))){ ?> active<?php } ?>">
							<a href="<?php echo U(MODULE_NAME.'/Order/index');?>">
								<i class="fa fa-medkit"></i>
								<span>洗车</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li>
									<a href="<?php echo U(MODULE_NAME.'/Order/index');?>">
										<i class="fa fa-angle-double-right"></i>
										订单
									</a>
								</li>
								<li>
									<a href="<?php echo U(MODULE_NAME.'/Car/index');?>">
										<i class="fa fa-angle-double-right"></i>
										车辆列表
									</a>
								</li>
								<li>
									<a href="<?php echo U(MODULE_NAME.'/Todolist/index',array('tdl_ctime'=>strtotime('today')));?>">
										<i class="fa fa-angle-double-right"></i>
										洗车任务
									</a>
								</li>
							</ul>
						</li>
						<li class="treeview<?php if(in_array(CONTROLLER_NAME,array('Cartype','Period','Village','Price','Taocan'))){ ?> active<?php } ?>">
							<a href="#">
								<i class="fa fa-wrench"></i>
								<span>洗车设置</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li>
									<a href="<?php echo U(MODULE_NAME.'/Cartype/index');?>">
										<i class="fa fa-angle-double-right"></i>
										车辆类型
									</a>
								</li>
								<li>
									<a href="<?php echo U(MODULE_NAME.'/Period/index');?>">
										<i class="fa fa-angle-double-right"></i>
										服务时长
									</a>
								</li>
								<li>
									<a href="<?php echo U(MODULE_NAME.'/Village/index');?>">
										<i class="fa fa-angle-double-right"></i>
										小区
									</a>
								</li>
								<li>
									<a href="<?php echo U(MODULE_NAME.'/Price/index');?>">
										<i class="fa fa-angle-double-right"></i>
										价格
									</a>
								</li>
								<li>
									<a href="<?php echo U(MODULE_NAME.'/Taocan/index');?>">
										<i class="fa fa-angle-double-right"></i>
										套餐
									</a>
								</li>
							</ul>
						</li>
						<li class="treeview<?php if(in_array(CONTROLLER_NAME,array('User','Usergroup','Wxuser'))){ ?> active<?php } ?>">
							<a href="<?php echo U(MODULE_NAME.'/User/index');?>">
								<i class="fa fa-fw fa-user"></i>
								<span>用户</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li>
									<a href="<?php echo U(MODULE_NAME.'/Wxuser/index');?>">
										<i class="fa fa-angle-double-right"></i>
										用户
									</a>
								</li>
								<li>
									<a href="<?php echo U(MODULE_NAME.'/Usergroup/index');?>">
										<i class="fa fa-angle-double-right"></i>
										用户组
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</section>
			</aside>
			<aside class="right-side">
				<section class="content-header">
					
	<h1><?php echo htmlspecialchars($htmlHeadTitle);?>
		<small><?php echo $htmlHeadTitle;?>列表</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo U(MODULE_NAME.'/Index/index');?>">
				<i class="fa fa-dashboard"></i>
				仪表盘
			</a>
		</li>
		<li class="active"><?php echo $htmlHeadTitle;?></li>
	</ol>

				</section>
				<section class="content">
					
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					
	<h3 class="box-title">
		<a href="<?php echo U(MODULE_NAME.'/'.CONTROLLER_NAME.'/add',$_GET);?>" data-toggle="tooltip" title="增加套餐">
			<i class="glyphicon glyphicon-plus">
			</i>
		</a>
	</h3>
	<div class="box-tools">
		<form method="get">
			<div class="input-group col-xs-3 pull-right">
				<input class="form-control input-sm pull-right" name="searchStr" placeholder="关键字搜索" value="<?php echo htmlSpecialChars(I('get.searchStr',''));?>" />
				<div class="input-group-btn">
					<button class="btn btn-sm btn-default">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</div>
		</form>
	</div>

					
				</div>
				<div class="box-body table-responsive no-padding">
					<?php echo $table;?>
				</div>
			</div>
		</div>
	</div>

				</section>
			</aside>
		</div>
		
		<?php echo $_regionClosure;?>
		
	</body>
</html>