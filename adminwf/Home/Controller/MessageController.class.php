<?php
namespace Home\Controller;
use Home\Controller;
class MessageController extends BaseController{
 public function index2(){
     $message=M('message');
     $count=$message->count();
     $page=new \Think\Page($count,16);
     $show=$page->show();
     $list=$message->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
     $this->show=$show;
     $this->assign('list',$list);
     $this->display();
 }
public function index(){
		$this->display();
	}
	public function getlist(){
		if(IS_GET){
		if($_GET){
		$search=I('search');	
		$cate=M('message');
		if($search!=''){
			$where['id']=$search;
			//$where['name']=array('like',"%$search%");
			$where['_logic'] = 'or';
			$count = $cate->where($where)->count();
			$list=$cate->where($where)->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		else{
			$count = $cate->count();
			$list=$cate->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		$data['rows']=$list;
		$data['total']=$count;	
		$this->ajaxReturn($data);
		}
		
		}	
    
} }   