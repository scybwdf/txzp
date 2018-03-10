$(function(){
		$(".checkall ins").click(function(){
			if($(".checkall input:checked").length==1){
				$(".checklist div").addClass("checked");
				$(".checklist input").prop("checked",true);
			}
			else{
				$(".checklist div").removeClass("checked");
				$(".checklist input").prop("checked",false);
			}
			
		});
		$(".checklist ins").click(function(){
				if($(".checklist input:checked").length!=$(".checklist input").length){
				$(".checkall div").removeClass("checked");
				$(".checkall input").prop("checked",false);
			}
			else{
					$(".checkall div").addClass("checked");
					$(".checkall input").prop("checked",false);
				}	
				
		});
		$("form[name=addgroup]").submit(function(){
			var checkedbox=$(".checklist input:checked");
			checkedarray=new Array();
			$.each(checkedbox,function(i,n){
				checkedarray.push($(n).val());	
			});
			subckecked=checkedarray.join(",");
			$.ajax({
				url:'',
				type:'post',
				dataType:'json',
				data:{
					title:$("form[name=addgroup] input[name=title]").val(),
					rules:subckecked,
					id:$("form[name=addgroup] input[name=id]").val()
				},
				success:function(data){
					if(data.status){
						swal({
							title:"成功提示",
							text:data.info,
							type:'success',
							timer: 2000,
  							showConfirmButton: false
						});
						urljump(2000);
					}
					else{
						swal({
							title:"错误提示",
							text:data.info,
							type:'error',
							timer: 1500
						});
					}
				}
			});return false;
		});
	//删除
		$(".btndelete").click(function(){
			  var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
            	return row.id;
			  });
			console.log(ids);alert(ids);return false;
			/*var ifchecked=$("tbody input[name='btSelectItem']:checked").parent().next().find("input");*/
			if(ifchecked.length==0){
				swal({
							title:"错误提示",
							text:"您还没有选择要删除的对象！",
							type:'info',
							timer: 1500
						});
				return false;
			}
			var checkallarray=new Array();
			$.each(ifchecked,function(i,n){
				checkallarray.push($(n).val());
			});
			subcheckall=checkallarray.join(",");
				swal({
		title:"您确定要删除"+ifchecked.length+"条数据吗？",
		text:"删除后将无法恢复，请谨慎操作！",
		type:"warning",
		showCancelButton:true,
		confirmButtonColor:"#DD6B55",
		confirmButtonText:"是的，我要删除！",
		cancelButtonText:"让我再考虑一下…",
		closeOnConfirm:false,
		closeOnCancel:false},
		function(isconfirm){
			if(isconfirm){
			$.ajax({
					url:URL+'/delete',
					dataType:'json',
					type:'get',
					data:{
						id:subcheckall
					},
					success:function(dataa){				
            	if(dataa.status){
					ifchecked.each(function(){
						$(this).parent().parent().remove();
					});
					 swal("删除成功！","您已经永久删除了"+ifchecked.length+"条信息。","success");
				}
				else{
					swal("删除失败","请重试！","error");
				}		
			}})	 
			}
			else{swal("已取消","您取消了删除操作！","error")}
		}
		);
		});
		//设置有效性
	$.set_effect=function(nowthis,id){
  		$.ajax({
				url:URL+'/set_effect',
				type:'post',
				dataType:'json',
				data:{
					id:id
				},
				success:function(data){
				if(data.status){
					if(data.info){
						$(nowthis).removeClass("btn-danger");
						$(nowthis).addClass("btn-info");
						$(nowthis).text("有效");
					}
					else{
						$(nowthis).removeClass("btn-info");
						$(nowthis).addClass("btn-danger");
						$(nowthis).text("无效");
					}
				}
				else{
					alert("失败");
				}	
				}
			});
		};
	 	$('.chosen-select').chosen();
		function urljump(timmer){
			clearTimeout(jumptime);
			var jumptime=setTimeout('window.location.href=window.location.href',timmer);
		}
	})