<?php 
	$htmlHeadTitle='待付款订单';
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
		<form method="get">
			<select name="vlg_id"><option value="">选择小区</option><?php foreach($vlgOption as $key=>$val){?><?php if(isset($vlg_id)&&($vlg_id==$key||(is_array($vlg_id)&&in_array($key,$vlg_id)))){?><option selected="selected" value="<?php echo htmlspecialchars($key); ?>"><?php echo htmlspecialchars($val);?></option><?php }else{?><option value="<?php echo htmlspecialchars($key);?>"><?php echo htmlspecialchars($val);?></option><?php }?><?php }?></select>
			<input name="search" placeholder="手机号/车牌号/姓名搜索" type="text" id="search" value="<?php if(isset($search)) echo htmlspecialchars($search);?>" />
			<button class="btn btn-primary" type="submit">搜索</button>
		</form>
		<?php if(empty($lists)){?>
			<p>没有待付款订单</p>
		<?php }else{ ?>
			<table class="table table-responsive">
				<thead>
					<tr>
						<th>车主</th>
						<th>车牌</th>
						<th>电话</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($lists as $k=>$v){?>
						<tr>
							<td><?php echo htmlspecialchars($v["car_owner"]);?></td>
							<td><?php echo htmlspecialchars($v["car_no"]);?></td>
							<td><?php echo htmlspecialchars($v["car_tel"]);?></td>
							<td>
								<a href="<?php echo U(MODULE_NAME.'/'.CONTROLLER_NAME.'/pay',array('id'=>$v['ord_id']));?>" onclick="return confirm('确认线下收款:<?php echo htmlspecialchars($v["car_owner"]);?>')">线下收款</a>
							</td>
						</tr>
					<?php }?>
				</tbody>
			</table>
		<?php }?>
	</div>

		

	</body>
</html>