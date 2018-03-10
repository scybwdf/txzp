<?php if (!defined('THINK_PATH')) exit();?>
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
	  var URL="/m.php/Home/System";
	  var MODULE_NAME="<?php echo (MODULE_NAME); ?>"; 
	  var CONTROLLER_NAME="<?php echo (CONTROLLER_NAME); ?>";
	  var ACTION_NAME="<?php echo (ACTION_NAME); ?>";
	</script>
</head>

<body class="gray-bg">
<script src="/js/admin/admin.js"></script>
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
                <form class="form-horizontal" role="form" action="<?php echo U('System/edit');?>" method="post">
                  	<div class="form-group">
                  		<label class="control-label col-sm-3">网站名称:</label>
                  		<div class="col-sm-5">
                  			<input class="form-control" name="webname" type="text" value="<?php echo ($config["WEBNAME"]); ?>" >
                  		</div>
                  	</div>
                  	 	<div class="form-group">
                  		<label class="control-label col-sm-3">网站logo:</label>
                  		<div class="col-sm-5">
                  			<span>
        <div style='float:left; height:35px; padding-top:1px;'>
            <input type='hidden' value='<?php echo ($config["LOGOIMG"]); ?>' name='logoimg' id='keimg_h_logoimg' />
            <div class='buttonActive' style='margin-right:5px;'>
                <div class='buttonContent'>
                    <button type='button' class='keimg ke-icon-upload_image' rel='logoimg'>选择图片</button>
                </div>
            </div>
        </div>
         <a href='<?php if($config["LOGOIMG"] == ''): ?>/public/images/nophoto.gif<?php else: echo ($config["LOGOIMG"]); endif; ?>' target='_blank' id='keimg_a_logoimg' ><img src='<?php if($config["LOGOIMG"] == ''): ?>/public/images/nophoto.gif<?php else: echo ($config["LOGOIMG"]); endif; ?>' id='keimg_m_logoimg' width=35 height=35 style='float:left; border:#ccc solid 1px; margin-left:5px;' /></a>
         <div style='float:left; height:35px; padding-top:1px;'>
             <div class='buttonActive'>
                <div class='buttonContent'>
                    <img src='/public/images/del.gif' style='<?php if($config["LOGOIMG"] == ''): ?>display:none<?php endif; ?>; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' class='keimg_d' rel='logoimg' title='删除'>
                </div>
            </div>
        </div>
        </span>
                  		</div>
                  	</div>
                  	<div class="form-group">
                  		<label class="control-label col-sm-3">SEO标题::</label>
                  		<div class="col-sm-5">
                  			<input class="form-control" name="seo_title" type="text" value="<?php echo ($config["SEO_TITLE"]); ?>" >
                  		</div>
                  	</div>
                  	<div class="form-group">
                  		<label class="control-label col-sm-3">SEO关键词:</label>
                  		<div class="col-sm-5">
                  			<input class="form-control" name="seo_keywords" type="text" value="<?php echo ($config["SEO_KEYWORDS"]); ?>" >
                  		</div>
                  	</div>
                  	<div class="form-group">
                  		<label class="control-label col-sm-3">SEO描述:</label>
                  		<div class="col-sm-5">
                  			<input class="form-control" name="seo_brief" type="text" value="<?php echo ($config["SEO_BRIEF"]); ?>" >
                  		</div>
                  	</div>
                  	<div class="form-group">
                  		<label class="control-label col-sm-3">站点版权:</label>
                  		<div class="col-sm-5">
                  			<input class="form-control" name="copy" type="text" value="<?php echo ($config["COPY"]); ?>" >
                  		</div>
                  	</div>
                  		<div class="form-group">
                  		<label class="control-label col-sm-3">网络备案信息:</label>
                  		<div class="col-sm-5">
                  			<input class="form-control" name="icp" type="text" value="<?php echo ($config["ICP"]); ?>" >
                  		</div>
                  	</div>
                  	<div class="form-group">
                  		<label class="control-label col-sm-3">统计代码:</label>
                  		<div class="col-sm-5">
                  			<textarea class="form-control" name="totaldata" ><?php echo ($config["TOTALDATA"]); ?></textarea>
                  		</div>
                  	</div>
                  	<div class="form-group">
                  		<div class="col-sm-offset-4 col-xs-offset-2 fl">
                  			<button class="btn btn-primary" type="submit">编辑</button>
                  		</div>
                  		<div class="col-sm-2 col-xs-2">
                  			<button class="btn btn-primary" type="reset">重置</button>
                  		</div>
                  	</div>
                </form> 
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