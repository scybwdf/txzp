;$(function(){
		$(".pp").hover(function(){
			$(this).find(".pmeng").css("display","block");
		},function(){
			$(this).find(".pmeng").css("display","none");
		});
		var liw = $(".nav_list").width();
		var oIndex = $(".nav_active").index();
		var oOffset = oIndex*liw+15;
		$(".heng").css("left",oOffset);
		
//		$(".nav_list").click(function(){
//			$(this).addClass("nav_active").siblings().removeClass("nav_active");
//			oIndex = $(this).index();
//		});
		
		$(".nav_list").hover(function(){
			var liIndex = $(this).index();
			var offset = liw*liIndex+15;
			$(".heng").css("left",offset);
		},function(){
			$(".heng").css("left",oOffset);
		});
	});