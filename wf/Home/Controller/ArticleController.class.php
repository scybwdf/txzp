<?php
namespace Home\Controller;
use Think\Controller;
class ArticleController extends CommonController {
    public function index(){
		$banner_list=S('load_banner_list')[3];
		//$this->assign('banner_list',$banner_list);
		$article=M('Article');
		$where=array('is_effect'=>1,'cate_id'=>65);
		$count=$article->where($where)->count();
		$page=new \Think\Page($count,10);
		 foreach($where as $k=>$v){
           // $page->parameter[$k]=urlencode($v);
        }
	    $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('last','末页');
		 $page->rollPage=5; 
		$article_list=$article->where($where)->order('sort desc')->field('id,tags,icon,brief,title,update_time')->limit($page->firstRow.','.$page->listRows)->select();
		foreach($article_list as $k=>$v){
			$article_list[$k]['icon']=imgqudian($v['icon']);
			$article_list[$k]['tags_arr']=preg_split("/[ ,]/",$v['tags']);
		}
		$newhot=$article->where(array('is_effect'=>1,'is_hot'=>1,'cate_id'=>65))->limit(10)->select();
		$pages=$page->show();
		$this->assign('newhot',$newhot);
		$this->assign('article_list',$article_list);
		$this->pages=$pages;
		$this->assign("page_title","三板资讯");
		$this->display();
    }
	public function inside(){
		$id=intval(I('id'));
		$article=M('article')->find($id);
		M('article')->where(array('id'=>$id))->setInc('click_count');
		$article['tags_arr']=preg_split("/[ ,]/",$article['tags']);
		$article['content']=htmlspecialchars_decode($article['content']);
		$prevarticle=M('article')->where(array('id'=>$id-1))->field('id,title')->find();
		$nextarticle=M('article')->where(array('id'=>$id+1))->field('id,title')->find();
		$this->assign('prevarticle',$prevarticle);
		$this->assign('nextarticle',$nextarticle);
		$tuijianart=M('article')->where(array('id'=>array("lt",$id)))->field('id,title,icon')->limit(3)->order('id desc')->select();
		foreach($tuijianart as $k=>$v){
			$tuijianart[$k]['icon']=imgqudian($v['icon']);
		}
		$articlehot=M('article')->where(array('is_effect'=>1,'id'=>array('neq',$id),'is_hot'=>1))->field('id,title')->limit(10)->select();
		$hot_deal=M('deal')->where(array('is_effect'=>1,'is_hot'=>1))->field('id,image')->find();
		$hot_deal['image']=imgqudian($hot_deal['image']);
		$this->hot_deal=$hot_deal;
		$this->assign("articlehot",$articlehot);
		$this->assign("tuijianart",$tuijianart);
		$this->assign('article',$article);
		$this->assign("page_title",$article['title']);
		$this->display();
	}
	
}