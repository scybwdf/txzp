<?php
namespace Home\Controller;
use Think\Controller;
class AjaxController extends CommonController {
   public function yuyue(){
	   if(IS_AJAX){
		   $data2=I();
		      $data2['create_time']=time();
			   $data2['ip']=get_client_ip();
		   	  $data2['is_new']=1;
			   $data2['source']=$_SERVER['HTTP_REFERER'];
			   $data2['area']=getarea($data2['ip']);
			   $data2['title']="手机端-".$data2['title'];
		   if($data2['name']==''){
			   $data['status']=0;
			   $data['info']="姓名不能为空";
			   $this->ajaxReturn($data);
		   }
		   if(!check_mobile($data2['mobile'])){
			   $data['status']=0;
			   $data['info']="手机号填写错误";
			    $this->ajaxReturn($data);
		   }
		   if($_COOKIE['subyuyue']==md5($data2['ip'].$data2['mobile'].$data2['source'])){
			   $data['status']=0;
			   $data['info']="您刚刚已经提交过了，请稍后再提交";
			   $this->ajaxReturn($data); 
		   }
		   else{
			  
			   if(M('yuyue')->create($data2)){
				   $result=M('yuyue')->add($data2);
				   if($result){
					   $value=md5($data2['ip'].$data2['mobile'].$data2['source']);
					   @setcookie('subyuyue',$value,time()+30,'/');
					   $data['status']=1;
					   $data['info']="预约成功!";
			   		   $this->ajaxReturn($data);  
				   }
				   else{
					   $data['status']=0;
					   $data['info']="预约失败，请稍后再试!";
			   		   $this->ajaxReturn($data);   
				   }
			   }
			   else{
				    $data['status']=0;
				    $data['info']="预约失败，请稍后再试!";
			   	    $this->ajaxReturn($data);   
			   }
			 
		   }
		  
		 
	   }
   }
}