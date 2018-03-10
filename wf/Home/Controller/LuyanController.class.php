<?php
namespace Home\Controller;
use Think\Controller;
class LuyanController extends CommonController {
    public function index(){
		$banner_list=S('load_banner_list')[3];
		$this->assign('banner_list',$banner_list);
		$luyan=M('Luyan');
		$start_list=$luyan->where(array('is_effect'=>1,'is_end'=>0))->order('sort desc')->select();
		$end_list=$luyan->where(array('is_effect'=>1,'is_end'=>1))->order('sort desc')->select();
		$this->assign("page_title","三板路演");
		$this->assign('start_list',$start_list);
		$this->assign('end_list',$end_list);
		$this->display();
    }
	public function inside(){
		$id=intval(I('id'));
		$luyan=M('Luyan')->find($id);
		M('Luyan')->where(array('id'=>$id))->setInc('readrow');
		$this->assign("page_title",$luyan['name']);
		$this->assign('luyan',$luyan);
		$this->display();
	}
	
}