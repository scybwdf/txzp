<?php
namespace Home\Controller;
use Think\Controller;
class BaikeController extends CommonController {
    public function index(){
		$article=M('article');
		$cate=M('article_cate');
		$lefttop_list=$cate->where(array('is_effect'=>1,'pid'=>41))->field('id,title,pid')->select();
		foreach($lefttop_list as $k=>$v){
			$listpid[$k]=$cate->where(array('is_effect'=>1,'pid'=>$v['id']))->field("id")->select();
		}
		foreach($listpid as $n){
			$cont1=$article->where(array('is_effect'=>1,'cate_id'=>$n[0]['id']))->field("id,title,brief")->select();
			if(empty($cont1)){
				continue;
			}
			if(count($cont)==10){
				break;
			}
			$cont[]=$cont1;
			
		}
		$this->assign("page_title","三板百科");
		$this->assign("cont",$cont);
		$this->assign("lefttop_list",$lefttop_list);
		$this->display();	
	}
	public function getall(){
		$article=M('article');
		$cate=M('article_cate');
		$lefttop_list=$cate->where(array('is_effect'=>1,'pid'=>41))->field('id,title,pid')->select();
		foreach($lefttop_list as $k=>$v){
			$listpid[$k]=$cate->where(array('is_effect'=>1,'pid'=>$v['id']))->field("id")->select();
		}
		foreach($listpid as $n){
			$cont1=$article->where(array('is_effect'=>1,'cate_id'=>$n[0]['id']))->field("id,title,brief")->select();
			if(empty($cont1)){
				continue;
			}
			$cont[]=$cont1;
		}
		$this->assign("cont",$cont[0]);
		$data['status']=1;
		$data['html']=$this->fetch('ajaxcont');
		$this->ajaxReturn($data);
	}
	public function getlist(){
		$id=intval($_POST['id']);
		$article=M('article');
		$cate=M('article_cate');
		$left_list=$cate->where(array('is_effect'=>1,'pid'=>$id))->select();
		$this->assign('left_list',$left_list);
		$data['status']=1;
		$data['html']=$this->fetch('ajaxleft');
		$this->ajaxReturn($data);
	}
	public function getcont(){
		$id=intval($_POST['id']);
		$cont=M('article')->where(array('is_effect'=>1,'cate_id'=>$id))->field('id,brief,title')->select();
		$data['status']=1;
		$this->assign("cont",$cont);
		$data['html']=$this->fetch("ajaxcont");
		$this->ajaxReturn($data);
	}
}