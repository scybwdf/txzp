<?php 
namespace Home\Controller;
use Think\Controller;
class ArticleController extends CommonController{
	public function index(){
		$article=M('article');
		$article_count=$article->where($artwhere)->field('id,title,writer,update_time,icon')->order('id desc')->count();
		$page=1;
		$page_size=10;
		$step=ceil($article_count/$page_size);
		$offeset=($page-1)*$page_size;
		if(!S('article_list')){
		$artwhere=array('is_effect'=>1,'cate_id'=>65);
		$article_list=$article->where($artwhere)->field('id,title,writer,update_time,icon')->order('id desc')->limit($offeset,$page_size)->select();
		S('article_list',$article_list);	
		}
		$this->assign('article_list',S('article_list'));
		$this->assign('step',$step);
		$this->display();
	}
	public function getart(){
		if(IS_AJAX){
		$article=M('article');
		$article_count=$article->where($artwhere)->field('id,title,writer,update_time,icon')->order('id desc')->count();
		$page=intval($_POST['page']);
		$page_size=10;
		$step=ceil($article_count/$page_size);
		$offeset=($page-1)*$page_size;
		if($page<=$step){
				$artwhere=array('is_effect'=>1,'cate_id'=>65);
		$article_list=$article->where($artwhere)->field('id,title,writer,update_time,icon')->order('id desc')->limit($offeset,$page_size)->select();
		$this->assign('article_list',$article_list);	
		$data['status']=1;
		$data['html']=$this->fetch("ajaxart");
		$this->ajaxReturn($data);	
		}
		else{
			$data['status']=0;
			$data['html']='';
			$this->ajaxReturn($data);	
		}	
	
	}
	}
	public function inside(){
		$id=intval($_GET['id']);
		if(isset($id)&&$id!=0){
			$article=M('article')->where(array('id'=>$id))->find();
			$article['tags']=preg_split("/[ ,]/",$article['tags']);
			$insidetj=M('article')->where(array('id'=>array('neq',$id),'id'=>array('gt',$id),'is_effect'=>1))->field('id,title,writer,update_time,icon,tags')->limit(3)->select();
			foreach($insidetj as $k=>$v){
				$insidetj[$k]['tags_arr']=preg_split("/[ ,]/",$v['tags']);
			}
			$this->assign('insidetj',$insidetj);
			$this->assign('article',$article);
			$this->assign('page_title',$article['title']);
			$this->display();	
		}
		else{
			header('location:'.U('Index/index'));
		}
	}
}