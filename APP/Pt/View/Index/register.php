<?php $htmlHeadTitle='注册';?>


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
		<form action="?" method="post">
			<div class="form-group">
				<label>姓名：</label>
				<input class="form-control" name="usr_realname" placeholder="请输入联系人姓名" required="required" data-bv-stringlength-max="5" data-bv-stringlength-min="2" data-bv-stringlength="true" />
			</div>
			<div class="form-group">
				<label>联系电话：</label>
				<input class="form-control" name="usr_tel" placeholder="请输入联系电话" required="required" data-bv-stringlength-max="20" data-bv-stringlength-min="11" data-bv-stringlength="true" />
			</div>
			<div class="form-group">
				<label>公司名称：</label>
				<input class="form-control" name="usr_company" placeholder="请输入工厂名/公司名/商铺名" required="required" data-bv-stringlength-max="50" data-bv-stringlength-min="5" data-bv-stringlength="true" />
			</div>
			<div class="form-group">
				<label>公司类型：</label>
				<?php $types= D('Usergroup')->where('ugp_id>1')->getField('ugp_id,ugp_name');?>
				<select class="form-control" name="ugp_id" required="required"><option value="">请选择公司类型</option><?php foreach($types as $key=>$val){?><option value="<?php echo htmlspecialchars($key);?>"><?php echo htmlspecialchars($val);?></option><?php }?></select>
			</div>
			<div class="form-group">
				<label>公司地址：</label>
				<input class="form-control" name="usr_address" placeholder="请输入你的公司地址" required="required" data-bv-stringlength-max="50" data-bv-stringlength-min="10" data-bv-stringlength="true" />
			</div>
			<p class="text-center">
				<button type="submit" class="btn btn-primary btn-lg">注册</button>
			</p>
		</form>
	</div>

		
		<script type="text/javascript" src="<?php echo $rootPath;?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/skin/bootstrapvalidator/js/bootstrapValidator.min.js"></script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/skin/bootstrapvalidator/js/language/zh_CN.js"></script>
	<script type="text/javascript">
		$('form').bootstrapValidator();

	</script>


	</body>
</html>