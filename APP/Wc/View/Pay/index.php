<?php 
	$htmlHeadTitle='确认订单';
	$json = array('sign'=>$sign,'redirect'=>U(MODULE_NAME.'/'.CONTROLLER_NAME.'/success'),'payParam'=>$payJsParam);
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
		<table class="table table-condensed">
			<tr>
				<td>姓名</td>
				<td><?php echo htmlspecialchars($car_owner);?></td>
			</tr>
			<tr>
				<td>手机号</td>
				<td><?php echo htmlspecialchars($car_tel);?></td>
			</tr>
			<tr>
				<td>小区</td>
				<td><?php echo htmlspecialchars($vlgOption[$vlg_id]);?></td>
			</tr>
			<tr>
				<td>车牌</td>
				<td><?php echo htmlspecialchars($car_no);?></td>
			</tr>
			<tr>
				<td>型号</td>
				<td><?php echo htmlspecialchars($car_model);?></td>
			</tr>
			<tr>
				<td>类型</td>
				<td><?php echo $ctpOption[$ctp_id];?></td>
			</tr>
			<tr>
				<td>停车区域</td>
				<td><?php echo htmlspecialchars($car_location);?></td>
			</tr>
			<?php if($car_remark){?>
				<tr>
					<td>固定车位/楼栋单元下</td>
					<td><?php echo htmlspecialchars($car_remark);?></td>
				</tr>
			<?php }?>
			<tr>
				<td>服务期限</td>
				<td><?php echo $prdOption[$prd_id];?></td>
			</tr>
			<tr>
				<td>支付金额</td>
				<td>
					<strong>￥<?php echo $ord_money/100;?>元</strong>
				</td>
			</tr>
			<tr>
				<td>套餐</td>
				<td><?php echo $tcOption[$tc_id];?></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<button id="payBtn" class="btn btn-primary btn-lg" type="button">立即支付</button>
					<a class="btn btn-default" href="<?php echo U(MODULE_NAME.'/Index/index');?>">重新填写</a>
				</td>
			</tr>
		</table>
	</div>

		
	<script type="text/javascript">
		__initData=<?php echo json_encode($json);?>;
	</script>
	<script type="text/javascript" src="<?php echo $rootPath;?>/js/jquery.min.js"></script>
	<script type="text/javascript">
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo json_encode($json['payParam']); ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				alert(res.err_code+res.err_desc+res.err_msg);
			}
		);
	}
	setTimeout(jsApiCall,5000);	
	</script>


	</body>
</html>