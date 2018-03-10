;$(function(){
		var orderHtml = '<section class="w100 order"><div class="order_con"><div class="order_header"><em>在线咨询</em><span></span></div><div class="order_form_con"><form name="yuyue" action=""><input class="order_name" type="text" name="name" placeholder="请输入您的姓名"><input class="order_phone" type="text"  name="mobile" placeholder="请输入您的号码"><input class="order_sub" type="submit" value="立即提交"></form><div class="kong20"></div><div class="talign f16 col222">*投资达客专业投资顾问将在24小时内与您联系</div></div></div></section>';
		$.order=function(){
			$(".order").remove();
			$(orderHtml).appendTo("body");
			$(".order_header span").click(function(){
				$(".order").remove();
			});
		$("form[name='yuyue']").submit(function(){
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
						$(".order").remove();
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
		};
	});