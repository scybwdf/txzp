<?php
namespace Home\Controller;
use Think\Controller;
class GroupController extends BaseController{
	public function index(){
		$group=M('auth_group');
		$list=$group->select();
		$this->list=$list;
		$this->display();
	}
	public function grouplist(){
		if($_GET){
		$search=I('search');	
		$group=M('auth_group');
		if($search!=''){
			$where['id']=$search;
			$where['title']=array('like',"%$search%");
			$where['_logic'] = 'or';
			$count = $group->where($where)->count();
			$list=$group->where($where)->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		else{
			$count = $group->count();
			$list=$group->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		$data['rows']=$list;
		$data['total']=$count;	
		$this->ajaxReturn($data);
		}
	}

	public function add(){
		if(IS_POST){
			$authgroup=D('group');
			$title=I('title');
			$rules=I('rules');
			$data=$_POST;
			if($title==""){
				$this->error("管理组名称不能为空");
			}
			elseif($authgroup->relation(true)->where(array('title'=>$title))->select()){
				$this->error("管理组已存在");
			}
			$id = $authgroup->insert($data);
			if($id){
				$data2=array('uid'=>$id,'group_id'=>$id);
				if(M('auth_group_access')->create($data2)){
					$result2=M('auth_group_access')->add($data2);
					if($result2){
						$this->success("新增成功!");
					}
					else{
						$this->error("新增失败!");
					}
				}
				else{
					$this->error("新增失败!");
				}
			}
			else{
				$this->error("新增失败!");
			}
		}
		else{
		$authass=M('auth_rule');
		$where=array('status'=>1);
		$list=$authass->where($where)->select();
		$this->assign("list",$list);
		$this->display();	
		}
		
	}
	public function edit(){
		if(IS_POST){
			$authgroup=D('group');
			$title=I('title');
			$rules=I('rules');
			$data=$_POST;
			if($title==""){
				$this->error("管理组名称不能为空");
			}
			elseif($authgroup->where(array('title'=>$title,'id'=>array('neq',$data['id'])))->select()){
				$this->error("管理组已存在");
			}
			elseif($authgroup->relation(true)->create($data)){
				
				$result=$authgroup->relation(true)->save($data);
				if($result){
					$this->success("编辑成功!");
					
				}
				else{
					$this->error("编辑失败!");
				}
			}
			else{
				$this->error("编辑失败!");
			}
		}
		if($_GET){
			$id=intval(I('id'));
			$authrule=M('auth_rule');
			$authgroup=M('auth_group');
			$where=array('id'=>$id);
			$authlist=$authrule->where(array('status'=>1))->select();
			$authadmin=$authgroup->where($where)->find();
			$authadmin['newrules']=explode(',',$authadmin['rules']);
			//var_dump($authadmin);die;
			$this->assign('list',$authlist);
			$this->assign('v',$authadmin);
			$this->display();
		}
	}
	
}
	