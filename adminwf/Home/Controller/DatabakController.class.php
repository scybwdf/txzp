<?php
/**
 * Created by FELIX.
 * Date: 2018/3/6
 * Time: 10:19
 */
namespace Home\Controller;
use Think\Db;
use Think\Controller;

class DatabakController extends BaseController {

    private $db;
    private $_linkID;
    private $max_size;//分卷最大文件大小

    public function __construct()
    {
        parent::__construct();
        $this->db=Db::getInstance();
        $this->max_size=800000;
        $this->_linkID=mysqli_connect(C('DB_HOST'),C('DB_USER'),C('DB_PWD'),C('DB_NAME'));
    }
    public function __destruct()
    {
        parent::__destruct();
        mysqli_close($this->_linkID);
    }

    private function make_head($vol){
        /**
         * 系统信息
         */
       $h_info['os']=PHP_OS;
       $h_info['web_server']=$_SERVER['SERVER_SOFTWARE'];
       $h_info['php_ver']=php_sapi_name();
       $ver=$this->db->query('select VERSION()');
       $h_info['mysql_ver']=  $mysql_ver=$ver[0]['version()'];
       $h_info['date']=date('Y-m-d H:i:s');

       $head="--wf sql dump program\r\n".
             "--".$h_info['web_server']."\r\n".
             "-- \r\n".
             "--DATE:".$h_info['date']."\r\n".
             "--MYSQL SERVER VERSION:".$h_info['mysql_ver']."\r\n".
             "--PHP VERSION:".$h_info['php_ver']."\r\n".
             "--VOL:".$vol."\r\n\r\n\r\n";
       return $head;
     }

     public function index(){
         if(intval($_REQUEST['action_id'])!='')
         {
             $action_id= intval($_REQUEST['action_id']);
         }
         $this->assign('action_id',$action_id);
         $db_bak_dir='public/wfdatabak/';

         if($dir=opendir($db_bak_dir)){

             while(($file   =  readdir($dir)))
             {
                // var_dump($file);

                 if (($file!=".")&&($file!=".."))
                 {
                     if(is_dir($db_bak_dir.$file))
                     {
                         $sql_list[$file] = array();
                         if($bk_dir = opendir($db_bak_dir.$file."/"))
                         {
                             while($bk_file=readdir($bk_dir))
                             {
                                 if (($bk_file!=".")&&($bk_file!=".."))
                                     $sql_list[$file][] = $bk_file;
                             }
                         }
                     }
                 }

             }

         }

         $this->assign("sql_list",$sql_list);
         $this->display();
     }

     public function dump(){
       set_time_limit(0);
         //$filebak_name=addcslashes(htmlspecialchars(trim($_REQUEST['filebak_name'])));
         $filebak_name=trim($_REQUEST['filebak_name']);
       if($filebak_name==''){
           $filebak_name=time();
       }

       $vol=intval($_REQUEST['vol']);
       $table_key=intval($_REQUEST['table_key']);
       $last_row=intval($_REQUEST['last_row']);
       $this->vol_dump($filebak_name,$vol,$table_key,$last_row);
     }

