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
	  var URL="/m.php/Home/Luyan";
	  var MODULE_NAME="<?php echo (MODULE_NAME); ?>"; 
	  var CONTROLLER_NAME="<?php echo (CONTROLLER_NAME); ?>";
	  var ACTION_NAME="<?php echo (ACTION_NAME); ?>";
	</script>
</head>

<body class="gray-bg">
<script src="/js/admin/tablelist.js"></script>
<script src="/js/admin/admin.js"></script>
<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>路演列表</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo U('add');?>">新增路演</a>
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
                    
                    <a  href="<?php echo U("add");?>" class="btn btn-outline btn-default">
                        <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                    </a>
                   
                    <button type="button" class="btn btn-outline btn-default">
                        <i class="glyphicon glyphicon-heart" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-outline btn-default btndelete">
                        <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                    </button>
                </div>
                <table id="tablelist" data-url="<?php echo U('luyanlist');?>" data-mobile-responsive="true" >
                <thead>
                	<tr>
                		<th data-checkbox="true"></th>
                		<th data-field="id" data-sortable="true">ID</th>
                		<th data-field="name" data-sortable="true">名称</th>
                		<th data-field="is_end" data-sortable="true" data-formatter="$.setend">是否结束</th>
                		<th data-field="is_effect" data-sortable="true" data-formatter="$.seteffect">是否有效</th>
                		<th data-field="sort" data-sortable="true">排序</th>
                		<th data-field="react" data-formatter="$.setedit" >操作</th>
                	</tr>
                </thead>
                </table>
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