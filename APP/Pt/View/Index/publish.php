<?php 
	$htmlHeadTitle='发布求购信息';
	$json = array('sign'=>$sign);
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
		
	<link rel="stylesheet" type="text/css" href="<?php echo $rootPath;?>/skin/bootstrapvalidator/css/bootstrapValidator.min.css" />

	</head>
	<body>
		
	<div class="container-fluid">
		<form action="?" method="post">
			<div class="form-group">
				<label>标题：</label>
				<input class="form-control" name="ifm_title" placeholder="请输入标题" required="required" data-bv-stringlength-max="40" data-bv-stringlength-min="10" data-bv-stringlength="true" />
			</div>
			<div class="form-group">
				<label>分类：</label>
				<?php $types=D('Infotype')->getField('ift_id,ift_name');?>
				<select class="form-control" name="ift_id" required="required"><option value="">请选择分类</option><?php foreach($types as $key=>$val){?><?php if(isset($ift_id)&&($ift_id==$key||(is_array($ift_id)&&in_array($key,$ift_id)))){?><option selected="selected" value="<?php echo htmlspecialchars($key); ?>"><?php echo htmlspecialchars($val);?></option><?php }else{?><option value="<?php echo htmlspecialchars($key);?>"><?php echo htmlspecialchars($val);?></option><?php }?><?php }?></select>
			</div>
			<div id="imgRow" class="form-group hide">
				<label>图片</label>
				<div class="form-control">
					<div id="imgList"></div>
					<button class="btn btn-default" type="button">点击上传图片
</button>
				</div>
			</div>
			<div class="form-group">
				<label>联系电话：</label>
				<input class="form-control" name="ifm_tel" required="required" data-bv-stringlength-max="20" data-bv-stringlength-min="11" data-bv-stringlength="true" type="text" id="ifm_tel" value="<?php if(isset($ifm_tel)) echo htmlspecialchars($ifm_tel);?>" />
			</div>
			<div class="form-group">
				<label>详细信息：</label>
				<textarea class="form-control" name="ifm_desc" rows="8" required="required" id="ifm_desc"><?php if(isset($ifm_desc)) echo htmlspecialchars($ifm_desc);?></textarea>
			</div>
			<p class="text-center">
				<button type="submit" class="btn btn-primary btn-lg">发布</button>
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
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
		__initData = <?php echo json_encode($json);?>;
	</script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/skin/pt/js/publish.js"></script>


	</body>
</html>