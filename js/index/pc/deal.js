;$(function(){
	$(".dealtag a").click(function(){
		 $(this).addClass("active").siblings().removeClass("active");  
		 var subtags=this.text;
		 var subarea=$(".dealarea .active").text(); 
		 $.ajax({
				type:'post',
				url:dealurl,
			 	data:{
					tags:subtags,
					area:subarea
				},
				success:function(res){
					console.log(res);
					 $(".ajaxcontent").html(res);return false;
				}
			});return false; 
	   });
	   $(".dealarea a").click(function(){
		 $(this).addClass("active").siblings().removeClass("active");  
		 var subarea2=this.text;
		 var  subtags2=$(".dealtag .active").text(); 
		 $.ajax({
				type:'post',
				url:dealurl,
			 	data:{
					name:1,
					tags:subtags2,
					area:subarea2
				},
				success:function(res){
					 $(".ajaxcontent").html(res);
					return false;
				}
			});return false;  
	   });
		$(document).on('click','.page a',function(){
			var suburl = this.href;
			$.ajax({
				type:'get',
				url:suburl,
				success:function(res){
					 $(".ajaxcontent").html(res);
				}
			}); 
			return false;
		});
	  $(".xsbinarticlehotbot li").each(function () {
            var ttt = $(this).index() + 1;
            $(this).find("span").text(ttt);
        });
        if ($(".xsbinarticlehotbot li:lt(3)")) {
            $(".xsbinarticlehotbot li:lt(3)").find("span").css("background", "#bb3333");
        };
	 $(".xsbzbanlietopprev").click(function(){
		 $.ajax({
				type:'post',
				url:dealzb,
			 	data:{
					zbp:$(".zbprev").val()
				},
				success:function(newzbdata){
				$(".zbprev").val(newzbdata.zbprev);
                $(".zbnext").val(newzbdata.zbnext);
                $(".xsbzbanliebot ul").html(newzbdata.html);
				}
			}); 
	   });
		 $(".xsbzbanlietopnext").click(function(){
		 $.ajax({
				type:'post',
				url:dealzb,
			 	data:{
					zbp:$(".zbnext").val()
				},
				success:function(newzbdata){
				$(".zbprev").val(newzbdata.zbprev);
                $(".zbnext").val(newzbdata.zbnext);
                $(".xsbzbanliebot ul").html(newzbdata.html);
				}
			}); 
	   });

});