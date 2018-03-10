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
	  var URL="/m.php/Home/Article";
	  var MODULE_NAME="<?php echo (MODULE_NAME); ?>"; 
	  var CONTROLLER_NAME="<?php echo (CONTROLLER_NAME); ?>";
	  var ACTION_NAME="<?php echo (ACTION_NAME); ?>";
	</script>
</head>

<body class="gray-bg">
<script src="/js/admin/admin.js"></script>
<div class="ibox float-e-margins">
    <div class="ibox-title row">
        <button disabled class="btn btn-default">新增文章</button>
        <a href="<?php echo U('index');?>" class="btn btn-primary">返回文章列表</a>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-wrench"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?php echo U('index');?>">文章列表</a>
                </li>
                <li>
                    <a href="<?php echo U('ArticleCate/add');?>">新增分类</a>
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
                        <label class="control-label col-sm-3">标题：</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="title" required="" placeholder="">
                        </div>
                    </div>
              		 <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">发布人：</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="writer" value="<?php echo session('auth')['username'];?>" required="" placeholder="">
                        </div>
                    </div>
                     <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">展示图片：</label>
                        <div class="col-sm-6">
                             <span>
        <div style='float:left; height:35px; padding-top:1px;'>
            <input type='hidden' value='' name='icon' id='keimg_h_icon' />
            <div class='buttonActive' style='margin-right:5px;'>
                <div class='buttonContent'>
                    <button type='button' class='keimg ke-icon-upload_image' rel='icon'>选择图片</button>
                </div>
            </div>
        </div>
         <a href='/public/images/nophoto.gif' target='_blank' id='keimg_a_icon' ><img src='/public/images/nophoto.gif' id='keimg_m_icon' width=35 height=35 style='float:left; border:#ccc solid 1px; margin-left:5px;' /></a>
         <div style='float:left; height:35px; padding-top:1px;'>
             <div class='buttonActive'>
                <div class='buttonContent'>
                    <img src='/public/images/del.gif' style='display:none; margin-left:10px; float:left; border:#ccc solid 1px; width:35px; height:35px; cursor:pointer;' class='keimg_d' rel='icon' title='删除'>
                </div>
            </div>
        </div>
        </span>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">简介：</label>
                         <div class="col-sm-6">
                       		 <textarea name="brief" rows="5" class="form-control"></textarea>
						</div>
                    </div>
                   
                    <div class="form-group col-sm-12">
                    	<label class="control-label  col-sm-3">所属分类：</label>
                    	 <div class= "col-sm-6">
                              <select name="cate_id" class="form-control chosen-select" >
                                  <option value="0" <?php if($_SESSION['cateid'] == 0): ?>selected="selected"<?php endif; ?> >顶级分类</option >
                                  <?php if(is_array($cate)): foreach($cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($_SESSION['cateid'] == $v['id']): ?>selected="selected"<?php endif; ?> ><?php echo ($v["title"]); ?></option ><?php endforeach; endif; ?>
                              </select>
                         </div>
                    </div>
                     <div class="form-group col-sm-12">
            		  <label class="control-label col-sm-3">文章内容：</label>
            		  <div class="col-sm-6">
          	 				<div  style='margin-bottom:5px; '><textarea id='editor' name='content' class='ketext' style='width:100%;height:100%' ></textarea> </div>
					  </div>	
        			</div>
                   	 <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">标签：</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="tags" required="" placeholder="">
                        </div>
                    </div>
                       <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">热门：</label>
                        <div class="col-sm-1">
                           有效&nbsp;&nbsp;<input class="i-checks" type="radio" name="is_hot" value="1">
                        </div>
                         <div class="col-sm-1">
                           无效&nbsp;&nbsp;<input class="i-checks" type="radio" name="is_hot" checked="checked"  value="0">
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">本周必读：</label>
                        <div class="col-sm-1">
                           有效&nbsp;&nbsp;<input class="i-checks" type="radio" name="is_week" value="1">
                        </div>
                         <div class="col-sm-1">
                           无效&nbsp;&nbsp;<input class="i-checks" type="radio" name="is_week" checked="checked"  value="0">
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
						<button style="text-shadow: black 5px 3px 3px;" class="btn btn-primary" type="submit">新增</button>
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