<?php 
	$htmlHeadTitle='洗车任务';
	$smallTxt = $htmlHeadTitle.'详情';
?>



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
									<a href="<?php echo U(MODULE_NAME.'/Todolist/index');?>">
										<i class="fa fa-angle-double-right"></i>
										洗车任务
									</a>
								</li>
							</ul>
						</li>
						<li class="treeview<?php if(in_array(CONTROLLER_NAME,array('Cartype','Period','Village','Price'))){ ?> active<?php } ?>">
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
		<small><?php echo $smallTxt;?></small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo U(MODULE_NAME.'/'.CONTROLLER_NAME.'/index');?>">
				<i class="fa fa-dashboard"></i>
				首页
			</a>
		</li>
		<li>
			<a href="<?php echo U(MODULE_NAME.'/'.CONTROLLER_NAME.'/index');?>">
				<i class="fa fa-user"></i>
				<?php echo $htmlHeadTitle;?>
			</a>
		</li>
		<li class="active"><?php echo $smallTxt;?>
			</li>
	</ol>

					
				</section>
				
				<section class="content">
					
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					
					
				</div>
				<div class="box-body table-responsive no-padding">
					<?php echo $table;?>
				</div>
			</div>
		</div>
	</div>

	<div class="box box-primary">
		
		<div class="box-body">
			<div class="form-horizontal">
				<div class="form-group">
					<div class="col-sm-2">车牌</div>
					<div class="col-sm-10"><?php echo htmlspecialchars($car_no);?></div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">车主</div>
					<div class="col-sm-10"><?php echo htmlspecialchars($car_owner);?></div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">手机号</div>
					<div class="col-sm-10"><?php echo htmlspecialchars($car_tel);?></div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">车辆类型</div>
					<div class="col-sm-10"><?php echo getCarTypeOption($ctp_id);?></div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">服务结束时间</div>
					<div class="col-sm-10"><?php echo date('Y-m-d',$car_endtime);?></div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">型号简写</div>
					<div class="col-sm-10"><?php echo htmlspecialchars($car_model);?></div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">颜色</div>
					<div class="col-sm-10"><?php echo htmlspecialchars($car_color);?></div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">小区</div>
					<div class="col-sm-10"><?php echo getVillageOption($vlg_id);?></div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">停车区域</div>
					<div class="col-sm-10"><?php echo htmlspecialchars($car_location);?></div>
				</div>
				<?php if($car_remark){?>
					<div class="form-group">
						<div class="col-sm-2">备注</div>
						<div class="col-sm-10"><?php echo htmlspecialchars($car_remark);?></div>
					</div>
				<?php }?>
				<div class="form-group">
					<div class="col-sm-2">任务日期</div>
					<div class="col-sm-10"><?php echo date('Y-m-d',$tdl_ctime);?></div>
				</div>
				<?php if($apm_id>0){?>
					<?php if($apm_washinner>0){?>
						<div class="form-group">
							<div class="col-sm-2">是否清洁车内</div>
							<div class="col-sm-10">是</div>
						</div>
					<?php }?>
					<?php if($apm_remark){?>
						<div class="form-group">
							<div class="col-sm-2">预约备注</div>
							<div class="col-sm-10"><?php echo htmlspecialchars($apm_remark);?></div>
						</div>
					<?php }?>
				<?php }?>
				<div class="form-group">
					<div class="col-sm-2">是否完成</div>
					<div class="col-sm-10"><?php echo getYesNoOption($tdl_state);?>
				</div>
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