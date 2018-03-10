<?php
namespace Home\Controller;
use Think\Controller;
class SystemController extends 	BaseController {
    public function index(){
		$config=include WEB_ROOT.'/wf/Common/Conf/system.php';
		$this->assign("config",$config);		
    	$this->display();
    }
	public function edit(){
		$path=WEB_ROOT.'/wf/Common/Conf/system.php';
		$config=include $path;
		$data['WEBNAME']=$_POST['webname'];
		$data['LOGOIMG']=$_POST['logoimg'];
		$data['SEO_TITLE']=$_POST['seo_title'];
		$data['SEO_KEYWORDS']=$_POST['seo_keywords'];
		$data['SEO_BRIEF']=$_POST['seo_brief'];
		$data['COPY']=$_POST['copy'];
		$data['ICP']=$_POST['icp'];
		$data['TOTALDATA']=$_POST['totaldata'];
		$setconf="<?php\r\nreturn " . var_export($data,true) . ";\r\n?>";
		if(file_put_contents($path,$setconf)){
			$data['id']=1;
			if(M('system')->create($data)){
				$result=M('system')->save($data);
				if($result){
					$this->success("修改成功！",U('System/index'));
				}
				else{
					$this->error("写入数据库失败,修改失败");
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
}