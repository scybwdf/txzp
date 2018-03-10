<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends BaseController{
	public function index(){
		$this->display();
	}
		public function adminlist(){
		if($_GET){
		$search=I('search');	
		$admin=D('admin');
		if($search!=''){
			$where['id']=$search;
			$where['username']=array('like',"%$search%");
			$where['_logic'] = 'or';
			$count = $admin->where($where)->count();
			$list=$admin->relation(true)->where($where)->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		else{
			$count = $admin->count();
			$list=$admin->relation(true)->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		unset($list['uid']);	
		foreach($list as $k=>$v){
			$list[$k]['uid']=$v['title'];
			$list[$k]['login_time']=date("Y-m-d h:i:s",$v['login_time']);
		}	
		$data['rows']=$list;
		$data['total']=$count;	
		$this->ajaxReturn($data);
		}
	}
	public function add(){
		if(IS_POST){
			$data=$_POST;
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
			$group=M('auth_group');
			$grouplist=$group->where(array('status'=>1))->select();
			$this->assign('list',$grouplist);
			$this->display();
			}
		}
	
	public function edit(){
		if(IS_POST){
			$data=$_POST;
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
			$group=M('auth_group')->where(array('status'=>1))->select();
			$this->assign("v",$admin);
			$this->assign("list",$group);
			$this->display();
		}
	}
		
}
	