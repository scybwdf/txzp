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
	  var URL="/m.php/Home/Msgtemp";
	  var MODULE_NAME="<?php echo (MODULE_NAME); ?>"; 
	  var CONTROLLER_NAME="<?php echo (CONTROLLER_NAME); ?>";
	  var ACTION_NAME="<?php echo (ACTION_NAME); ?>";
	</script>
</head>

<body class="gray-bg">
<script src="/js/admin/admin.js"></script>
<script src="/js/admin/tablelist.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("select[name='name']").bind("change",function(){
			load_tpl($("select[name='name']").val());
		});
		load_tpl($("select[name='name']").val());
		
		$(".template_btn").bind('click',function(){
			var type=parseInt($(this).attr("rel"));
			$(".template_btn").removeClass("btn-warning");
			$(".template_btn").removeClass("btn-warning");
			$(this).addClass("btn-warning");
			$.ajax({
				url:URL+'/ajax_tpl?type='+type,
				data:"ajax=1",
				dataType: "json",
				success:function(obj){
					
					if(obj.status==1)
					{
						
						var tpl_list=obj.list;
						var type=obj.type;
						var tpl_html= '<option value="">请选择需要编辑的模板</option >';
						for(i=0;i<tpl_list.length;i++)
						{
							tpl_html+='<option value="'+tpl_list[i]['name']+'">'+tpl_list[i]['name']+'</option>';
						}
						$("select[name='name']").html(tpl_html);
						
						if(type == 1)
						{
							$("#html_row").show();
							$("select[name='is_html']").val(1);	
						}
						else
						{
							hide_html_row();
						}
						
						$("textarea[name='content']").val('');
						$("input[name='id']").val(0);
						
						$("#content_tip").html('');
						$("#content_tip").hide();
						
					}
				}
			});
		});
		
		
		$("#sub_button").bind("click",function(){
			var query=new Object();
			query.id=$("#template_form").find("input[name='id']").val();
			query.name=$("#template_form").find("select[name='name']").val();
			query.content=$("#template_form").find("textarea[name='content']").val();
			query.is_html=$("#template_form").find("select[name='is_html']").val();
			query.ajax=1;
			
			if(query.name =='' || query.id <=0)
				{
					alert("请选择模板");return false;
				}
			else{
				$.ajax({
				url:URL+'/update',
				data:query,
				dataType: "json",
				type:'POST',
				success:function(obj){
				 alert(obj.info);	
				}
			});
			};return false;	
			
		});
		
	});
	
	
	function load_tpl(tpl_name)
	{
		if(tpl_name != '')
		{
			$.ajax({ 
					url: URL+'/load_tpl?name='+tpl_name, 
					data: "ajax=1",
					dataType: "json",
					success: function(obj){	
						console.log(obj);
						if(obj.status==1)
						{
							var tpl = obj;
							if(tpl.type == 1)
							{
								$("#html_row").show();
								$("select[name='is_html']").val(tpl.is_html);	
							}
							else
							{
								hide_html_row();
							}
							$("textarea[name='content']").val(tpl.content);
							$("input[name='id']").val(tpl.id);
							if(tpl.tip)
							{
								$("#content_tip").html(tpl.tip);
								$("#content_tip").show();
							}
							
						}
						else
						{
							$("textarea[name='content']").val('');
							$("input[name='id']").val(0);
							hide_html_row();
						}
					}
			});
		}
		else
		{
			$("textarea[name='content']").val('');
			$("input[name='id']").val(0);
			$("#content_tip").hide();
			hide_html_row();
		}
	}
	function hide_html_row()
	{
		$("#html_row").hide();
		$("select[name='is_html']").val(0);		
		$("#content_tip").hide();
	}
</script>
<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>消息模板</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                       
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
				
                    <div class="form-group col-xs-6">
          
                        <div class="col-xs-2">
							<input type="button" class="btn template_btn btn-warning btn-sm" value="短信模板" rel="0" /> 
                        </div>
						 <div class="col-xs-2">
								 <input type="button" class="btn template_btn  btn-sm" value="邮件模板" rel="1" /> 
                        </div>
                    </div>
				
             <form id="template_form"  class="form-horizontal" method="post" action="<?php echo U('update');?>">
                    <div class="form-group col-sm-12">
                    	<label class="control-label  col-sm-3">模板名称：</label>
                    	 <div class= "col-sm-6">
                              <select name="name" class="form-control" >
                                  <option value="">请选择需要编辑的模板</option >
                                  <?php if(is_array($tpl_list)): foreach($tpl_list as $key=>$tpl_item): ?><option value="<?php echo ($tpl_item["name"]); ?>"><?php echo ($tpl_item["name"]); ?></option ><?php endforeach; endif; ?>
                              </select>
                         </div>
                    </div>
                      <div id="html_row" class="form-group col-sm-12">
                    	<label class="control-label  col-sm-3">是否超文本：</label>
                    	 <div class= "col-sm-2">
                              <select name="is_html" class="form-control" >
                                  <option value="0">否</option >
								 <option value="1">是</option >
                              </select>
                         </div>
                    </div>
                   	<div class="form-group col-sm-12">
                        <label class="control-label col-sm-3">内容：</label>
                         <div class="col-sm-6">
                       		 <textarea name="content" rows="10" class="form-control"></textarea>
						</div>
                    </div>
                    <span id="content_tip" class="help-block text-info"></span>
                    <input type="hidden" value="0" name="id" />
					<div class="col-sm-6 col-sm-offset-5 col-xs-4 col-xs-offset-4 ">
						<button  id="sub_button" class="btn btn-primary">编辑</button>
                    </div>
                </form>
     
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