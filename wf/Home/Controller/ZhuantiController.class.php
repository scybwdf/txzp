<?php
namespace Home\Controller;
use Think\Controller;
class ZhuantiController extends CommonController{
	public function inside(){
		$id=intval($_GET['id']);
		if(isset($id)&&$id!=0){
			$zhuanti=M('deal')->where(array('id'=>$id))->field('id,pczhuanti,name')->find();
			M('deal')->where(array('id'=>$id))->setInc('readrow');
			$zhuanti['pczhuanti']=htmlspecialchars_decode($zhuanti['pczhuanti']);
			$this->assign('zhuanti',$zhuanti);
			$this->assign('page_title',$zhuanti['name']);
			$this->display();	
		}
		else{
			header('location:'.U('Index/index'));
		}
		
	}
}