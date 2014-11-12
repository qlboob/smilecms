<?php $htmlHeadTitle = '字段排序';?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php echo $htmlHeadTitle;?></title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
		<link href="<?php echo __ROOT__;?>/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<link href="<?php echo __ROOT__;?>/skin/adminlte/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		
		
		
		
		<link href="<?php echo __ROOT__;?>/skin/adminlte/morris/morris.css" rel="stylesheet" type="text/css" />
		
		
		
		<link href="<?php echo __ROOT__;?>/skin/adminlte/AdminLTE.css" rel="stylesheet" type="text/css" />

		
		
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		
	<link href="<?php echo __ROOT__;?>/skin/jqueryui/jquery-ui.css" rel="stylesheet" type="text/css" />

	</head>
	<body class="skin-blue">
		<header class="header">
			<a class="logo" href="<?php echo U('Dev/Index/index');?>">Smile Cms</a>
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
								Online
							</a>
						</div>
					</div>
					<ul class="sidebar-menu">
						<li>
							<a href="<?php echo U('Dev/Index/index');?>">
								<i class="fa fa-dashboard"></i>
								<span>首页</span>
							</a>
						</li>
						<li class="treeview active">
							<a href="#">
								<i class="fa fa-bar-chart-o"></i>
								<span>核心</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li>
									<a href="<?php echo U('Dev/Form/index');?>">
										<i class="fa fa-angle-double-right"></i>
										表单
									</a>
								</li>
								<li>
									<a href="<?php echo U('Dev/Model/index');?>">
										<i class="fa fa-angle-double-right"></i>
										模型
									</a>
								</li>
								<li>
									<a href="<?php echo U('Dev/Event/index');?>">
										<i class="fa fa-angle-double-right"></i>
										事件
									</a>
								</li>
								<li>
									<a href="<?php echo U('Dev/Block/index');?>">
										<i class="fa fa-angle-double-right"></i>
										区块
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</section>
			</aside>
			
			<aside class="right-side">
				<section class="content-header">
					<h1>首页
						<small>xxx</small></h1>
					<ol class="breadcrumb">
						<li>
							<a href="#">
								<i class="fa fa-dashboard"></i>
								Home
							</a>
						</li>
						<li class="active">Test</li>
					</ol>
				</section>
				
				<section class="content">
					
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><?php echo htmlspecialchars($htmlHeadTitle);?></h3>
				</div>
				<div class="box-body table-responsive no-padding">
					<ul id="sortable" class="list-unstyled">
						<?php foreach($lists as $k=>$v){?>
							<?php if($v['level']>0){?>
								<?php $hasParent = 1;?>
							<?php }?>
							<li class="ui-state-default" data-level="<?php echo $v["level"];?>" data-id="<?php echo $v["ffd_id"];?>" data-weight="<?php echo $v["ffd_weight"];?>"><?php echo $v["ffd_label"];?> <?php echo htmlspecialchars($v["ffd_name"]);?>[<?php echo $v["ffd_type"];?>]</li>
						<?php }?>
					</ul>
					<div class="row">
						<button id="dosort" class="btn btn-primary">排序</button>
						<?php if(!empty($hasParent)){?>
							<label>
								<input type="checkbox" name="change" value="1" />修改父表单排序
							</label>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>

				</section>
			</aside>
		</div>
		<script type="text/javaScript" src="<?php echo __ROOT__;?>/js/jquery.min.js"></script>
		<script type="text/javaScript" src="<?php echo __ROOT__;?>/js/bootstrap.min.js"></script>
		<script type="text/javaScript" src="<?php echo __ROOT__;?>/skin/adminlte/js/AdminLTE/app.js"></script>
		
	<script type="text/javaScript" src="<?php echo __ROOT__;?>/skin/jqueryui/jquery-ui.min.js"></script>
	<script type="text/javascript">
		$('#sortable').sortable();
		$('#dosort').click(function(){
			var ret = [];
			$('#sortable li').each(function(){
				ret.push({
					id:$(this).attr('data-id'),
					level:$(this).attr('data-level'),
					weight:$(this).attr('data-weight')
				});
			});
			$.post(this.href,{sorted:ret},function(data){
				$.each(data,function(){
					$('[data-id='+this.ffd_id+']').attr('data-weight',this.ffd_weight);
				});
			},'json');
		});</script>


	</body>
</html>