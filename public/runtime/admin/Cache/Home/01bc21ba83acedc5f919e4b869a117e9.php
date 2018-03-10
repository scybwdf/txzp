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
	  var URL="/m.php/Home/ArticleCate";
	  var MODULE_NAME="<?php echo (MODULE_NAME); ?>"; 
	  var CONTROLLER_NAME="<?php echo (CONTROLLER_NAME); ?>";
	  var ACTION_NAME="<?php echo (ACTION_NAME); ?>";
	</script>
</head>

<body class="gray-bg">
<script src="/js/admin/admin.js"></script>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5 class="text-primary text-center">编辑文章分类</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-wrench"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?php echo U('index');?>">文章分类列表</a>
                </li>
                <li>
                    <a href="<?php echo U('ArticleCate/add');?>">新增文章分类</a>
                </li>
            </ul>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">
        <div class="row row-lg">
            <div class="col-xs-12">
                <form  class="form-horizontal" method="post" action="<?php echo U('edit');?>">
                    <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">分类名称：</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="title" value="<?php echo ($vo["title"]); ?>" required="" placeholder="">
                        </div>
                    </div>
              
                    <div class="form-group col-sm-12">
                    	<label class="control-label  col-sm-3">所属分类：</label>
                    	 <div class= "col-sm-6">
                              <select name="pid" class="form-control chosen-select" >
                                   <option value="0"  <?php if($vo['pid'] == 0): ?>selected="selected"<?php endif; ?>>==顶级分类==</option>
                					<?php if(is_array($catelist)): foreach($catelist as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($vo['pid'] == $v['id']): ?>selected="selected"<?php endif; ?>><?php echo ($v["title_show"]); ?></option><?php endforeach; endif; ?>
                              </select>
                         </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">是否有效：</label>
                        <div class="col-sm-1">
                           有效&nbsp;&nbsp;<input class="i-checks" type="radio" name="is_effect"
							<?php if($vo['is_effect'] == 1): ?>checked="checked"<?php endif; ?> 
                           value="1" >
                        </div>
                         <div class="col-sm-1">
                           无效&nbsp;&nbsp;<input class="i-checks" type="radio" name="is_effect"
                           <?php if($vo['is_effect'] == 0): ?>checked="checked"<?php endif; ?>
                             value="0">
                        </div>
                    </div>
                     <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">排序：</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" name="sort" value="<?php echo ($vo["sort"]); ?>" required="" placeholder="">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>">
					<div class="col-sm-6 col-sm-offset-5 col-xs-4 col-xs-offset-4 ">
						<button style="text-shadow: black 5px 3px 3px;" class="btn btn-primary" type="submit">编辑</button>
                    </div>
                </form>
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