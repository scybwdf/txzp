<?php
namespace Home\Controller;
use Think\Controller;
class MsgtempController extends BaseController {
		public function index()
	{
		$tpl_list = M("MsgTemp")->where("type = 0 ")->select();
		//var_dump($tpl_list);die;
		$this->assign("tpl_list",$tpl_list);
		$this->display();
	}	
	public function load_tpl()
	{
		$name = trim($_REQUEST['name']);
		$tpl = M("MsgTemp")->where("name='".$name."'")->find();
		if($tpl)
		{
			$tpl['tip'] = l("MSG_TIP_".strtoupper($name));
			$tpl['status']=1;
			$this->ajaxReturn($tpl);
		}
		else
		{	$tpl['status']=0;
			$this->ajaxReturn($tpl);
		}		
	}
	
	public function update()
	{
		//$data = M(MODULE_NAME)->create ();
		$data = array();
		$data['id'] = intval($_REQUEST['id']);
		$data['name'] = $_REQUEST['name'];
		//$data['content'] = $_REQUEST['content'];
		$data['content'] = stripslashes($_REQUEST['content']);
		$data['is_html'] = intval($_REQUEST['is_html']);
		
		$return=array('info'=>'','status'=>'0');
		if($data['name']=='' || $data['id']==0)
		{
			$info=l("SELECT_MSG_TPL");
			header("Content-Type:text/html; charset=utf-8");
			echo $info;
		}
		$log_info = $data['name'];
		
		// 更新数据
		$list=M('MsgTemp')->save($data);
		if (false !== $list) {
			$return['info']=$data['name']."模板更新成功";
			$return['status']=1;
			header("Content-Type:text/html; charset=utf-8");
			$this->ajaxReturn($return);
			
		} else {
			//错误提示
			
			$return['info']=$data['name']."模板更新失败";
			$return['status']=0;
			header("Content-Type:text/html; charset=utf-8");
			$this->ajaxReturn($return);

		}
	}
	public function ajax_tpl()
	{
		$type=intval($_REQUEST['type']);
		$tpl_list = M("MsgTemp")->where("type=".$type)->select();
		
		$data['list'] = $tpl_list;
		$data['type'] = $type;
		$data['status']=1;
		
		$this->ajaxReturn($data);
	}
}