<?php 
namespace Home\Controller;
use Think\Controller;
class DealController extends BaseController{
	public function index(){
		$this->display();
	}
	public function deallist(){
		if($_GET){
		$search=I('search');	
		$cate=M('Deal');
		if($search!=''){
			$where['id']=$search;
			$where['name']=array('like',"%$search%");
			$where['_logic'] = 'or';
			$count = $cate->where($where)->count();
			$list=$cate->where($where)->field('id,business_name,writer,is_hot,is_huati,is_effect,is_recommend,sort')->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		else{
			$count = $cate->count();
			$list=$cate->field('id,business_name,writer,is_hot,is_huati,is_effect,is_recommend,sort')->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		$data['rows']=$list;
		$data['total']=$count;	
		$this->ajaxReturn($data);
		}
	}
	 public function add(){
		if(!IS_POST){
			$this->assign('vosort',M('Deal')->max('sort')+1);
			$this->display();
		}
		if(IS_POST){
      $Article=M('Deal');
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
		$Article=M('Deal');
		$data=$Article->find($id);
		$data['image']=imgqudian($data['image']);
		$data['description_2']=imgqudian($data['description_2']);	
        $this->assign('vo',$data);
        $this->display();}
		if(IS_POST){
			$artedit=D('Deal');
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