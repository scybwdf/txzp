<?php
namespace Home\Controller;
use Think\Controller;
class DealController extends CommonController {
    public function index(){
		$banner_list=S('load_banner_list')[1];
		$this->assign('banner_list',$banner_list);
		$deal=M('deal');
		$gettags=$_POST['tags'];
		$getarea=$_POST['area'];
		if(!isset($getarea)&&!isset($gettags)||$gettags=="全部"&&$getarea=="全部"){
			$where=array(
			"is_effect"=>1,
			'is_huati'=>0
			);
		}
		elseif($gettags=="全部"&&$getarea!="全部"){
			$where=array(
			"is_effect"=>1,
			'is_huati'=>0,
			'province'=>$getarea	
			);
		}
		elseif($gettags!="全部"&&$getarea=="全部"){
			$where=array(
			"is_effect"=>1,
			'is_huati'=>0,
			'tags'=>$gettags	
			);
		}
		else{
			$where=array(
			"is_effect"=>1,
			'is_huati'=>0,
			'tags'=>$gettags,
			'province'=>$getarea	
			);
		}
		
		$wheres=array("is_effect"=>1,'is_huati'=>0);
		$tags=tagsquchong($deal->where($wheres)->field('tags')->select());
		$area=tagsquchong($deal->where($wheres)->field('province')->select());
		$this->assign("tags",$tags);
		$this->assign("area",$area);
		$count=$deal->where($where)->count();
		$page=new \Think\Page($count,9);
		/* foreach($where as $k=>$v){
            $page->parameter[$k]=urlencode($v);
        }*/
	    $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('last','末页');
		$deal_list=$deal->where($where)->order('sort desc')->field('id,tags,image,business_name,daima,business_descripe')->limit($page->firstRow.','.$page->listRows)->select();
		$pages=$page->show();
		$this->pages=$pages;
		$this->assign("page_title","精选项目");
		$this->deal_list=$deal_list;
		if(IS_AJAX&&IS_POST){
			$html=$this->fetch("pageajax");
			$this->ajaxReturn($html);
		}
		elseif(IS_AJAX&&IS_GET){
			$html=$this->fetch("pageajax");
			$this->ajaxReturn($html);
		}
		$this->display();
    }
	public function inside(){
		$id=intval(I('id'));
		if($id){
			$dealin=M('deal')->field('id,tags,image,business_name,daima,business_descripe,province,city,jianname,zqdaima,guben,fcfangan,fdquanshang,zrfangshi,item_good,vedio,description_2')->find($id);
			$dealin['image']=imgqudian($dealin['image']);
			$dealin['item_good']=htmlspecialchars_decode($dealin['item_good']);
			$dealin['description_2']=htmlspecialchars_decode($dealin['description_2']);
			$dd=M('deal')->where(array('id'=>$id))->setInc('readrow');
			$this->assign('dealin',$dealin);
			$tuijian=M('deal')->where(array('id'=>array('neq',$id),'is_effect'=>1))->field('id,image')->order('sort asc')->limit(3)->select();
			foreach($tuijian as $k=>$v){
			$tuijian[$k]['image']=imgqudian($v['image']);	
			}
			$zbp=intval($_REQUEST['zbp']);
            if($zbp==""){
                $zbp=1; 
            }
           $zbpage_size=5;
			$zbwhere=array('is_effect'=>1,'cate_id'=>110);
            $getzbcount=M('article')->where($zbwhere)->order('id desc')->count();
            $zbmes_count=ceil($getzbcount/$zbpage_size);
            $zboffeset=($zbp-1)*$zbpage_size;
			$getzbanlie=M('article')->where($zbwhere)->order('id desc')->limit($zboffeset,$zbpage_size)->select();
			
            if($zbp==1||$zbp==""){
                $zbdata['zbprev']=$zbmes_count;
				if($zbp==$zbmes_count){
					 $zbdata['zbnext']=1;
				}
                else{$zbdata['zbnext']=$zbp+1;}
            
            }
          
            elseif($zbp==$zbmes_count){
                $zbdata['zbprev']=$zbp-1;
                 $zbdata['zbnext']=1;
              
               
            }
              else{
                $zbdata['zbprev']=$zbp-1;
                $zbdata['zbnext']=$zbp+1;
               
            }
           $this->assign('zbprev', $zbdata['zbprev']);
            $this->assign('zbnext', $zbdata['zbnext']);
            $this->assign('zbanlie',$getzbanlie);
			$this->assign('tuijian',$tuijian);
			$article=M('article')->where(array('is_effect'=>1))->field('id,title')->limit(5)->select();
			$this->assign('article',$article);
			$this->assign("page_title",$dealin['business_name']);
			$this->display();
		}
		else{
			header("content-type:text/html;charset='utf-8'");
			$this->redirect('Index/index');
		}
		
	}
	public function qaneeq(){
		$this->display();
	}
	public function getzbanlie(){
        //自写转板案列
           $zbp=intval($_REQUEST['zbp']);
            if($zbp==""){
                $zbp=1; 
            }
           $zbpage_size=5;
			$zbwhere=array('is_effect'=>1,'cate_id'=>110);
            $getzbcount=M('article')->where($zbwhere)->order('id desc')->count();
            $zbmes_count=ceil($getzbcount/$zbpage_size);
            $zboffeset=($zbp-1)*$zbpage_size;
			$getzbanlie=M('article')->where($zbwhere)->order('id desc')->limit($zboffeset,$zbpage_size)->select();
            if($zbp==1||$zbp==""){
                $zbdata['zbprev']=$zbmes_count; 
				if($zbp==$zbmes_count){
					 $zbdata['zbnext']=1;
				}	
                 else{$zbdata['zbnext']=$zbp+1;}
            }
          
            elseif($zbp==$zbmes_count){
                $zbdata['zbprev']=$zbp-1;
                 $zbdata['zbnext']=1;
               
            }
              else{
                $zbdata['zbprev']=$zbp-1;
                $zbdata['zbnext']=$zbp+1;
              
            }
			$this->assign('zbanlie',$getzbanlie);
			$zbdata['html']=$this->fetch('ajaxzbanlie');
            $this->ajaxReturn($zbdata);
    }
}