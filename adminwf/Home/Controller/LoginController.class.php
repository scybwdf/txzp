<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    //登陆主页
    public function index(){
		if(session('auth')['username']){
		$this->redirect('Index/index');	
		}
       else{$this->display();}
		
    }
	public function login(){
         if(!IS_POST)$this->error("非法请求");
        $admin=M('admin');
        $username=I('username');
        $password=I('password','','md5');
        $code=I('verify','','strtolower');
        if(!$this->check_verify($code)){
            $this->error('验证码错误!');
        }
        $user=$admin->where(array('username'=>$username,'password'=>$password))->find();
        if(!$user){
            $this->error('账号或密码错误!');
        }
        if($user['is_effect']==0){
            $this->error('账号被禁用，请联系网站管理员');
        }
        $data=array(
        'id'=>$user['id'],
        'login_time'=>time(),
        'login_ip'=>get_client_ip(),     
        );
        if($admin->save($data)){
			$ip=get_client_ip();
			$value=$user['username'].'|'.$ip;
			$value=encrypetion($value);
			@setcookie('auth',$value,C('AUTO_LOGIN_TIME'),'/');
            session('auth',$user);
            $this->success('登录成功',U('Index/index'));
        }
		
            
	}
    public function loginout(){
        session('[destroy]');
		@setcookie('auth','',time() - 3600,'/');
        $this->success('退出成功',U('Login/index'));
    }
	public function verify(){
		$verify=new \Think\Verify();
		$verify->codeSet='0123456789';
		$verify->fontSize=14;
		$verify->length=4;
		$Verify->fontttf = '5.ttf'; 
		$verify->useNoise = false;
		$verify->entry();
		
	}
	protected function check_verify($code){
		$verify=new \Think\Verify();
        return $verify->check($code);
	}
}