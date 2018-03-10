<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function _initialize(){
		   if(isset($_COOKIE['auth'])&&!session('auth')){
            $value=$_COOKIE['auth'];
            $value=encrypetion($value,1);  
            $ip=get_client_ip();
            $data=explode('|',$value);
            if($ip==$data[1]){
                $where=array('username'=>$data[0]);
                $user=M('admin')->where($where)->find();
                if($user&&$user['is_effect']){ 
                    session('auth',$user);
                }
            } 
        }

		$sess_auth=session('auth');
		if(!$sess_auth){
			 redirect(U('Login/index'));
		}
		if($sess_auth['uid']==1){
			return true;
		}
		$auth= new \Think\Auth();
		if(!$auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,$sess_auth['uid'])){
			echo "<script>alert('对不起您没有权限！');</script>";die;
		}
      
    }
     public function avatar(){
        if(!IS_POST){
            $getuser=M('admin');
            $user=$getuser->where('id='.session('auth')['id'])->field('face64,face180')->find();
			$user['face64']=__ROOT__.$user['face64'];
			$user['face180']=__ROOT__.$user['face180'];
            $this->user=$user;
            $this->display();
        }
        if(IS_POST){
            $thumb=array(
            0=>array('w'=>64,'h'=>64,'n'=>'mid'),
            1=>array('w'=>180,'h'=>180,'n'=>'max')    
            );
            $setavatar=$this->_upload('face',$thumb);
            
           echo json_encode($setavatar);
        }
        
    }
     private function _upload($path,$thumb){
	   if(!is_array($path)&&!empty($path)){
		   $path=$path;
	   }
	   elseif(is_array($path)&&empty($thumb)){
		   $thumb=$path;
		   $path='other';
	   }
	   else{
		   $path='other';
	   }
	   $strupload=new \Think\Upload();
	   $strupload->maxSize=C('IMGUPLOAD_MAX_SIZE');
	   $strupload->saveName=time;
	   $strupload->exts=C('UPLOAD_EXTS');
	   $strupload->rootPath=C('UPLOAD_PATH');
	    $strupload->savePath='upload/admin/'.$path.'/';
	   $strupload->saveRule='uiqid';
	   $strupload->replace='true';
	   $strupload->autoSub=true;
	     $strupload->subName=array('date','Ymd');
	   $info=$strupload->upload();
	  if(!$info){
		  return array('status'=>0,'msg'=>$strupload->getError());
		 
	  }
	  else{
		foreach($info as $file){
		 $file_path=C('UPLOAD_PATH').$file['savepath'].$file['savename'];	
		}
		
		if(is_array($thumb)&&!empty($thumb)){
			$image=new \Think\Image();
		 $image->open($file_path);
		 $addr=array();
		foreach($thumb as $k=>$v){
			 $image->thumb($v['w'],$v['h']);
			 $file_name[$k]=$v['n'];
			 $file_mini[$k]=C('UPLOAD_PATH').$file['savepath'].$v['n'].'_'.$file['savename'];
			 $image->save($file_mini[$k]);
			 $addr[$v['n']]=explode('.',$file_mini[$k],2)[1];
		}
		unlink($file_path);
		return array('status'=>1,'path'=>$addr);
		}
		else{
			 return array('status'=>1,'path'=>array('other'=>split('.',$file_path,2)[1]));
		}
	  }
	   
   }

    /**
     * 一般删除,可恢复
     */
	public function delete(){
        $id=I('id');
        if (isset($id)){
				$condition = array ('id' => array ('in', explode ( ',', $id )));
			 if(CONTROLLER_NAME=='Group'){
			$condition['auth_group_access']=array('uid'=>array ('in', explode ( ',', $id )));
			 $authgroup=D('Group')->relation(true);
		 }
		 else{
			
			 $authgroup=M(CONTROLLER_NAME);
		 }

		 $result = $authgroup->where ($condition)->setField('is_delete',1);

        if($result){
            $data['status']=1;
        }
        else{
			 $data['status']=0;
        }
		}
		else{
			$data['status']=0;
		}
		$this->ajaxReturn($data);  	
    }

    /**
     * 恢复操作
     */
    public function restore(){
        $id=I('id');
        if (isset($id)){
            $condition = array ('id' => array ('in', explode ( ',', $id )));
            if(CONTROLLER_NAME=='Group'){
                $condition['auth_group_access']=array('uid'=>array ('in', explode ( ',', $id )));
                $authgroup=D('Group')->relation(true);
            }
            else{

                $authgroup=M(CONTROLLER_NAME);
            }

            $result = $authgroup->where ($condition)->setField('is_delete',0);

            if($result){
                $data['status']=1;
            }
            else{
                $data['status']=0;
            }
        }
        else{
            $data['status']=0;
        }
        $this->ajaxReturn($data);
    }

    /**
     * 永久删除无法恢复
     */
    public function redelete(){
        $id=I('id');
        if (isset($id)){
            $condition = array ('id' => array ('in', explode ( ',', $id )));
            if(CONTROLLER_NAME=='Group'){
                $condition['auth_group_access']=array('uid'=>array ('in', explode ( ',', $id )));
                $authgroup=D('Group')->relation(true);
            }
            else{

                $authgroup=M(CONTROLLER_NAME);
            }

            $result = $authgroup->where ($condition)->delete();

            if($result){
                $data['status']=1;
            }
            else{
                $data['status']=0;
            }
        }
        else{
            $data['status']=0;
        }
        $this->ajaxReturn($data);
    }


	 public function set_effect(){
        $id=intval(I('id'));
		 if(CONTROLLER_NAME=='Group'){
			$effect='status';
			 $authgroup=M('auth_group');
		 }
		 else{
			 $effect='is_effect';
			 $authgroup=M(CONTROLLER_NAME);
		 }
         $noweffect=$authgroup->where("id=".$id)->getField($effect);
        $seteffect=$noweffect==0 ? 1 : 0;
       $result=$authgroup->where("id=".$id)->setField($effect,$seteffect);
        if($result){
            if($seteffect){
           $data['status']=1;
			$data['info']=1;	
        }    
           else{
             $data['status']=1;
			 $data['info']=0;	  
        }   
        }
         
        else{
             $data['status']=0;
			$data['error']=CONTROLLER_NAME;
			 $data['info']="状态改变失败";	
        }
       $this->ajaxReturn($data);
    }
	 public function set_toogle(){
        $id=intval(I('id'));
		 if(CONTROLLER_NAME=='Group'){
			$effect='status';
			 $authgroup=M('auth_group');
		 }
		 else{
			 $effect=I('name');
			 $authgroup=M(CONTROLLER_NAME);
		 }
         $noweffect=$authgroup->where("id=".$id)->getField($effect);
        $seteffect=$noweffect==0 ? 1 : 0;
       $result=$authgroup->where("id=".$id)->setField($effect,$seteffect);
        if($result){
            if($seteffect){
           $data['status']=1;
			$data['info']=1;	
        }    
           else{
             $data['status']=1;
			 $data['info']=0;	  
        }   
        }
         
        else{
             $data['status']=0;
			$data['error']=CONTROLLER_NAME;
			 $data['info']="状态改变失败";	
        }
       $this->ajaxReturn($data);
    }
		
}