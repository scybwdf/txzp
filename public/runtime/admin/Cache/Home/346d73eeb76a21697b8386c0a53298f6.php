<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
	  var URL="/m.php/Home/Databak";
	  var MODULE_NAME="<?php echo (MODULE_NAME); ?>"; 
	  var CONTROLLER_NAME="<?php echo (CONTROLLER_NAME); ?>";
	  var ACTION_NAME="<?php echo (ACTION_NAME); ?>";
	</script>
</head>

<body class="gray-bg">
<script>
    var dump="<?php echo U('dump');?>";
    var restore="<?php echo U('restore');?>";
    var deletebak="<?php echo U('delete');?>";

</script>
<script src="/js/admin/admin.js"></script>
<script src="/js/admin/tablelist.js"></script>
<script src="/js/admin/databak.js"></script>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>数据备份列表</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-wrench"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a id="nowbak" onclick="backup();">创建备份</a>
                </li>
            </ul>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">
        <div class="row row-lg">
            <div class="col-sm-12">
                <!-- Example Events -->
                <div class="example-wrap">

                    <div class="example">
                        <div class="btn-group hidden-xs" id="tableToolbar" role="group">

                            <a onclick="backup();" class="btn btn-outline btn-default">
                            <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                            </a>

                       <!--     <button type="button" class="btn btn-outline btn-default">
                                <i class="glyphicon glyphicon-heart" aria-hidden="true"></i>
                            </button>-->
                   <!--         <button type="button" class="btn btn-outline btn-default btndelete">
                                <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                            </button>-->
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>卷名</th>
                                    <th>时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($sql_list)): foreach($sql_list as $key=>$list): ?><tr>
                                            <td style="text-align: left"><?php echo ($key); ?></td>
                                            <td><?php echo (date('Y-m-d H:i:s',$key)); ?></td>
                                            <td>
                                                <a class="btn btn-warning btn-sm"  onclick="restore_db(<?php echo ($key); ?>);">还原</a>
                                                <a class="btn btn-danger btn-sm"  onclick="delsql(<?php echo ($key); ?>);">删除</a>
                                            </td>
                                        </tr><?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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