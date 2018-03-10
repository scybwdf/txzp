<?php

if (isset($read_modules) && $read_modules == true)
{
    $module['class_name']    = 'dxw';
    /* 名称 */
    $module['name']    = "56短信网 (<a href='http://www.56dxw.com' target='_blank'><font color='red'>还没账号？点击这免费注册</font></a>)";
    $module['server_url'] = 'http://jiekou.56dxw.com/sms/HttpInterfaceMd5.aspx';
    
    if(ACTION_NAME == "install" || ACTION_NAME == "edit"){  
    	$module['lang']  = array();
      $module['config'] = array();
    }

    return $module;
}

// 企信通短信平台
require_once WEB_ROOT."/system/lib/sms.php";  //引入接口
require_once WEB_ROOT."/system/sms/dxw/sms_trans.php";

class dxw_sms implements sms
{
	public $sms;
	public $message = "";
	
	private $statusStr = array(
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
	
  public function __construct($smsInfo = '')
    { 	    	
		if(!empty($smsInfo))
		{			
			$this->sms = $smsInfo;
		}
    }
	
	public function sendSMS($mobile_number,$content,$is_adv=0)
	{
	
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
				/* ==========================================comid为企业ID，唯一的，请把comid修改成客服给您的企业ID============================== */
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
	
	public function getSmsInfo()
	{		
			return "56短信网(最好的短信平台)";
	}
	
	public function check_fee()
	{
global $username,$userpwd;
		es_session::start();
		$last_visit = intval(es_session::get("last_visit_dxw"));
		if(get_gmtime() - $last_visit > 10)
		{
			$sms = new sms_trans();				
$username=$this->sms['user_name'];
$userpwd=$this->sms['password'];
/* ==========================================comid为企业ID，唯一的，请把comid修改成客服给您的企业ID============================== */
 $url = "http://jiekou.56dxw.com/sms/HttpInterfaceR.aspx?comid=61&username=$username&userpwd=$userpwd&newpwd=&action=moneyc";
 $string = file_get_contents($url);	
$match = explode('#',$string);

if ($username!= '')
    	{

 $str = sprintf($match[0]);
}
else
{

$str = sprintf('您刚获取过短信余额条数了，等等再获取吧');

}

es_session::set("dxw_info",$str);
			es_session::set("last_visit_dxw",get_gmtime());
			return $str;
		}
   else

{
 $str = sprintf('请稍后再试');

}



	}
}
?>