<?php 
namespace Home\Controller;
use Think\Controller;
class BannerController extends BaseController{
	public function __construct(){
		parent::__construct();
		$banner_type=array(
		'0'=>'首页',
		'1'=>'项目列表',
		'2'=>'项目内页',
		'3'=>'路演列表',
		'4'=>'路演内页',
		'5'=>'文章列表',
		'6'=>'文章内页',
		'7'=>'手机端首页'	
		);
		
		$this->banner_type=$banner_type;
	}
	public function index(){
		$this->display();
	
	}
	public function artlist(){
		if($_GET){
		$search=I('search');	
		$cate=M(CONTROLLER_NAME);
		if($search!=''){
			$where['id']=$search;
			$where['title']=array('like',"%$search%");
			$where['_logic'] = 'or';
			$count = $cate->where($where)->count();
			$list=$cate->where($where)->field('id,title,type,is_effect,sort')->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		else{
			$count = $cate->count();
			$list=$cate->field('id,title,type,is_effect,sort')->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		$banner=$this->banner_type;
		foreach($list as $k=>$v){
			$list[$k]['type']=$banner['banner_type'][$v['type']];
		}	
		$data['rows']=$list;
		$data['total']=$count;	
		$this->ajaxReturn($data);
		}
	}
	 public function add(){
		if(!IS_POST){
			$article=M(CONTROLLER_NAME);
			$this->assign('vosort',M(CONTROLLER_NAME)->max('sort')+1);
			$this->display();
		}
		if(IS_POST){
      	$Article=D(CONTROLLER_NAME);
        if($Article->create()){
            $result=$Article->add();
            if($result){
			
                $this->success('新增成功',U('index'));
            }
            else{
                $this->error('新增失败');
            }}
            else{
                $this->error($Article->getError());
		}}
        
        }
    public function edit(){
		 $id=I('id');
		if(!IS_POST){
		$Article=M(CONTROLLER_NAME);
        $this->assign('vo',$Article->find($id));
        $this->display();}
		if(IS_POST){
			$artedit=D(CONTROLLER_NAME);
			if($data=$artedit->create()){
				$result=$artedit->save($data);
				if($result){
					$this->success('编辑成功',U('index'));
				}
				else{
					$this->error('编辑失败');
				}
			}
			else{
				$this->error($artedit->getError());
			}
		}
    }
   
}