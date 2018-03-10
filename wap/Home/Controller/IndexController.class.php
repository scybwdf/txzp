<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
		$banner_list=S('load_banner_list')[7];
		$this->assign('banner_list',$banner_list);
		if(!S('hot_art')){
			$hot_art=M('article')->where(array('is_effect'=>1,'is_hot'=>1,'cate_id'=>65))->field('id,title')->limit(3)->select();
			S('hot_art',$hot_art);
		}
		$this->assign('hot_art',S('hot_art'));
		if(!S('hot_deal')){
		$hot_deal=M('deal')->where(array('is_effect'=>1,'is_hot'=>1))->field('id,jianname,province,city,daima,frdaibiao,mobile_img')->limit(3)->select();
		S('hot_deal',$hot_deal);
		}
		$this->assign('hot_deal',S('hot_deal'));
		
		if(!S('artlist')){
		$artlist=M('article')->where(array('is_effect'=>1,'cate_id'=>65))->field('id,title,update_time,tags')->limit(5)->select();
		foreach($artlist as $k=>$v){
			$artlist[$k]['tag_arr']=preg_split("/[ ,]/",$v['tags']);
		}
			S('artlist',$artlist);	
		}	
		$this->assign('artlist',S('artlist'));
		if(!S('video_top')){
		$video_top=M('Video')->where(array('is_effect'=>1,'is_hot'=>1))->field('id,readrow,update_time,name,img')->order('sort desc')->find();
			S('video_top',$video_top);	
		}
		$this->assign('video_top',S('video_top'));
		if(!S('video_index')){
		$video_index=M('Video')->where(array('is_effect'=>1,'is_index'=>1))->field('id,readrow,update_time,name,img')->order('sort desc')->limit(3)->select();
			S('video_index',$video_index);	
		}	
		$this->assign('video_index',S('video_index'));
		$this->display();
    }
	
}