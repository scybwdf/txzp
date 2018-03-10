<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends BaseController {
    public function index(){
      $this->display();
    }
   public function yylist(){
	   if($_GET){
		$search=I('search');	
		$cate=M('User');
		if($search!=''){
			$where['id']=$search;
			$where['login_ip']=$search;
			$where['mobile']=$search;
			$where['_logic'] = 'or';
			$count = $cate->where($where)->count();
			$list=$cate->where($where)->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		else{
			$count = $cate->count();
			$list=$cate->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		foreach($list as $k=>$v){
			$list[$k]['source']='<a href='.$v['source'].' >来源页详情</a>';
			$list[$k]['time']=date("Y-m-d H:i:s",$v['time']);
			$list[$k]['area']=getarea($v['login_ip']);
		}
		}
		$data['rows']=$list;
		$data['total']=$count;
	
		$this->ajaxReturn($data);
		}
    public function editface(){
        if(!IS_POST){
            echo "页面不存在！";
        }
        if(IS_POST){
            $data=$_POST;
            $db=M('admin');
            $where=array('id'=>session('auth')['id']);
            $field=array('face180,face64');
            $getuser=$db->where($where)->field($field)->find();
            if($db->where($where)->save($data)){
                if(!empty($getuser['face64'])){
                    @unlink(WEB_ROOT.$getuser['face64']);
                    @unlink(WEB_ROOT.$getuser['face180']);
                }
                $this->success("修改成功！");
            }
            else{
                $this->error("修改失败！");
            }
        }
	}
}
