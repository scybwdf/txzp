;$(function(){
		var pagenum=1;
		if($(".artcount").val()<=1){
			$(".getmore").text("没有更多了");return false;
		}
		else{
			$(".getmore").on('click',function(){
			pagenum++;
			if(pagenum<=$(".artcount").val()&&$(".artcount").val()>1){
				$.ajax({
				url:getart,
				type:'post',
				dataType:'json',
				data:{
					page:pagenum
				},
				success:function(data){
					if(data.status){
						$(".artlist").append(data.html);return false;	
					}
					else{
						$(".getmore").text("没有更多了");
					}
				}
				
			});	
			}
			else{
				$(".getmore").text("没有更多了");
			}
		});return false;
		}
	});