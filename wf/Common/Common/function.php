<?php
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
        if(function_exists("mb_substr"))
            $slice = mb_substr($str, $start, $length, $charset);
        elseif(function_exists('iconv_substr')) {
            $slice = iconv_substr($str,$start,$length,$charset);
            if(false === $slice) {
                $slice = '';
            }
        }else{
            $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("",array_slice($match[0], $start, $length));
        }
        $fix='';
        if(strlen($slice) < strlen($str)){
            $fix='...';
        }
        return $suffix ? $slice.$fix : $slice;
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
    }}
function tagsquchong($tags){
	foreach($tags as $v){
			$v=join(",",$v);
			$temp[]=$v;
		}
		$temp=array_unique($temp);
		$temp=array_filter($temp);	
		foreach($temp as $k=>$v){
			if(!$v){
				unset($temp[$k]);
			}
			//$temp[$k]=explode(",",$v);
		}
	return $temp;
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
function get_nav_list($nav_list){
	  foreach($nav_list as $k=>$v){
			  if($v['u_module']!=''){
				  if($v['u_action']!=''&&$v['u_param']!=''){
					  $nav_list[$k]['url']=U($v['u_module'].'/'.$v['u_action'].'?'.html_entity_decode($v['u_param']));
				  }
				  elseif($v['u_action']!=''&&$v['u_param']==''){
					  $nav_list[$k]['url']=U($v['u_module'].'/'.$v['u_action']); 
				  }
				  elseif($v['u_action']==''){
					   $nav_list[$k]['url']=U($v['u_module'].'/'.'index'); 
				  }
				  
			  }
			  else{
				  if($v['url']!='')
				{
				if(substr($v['url'],0,7)!="http://")
				{		
					$nav_list[$k]['url'] = __ROOT__."/".$v['url'];
				}
				}
				  else{
					 $nav_list[$k]['url']=$v['url']; 
				  }
				 
			  }
		  }
	return $nav_list;
}