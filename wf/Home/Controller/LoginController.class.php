<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
		if(isset($_COOKIE['userauto'])){
			redirect(U('Index/index'));
		}
		if(IS_POST){
			$account=I('account');
			$password=I('password','','md5');
			$where=array('account'=>$account);
			$find=M('user')->where($where)->find();
			if(!$find||$find['password']!=$password){
				$this->error('用户名或密码错误');
			}
			if($find['lock']){
				$this->error('用户账户被锁定');
			}
			
			if(isset($_POST['userauto'])){
				$account=$find['account'];
				$ip=get_client_ip();
				$value=$account.'|'.$ip;
				$value=encryption($value);
				@setcookie('userauto',$value,C('AUTO_LOGIN_TIME'),'/');
				$value=encryption($value,1);
				
			}
			
				session('uid',$find['id']);
				header('Content-type:text/html;Charset=UTF-8');
				redirect(U('Index/index'),3,'登陆成功正在跳转...');
			
		}
		
		$to='858586480@qq.com';
		$subject="dddaqadq";
		//$content="ddddd";
			//$info['content']="欢迎使用悦无限产品";
			//$info['send_time']=date("Y-m-d H:i:s");
			//$this->assign("info",$info);
			//$content=$this->fetch("./mail_html/demo.html");
			//echo $content;die;
			//echo $_SERVER['SERVER_NAME']; die;
			//$mail=send_mail($to,$subject,$content);
		
			//$this->display();
		redirect(U('Index/index'));	
    }
	public function loginout(){
		 session_unset();
		 session_destroy();
        @setcookie('pcautouser','',time() - 3600,'/');
		@setcookie('puser','',time() - 3600,'/');
      	$data['status']=1;
		$this->ajaxReturn($data);
	}
	public function do_login(){
		if(IS_POST){
			$mobile=intval($_POST['mobile']);
			$password=I('password','','md5');
			$where=array('mobile'=>$mobile);
			$find=M('user')->where($where)->find();
			if(!$find||$find['password']!=$password){
			
					$data['status']=0;
					$data['info']="用户名或密码错误";
					$this->ajaxReturn($data);
				
			}
			if($find['lock']){
					$data['status']=0;
					$data['info']="用户账户被冻结";
					$this->ajaxReturn($data);
			}
			else{
				$data2['login_time']=time();
				$data2['login_ip']=get_client_ip();
				
				M('user')->create($data2);
				M('user')->where(array('mobile'=>$find['mobile']))->save($data2);
				$mobile=$find['mobile'];
				$ip=get_client_ip();
				$value=$mobile.'|'.$ip;
				$value=encrypetion($value);
				@setcookie('pcautouser',$value,C('AUTO_LOGIN_TIME'),'/');
				@setcookie('puser',$mobile,C('AUTO_LOGIN_TIME'),'/');
				$_SESSION['pcuser']=$mobile;
				$data['status']=1;
					$data['info']="登录成功";
					$this->ajaxReturn($data);
			}
		}
	}
	public function register(){
		if($_SESSION['uid']){
			$this->redirect('login');
			
		}
		if(IS_POST){
			$code=I('verify','','strtolower');
			if(!$this->check_verify($code)){
				$this->error('验证码错误');
			}
			if(I('password')!=I('repassword')){
				$this->error('两次密码输入不一致');
			}
			$data=array(
						'account'=>I('account'),
						'password'=>I('password','','md5'),
						'time'=>time(), 
						'userinfo'=>array(
										'username'=>I('username')
										)		
			);
			$id=D('User')->insert($data);
			if($id){
				session('uid',$id);
				$this->redirect(U('Index/index'));
			}
			else{
				$this->error('注册失败');
			}
		}
		else{
			$this->display();
			}
	}
