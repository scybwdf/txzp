<?php
class sms_sender
{
	var $sms;
	
	public function __construct()
    { 	
		$sms_info = M('sms')->where("is_effect=1")->find();
		if($sms_info)
		{
			$sms_info['config'] = unserialize($sms_info['config']);
			
			require_once WEB_ROOT."/system/sms/".$sms_info['class_name']."_sms.php";
			
			$sms_class = $sms_info['class_name']."_sms";
			$this->sms = new $sms_class($sms_info);
		}
		
    }
    
	
	public function sendSms($mobiles,$content,$sendTime='',$is_adv=0)
	{
		if(C("SMS_ON")==0)
		{
			return array(
					"status"	=>	0,
					"msg"	=>	'网站未开启短信功能',
					);
		}
		if(!is_array($mobiles))
			$mobiles = preg_split("/[ ,]/i",$mobiles);
		
		if(count($mobiles) > 0 )
		{
			if(!$this->sms)
			{
				$result['status'] = 0;
			}
			else
			{
				$result = $this->sms->sendSms($mobiles,$content,$sendTime,$is_adv);
			}
		}
		else
		{
			$result['status'] = 0;
			$result['msg'] = "没有发送的手机号";
		}
		
		return $result;
	}
}
?>