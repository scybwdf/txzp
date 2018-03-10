;$(function(){
		var vcon = $(".pnews_mid");
		
        function nextscroll() {
            var offset = ($(".pnews_mid ul li").height()) * -1;
            vcon.stop().animate({
                top: offset
            }, "slow", function() {
                var firstItem = $(".pnews_mid ul li").first();
                vcon.find("ul").append(firstItem);
                $(this).css("top", "0px");
            })
        };
        var timer = null;
        timer = setInterval(function(){nextscroll()},2500);
        function prevscroll() {
            
            var offset = ($(".pnews_mid li").width() * -1);
            var lastItem = $(".pnews_mid ul li").last();
            vcon.find("ul").prepend(lastItem);
            vcon.css("top", offset);
            vcon.animate({
                top: "0px"
            }, "slow")
        };
		$(".phLogo_login").on("touchstart",function(){
			var loglis =$(".close_login").css("display");
			if(loglis=='none'){
			$(".close_login").css("display","block");	
			}
			else{
				$(".close_login").css("display","none");	
			}
		});
		$(".close_login").on("touchstart",function(){
			$.ajax({
				url:loginout,
				type:"POST",
				data:{
				ajax:1,
			},
				datatype:"JSON",
				success:function(sdata){
					if(sdata.status){
						window.location.reload();
					}
				}
			});return false;
		})
});