<?php 
	$htmlHeadTitle='预约洗车';
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
		<form class="form-horizontal" method="post">
			<div class="panel panel-default"><div class="panel-heading"><i class="glyphicon glyphicon-time"></i>预约洗车</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-xs-3">预约时间</label>
						<div class="col-xs-9">
							<select class="form-control" name="apm_time"><?php foreach($timeOption as $key=>$val){?><option value="<?php echo htmlspecialchars($key);?>"><?php echo htmlspecialchars($val);?></option><?php }?></select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">服务内容</label>
						<div class="col-xs-9">
							<?php $innerOption= array('外部清洁','内部清洁');?>
							<select class="form-control" name="apm_washinner"><?php foreach($innerOption as $key=>$val){?><option value="<?php echo htmlspecialchars($key);?>"><?php echo htmlspecialchars($val);?></option><?php }?></select>
							<p class="help-block">车内清洁需你在场</p>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3">特别要求</label>
						<div class="col-xs-9">
							<textarea class="form-control" name="apm_remark" placeholder="请输入你洗车的特别要求" id="apm_remark"><?php if(isset($apm_remark)) echo htmlspecialchars($apm_remark);?></textarea>
						</div>
					</div>
					<p class="text-center">
						<button class="btn btn-primary btn-lg" type="submit">预约
</button>
					</p>
				</div>
			</div>
		</form>
	</div>

		

	</body>
</html>