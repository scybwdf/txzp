<?php
namespace Home\Controller;
use Think\Controller;
class UserSettingController extends CommonController {
    public function index(){
		
		$where=array('uid',session('uid'));
		$field=array('username','truename','sex','location','constellation','intro','face180');
		$user=M('userinfo')->field($field)->where($where)->find();
		$this->user=$user;
		$this->display();
    }
	public function editBasic(){
		if(!IS_POST){
			redirect(U('Index/index'));
		}
		else{
			
			$data=array(
				'username'=>I('nickname'),
				'truename'=>I('truename'),
				'sex'=>I('sex'),
				'location'=>I('province').''.I('city'),
				'constellation'=>I('night'),
				'intro'=>I('intro')
			);
			$where=array('uid'=>session('uid'));
			$result=M('userinfo')->where($where)->save($data);
			if($result){
				$this->success("修改成功");
			}
			else{
				$this->error("修改失败");
			}
		}
	}
	public function editface(){
		if(!IS_POST){
			echo "页面不存在";
		}
		if(IS_POST){
			$data=I();
			$db=M('userinfo');
			$where=array('uid'=>session('uid'));
			$filed=array('face180','face80','face50');
			$old=$db->where($where)->field($filed)->find();
			if($db->where($where)->save($data)){
				if(!empty($old['face50'])){
					@unlink('.'.$old['face180']);
					@unlink('.'.$old['face80']);
					@unlink('.'.$old['face50']);
				}
				$this->success("编辑成功");
			}
			else{
				$this->error("编辑失败");
			}
		}
	}
}