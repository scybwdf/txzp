;$(function(){
	function getCookie(name){var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));if(arr != null) return unescape(arr[2]); return null;};
	function delCookie(name){
		var exp = new Date();exp.setTime(exp.getTime() - 1);var cval=getCookie(name);
		if(cval!=null)
			document.cookie= name + "="+cval+";expires="+exp.toGMTString();
		}
if (getCookie('wapuser')!=null){
	$("#login_start").html('<div class="phLogo_login">**'+(getCookie('wapuser')).substring(7)+'<span></span></div><div class="close_login dis-non p-abs">退出</div>');
}
else{
	$("#login_start").html('<a href="'+loginin+'" class="before_login">登录</a>');
	};
	var orderHtml= '<section class="meng"><div class="order"><div class="order_tit">在线咨询<div class="order_cha"></div></div><div class="order_con"><form name="yuyue" action=""><input class="order_name" name="name" type="text" placeholder="请输入您的姓名"><input name="mobile" class="order_phone" type="text" placeholder="请输入您的手机号码"><input class="order_sub" type="submit" value="确定"></form></div></div></section>';
	$(".phyuyue").on('touchstart',function(){
		$.phorder();
	});
	$('.phoneleft').on('touchstart',function(){
		window.location.href='tel:4001699118';
	});
		$.phorder = function(){
			$(".meng").remove();
			$(orderHtml).appendTo("body");
			$(".order_cha").on('click',function(){
				$(".meng").remove();
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
						$(".meng").remove();
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