<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
   public function _initialize(){
	   if(isset($_COOKIE['pcautouser'])&&!session('pcuser')){
            $value=$_COOKIE['pcautouser'];
            $value=encrypetion($value,1);
            $ip=get_client_ip();
            $data=explode('|',$value);
            if($ip==$data[1]){
                $where=array('mobile'=>$data[0]);
                $user=M('user')->where($where)->find();
                if($user&&!$user['lock']){
                    session('pcuser',$user['mobile']);
                }
            } 
        }

	  if(!S('load_nav_list')){
		$get_nav=M('Nav')->where(array('is_effect'=>1))->order('sort asc')->select();
		$nav_list=get_nav_list($get_nav);
			S('load_nav_list',$nav_list);
		}
	   if(!S('load_banner_list')){
		   $get_banner=M('banner')->where(array('is_effect'=>1))->order('sort asc')->select();
		   $get_banner_array=array();
		   foreach($get_banner as $k=>$v){
			   $get_banner_array[$v['type']][$v['id']]=$v;
		   }
		   S('load_banner_list',$get_banner_array);
	   }
	  // header("content-type:text/html;charset='utf8'");
	//  var_dump(S('load_banner_list')[0]);die;
		$this->assign('nav_list',S('load_nav_list'));
   }
  
}