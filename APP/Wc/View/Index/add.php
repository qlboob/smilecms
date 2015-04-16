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
<?php 
	$htmlHeadTitle='登记录车辆信息';
	empty($car_no) && $car_no='川A';
	$priceLists = D('Price')->select();
	$json = array('descMap'=>$tcDescOption,'priceLists'=>$priceLists);
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
							<input class="form-control" name="car_owner" placeholder="请输入你的姓名" required="required" data-bv-stringlength-max="10" data-bv-stringlength-min="2" data-bv-stringlength="true" type="text" id="car_owner" value="<?php if(isset($car_owner)) echo htmlspecialchars($car_owner);?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">手机号</label>
						<div class="col-xs-9">
							<input class="form-control" name="car_tel" placeholder="请输入你的手机号" required="required" data-bv-stringlength-max="11" data-bv-stringlength-min="11" data-bv-stringlength="true" pattern="^1[3|4|5|8][0-9]\d{4,8}$" data-bv-regexp-message="请输入正确的手机号码" type="text" id="car_tel" value="<?php if(isset($car_tel)) echo htmlspecialchars($car_tel);?>" />
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
							<input class="form-control" name="car_no" placeholder="请输入你的车牌号" required="required" data-bv-stringlength-max="12" data-bv-stringlength-min="7" data-bv-stringlength="true" type="text" id="car_no" value="<?php if(isset($car_no)) echo htmlspecialchars($car_no);?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">颜色</label>
						<div class="col-xs-9">
							<input class="form-control" name="car_color" placeholder="请输入你的爱车颜色" type="text" id="car_color" value="<?php if(isset($car_color)) echo htmlspecialchars($car_color);?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">品牌型号</label>
						<div class="col-xs-9">
							<input class="form-control" name="car_model" placeholder="请输入你的爱车品牌和型号如宝马X4" type="text" id="car_model" value="<?php if(isset($car_model)) echo htmlspecialchars($car_model);?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">类型</label>
						<div class="col-xs-9">
							<select class="form-control" name="ctp_id" required="required"><option value="">请选择</option><?php foreach($ctpOption as $key=>$val){?><?php if(isset($ctp_id)&&($ctp_id==$key||(is_array($ctp_id)&&in_array($key,$ctp_id)))){?><option selected="selected" value="<?php echo htmlspecialchars($key); ?>"><?php echo htmlspecialchars($val);?></option><?php }else{?><option value="<?php echo htmlspecialchars($key);?>"><?php echo htmlspecialchars($val);?></option><?php }?><?php }?></select>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">爱车在哪里</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-xs-3">小区</label>
						<div class="col-xs-9">
							<select class="form-control" name="vlg_id" required="required"><option value="">请选择小区</option><?php foreach($vlgOption as $key=>$val){?><?php if(isset($vlg_id)&&($vlg_id==$key||(is_array($vlg_id)&&in_array($key,$vlg_id)))){?><option selected="selected" value="<?php echo htmlspecialchars($key); ?>"><?php echo htmlspecialchars($val);?></option><?php }else{?><option value="<?php echo htmlspecialchars($key);?>"><?php echo htmlspecialchars($val);?></option><?php }?><?php }?></select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">停车区域</label>
						<div class="col-xs-9">
							<select class="form-control" name="car_location" required="required"><?php foreach($loctionOption as $key=>$val){?><?php if(isset($car_location)&&($car_location==$key||(is_array($car_location)&&in_array($key,$car_location)))){?><option selected="selected" value="<?php echo htmlspecialchars($key); ?>"><?php echo htmlspecialchars($val);?></option><?php }else{?><option value="<?php echo htmlspecialchars($key);?>"><?php echo htmlspecialchars($val);?></option><?php }?><?php }?></select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">固定车位/楼栋单元下</label>
						<div class="col-xs-9">
							<textarea class="form-control" rows="3" name="car_remark" placeholder="如果有固定停车请输入车位号，也可以输入爱车所停的XX单元XX栋" id="car_remark"><?php if(isset($car_remark)) echo htmlspecialchars($car_remark);?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">服务选择</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-xs-3">服务期限</label>
						<div class="col-xs-9">
							<select class="form-control" name="prd_id" required="required"><?php foreach($prdOption as $key=>$val){?><?php if(isset($prd_id)&&($prd_id==$key||(is_array($prd_id)&&in_array($key,$prd_id)))){?><option selected="selected" value="<?php echo htmlspecialchars($key); ?>"><?php echo htmlspecialchars($val);?></option><?php }else{?><option value="<?php echo htmlspecialchars($key);?>"><?php echo htmlspecialchars($val);?></option><?php }?><?php }?></select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">服务套餐</label>
						<div class="col-xs-9">
							<select class="form-control" name="tc_id" required="required"><?php foreach($tcOption as $key=>$val){?><?php if(isset($tc_id)&&($tc_id==$key||(is_array($tc_id)&&in_array($key,$tc_id)))){?><option selected="selected" value="<?php echo htmlspecialchars($key); ?>"><?php echo htmlspecialchars($val);?></option><?php }else{?><option value="<?php echo htmlspecialchars($key);?>"><?php echo htmlspecialchars($val);?></option><?php }?><?php }?></select>
							<p id="tcDesc" class="help-block"></p>
						</div>
					</div>
					<div id="priceRow" class="form-group hide">
						<label class="control-label col-xs-3">价格</label>
						<div class="col-xs-9">
								<strong id="money" style="color:red"></strong>
						</div>
					</div>
				</div>
				<p class="text-center">
					<button class="btn btn-primary btn-lg" type="submit">登记</button>
				</p>
			</div>
		</form>
	</div>

		
	<script type="text/javascript">
		__initData = <?php echo json_encode($json);?>;
	</script>
		<script type="text/javascript" src="<?php echo $rootPath;?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/skin/bootstrapvalidator/js/bootstrapValidator.min.js"></script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/skin/bootstrapvalidator/js/language/zh_CN.js"></script>
	<script type="text/javascript">
		$('form').bootstrapValidator();

	</script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/skin/wc/js/add.js"></script>


	</body>
</html>