    /**循环处理vol
     * @param $filebak_name 备份文件名
     * @param int $vol  文件分卷
     * @param int $table_key 表键值
     * @param int $last_row
     * @param string $dumpsql_vol 表内容
     * @param int $loop_limit
     */
     private function vol_dump($filebak_name,$vol=1,$table_key=0,$last_row=0,$dumpsql_vol='',$loop_limit=0){
         $loop_limit ++;
         $table_all=$this->db->getTables();

         $tables=array();
         foreach($table_all as $table){
             if(preg_match("/".C('DB_PREFIX')."/",$table)){
                 array_push($tables,$table);
             }
         }
         if($loop_limit>50){
              //超出递归限制
             if($this->write_sql($filebak_name,$vol,$dumpsql_vol)){
                 $vol++;
                 $result['vol'] = $vol;  //下一卷的卷数
                 $result['filebak_name'] = $filebak_name;
                 $result['table_key'] = $table_key;
                 $result['last_row'] = $last_row;
                 $result['done'] = 0;    //全部结束
                 $result['status'] = 1; //导出成功
                 $result['table_total'] = count($tables);
                 $result['table_name'] = $tables[$table_key];
                 $this->ajaxReturn($result);
             }
             else{
                 $result['status'] = 0; //导出失败
                 $result['table_name'] = $tables[$table_key];
                 $result['info'] = "数据库备份失败";
                 $this->ajaxReturn($result);
             }

         }

         if($table_key>=count($tables)){
             //超出了表的最大限制
             if($this->write_sql($filebak_name,$vol,$dumpsql_vol)){
                 $vol++;
                 $result['vol'] = $vol;  //下一卷的卷数
                 $result['filebak_name'] = $filebak_name;
                 $result['table_key'] = $table_key;
                 $result['last_row'] = $last_row;
                 $result['done'] = 1;    //全部结束
                 $result['status'] = 1; //导出成功
                 $result['table_total'] = count($tables);
                 $result['table_name'] = $tables[$table_key];
                 $this->ajaxReturn($result);
             }
             else{
                 $result['status'] = 0; //导出失败
                 $result['table_name'] = $tables[$table_key];
                 $result['info'] = "数据库备份失败";
                 $this->ajaxReturn($result);
             }
         }
         if($dumpsql_vol==''){
            $dumpsql_vol=$this->make_head($vol);
         }
         $tbname=$tables[$table_key];
         $modelname=str_replace(C('DB_PREFIX'),'',$tbname);
         $tbname_o=$tbname;
         $tbname=str_replace(C('DB_PREFIX'),'%DB_PREFIX%',$tbname);
         if($last_row==0){
              //开始创建表的结构
             $dumpsql_vol.="DROP TABLE IF EXISTS `$tbname`;\r\n";

             $tmp_arr=$this->db->query("SHOW CREATE TABLE `$tbname_o`");

             $tmp_sql = $tmp_arr[0]['create table'].";\r\n";
             $tmp_sql  = str_replace(C('DB_PREFIX'),'%DB_PREFIX%',$tmp_sql);
             $dumpsql_vol .= $tmp_sql;   //表结构语句处理结束



         }

         $modelname=parse_name($modelname,1);
         $model=D($modelname);
         if($modelname!='AutoCache')
         {
             $limit_str = $last_row.",500";
             $rows = $model->limit($limit_str)->select();
         }
         if(count($rows)>0)
         {
             foreach($rows as $row)
             {
                 $dumpsql_row = "INSERT INTO `{$tbname}` VALUES (";   //用于每行数据插入的SQL脚本语句
                 foreach($row as $col_value)
                 {
                     $dumpsql_row .="'".mysqli_real_escape_string($this->_linkID,$col_value)."',";
                 }
                 $dumpsql_row=substr($dumpsql_row,0,-1);  //删除最后一个逗号
                 $dumpsql_row .= ");\r\n";
                 $dumpsql_vol.= $dumpsql_row;
                 $last_row++;
             }

             //开始判断分卷长度
             if(strlen($dumpsql_vol)>$this->max_size)
             {
                 //开始写入sql脚本
                 if($this->write_sql($filebak_name,$vol,$dumpsql_vol))
                 {
                     $vol++;  //增加卷数
                     $result['status'] = 1; //导出一卷成功
                     $result['vol'] = $vol;  //下一卷的卷数
                     $result['done'] = 0;    //未结束。还需继续导出
                     $result['filebak_name'] = $filebak_name;
                     $result['table_key'] = $table_key;
                     $result['table_total'] = count($tables);
                     $result['table_name'] = $tables[$table_key];
                     $result['last_row'] = $last_row;
                     $this->ajaxReturn($result);
                 }
                 else
                 {

                     $result['status'] = 0; //导出失败
                     $result['info'] = "数据库备份失败";
                     $this->ajaxReturn($result);
                 }
             }
             else
             {
                 //未超出分卷长度，递归调用
                 $this->vol_dump($filebak_name,$vol,$table_key,$last_row,$dumpsql_vol,$loop_limit);  //进行递归
             }
         }
         else
         {

             //进入下一张表的查询
             $last_row = 0;
             $table_key++;
             $this->vol_dump($filebak_name,$vol,$table_key,$last_row,$dumpsql_vol,$loop_limit);  //进行递归

         }




     }



