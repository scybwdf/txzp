<?php
namespace Home\Controller;
use Think\Controller;
class CacheController extends BaseController{
	public function index(){
		$dir=WEB_ROOT.'/public/runtime/index/pc';
		if(!$this->delDirAndFile($dir)){
			echo 1111;
		}
		else{
			var_dump($this->delDirAndFile($dir));
		}
		//$this->display();
	}
	public function pcdelcache(){
		if(IS_POST){
			$dir=WEB_ROOT.'/public/runtime/index/pc';
			if(!$this->delDirAndFile($dir)){
				$data['status']=1;
				$data['info']='前端PC缓存清除成功';
				$this->ajaxReturn($data);
			}
			else{
				$data['status']=0;
				$data['info']='前端PC缓存清除失败，请检查权限';
				$this->ajaxReturn($data);
			}
		}
	}
	public function wapdelcache(){
		if(IS_POST){
			$dir=WEB_ROOT.'/public/runtime/index/wap';
			if(!$this->delDirAndFile($dir)){
				$data['status']=1;
				$data['info']='前端手机端缓存清除成功';
				$this->ajaxReturn($data);
			}
			else{
				$data['status']=0;
				$data['info']='前端手机端缓存清除失败，请检查权限';
				$this->ajaxReturn($data);
			}
		}
	}
	public function alldelcache(){
		if(IS_POST){
			$dir=WEB_ROOT.'/public/runtime/index';
			if(!$this->delFileUnderDir($dir)){
				$data['status']=1;
				$data['info']='前端所有缓存清除成功';
				$this->ajaxReturn($data);
			}
			else{
				$data['status']=0;
				$data['info']='前端所有缓存清除失败，请检查权限';
				$this->ajaxReturn($data);
			}
		}
	}
	public function houdelcache(){
		if(IS_POST){
			$dir=WEB_ROOT.'/public/runtime/admin';
			if(!$this->delDirAndFile($dir)){
				$data['status']=1;
				$data['info']='后台缓存清除成功';
				$this->ajaxReturn($data);
			}
			else{
				$data['status']=0;
				$data['info']='后台缓存清除失败，请检查权限';
				$this->ajaxReturn($data);
			}
		}
	}
  private function delDirAndFile($dirName){
	if ($handle = opendir("$dirName")){
		while (false!==($item=readdir($handle))){
			if ($item!="."&& $item!=".."){
				if (is_dir("$dirName/$item")) {
					$this->delDirAndFile("$dirName/$item");
				}
				else {
				if(unlink("$dirName/$item")){
					//header("Content-type:text/html;charset=utf-8");
					//echo "成功删除文件： $dirName/$item\n";
					return true;
				}	
				}
			}
		}
		closedir($handle);
		if(rmdir($dirName)){
		//	header("Content-type:text/html;charset=utf-8");
		//	echo "成功删除目录： $dirName\n";
			return true; 
		}
		
	}
}
  	private function delFileUnderDir($dirName){
		if ($handle=opendir("$dirName")) {
			while (false!==($item=readdir($handle))){
      		if ($item!="."&&$item!="..") {
				if(is_dir("$dirName/$item")){
					$this->delFileUnderDir( "$dirName/$item" );
				} 
				else {
					if( unlink( "$dirName/$item" ) ){
						//echo "成功删除文件： $dirName/$item\n";
						return true;
					}
				}
			}
			}
			closedir( $handle );
		}
		else{
			return false;
		}
	}
}