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
	  var URL="/m.php/Home/Nav";
	  var MODULE_NAME="<?php echo (MODULE_NAME); ?>"; 
	  var CONTROLLER_NAME="<?php echo (CONTROLLER_NAME); ?>";
	  var ACTION_NAME="<?php echo (ACTION_NAME); ?>";
	</script>
</head>

<body class="gray-bg">
<script src="/js/admin/admin.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		
		load_u_define();
		$("select[name='u_module']").bind("change",function(){ load_u_define();});		
	});
	function load_u_define()
	{
		if($("select[name='u_module']").val()=='')
		{
			
			$("#u_config").hide();
			$("#u_act").hide();
			$("#u_define").show();
		}
		else
		{
			var module = $("select[name='u_module']").val();
			var id = $("input[name='id']").val();
			$.ajax({ 
					url:URL+'/load_module', 
					//type:'get',
					data: {
						id:id,
						module:module
					},
					dataType: "json",
					success: function(obj){
						if(obj.data)
						{
							var html="<select name='u_action' class='form-control' >";
							for(names in obj.data)
							{
								html+="<option value='"+names+"' ";
								if(obj.info==names)
								{
									
									html+=" selected='selected' ";
								}
								html+=" >"+obj.data[names]+"</option>";
							}
							html+="</select>";
							$("#u_act").html(html);
						}
						else
						{
							$("#u_act").html("");
						}
					}
			});
			$("#u_act").show();
			$("#u_define").hide();
			$("#u_config").show();
		}
	}
</script>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5 class="text-primary text-center">编辑导航菜单</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-wrench"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?php echo U('index');?>">导航菜单列表</a>
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
                        <label class="control-label col-sm-3">名称：</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" value="<?php echo ($vo["name"]); ?>" required="" placeholder="">
                        </div>
                    </div>
              
                    <div class="form-group col-sm-12">
                    	<label class="control-label  col-sm-3">网址：</label>
                    	 <div class= "col-sm-2">
                              <select name="u_module" class="form-control" >
                                  <option value="">自定义网址</option >
                                  <?php if(is_array($navs)): foreach($navs as $key=>$nav): ?><option value="<?php echo ($key); ?>" <?php if($key == $vo['u_module']): ?>selected="selected"<?php endif; ?> ><?php echo ($nav["name"]); ?></option ><?php endforeach; endif; ?>
                              </select>
                         </div>
                         <div id="u_act" class="col-sm-2"></div>
                      	<div id="u_config" class="col-sm-2" >				
							<input type="text" class="form-control" name="u_param"  value="<?php echo ($vo["u_param"]); ?> "/>
							<span class="help-block text-info">额外参数：如id=2&p=3</span>
						</div>
						
						<div id="u_define" class="col-sm-2">
							<input type="text" class="form-control" name="url" value="<?php echo ($vo["url"]); ?>" />
						</div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">新窗口打开：</label>
                        <div class="col-sm-1">
							是&nbsp;&nbsp;<input class="i-checks" <?php if($vo['blank'] == 1): ?>checked="checked"<?php endif; ?> type="radio" name="blank" value="1">
                        </div>
                         <div class="col-sm-1">
                           否&nbsp;&nbsp;<input class="i-checks" type="radio"  <?php if($vo['blank'] == 0): ?>checked="checked"<?php endif; ?> name="blank" value="0">
                        </div>
                    </div>
          	        <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">是否有效：</label>
                        <div class="col-sm-1">
                           有效&nbsp;&nbsp;<input class="i-checks"  type="radio" name="is_effect"  <?php if($vo['is_effect'] == 1): ?>checked="checked"<?php endif; ?> value="1">
                        </div>
                         <div class="col-sm-1">
                           无效&nbsp;&nbsp;<input class="i-checks" type="radio"  <?php if($vo['is_effect'] == 0): ?>checked="checked"<?php endif; ?> name="is_effect" value="0">
                        </div>
                    </div>
                    
                     <div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">排序：</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" name="sort" value="<?php echo ($vo["sort"]); ?>" required="" >
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>">
					<div class="col-sm-6 col-sm-offset-5 col-xs-4 col-xs-offset-4 ">
						<button  class="btn btn-primary" type="submit">编辑</button>
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