<?php
namespace Home\Controller;
use Think\Controller;
class ConfigController extends BaseController {
	public function add(){
					$mr=$this->mr();
					$mr->setDBName(C('DB_NAME'));
			 		$mr->backup();
                    $this->success( '数据库备份成功！',U("Config/index"),1);
	}
	public function index(){
		  $DataDir = "wfdatabak/";
           mkdir($DataDir);
		   $file_list= $this->MyScandir('wfdatabak/');
            $this->assign("datadir",$DataDir);
            $this->assign("file_list", $file_list);
            $this->assign("title"," 备份数据库");
            $this->display();
	}
	public function restore(){
		$mr=$this->mr();
		$mr->setDBName(C('DB_NAME'));
		$mr->recover($_GET['file']);
        $this->success( '数据库还原成功！',U("Config/index"),1);
	}
	public function del(){
		$DataDir="wfdatabak/";
		if (@unlink($DataDir . $_GET['file'])) {
                          $this->success('删除成功！',U("Config/index"));
                      } else {
                          $this->error('删除失败！',U("Config/index"));
                      }
	}
	public function download(){
		 function DownloadFile($fileName) {
                            ob_end_clean();
                            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                            header('Content-Description: File Transfer');
                            header('Content-Type: application/octet-stream');
                            header('Content-Length: ' . filesize($fileName));
                            header('Content-Disposition: attachment; filename=' . basename($fileName));
                            readfile($fileName);
                    }
                    DownloadFile($DataDir . $_GET['file']);
                    exit();
	}

    private function MyScandir($FilePath = './', $Order = 0) {
        $FilePath = opendir($FilePath);
        while (false !== ($filename = readdir($FilePath))) {
            $FileAndFolderAyy[] = $filename;
        }

        $Order == 0 ? sort($FileAndFolderAyy) : rsort($FileAndFolderAyy);
        return $FileAndFolderAyy;
    }
	private function mr(){
		vendor('Mysqlbak.MySQLReback'); 
		$DataDir = "wfdatabak/";
		           mkdir($DataDir);
                  $config = array(
                       'host' => C('DB_HOST'),
                       'port' => C('DB_PORT'),
                       'userName' => C('DB_USER'),
                       'userPassword' => C('DB_PWD'),
                       'dbprefix' => C('DB_PREFIX'),
                       'charset' => 'UTF8',
                       'path' => $DataDir,
                       'isCompress' => 0, //是否开启gzip压缩
                       'isDownload' => 0
                        );
					$mr = new MySQLReback($config);
		return $mr;
	}
}