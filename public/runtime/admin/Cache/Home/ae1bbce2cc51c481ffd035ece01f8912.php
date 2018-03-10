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
	  var URL="/m.php/Home/Luyan";
	  var MODULE_NAME="<?php echo (MODULE_NAME); ?>"; 
	  var CONTROLLER_NAME="<?php echo (CONTROLLER_NAME); ?>";
	  var ACTION_NAME="<?php echo (ACTION_NAME); ?>";
	</script>
</head>

<body class="gray-bg">
<script src="/js/admin/admin.js"></script>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5 class="text-primary text-center">新增路演</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-wrench"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?php echo U('index');?>">路演列表</a>
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
                <form  class="form-horizontal" method="post" action="<?php echo U('add');?>">
                    <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">路演名称：</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" required="" placeholder="">
                        </div>
                    </div>
                      <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">主办单位：</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="danwei" placeholder="">
                        </div>
                    </div>
                       <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">路演地点：</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="area" placeholder="">
                        </div>
                    </div>
                        <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">路演时间：</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="time" placeholder="">
                        </div>
                    </div>
                         <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">规模：</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="guimo" placeholder="如：1000人">
                        </div>
                    </div>
                       <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">列表图片：</label>
                        <div class="col-sm-6">
                             <span>
        <div style='float:left; height:35px; padding-top:1px;'>
            <input type='hidden' value='' name='icon1' id='keimg_h_icon1' />
            <div class='buttonActive' style='margin-right:5px;'>
                <div class='buttonContent'>
                    <button type='button' class='keimg ke-icon-upload_image' rel='icon1'>选择图片</button>
                </div>
            </div>
        </div>
         <a href='/public/images/nophoto.gif' target='_blank' id='keimg_a_icon1' ><img src='/public/images/nophoto.gif' id='keimg_m_icon1' width=35 height=35 style='float:left; border:#ccc solid 1px; margin-left:5px;' /></a>
         <div style='float:left; height:35px; padding-top:1px;'>
             <div class='buttonActive'>
                <div class='buttonContent'>
                    <img src='/public/images/del.gif' style='display:none; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' class='keimg_d' rel='icon1' title='删除'>
                </div>
            </div>
        </div>
        </span>
                        </div>
                    </div>
                       <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">活动介绍：</label>
                         <div class="col-sm-6">
                       		 <textarea name="brief" rows="5" class="form-control"></textarea>
						</div>
                    </div>
                     <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">主办方：</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="zhubanfang">
                        </div>
                    </div>
                     <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">主办方介绍：</label>
                         <div class="col-sm-6">
                       		 <textarea name="zbfbrief" rows="5" class="form-control"></textarea>
						</div>
                    </div>
                     <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">主办方图片：</label>
                        <div class="col-sm-6">
                             <span>
        <div style='float:left; height:35px; padding-top:1px;'>
            <input type='hidden' value='' name='icon2' id='keimg_h_icon2' />
            <div class='buttonActive' style='margin-right:5px;'>
                <div class='buttonContent'>
                    <button type='button' class='keimg ke-icon-upload_image' rel='icon2'>选择图片</button>
                </div>
            </div>
        </div>
         <a href='/public/images/nophoto.gif' target='_blank' id='keimg_a_icon2' ><img src='/public/images/nophoto.gif' id='keimg_m_icon2' width=35 height=35 style='float:left; border:#ccc solid 1px; margin-left:5px;' /></a>
         <div style='float:left; height:35px; padding-top:1px;'>
             <div class='buttonActive'>
                <div class='buttonContent'>
                    <img src='/public/images/del.gif' style='display:none; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' class='keimg_d' rel='icon2' title='删除'>
                </div>
            </div>
        </div>
        </span>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">资讯地址：</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="zixun" placeholder="活动结束跳转资讯地址">
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">地图图片：</label>
                        <div class="col-sm-6">
                             <span>
        <div style='float:left; height:35px; padding-top:1px;'>
            <input type='hidden' value='' name='icon3' id='keimg_h_icon3' />
            <div class='buttonActive' style='margin-right:5px;'>
                <div class='buttonContent'>
                    <button type='button' class='keimg ke-icon-upload_image' rel='icon3'>选择图片</button>
                </div>
            </div>
        </div>
         <a href='/public/images/nophoto.gif' target='_blank' id='keimg_a_icon3' ><img src='/public/images/nophoto.gif' id='keimg_m_icon3' width=35 height=35 style='float:left; border:#ccc solid 1px; margin-left:5px;' /></a>
         <div style='float:left; height:35px; padding-top:1px;'>
             <div class='buttonActive'>
                <div class='buttonContent'>
                    <img src='/public/images/del.gif' style='display:none; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' class='keimg_d' rel='icon3' title='删除'>
                </div>
            </div>
        </div>
        </span>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">是否结束：</label>
                        <div class="col-sm-1">
                           是&nbsp;&nbsp;<input class="i-checks" type="radio" name="is_end" value="1">
                        </div>
                         <div class="col-sm-1">
                           否&nbsp;&nbsp;<input class="i-checks" type="radio" name="is_end" checked="checked"  value="0">
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">是否有效：</label>
                        <div class="col-sm-1">
                           有效&nbsp;&nbsp;<input class="i-checks" type="radio" name="is_effect" checked="checked" value="1">
                        </div>
                         <div class="col-sm-1">
                           无效&nbsp;&nbsp;<input class="i-checks" type="radio" name="is_effect" value="0">
                        </div>
                    </div>
                     <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">排序：</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" name="sort" value="<?php echo ($vosort); ?>" required="" placeholder="">
                        </div>
                    </div>
					<div class="col-sm-6 col-sm-offset-5 col-xs-4 col-xs-offset-4 ">
						<button class="btn btn-primary" type="submit">新增</button>
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