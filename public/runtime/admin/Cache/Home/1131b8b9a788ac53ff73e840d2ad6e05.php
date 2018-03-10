<?php if (!defined('THINK_PATH')) exit();?><!-- 调用头部文件 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>后台管理</title>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/css/admin/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/css/common/bootstrap-table.min.css" rel="stylesheet">
    <link href="/css/admin/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/css/admin/animate.min.css" rel="stylesheet">
    <link href="/css/admin/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/css/common/common.css" rel="stylesheet">
    <link href="/css/common/sweetalert.css" rel="stylesheet">
     <link href="/css/admin/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/js/common/uploadify/uploadify.css" rel="stylesheet">
      <link href="/css/admin/plugins/chosen/chosen.css" rel="stylesheet">
    <script type="text/javascript" src="/js/common/jquery-1.12.2.js"></script>
    <script type="text/javascript" src="/js/admin/plugins/iCheck/icheck.min.js"></script>
    <script type="text/javascript" src='/js/common/uploadify/jquery.uploadify.min.js'></script>
    <script type="text/javascript" src='/js/common/sweetalert.min.js'></script>
     <script type='text/javascript'  src='/public/kindeditor2/kindeditor.js'></script>
	 <script type='text/javascript'  src='/public/kindeditor2/lang/zh_CN.js'></script>
    <script>
	  var ROOT="";
	  var URL="/m.php/Home/Config";
	  var MODULE_NAME="<?php echo (MODULE_NAME); ?>"; 
	  var CONTROLLER_NAME="<?php echo (CONTROLLER_NAME); ?>";
	  var ACTION_NAME="<?php echo (ACTION_NAME); ?>";
	</script>
</head>

<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>系统设置</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                        <div class="col-sm-6">
                                <a href="<?php echo U('Config/add');?>" type="button" class="btn btn-danger btn-sm">备份</a>
                        </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>编号</th>
                                <th>文件名</th>
                                <th>备份时间</th>
                                <th>文件大小</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($file_list)): foreach($file_list as $key=>$list): if($key > 1): ?><tr>
                                    <td><?php echo ($key-1); ?></td>
                                    <td style="text-align: left"><a href="<?php echo U('Config/download',array('file'=>$list));?>"><?php echo ($list); ?></a></td>
                                    <td><?php echo (get_file_time($datadir,$list)); ?></td>
                                    <td><?php echo (get_file_size($datadir,$list)); ?></td>
                                    <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo U('Config/download',array('file'=>$list));?>">下载</a>
                                    <a class="btn btn-warning btn-sm"  onclick="return confirm('确定将数据库还原到当前备份吗？')"href="<?php echo U('Config/restore',array('file'=>$list));?>">还原</a>
                                    <a class="btn btn-danger btn-sm"  onclick="return confirm('确定删除该备份文件吗？')"href="<?php echo U('Config/del',array('file'=>$list));?>">删除</a>
                                    </td>
                                </tr><?php endif; endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 调用脚部文件 -->
       <script src="/js/common/bootstrap-table.min.js"></script>
    <script type="text/javascript" src="/js/admin/bootstrap.min.js?v=3.3.6"></script>
    <script src="/js/common/tableExport.min.js"></script>
    <script src="/js/common/jspdf.min.js"></script>
    <script src="/js/common/jspdf.plugin.autotable.js"></script>
     <script src="/js/common/bootstrap-table-export.min.js"></script>
    <script src="/js/admin/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
    <script src="/js/admin/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
	<script type="text/javascript" src='/js/admin/plugins/chosen/chosen.jquery.js'></script>
   <script>
	try
{
  $(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",});
}
catch(err)
{
  console.log(err);
}

</script>
</body>
</html>