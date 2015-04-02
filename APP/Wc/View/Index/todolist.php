<?php 
	$htmlHeadTitle='待洗车列表';
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
		<form method="get">
			<select name="vlg_id"><option value="">选择小区</option><?php foreach($vlgOption as $key=>$val){?><?php if(isset($vlg_id)&&($vlg_id==$key||(is_array($vlg_id)&&in_array($key,$vlg_id)))){?><option selected="selected" value="<?php echo htmlspecialchars($key); ?>"><?php echo htmlspecialchars($val);?></option><?php }else{?><option value="<?php echo htmlspecialchars($key);?>"><?php echo htmlspecialchars($val);?></option><?php }?><?php }?></select>
			<input name="search" placeholder="手机号/车牌号/姓名搜索" type="text" id="search" value="<?php if(isset($search)) echo htmlspecialchars($search);?>" />
			<button class="btn btn-primary" type="submit">搜索</button>
		</form>
		<?php if(empty($lists)){?>
			<p>没有待洗车</p>
		<?php }else{ ?>
			<table class="table table-responsive">
				<thead>
					<tr>
						<th>车牌</th>
						<th>颜色</th>
						<th>型号</th>
						<th>类型</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($lists as $k=>$v){?>
						<tr>
							<td>
								<a href="<?php echo U(MODULE_NAME.'/'.CONTROLLER_NAME.'/tododetail',array('id'=>$v['tdl_id']));?>"><?php echo htmlspecialchars(mb_substr($v["car_no"],2,10,'utf-8'));?></a>
							</td>
							<td><?php echo htmlspecialchars($v["car_color"]);?></td>
							<td><?php echo htmlspecialchars($v["car_model"]);?></td>
							<td><?php echo $ctpOption[$v['ctp_id']];?></td>
						</tr>
					<?php }?>
				</tbody>
			</table>
			<?php if(!empty($pageHtml)){?>
				<div class="pull-right"><?php echo $pageHtml;?></div>
			<?php }?>
		<?php }?>
	</div>

		

	</body>
</html>