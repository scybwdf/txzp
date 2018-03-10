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
	  var URL="/m.php/Home/Group";
	  var MODULE_NAME="<?php echo (MODULE_NAME); ?>"; 
	  var CONTROLLER_NAME="<?php echo (CONTROLLER_NAME); ?>";
	  var ACTION_NAME="<?php echo (ACTION_NAME); ?>";
	</script>
</head>

<body class="gray-bg">
<script src="/js/admin/admin.js"></script>
<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5 class="text-primary text-center"  >新增管理组</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">管理组列表</a>
                        </li>
                        <li><a href="#"></a>
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
            <h4 class="example-title">事件</h4>
            <div class="example">
                <div class="alert alert-success" id="examplebtTableEventsResult" role="alert">
                    事件结果
                </div>
             	<form name="addgroup">
                <div class="input-group col-xs-12 col-sm-4 col-lg-3">
           		 <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>管理组名称</span>
           		 <input type="text" class="form-control" name="title" placeholder="">
        		</div>
                <table class="table table-bordered text-center" id="exampleTableEvents" data-mobile-responsive="true" >
                    <thead>
                        <tr >
                           	<th class="text-center checkall" data-field="rules" data-checkbox="true">
                           		<input type="checkbox" class="i-checks">
                           	</th>
                            <th class="text-center" data-field="ID" data-align="center" >编号</th>
                            <th class="text-center" data-field="username" data-align="center" >权限</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($list)): foreach($list as $k=>$v): ?><tr style="text-align:center" >
                                <td class="bs-checkbox checklist ">
                                <input type="checkbox" class="i-checks" name="rules" value="<?php echo ($v["id"]); ?>">    
                                </td>
                                <td>
                                    <?php echo ($v["id"]); ?>
                                </td>
								<td><?php echo ($v["title"]); ?></td>
                            </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
                 	<button type="submit" style="text-shadow: black 5px 3px 3px;" class="btn btn-lg col-sm-offset-4 col-sm-2  btn-primary">新增</button>
                 	
              </form>
            </div>
        </div>
        </div>
        <!-- End Example Events -->
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