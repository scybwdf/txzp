<?php 
namespace Home\Controller;
use Think\Controller;
class LuyanController extends BaseController{
	public function index(){
		$this->display();
	}
	public function luyanlist(){
		if($_GET){
		$search=I('search');	
		$cate=M('Luyan');
		if($search!=''){
			$where['id']=$search;
			$where['name']=array('like',"%$search%");
			$where['_logic'] = 'or';
			$count = $cate->where($where)->count();
			$list=$cate->where($where)->field('id,name,is_end,is_effect,sort')->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		else{
			$count = $cate->count();
			$list=$cate->field('id,name,is_end,is_effect,sort')->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		$data['rows']=$list;
		$data['total']=$count;	
		$this->ajaxReturn($data);
		}
	}
	 public function add(){
		if(!IS_POST){
			$this->assign('vosort',M('Luyan')->max('sort')+1);
			$this->display();
		}
		if(IS_POST){
      $Article=M('Luyan');
			$data=I();
			if($data['name']==''){
			$this->error('新增失败');	
			}
			$data['create_time']=time();
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
		$Article=M('Luyan');
		$data=$Article->find($id);	
        $this->assign('vo',$data);
        $this->display();}
		if(IS_POST){
			$artedit=D('Luyan');
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