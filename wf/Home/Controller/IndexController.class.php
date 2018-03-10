<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
		$banner_list=S('load_banner_list')[0];
		$this->assign('banner_list',$banner_list);
		$deal=M('deal');
		$article=M('article');
		$xsb_hot=$deal->where(array('is_effect'=>1,'is_hot'=>1))->field('id,hot_image,business_descripe')->order('sort desc')->limit(4)->select();
		$this->assign('xsb_hot',$xsb_hot);
		$xsb_tuijian=$deal->where(array('is_effect'=>1,'is_recommend'=>1))->field('id,image,tags,readrow,daima,jianname')->order('sort desc')->limit(8)->select();
		foreach($xsb_tuijian as $k=>$v){
			$xsb_tuijian[$k]['image']=imgqudian($v['image']);
		}
		$this->assign('xsb_tuijian',$xsb_tuijian);
		$zx_top=$article->where(array('cate_id'=>65,'is_effect'=>1))->field('id,icon,title,brief,tags,update_time,writer')->order('sort desc')->limit(2)->select();
		foreach($zx_top as $k=>$v){
			$zx_top[$k]['icon']=imgqudian($v['icon']);
			$zx_top[$k]['tag_arr']= preg_split("/[ ,]/",$v['tags']);
		}
		$this->zx_top=$zx_top;
		$baike_top=$article->where(array('cate_id'=>41,'is_effect'=>1,'is_hot'=>1))->field('id,icon,title,brief,tags,update_time,writer')->order('sort desc')->limit(0,2)->select();
		$baike_list=$article->where(array('cate_id'=>41,'is_effect'=>1))->field('id,icon,title,brief,tags,update_time,writer')->order('sort desc')->limit(2,5)->select();
		//var_dump($baike_list);die;
		$this->baike_top=$baike_top;
		$this->baike_list=$baike_list;
		$this->display();
    }
	
}