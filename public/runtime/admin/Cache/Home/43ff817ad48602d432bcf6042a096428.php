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
	  var URL="/m.php/Home/Sms";
	  var MODULE_NAME="<?php echo (MODULE_NAME); ?>"; 
	  var CONTROLLER_NAME="<?php echo (CONTROLLER_NAME); ?>";
	  var ACTION_NAME="<?php echo (ACTION_NAME); ?>";
	</script>
</head>

<body class="gray-bg">
<script src="/js/admin/admin.js"></script>
<script src="/js/admin/tablelist.js"></script>
<script type="text/javascript">
	function uninstall(id)
	{
		if(confirm("确定要卸载吗？"))
		{
			location.href = URL + "/uninstall?id="+id;
		}
	}
	function send_demo()
	{		
		$.ajax({ 
				url: URL+'/send_demo?test_mobile='+$.trim($("input[name='test_mobile']").val()), 
				data: "ajax=1",
				dataType: "json",
				success: function(obj){
					if(obj.status==0)
					{
						alert(obj.info);
					}
					else
					$("#info").html(obj.info);
				}
		});
	}
	$(document).ready(function(){
		$("input[name='test_mobile_btn']").bind("click",function(){
			var mail = $.trim($("input[name='test_mobile']").val());	
			if(mail!='')
			send_demo();
		});
	});
</script>
<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>短信接口列表</h5>
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
          
                        <div class="col-xs-5">
								<input type="text" class="form-control"  name="test_mobile" placeholder="11位手机号" />
								<!-- <input type="button" class="btn btn-primary btn-sm" name="test_mobile_btn" value="发送测试" onclick="check_fee(<?php echo ($data["id"]); ?>);" /> -->
                        </div>
						 <div class="col-xs-2">
								 <input type="button" class="btn btn-primary btn-sm" name="test_mobile_btn" value="发送测试" /> 
                        </div>
                    </div>
				
               <!--  <input type="text" class="f" name="test_mobile" />
				<input type="button" class="button" name="test_mobile_btn" value="{%TEST}" /> -->
                <table id="tablelist"  data-mobile-responsive="true" >
                <thead>
                	<tr>
                		<th data-field="name" >接口名称</th>
                		<th data-field="description">描述</th>
                		 <th data-field="react"  >操作</th>
                	</tr>
                </thead>
				<tbody>
				<?php if(is_array($sms_list)): foreach($sms_list as $key=>$sms_item): ?><tr>
					<td><?php echo ($sms_item["name"]); ?></td>
					<td><?php echo ($sms_item["description"]); ?></td>				
					<td>
						<?php if($sms_item['installed'] == 0): ?><a href="<?php echo u("Sms/install",array("class_name"=>$sms_item['class_name']));?>">安装</a>
						<?php else: ?>
							<a href="javascript:uninstall(<?php echo ($sms_item["id"]); ?>);" >卸载</a>
							<a href="<?php echo u("Sms/edit",array("id"=>$sms_item['id']));?>" >编辑</a>
							<?php if($sms_item['is_effect'] == 0): ?><a href="<?php echo u("Sms/use_effect",array("id"=>$sms_item['id']));?>">使用该接口</a>
							<?php else: ?>
								正在使用中<?php endif; endif; ?>
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