<?php
namespace Home\Controller;
use Think\Controller;
class SmsController extends BaseController {
	private function read_modules()
	{
		$directory = WEB_ROOT."/system/sms/";
		$read_modules = true;
		$dir = @opendir($directory);
	    $modules     = array();
	
	    while (false !== ($file = @readdir($dir)))
	    {
	        if (preg_match("/^.*?\.php$/", $file))
	        {
	            $modules[] = require_once($directory.$file);
	        }
	    }
	    @closedir($dir);
	    unset($read_modules);
	
	    foreach ($modules AS $key => $value)
	    {
	        ksort($modules[$key]);
	    }
	    ksort($modules);
	
	    return $modules;
	}
    public function index(){
	$modules = $this->read_modules();
	$db_modules=M('sms')->select();
	foreach($modules as $k=>$v)
		{
			$sms_info = array();
			foreach($db_modules as $kk=>$vv)
			{
				if($v['class_name']==$vv['class_name'])
				{
					//已安装
					$modules[$k]['id'] = $vv['id'];
					$modules[$k]['is_effect'] = $vv['is_effect'];
					$modules[$k]['description'] = $vv['description'];
					$modules[$k]['installed'] = 1;
					$vv['config'] = unserialize($vv['config']);
					$sms_info = $vv;
					break;
				}
			}
			if($modules[$k]['installed'] != 1)
			$modules[$k]['installed'] = 0;	
			else
			{
				if($modules[$k]['is_effect']==1)
				{
					include WEB_ROOT."/system/sms/".$modules[$k]['class_name']."_sms.php";
					$sms_class = $modules[$k]['class_name']."_sms";
					$sms_module = new $sms_class($sms_info);
					$modules[$k]['name'] = $sms_module->getSmsInfo();
				}
			}			
		}
		$this->assign("sms_list",$modules);
		$this->display();
    
	}
	
	public function install()
	{
		$class_name = $_REQUEST['class_name'];
		$directory = WEB_ROOT."/system/sms/";
		$read_modules = true;
		
		$file = $directory.$class_name."_sms.php";
		if(file_exists($file))
		{
			$module = require_once($file);
			$rs = M("Sms")->where("class_name = '".$class_name."'")->count();
			if($rs > 0)
			{
				$this->error("错误啦");
			}
		}
		else
		{
			$this->error("错误啦");
		}
		
		//开始插入数据
		$data['name'] = $module['name'];
		$data['class_name'] = $module['class_name'];
		$data['server_url'] = $module['server_url'];
		$data['lang'] = $module['lang'];
		$data['config'] = $module['config'];

		$this->assign("data",$data);

		$this->display();
		
	}
		public function uninstall()
	{
		$ajax = intval($_REQUEST['ajax']);
		$id = intval($_REQUEST ['id']);
		$data = M('sms')->getById($id);
		if($data)
		{
			
			$list = M('sms')->where( array('id'=>$data['id']) )->delete();	
			if ($list!==false) {
					
					$this->success ("卸载成功",$ajax);
				} else {
					
					$this->error ("卸载失败",$ajax);
				}
		}
		else
		{
			$this->error ("卸载失败",$ajax);
		}
	}
	public function insert()
	{
		$data = M('sms')->create ();
		$data['config'] = serialize($_REQUEST['config']);
		// 更新数据
		$log_info = $data['name'];
		$list= M('sms')->add($data);
		$this->assign("jumpUrl",u(MODULE_NAME."/index"));
		if (false !== $list) {
			//成功提示
			$this->success("安装成功",U('index'));
		} else {
			//错误提示
			
			$this->error("安装失败",U('index'));
		}
	}
	public function edit() {		
		$id = intval($_REQUEST ['id']);
		$condition['id'] = $id;		
		$vo = M('sms')->where($condition)->find();
		
		$directory = WEB_ROOT."/system/sms/";
		$read_modules = true;
		
		$file = $directory.$vo['class_name']."_sms.php";
		if(file_exists($file))
		{
			$module = require_once($file);
		}
		else
		{
			$this->error("出错啦");
		}
		$data = $vo;
		$vo['config'] = unserialize($vo['config']);
		
		$data['lang'] = $module['lang'];
		$data['config'] = $module['config'];
		$data['name']=htmlspecialchars_decode($data['name']);
		$this->assign ('vo', $vo );
		$this->assign ('data', $data );
		$this->display ();
	}
	public function update()
	{
		$data = M('sms')->create ();
		$data['config'] = serialize($_REQUEST['config']);
		$log_info = M('sms')->where("id=".intval($data['id']))->getField("name");

		$this->assign("jumpUrl",u("edit",array("id"=>$data['id'])));
		
		// 更新数据
		$list=M('sms')->save ($data);
		if (false !== $list) {
			//成功提示
			
			$this->success("编辑成功",U('index'));
		} else {
			//错误提示
			
			$this->error("编辑失败");
		}
	}
	public function use_effect()
	{
		$id = intval($_REQUEST['id']);
		$ajax = intval($_REQUEST['ajax']);
		M('sms')->where('is_effect=1')->setField("is_effect",0);	
		M('sms')->where("id=".$id)->setField("is_effect",1);	
		$this->success("成功使用该接口");	
	}
	public function check_fee()
	{
		$id = intval($_REQUEST['id']);
		$data = M("Sms")->getById($id);
		if($data)
		{
			include WEB_ROOT."/system/sms/".$data['class_name']."_sms.php";
			$sms_info = $data;
			$sms_info['config'] = unserialize($sms_info['config']);
			$sms_class = $data['class_name']."_sms";
			$sms_module = new $sms_class($sms_info);
			header("Content-Type:text/html; charset=utf-8");
			echo $sms_module->check_fee();
		}
		else
		{
			header("Content-Type:text/html; charset=utf-8");
			return "接口不存在";
		}
	}
	public function send_demo()
	{
		
		$test_mobile = $_REQUEST['test_mobile'];
		vendor('Sms.sms');
		$sms = new sms_sender();
		$result = $sms->sendSms($test_mobile,"11111");
		var_dump($result);die;
 		//$result = $GLOBALS['msg']->manage_msg("SMS_DEMO",$test_mobile);
		if($result['status'])
		{
			$this->success("发送成功",1);
		}
		else
		{
			
			$this->error($result['msg'],1);	
		}
	}
	
}