<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends BaseController{
	public function index(){
		$admin=M('admin');
		$group=M('group');
		$list=$admin->select();
		$grouplist=$group->select();
		$this->glist=$grouplist;
		$this->list=$list;
		$this->display();
	}
	public function add(){
		if(IS_POST){
			$data=I();
			$admin=M('admin');
			$data['creat_time']=time();
			$data['login_time']=time();
			$data['login_ip']=get_client_ip();
			
			unset($data['password']);
			$data['password']=md5(I('password'));
			if($data['username']==''){
				$this->error("管理员名称不能为空!");
			}
			elseif($admin->where(array('username'=>$data['username']))->select()){
				$this->error("用户已存在!");
			}
			elseif(I('password')==''){
				$this->error("密码不能为空!");
			}	
			elseif($admin->create($data)){
				$result=$admin->add($data);
				if($result){
					$this->success("新增成功");
				}
				else{
					$this->error("新增失败");
				}
			}
			else{
				$this->error("新增失败");
			}
			}
		else{
			$group=M('group');
			$grouplist=$group->where(array('status'=>1))->select();
			$this->assign('list',$grouplist);
			$this->display();
			}
		}
	
	public function edit(){
		if(IS_POST){
			$data=I();
			$admin=M('admin');
			$data['creat_time']=time();
			$data['login_time']=time();
			$data['login_ip']=get_client_ip();
			$data['password']=md5(I('password'));
			if(I('password')==''){
				unset($data['password']);
			}	
			if($data['username']==''){
				$this->error("管理员名称不能为空!");
			}
			elseif($admin->where(array('username'=>$data['username'],'id'=>array('neq'=>I('id'))))->select()){
				$this->error("用户已存在!");
			}
		
			elseif($admin->create($data)){
				$result=$admin->save($data);
				if($result){
					$this->success("编辑成功");
				}
				else{
					$this->error("编辑失败");
				}
			}
			else{
				$this->error("编辑失败");
			}
		}
			if($_GET){
			$id=I("id");
			$admin=M('admin')->where(array('id'=>$id))->find();
			$group=M('group')->where(array('status'=>1))->select();
			$this->assign("v",$admin);
			$this->assign("list",$group);
			$this->display();
		}
	}
	
	
}
	