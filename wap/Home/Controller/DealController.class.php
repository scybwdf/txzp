<?php
namespace Home\Controller;
use Think\Controller;
class DealController extends CommonController{
	public function index(){
		$deal=M('deal');
		$wheres=array("is_effect"=>1,'is_huati'=>0);
		$tags=tagsquchong($deal->where($wheres)->field('tags')->select());
		$area=tagsquchong($deal->where($wheres)->field('province')->select());
		$gettags=$_POST['tags'];
		$getarea=$_POST['area'];
		$key=$_POST['key'];
		$type=intval($_POST['type']);
		$page=intval($_POST['page']);
			if(!isset($getarea)&&!isset($gettags)&&$key==''||$gettags=="全部"&&$getarea=="全部"&&$key==''){
			$where=array(
			"is_effect"=>1,
			'is_huati'=>0,
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
		elseif($key!=''&&$gettags==''&&$getarea==''){
			$where=array(
			"is_effect"=>1,
			'is_huati'=>0,
			'business_name|tags|province|city'=>array('like','%'.$key.'%')
			);
		}
		elseif($key!=''&&$gettags!=''&&$getarea!=''){
			$where=array(
			"is_effect"=>1,
			'is_huati'=>0,
			'business_name|tags|province|city'=>array('like','%'.$key.'%')	
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
		if($page==0||!isset($page)){$page=1;}
		else{
			$page=$page;
		}
		
		$page_size=4;
		$count=$deal->where($where)->count();
		$step=ceil($count/$page_size);
		$offset=($page-1)*$page_size;
		$deal_list=$deal->where($where)->order('sort desc')->field('id,tags,mobile_img,business_name,daima,city,province')->limit($offset,$page_size)->select();
		$this->assign('deal_list',$deal_list);
	
		if(IS_AJAX&&IS_POST&&$step>=$page){
			$data['status']=1;
			$data['step']=$step;
			$data['html']=$this->fetch("ajaxcontent");
			$this->ajaxReturn($data);
		
		}
		elseif(IS_AJAX&&IS_POST&&$step<$page){
			$data['status']=0;
			$data['step']=$step;
			$data['html']=$this->fetch("ajaxcontent");
			$this->ajaxReturn($data);
		}
		elseif(IS_AJAX){
			$data['status']=0;
			$data['step']=$step;
			$data['html']=$this->fetch("ajaxcontent");
			$this->ajaxReturn($data);
		}
		$this->assign('step',$step);
		$this->assign('tagslist',$tags);
		$this->assign('arealist',$area);
		$this->display();
    }
	
	public function inside(){
		$id=intval(I('id'));
		if($id){
			$dealin=M('deal')->field('id,tags,mobile_img,business_name,daima,business_descripe,province,city,jianname,zqdaima,guben,fcfangan,fdquanshang,zrfangshi,item_good,vedio,mobile_inside')->find($id);
			$dealin['mobile_img']=imgqudian($dealin['mobile_img']);
			$dealin['mobile_inside']=htmlspecialchars_decode($dealin['mobile_inside']);
			M('deal')->where(array('id'=>$id))->setInc('readrow');
			$this->assign('dealin',$dealin);
		$this->display();
	}
}
}