$(function(){
	function getCookie(name){var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));if(arr != null) return unescape(arr[2]); return null;};
if (getCookie('puser')!=null){
	$(".headertop-left").html('<span >您好,&nbsp;'+getCookie('puser')+'</span><span onClick="$.logout()">退出登录</span><span>:</span><span class="maincolor">touzidake@126.com</span>');
}
else{
	$(".headertop-left").html('<span onClick="$.login()" >您好,&nbsp;请登录</span><span onClick="$.reg()">免费注册</span><span>:</span><span class="maincolor">touzidake@126.com</span>');
	};
	
});