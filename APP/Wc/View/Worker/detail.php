<?php 
	$htmlHeadTitle='任务详情';
?>
<?php 
	$vlgOption = D('Village')->where('vlg_state=1')->getField('vlg_id,vlg_name');
	$ctpOption = D('Cartype')->where('ctp_state=1')->getField('ctp_id,ctp_name');
	$loctionOption = array('地面','负1楼','负2楼','负3楼');
	$loctionOption = array_combine($loctionOption,$loctionOption);
	$prdOption = D('Period')->where('prd_state=1')->getField('prd_id,prd_name');
	$tcLists = D('Taocan')->getField('tc_id,tc_name,tc_desc');
	$tcOption = $tcDescOption = array();
	foreach ($tcLists as $k=>$v){ $tcOption[$k]=$v['tc_name']; $tcDescOption[$k]=$v['tc_desc'] ;}
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
		<div class="row">
			<div class="col-xs-3">姓名</div>
			<div class="col-xs-9"><?php echo htmlspecialchars($car_owner);?></div>
		</div>
		<div class="row">
			<div class="col-xs-3">手机号</div>
			<div class="col-xs-9">
				<a href="tel:<?php echo htmlspecialchars($car_tel);?>"><?php echo htmlspecialchars($car_tel);?></a>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3">车牌</div>
			<div class="col-xs-9"><?php echo htmlspecialchars($car_no);?></div>
		</div>
		<div class="row">
			<div class="col-xs-3">颜色</div>
			<div class="col-xs-9"><?php echo htmlspecialchars($car_color);?></div>
		</div>
		<div class="row">
			<div class="col-xs-3">型号</div>
			<div class="col-xs-9"><?php echo htmlspecialchars($car_model);?></div>
		</div>
		<div class="row">
			<div class="col-xs-3">小区</div>
			<div class="col-xs-9"><?php echo htmlspecialchars($vlgOption[$vlg_id]);?></div>
		</div>
		<div class="row">
			<div class="col-xs-3">停车区域</div>
			<div class="col-xs-9"><?php echo htmlspecialchars($car_location);?></div>
		</div>
		<?php if($car_remark){?>
			<div class="row">
				<div class="col-xs-3">固定车位</div>
				<div class="col-xs-9"><?php echo $car_remark;?></div>
			</div>
		<?php }?>
		<?php if($apm_id>0){?>
			<div class="row">
				<div class="col-xs-3">预约时间</div>
				<div class="col-xs-9"><?php echo date('m月d日H点',$apm_time);?></div>
			</div>
			<?php if($apm_remark){?>
				<div class="row">
					<div class="col-xs-3">备注</div>
					<div class="col-xs-9"><?php echo htmlspecialchars($apm_remark);?></div>
				</div>
			<?php }?>
			<?php if($apm_washinner>0){?>
				<div class="row">
					<div class="col-xs-3">预约内容</div>
					<div class="col-xs-9">清洁车内</div>
				</div>
			<?php }?>
		<?php }?>
		<div id="imgshow" class="row thumbnail"></div>
		<div class="row text-center">
			<label>
				<input id="washinner" />isset($apm_washinner)&&$apm_washinner>0checked=checked type=checkbox 清洁车内
			</label>
			<button id="upload" class="btn btn-primary" type="button">清洗完成</button>
			<a class="btn btn-default" href="<?php echo U(MODULE_NAME.'/'.CONTROLLER_NAME.'/index');?>">返回</a>
		</div>
	</div>

		
	<script type="text/javascript" src="<?php echo $rootPath;?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/skin/wc/js/detail.js"></script>


	</body>
</html>