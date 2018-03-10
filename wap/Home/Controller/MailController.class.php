<?php
namespace Home\Controller;
use Think\Controller;
class MailController extends Controller{
	public function _initialize() {
        vendor('PHPMailer.PHPMailerAutoload'); 
	}
	public function send(){
		$to='858586480@qq.com';
		$subject='悦无限';
		$body=file_get_contents('http://www.passpay.net/index.php?s=/PayOrder/displayorder/payding/MDAwMDAwMDAwMH6KgpaHfHqTgaehog.html');
		$send=postmail($to,$subject,$body);
	}
}