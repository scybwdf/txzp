<?php
namespace Home\Controller;
use Think\Controller;
class MailserverController extends 	BaseController {
    public function index(){
		$vo=include __ROOT__.'./wf/Common/Conf/mail.php';
		$this->assign("vo",$vo);
    	$this->display();
    }
	public function update(){
		if(IS_POST){
			$path=__ROOT__.'./wf/Common/Conf/mail.php';
			$config=include $path;
			$data2=I();
			$data['SMTP_SERVER']=$_POST['smtp_server'];
			$data['SMTP_NAME']=$_POST['smtp_name'];
			$data['SMTP_PWD']=$_POST['smtp_pwd'];
			$data['SMTP_AUTH']=intval($_POST['smtp_auth']);
			$data['SMTP_PORT']=intval($_POST['smtp_port']);
			$data['CHARSET']=$_POST['charset'];
			$data['SECURE']=intval($_POST['secure']);
			$data['IS_SMTP']=intval($_POST['is_smtp']);
			$mail=M('mailserver');
			if($data2['smtp_server']==''){
				$this->error("SMTP服务器地址不能为空！");
			}
			if($data2['smtp_name']==''){
				$this->error("账号不能为空！");
			}
			$setconf="<?php\r\nreturn " . var_export($data,true) . ";\r\n?>";
			if(file_put_contents($path,$setconf)){
			if($mail->create($data2)){
				$result=$mail->save($data2);
				if($result){
					$this->success("修改成功！",U('Mailserver/index'));
				}
				else{
					$this->error("修改失败");
				}
				
			}
			else{
				$this->error("写入数据库失败，修改失败");
			}
			
		}
		else{
			$this->error("修改失败,请修改".$path."的写入权限");
		}
		}
		else{
			echo "页面不存在！";
		}
	}
}