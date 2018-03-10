$(function(){
		$(".tixing").click(function(){
			if($(".item_bottom_open").is(":hidden")){
				$(".item_bottom_open").css("display","block");
				$(".item_bottom_close").css("display","none");
				$(".tixing").text('点击收起');
				$(".tixing").css("background-image", "url(/img/pc/bottom_jian2.png)");
			}else{
				$(".item_bottom_open").css("display","none");
				$(".item_bottom_close").css("display","block");
				$(".tixing").text('点击展开');
				$(".tixing").css("background-image", "url(/img/pc/bottom_jian.png)");
			}
		});
		$("form[name='ztyuyue']").submit(function(){
			var subname=$(this).find("input[name='name']").val();
			var submobile=$(this).find("input[name='mobile']").val();
			var xsname="/^([\u4e00-\u9fa5]){2,7}$/";
			var xsmobile="/^1[34578]\d{9}$/";
			if(subname==''){
				 new $.flavr({
								content     :'姓名不能为空',
    							autoclose   : true,
								timeout     : 1500
								});	
				return false;
			}
			if(submobile==''){
				 new $.flavr({
								content     :'手机号不能为空',
    							autoclose   : true,
								timeout     : 1500
								});	
				return false;
			}
			if(!(/^([\u4e00-\u9fa5]){2,7}$/.exec(subname))){
			 new $.flavr({
								content     :"姓名填写错误",
    							autoclose   : true,
								timeout     : 1500
								});	
				return false;	
			}
			if(!(/^1[34578]\d{9}$/.exec(submobile))){
			 new $.flavr({
								content     :'手机号填写错误',
    							autoclose   : true,
								timeout     : 1500
								});	
				return false;	
			}
			$.ajax({
				url:yuyueurl,
				dataType:'json',
				type:'post',
				data:{
					name:subname,
					mobile:submobile,
					title:document.title
				},
				success:function(data){
					if(data.status){
						 new $.flavr({
								content     :data.info,
    							autoclose   : true,
								timeout     : 1500
								});
					}
					else{
						 new $.flavr({
								content     :data.info,
    							autoclose   : true,
								timeout     : 1500
								});	
					}
				}
				
			});
			return false;
			
		});	
	});