public function do_register(){
		if(IS_POST){
			$mobile=$_POST['mobile'];
			$password=$_POST['password'];
			$msgverify=$_POST['code'];
			if($mobile==""){
				$data['status']=0;
				$data['info']="手机号码不能为空！";
				ajax_return($data);
			}
			elseif(!check_mobile($mobile)){
				$data['status']=0;
				$data['info']="请填写正确的手机号码！";
				ajax_return($data);
			}
			elseif($password==""){
				$data['status']=0;
				$data['info']="密码不能为空!";
				ajax_return($data);
			}
			elseif($msgverify==""){
				$data['status']=0;
				$data['info']="验证码不能为空!";
				$this->ajaxReturn($data);
			}
			
			else{
				$data2['mobile']=$mobile;
				$data2['account']=$mobile;
				$data2['password']=md5($password);
				$data2['time']=time();
				$data2['login_time']=time();
				$data2['login_ip']=get_client_ip();
				$data2['source']=$_SERVER['HTTP_REFERER'];
				if(M('user')->create($data2)){
					$result=M('user')->add($data2);
					if($result){
				M('mobile_verify_code')->where(array('mobile'=>$mobile))->delete();
				$ip=get_client_ip();
				$value=$mobile.'|'.$ip;
				$value=encrypetion($value);
				@setcookie('pcautouser',$value,C('AUTO_LOGIN_TIME'),'/');
				@setcookie('puser',$mobile,C('AUTO_LOGIN_TIME'),'/');		
				$_SESSION['pcuser']=$mobile;	
				$data['status']=1;
				$data['info']="注册成功！";
				$this->ajaxReturn($data);		
				}
				else{
					$data['status']=0;
					$data['info']="注册失败，请稍后再试";
					$this->ajaxReturn($data);	
				}
				}
				else{
					$data['status']=0;
					$data['info']="注册失败，请稍后再试";
					$this->ajaxReturn($data);	
				}
			}
			
		}
		else{
			echo "页面不存在！";
		}
	}
	public function checkmo(){
		$mobile=$_POST['mobile'];
		$result=M('user')->where(array('mobile'=>$mobile))->count();
		if($result==0){
			echo 'true';
		}
		else{
			echo 'false';
		}
	}
	public function get_msgcode(){
		$mobile=$_POST['mobile'];
		if($mobile==""){
			$data['status']=0;
			$data['info']="手机号不能为空!";
			$this->ajaxReturn($data);
		}
		elseif(!check_mobile($mobile))
		{
			$data['status'] = 0;
			$data['info'] = "请填写正确的手机号码";
			$this->ajaxReturn($data);
		}
		elseif((M('user')->where(array('mobile'=>$mobile))->count())>0){
			$data['status']=0;
			$data['info']="该手机号已注册";
			$this->ajaxReturn($data);
		}
		/*elseif(!check_ipop_limit(get_client_ip(),"mobile_verify",60,0)){
			$data['status']=0;
			$data['info']="发送速度太快了";
			ajax_return($data);
		}*/
		elseif((M('mobile_verify_code')->where(array('mobile'=>$mobile,'client_ip'=>get_client_ip(),'create_time'=>array('egt',time()-60)))->count())>0){
			$data['status']=0;
			$data['info']="发送速度太快了";
			$this->ajaxReturn($data);
		}
		else{
			$old_time=time()-300;
			M('mobile_verify_code')->where(array('create_time'=>array('elt',$old_time)))->delete();
			$data1['verify_code']=rand(100000,999999);
			$data1['mobile']=$mobile;
			$data1['create_time']=time();
			$data1['client_ip']=get_client_ip();
		
			M('mobile_verify_code')->create($data1);
			M('mobile_verify_code')->add($data1);
			send_verify_sms($data1['mobile'],$data1['verify_code']);
			$data['status']=1;
			$data['info']="验证码发送成功!";
			//$data['code']=$code;
			$this->ajaxReturn($data);
		}
	}
		public function checkcode(){
		if(IS_POST){
			$cmobile=$_POST['cmobile'];
			$msgverify=$_POST['msgverify'];
			$result=M('mobile_verify_code')->where(array('mobile'=>$cmobile,'verify_code'=>$msgverify))->select();
				if($result){
					echo 'true';
				}
				else{
					
					echo 'false';
				}
		}
		else{
			echo "非法操作";
		}
	}
	public function verify(){
		ob_end_clean();
		$verify=new \Think\Verify();
		$verify->codeSet='0123456789';
		$verify->fontSize=14;
		$verify->length=4;
		$Verify->fontttf = '5.ttf'; 
		$verify->useNoise = false;
		$verify->entry();
	}
	public function check(){
		if(IS_POST){
			$account=I('account');
			$verify=I('verify');
			if($account){$where=array('account'=>$account);}
			if($verify){$result=!$this->check_verify($verify);}
			else{$result=M('user')->where($where)->getField('id');}
			if($result){
				echo 'false';
			}
			else{
				echo 'true';
			}
		}
		else{
			$this->error('非法操作！');
		}
	}
	protected function check_verify($code){
		$verify=new \Think\Verify();
        return $verify->check($code);
	}
}