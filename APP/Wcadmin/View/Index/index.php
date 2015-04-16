<?php $htmlHeadTitle='仪表盘';?>


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
		
	<link href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" type="text/css" rel="stylesheet" />

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
					
	<h1><?php echo $htmlHeadTitle;?>
		<small>今日概览</small></h1>
	<ol class="breadcrumb">
		<li class="active"><?php echo $htmlHeadTitle;?></li>
	</ol>

				</section>
				<section class="content">
					
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3>￥<?php echo $sum/100;?></h3>
					<p>总订单数<?php echo $orderCnt;?>
						<a href="<?php echo U(MODULE_NAME.'/Order/index',array('ord_state'=>0,'ord_mtime_gt_'=>date('Y-m-d'));?>">未支付<?php echo $noPayCnt;?></a></p>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				<a class="small-box-footer" href="<?php echo U(MODULE_NAME.'/Order/index');?>">详情<i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div><div class="col-lg-3 col-xs-6">
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo $completaRate;?><sup>%</sup></h3>
					<p>任务完成比例<?php echo $completeCnt[1];?>/<?php echo $completeCnt[0]+$completeCnt[1];?></p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a class="small-box-footer" href="<?php echo U(MODULE_NAME.'/Todolist/index',array('tdl_ctime'=>$today));?>">详情<i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div><div class="col-lg-3 col-xs-6">
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3><?php echo $userSum;?></h3><p>用户数
						<?php foreach($userCnt as $k=>$v){?><a href="<?php echo U(MODULE_NAME.'/Wxuser/index',array('ugp_id'=>$k));?>"><?php echo $v;?></a><?php if($k<5){?><?php echo htmlSpecialChars('/');?><?php }?><?php }?></p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a class="small-box-footer" href="<?php echo U(MODULE_NAME.'/Wxuser/index');?>">详情<i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>

				</section>
			</aside>
		</div>
		
		<?php echo $_regionClosure;?>
		
	</body>
</html>