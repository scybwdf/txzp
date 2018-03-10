<?php 
namespace Home\Controller;
use Think\Controller;
class YuyueController extends BaseController{
	public function index(){
		$this->display();
	}
	public function yylist(){
		if($_GET){
		$search=I('search');	
		$cate=M('yuyue');
		if($search!=''){
			$where['id']=$search;
			$where['ip']=$search;
			$where['mobile']=$search;
			$where['area']=array('like',"%$search%");
			$where['name']=array('like',"%$search%");
			$where['title']=array('like',"%$search%");
			$where['_logic'] = 'or';
			$count = $cate->where($where)->count();
			$list=$cate->where($where)->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		else{
			$count = $cate->count();
			$list=$cate->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		foreach($list as $k=>$v){
			$list[$k]['title']='<a href='.$v['source'].' >'.$v['title'].'</a>';
			$list[$k]['create_time']=date("Y-m-d H:i:s",$v['create_time']);
		}
		}
		$data['rows']=$list;
		$data['total']=$count;
		$cate->where(array('is_new'=>1))->setField('is_new',0);
		$this->ajaxReturn($data);
		}
		
	}