    /**
     * 写入sql脚本到文件
     * @param $filebak_name
     * @param $vol
     * @param $dumpsql_vol
     * @return bool
     */
     public function write_sql($filebak_name,$vol,$dumpsql_vol){

        $filepath="public/wfdatabak/".$filebak_name;
        if(!is_dir($filepath)){
            if(!mkdir($filepath,0777)){
                return false;
            }
        }

        $filename=$filebak_name."_".$vol.'.sql';
        $rs=@file_put_contents($filepath."/".$filename,$dumpsql_vol);
        if($rs==0){
            for($i=0;$i<=$vol;$i++){
                @unlink($filepath."/".$filename."_".$vol.".sql");
            }
            return false;
        }
        else{
            return true;
        }

     }

    public function restore()
    {
        set_time_limit(0);
        $groupname = $_REQUEST['file'];
        $vol = intval($_REQUEST['vol']);
        $db_back_dir = WEB_ROOT."/public/wfdatabak/".$groupname."/";
        $sql_list = $this->dirFileInfo($db_back_dir,".sql");
        $sql_list = $sql_list[$groupname];

        $fileItem = $sql_list[$vol];
        $sql = file_get_contents($db_back_dir.$fileItem['filename']);
        $sql = $this->remove_comment($sql);
        $sql = trim($sql);
        $sql = str_replace("\r", '', $sql);
        $segmentSql = explode(";\n", $sql);

        foreach($segmentSql as $itemSql)
        {

            if($itemSql!='')
            {
                $itemSql = str_replace("%DB_PREFIX%",C('DB_PREFIX'),$itemSql);
                $this->db->execute($itemSql);
            }
        }
        //print_r($arrr);die;

        if($vol==count($sql_list))
        {
            $result['done'] = 1;
            $result['status'] = 1;
        }
        else
        {
            $vol++;
            $result['filename'] = $groupname;
            $result['vol'] = $vol;
            $result['status'] = 1;
        }
       $this->ajaxReturn($result);


    }

    private function remove_comment($sql)
    {
        /* 删除SQL行注释，行注释不匹配换行符 */
        $sql = preg_replace('/^\s*(?:--|#).*/m', '', $sql);

        /* 删除SQL块注释，匹配换行符，且为非贪婪匹配 */
        //$sql = preg_replace('/^\s*\/\*(?:.|\n)*\*\//m', '', $sql);
        $sql = preg_replace('/^\s*\/\*.*?\*\//ms', '', $sql);

        return $sql;
    }

    /**
     * 删除备份操作
     */
     public function delete(){
         $file=$_REQUEST['file'];
         $filename=WEB_ROOT."/public/wfdatabak/".$file."/";
         $filearray=$this->dirFileinfo($filename,".sql");
         $delte_group=$filearray[$file];
         foreach($delte_group as $group){
            // chmod($filename.$group['filename'],0777);
             @unlink($filename.$group['filename']);
         }
         $dir=opendir($filename);
         closedir($dir);
         rmdir($filename);
         $this->success("删除成功");
     }

     private function dirFileinfo($filename,$type){
            if(!is_dir($filename)){
                return false;
            }
           // chmod($filename,0777);
            $dirhand=opendir($filename);
            $arrayFileName=array();
            while(($file = readdir($dirhand)) !==   false){

                if (($file!=".")&&($file!=".."))
                {

                    $typelen=0-strlen($type);

                    if	(substr($file,$typelen)==$type)
                    {
                        $file_only_name = substr($file,0,strlen($file)+$typelen);

                        $file_name_arr = explode("_",$file_only_name);

                        $file_only_name = $file_name_arr[0];
                        $fileIdx = $file_name_arr[1];
                        if($fileIdx)
                        {
                            $arrayFileName[$file_only_name][$fileIdx]=array
                            (
                                'filename'=>$file,
                                'filedate'=>$this->to_date($file_only_name)
                            );
                        }
                        else
                        {
                            $arrayFileName[$file_only_name][]=array
                            (
                                'filename'=>$file,
                                'filedate'=>$this->to_date($file_only_name)
                            );
                        }
                    }
                }
            }
         //通过ArrayList类对数组排序
         foreach($arrayFileName as $k=>$group)
         {
             $arr = $group;
                ksort($arr);
             $arrayFileName[$k] =$arr;
         }

         return   $arrayFileName;

     }

     private function to_date($timer){
         return date('Y-m-d H:i:s',$timer);
     }



}