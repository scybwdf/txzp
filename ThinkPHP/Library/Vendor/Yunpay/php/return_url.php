<?php
/* *
 * 功能：服务器同通知页面
 */

require_once("shanpayconfig.php");
require_once("lib/shanpayfunction.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//计算得出通知验证结果
$shanNotify = md5VerifyShan($_REQUEST['out_order_no'],$_REQUEST['total_fee'],$_REQUEST['trade_status'],$_REQUEST['sign'],$shan_config['key'],$shan_config['partner']);
if($shanNotify) {//验证成功
	if($_REQUEST['trade_status']=='TRADE_SUCCESS'){
		    /*
			加入您的入库及判断代码;
			判断返回金额与实金额是否想同;
			判断订单当前状态;
			完成以上才视为支付成功
			*/
			//商户订单号
			$out_trade_no = $_REQUEST['out_order_no'];
			//云通付交易号
			$trade_no = $_REQUEST['trade_no'];
			//价格
			$price=$_REQUEST['total_fee'];
			//var_dump($_REQUEST);
			echo "支付成功";
		}else{
			echo "支付失败";
		}

}
else {
    //验证失败
    echo "验证失败";
}
?>
        <title>云通付接口</title>
	</head>
    <body>
    </body>
</html>