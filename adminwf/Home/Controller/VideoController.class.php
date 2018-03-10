<?php 
namespace Home\Controller;
use Think\Controller;
class VideoController extends BaseController{
	public function index(){
		$this->display();
	}
	public function videolist(){
		if($_GET){
		$search=I('search');	
		$cate=M('Video');
		if($search!=''){
			$where['id']=$search;
			$where['name']=array('like',"%$search%");
			$where['_logic'] = 'or';
			$count = $cate->where($where)->count();
			$list=$cate->where($where)->field('id,name,is_effect,is_hot,is_index,sort')->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		else{
			$count = $cate->count();
			$list=$cate->field('id,name,is_effect,is_hot,is_index,sort')->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		$data['rows']=$list;
		$data['total']=$count;	
		$this->ajaxReturn($data);
		}
	}
	 public function add(){
		if(!IS_POST){
			$this->assign('vosort',M(CONTROLLER_NAME)->max('sort')+1);
			$this->display();
		}
		if(IS_POST){
      $Article=M(CONTROLLER_NAME);
			$data=I();
			if($data['name']==''){
			$this->error('新增失败');	
			}
			$data['create_time']=time();
			$data['update_time']=time();
        if($Article->create($data)){
            $result=$Article->add($data);
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
		$data=$Article->find($id);	
        $this->assign('vo',$data);
        $this->display();}
		if(IS_POST){
			$artedit=M(CONTROLLER_NAME);
			if($artedit->create()){
				$result=$artedit->save();
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