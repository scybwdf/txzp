<?php
	
function send_mail($to, $subject, $content) {
    vendor('PHPMailer.PHPMailerAutoload');
    $mail = new PHPMailer();
    // 装配邮件服务器
    if (C('mail.IS_SMTP')) {
        $mail->IsSMTP();
    }
    $mail->Host = C('mail.SMTP_SERVER');
	if(C('mail.SMTP_AUTH')){
		  $mail->SMTPAuth =true;
	}
    $mail->Username = C('mail.SMTP_NAME');
    $mail->Password = C('mail.SMTP_PWD');
	if(C('mail.SECURE')){
	 $mail->SMTPSecure ='ssl';	
	}
    $mail->CharSet = C('mail.CHARSET');
	$mail->Port = C('mail.SMTP_PORT');
    // 装配邮件头信息
    $mail->From = C('mail.SMTP_NAME');
    $mail->AddAddress($to);
    $mail->FromName = C('system.WEBNAME');
    $mail->IsHTML(true);
    // 装配邮件正文信息
    $mail->Subject = $subject;
    $mail->Body = $content;
    // 发送邮件
    if (!$mail->Send()) {
        return FALSE;
    } else {
        return TRUE;
    }
}