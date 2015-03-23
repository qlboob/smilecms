<?php 
	$htmlHeadTitle='确认订单';
	$json = array('sign'=>$sign,'redirect'=>U(MODULE_NAME.'/'.CONTROLLER_NAME.'/success'));
?>
<?php 
	$vlgOption = D('Village')->where('vlg_state=1')->getField('vlg_id,vlg_name');
	$ctpOption = D('Cartype')->where('ctp_state=1')->getField('ctp_id,ctp_name');
	$loctionOption = array('地面','负1楼','负2楼','负3楼');
	$loctionOption = array_combine($loctionOption,$loctionOption);
	$prdOption = D('Period')->where('prd_state=1')->getField('prd_id,prd_name');
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
		<form class="form-horizontal" action="<?php echo U(MODULE_NAME.'/Pay/index');?>" method="post">
			<div class="panel panel-default">
				<div class="panel-heading">你的信息</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-xs-3">姓名</label>
						<div class="col-xs-9">
							<?php echo htmlspecialchars($car_owner);?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">手机号</label>
						<div class="col-xs-9">
							<?php echo htmlspecialchars($car_tel);?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">小区</label>
						<div class="col-xs-9">
							<?php echo htmlspecialchars($vlgOption[$vlg_id]);?>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">爱车信息</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-xs-3">车牌</label>
						<div class="col-xs-9">
							<?php echo htmlspecialchars($car_no);?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">型号</label>
						<div class="col-xs-9">
							<?php echo htmlspecialchars($car_model);?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">类型</label>
						<div class="col-xs-9">
							<?php echo $ctpOption[$ctp_id];?>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">爱车在哪里</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-xs-3">停车区域</label>
						<div class="col-xs-9">
							<?php echo htmlspecialchars($car_location);?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">固定车位/楼栋单元下</label>
						<div class="col-xs-9">
							<?php echo htmlspecialchars($car_remark);?>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">服务期限</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-xs-3">服务期限</label>
						<div class="col-xs-9">
							<?php echo $prdOption[$prd_id];?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label clo-xs-3">支付金额</label>
						<div class="clo-xs-9">
							<strong>￥<?php echo $ord_money/100;?>元</strong>
						</div>
					</div>
				</div>
				<p class="text-center">
					<button id="payBtn" class="btn btn-primary btn-lg" type="button">立即支付</button>
					<a class="btn btn-default" href="<?php echo U(MODULE_NAME.'/Index/index');?>">重新填写</a>
				</p>
			</div>
		</form>
	</div>

		
		<script type="text/javascript" src="<?php echo $rootPath;?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/skin/bootstrapvalidator/js/bootstrapValidator.min.js"></script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/skin/bootstrapvalidator/js/language/zh_CN.js"></script>
	<script type="text/javascript">
		$('form').bootstrapValidator();

	</script>
	<script type="text/javascript">
		__initData=<?php echo json_encode($json);?>;
	</script>


	</body>
</html>