$(function(){
	$(".pcdelcache").on('click',function(){
		startcache(pccacheurl);
	});
	$(".wapdelcache").on('click',function(){
		startcache(wapcacheurl);
	});
	$(".alldelcache").on('click',function(){
		startcache(allcacheurl);
	});
	$(".houdelcache").on('click',function(){
		startcache(houcacheurl);
	});
	function startcache(url){
		$.ajax({
			url:url,
			data:{
				ajax:1
			},
			dataType:'json',
			type:'post',
			success:function(data){
			if(data.status){
				new $.flavr({
								content     : data.info,
    							autoclose   : true,
								timeout     : 1500
								});
			}
			else{
				new $.flavr({
								content     : data.info,
    							autoclose   : true,
								timeout     : 1500
								});
			}	
			}
		});
	};
})