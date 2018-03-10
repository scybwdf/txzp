<?php
namespace Home\Controller;
use Think\Controller;
class VideoController extends CommonController{
	public function index(){
		if(!S('videolis')){
		$videolis=M('Video')->where(array('is_effect'=>1))->field('id,img,name,readrow,update_time')->order('sort desc')->select();
		S('videolis',$videolis);	
		}
		$this->assign("videolis",S('videolis'));
		$this->display();
	}
	public function inside(){
		$id=intval($_GET['id']);
		if(isset($id)&&$id!=0){
			if(!S('videoin'.$id)){
			$videoin=M('Video')->where(array('id'=>$id))->find();
			S('videoin'.$id,$videoin);
			}
			$this->assign('videoin',S('videoin'.$id));
			$this->display();
		}
		else{
			header('location:'.U('Video/index'));
		}
	}
}