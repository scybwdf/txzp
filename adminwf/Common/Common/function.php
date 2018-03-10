<?php
	function encrypetion($value,$type=0){
		$key=md5(C('ENCRYPETION_KEY'));
		if(!$type){
            return str_replace('=','',base64_encode($value ^ $key));
        }
        else{
            $value=base64_decode($value);
            return $value^$key;
        }
	}
//获取文件修改时间
function get_file_time($DataDir,$file) {
    $a = filemtime($DataDir . $file);
    $time = date("Y-m-d H:i:s", $a);
    return $time;
}

//获取文件的大小
function get_file_size($DataDir,$file) {
    $perms = stat($DataDir . $file);
    $size = $perms['size'];
    // 单位自动转换函数
    $kb = 1024;         // Kilobyte
    $mb = 1024 * $kb;   // Megabyte
    $gb = 1024 * $mb;   // Gigabyte
    $tb = 1024 * $gb;   // Terabyte

    if ($size < $kb) {
        return $size . " B";
    } else if ($size < $mb) {
        return round($size / $kb, 2) . " KB";
    } else if ($size < $gb) {
        return round($size / $mb, 2) . " MB";
    } else if ($size < $tb) {
        return round($size / $gb, 2) . " GB";
    } else {
        return round($size / $tb, 2) . " TB";
    }
}
//邮件发送
function sendMail($to, $subject, $content) {
    Vendor('phpmailer.class#phpmailer');
    $mail = new \PHPMailer(); //实例化
    // 装配邮件服务器
    if (C('MAIL_SMTP')) {
        $mail->IsSMTP();  //启动SMTP
    }
    $mail->Host = C('MAIL_HOST'); //SMTP服务器地址
    $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用SMTP认证
    $mail->Username = C('MAIL_USERNAME');//邮箱名称
    $mail->Password = C('MAIL_PASSWORD');//邮箱密码
    $mail->SMTPSecure = C('MAIL_SECURE');//发件人地址
    $mail->CharSet = C('MAIL_CHARSET');//邮件头部信息
    $mail->From = C('MAIL_USERNAME');//发件人是谁
    $mail->AddAddress($to);
    $mail->FromName = 'Marker | pop';//设置每行字符长度
    $mail->IsHTML(C('MAIL_ISHTML'));//是否是HTML字样
    $mail->Subject = $subject;// 邮件标题信息
    $mail->Body = $content;//邮件内容
    // 发送邮件
    if (!$mail->Send()) {
        return FALSE;
    } else {
        return TRUE;
    }
};

function sendSMS($mobile_number,$content,$is_adv=0)
	{
		$statusStr = array(
		"1" => "短信发送成功",
		"-2" => "除时间外，所有参数不能为空",
		"-3" => "用户名密码不正确",
		"-4" => "平台不存在",
		"-5" => "客户短信数量为0",
		"-6" => "客户账户余额小于要发送的条数",
		"-7" => "不能超过70个字",
		"-8" => "非法短信内容",
		"-9" => "未知系统故障",
	        "-10" => "网络性错误",
		"-21" => "代表要加签名"
	);
		if(is_array($mobile_number))
		{
			$mobile_number = implode(",",$mobile_number);
		}
		$sms = new sms_trans();
				
				$params = array(
					"username"=>$this->sms['user_name'],
					"userpwd"=>md5($this->sms['password']),
					"handtel"=>$mobile_number,
					"sendcontent"=>urlencode(iconv("UTF-8","gbk",$content)),
					"sendtime"=>'',
					"smsnumber"=>10690,
                                        "comid"=>61
				);
				
				$result = $sms->request($this->sms['server_url'],$params);
				$code = $result['body'];
				
				if($code=='0')
				{
							$result['status'] = 1;
				}
				else
				{
							$result['status'] = 0;
							$result['msg'] = $this->statusStr[$code];
				}
		return $result;
	}
function imgqudian($v){
	$re=stripos($v,"./public/attachment/");
	if($re!==false){
		$v=str_replace("./public/attachment/",'/public/attachment/',$v);
		return $v;	
	}
	else{
		return $v;
	}
}
 function getarea($getIp){ 
  $content = file_get_contents("http://api.map.baidu.com/location/ip?ak=E1b2ed517a2cd26c9839839fdf88795b&ip={$getIp}&coor=bd09ll");
  $json = json_decode($content);
   $area=$json->{'content'}->{'address'};//按层级关系提取address数据
    return $area;

   }

