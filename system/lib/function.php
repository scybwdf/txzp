<?php
function get_url(){
	  $http = (isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!='off')?'https://':'http://';
	  $url = $http.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
		return $url;	
}
function is_Mobile() {
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        return true;
    
    //此条摘自TPM智能切换模板引擎，适合TPM开发
    if(isset ($_SERVER['HTTP_CLIENT']) &&'PhoneClient'==$_SERVER['HTTP_CLIENT'])
        return true;
    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
        //找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
    //判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array(
            'nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
        );
        //从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    //协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
 }
function encrypetion($value,$type=0){
		$key=md5(C('ENCRYPETION_KEY'));
		if(!$type){
		 return str_replace('=','',base64_encode($value^$key));
		}
		else{
			$value=base64_decode($value);
			return $value^$key;
		}
	}
//编译生成css文件
function parse_css($urls,$ispc)
{
	//return var_dump($urls);die;
	$url = md5(implode(',',$urls));
	$css_url = '/public/runtime/index/'.$ispc.'/statics/'.$url.'.css';
	$url_path = WEB_ROOT.$css_url;
	if(!file_exists($url_path))
	{
		if(!file_exists(WEB_ROOT.'/public/runtime/index/'.$ispc.'/statics/')){
			mkdir(WEB_ROOT.'/public/runtime/index/'.$ispc.'/statics/',0777);  
	}
	$css_content='';
	foreach($urls as $url)
		{
			$css_content .= file_get_contents($url);
		}
		$css_content = preg_replace("/[\r\n]/",'',$css_content);
	    $css_content = str_replace("../img/",'../../../../../img/'.$ispc.'/',$css_content);
		file_put_contents($url_path, $css_content);	
	}
	
	return  __ROOT__.$css_url."?wf=1.1";
	
	}
/**
 * 
 * @param $urls 载入的脚本
 * @param $encode_url 需加密的脚本
 */
function parse_script($urls,$encode_url=array(),$ispc)
{	
	
	$url = md5(implode(',',$urls));
	$js_url = '/public/runtime/index/'.$ispc.'/statics/'.$url.'.js';
	$url_path = WEB_ROOT.$js_url;
	if(!file_exists($url_path))
	{
		if(!file_exists(WEB_ROOT.'/public/runtime/index/'.$ispc.'/statics/'))
		mkdir(WEB_ROOT.'/public/runtime/index/'.$ispc.'/statics/',0777);
	
		if(count($encode_url)>0)
		{
			require_once WEB_ROOT."/system/lib/javascriptpacker.php";
		}
		
		$js_content = '';
		foreach($urls as $url)
		{
			$append_content = @file_get_contents($url)."\r\n";
			
			if(in_array($url,$encode_url))
			{
				$packer = new JavaScriptPacker($append_content);
				$append_content = $packer->pack();
			}			
			$js_content .= $append_content;
		}
	
//		require_once APP_ROOT_PATH."system/libs/javascriptpacker.php";
//	    $packer = new JavaScriptPacker($js_content);
//		$js_content = $packer->pack();
		@file_put_contents($url_path,$js_content);
		
	}
	return __ROOT__.$js_url."?wf=1.1";
}

function check_verify_coder($verify_coder){
	if(!empty($verify_coder) && !preg_match("/^([0-9]{6})?$/",$verify_coder))
	{
		return false;
	}
	else
	return true;
}
function get_verify_code($verify_coder){
 			$verify_coder_result = check_user("verify_coder",$verify_coder);
			//var_dump($verify_coder_result);exit;
			if($verify_coder_result['status']==0)
			{
				if($verify_coder_result['data']['error']==EMPTY_ERROR)
				{
					$error = "不能为空";
					$type = "form_tip";
				}
				if($verify_coder_result['data']['error']==EXIST_ERROR)
				{
					$error = "错误";
					$type="form_error";
				}
				return array("type"=>$type,"field"=>"verify_coder","info"=>"验证码".$error);
			}
			else
			{
				return array("type"=>"form_success","field"=>"verify_coder","info"=>"");
			}
 }
function send_verify_sms($mobile,$code,$type="")
{
	Vendor('Sms.message_send');
	$msg=new message_send();
	$info=$msg->manage_msg('TPL_SMS_VERIFY_CODE',$mobile,array('code'=>$code,'title'=>$title));
	return $info;
}

function check_mobile($mobile)
{
	if(!empty($mobile) && !preg_match("/^([0-9]{11})?$/",$mobile))
	{
		return false;
	}
	else
	return true;
}
 function getarea($getIp){ 
  $content = file_get_contents("http://api.map.baidu.com/location/ip?ak=E1b2ed517a2cd26c9839839fdf88795b&ip={$getIp}&coor=bd09ll");
  $json = json_decode($content);
   $area=$json->{'content'}->{'address'};//按层级关系提取address数据
    return $area;

   }
