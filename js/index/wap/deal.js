$().ready(function(){
		$("li.phCho_item").on('touchstart',function(){
			$(this).siblings("li.phCho_item").find("ol.phCho_item_list").hide();
			var $child = $(this).find("ol.phCho_item_list");
			if($child.is(":hidden")){
				$(this).addClass("phCho_itemtop").removeClass("phCho_itembottom");
				$child.stop().slideDown(300);
			}else{
				$(this).addClass("phCho_itembottom").removeClass("phCho_itemtop");
			};
		});
		$(".dealtag a").on('touchstart',function(){
		 $(this).addClass("actives").parent().siblings().find("a").removeClass("actives");  
		 var subtags=this.text;
		 var subarea=$(".dealarea a.actives").text(); 
		 $.ajax({
				type:'post',
			 	dataType:'json',
				url:dealurl,
			 	data:{
					type:1,
					tags:subtags,
					area:subarea
				},
				success:function(data){
					if(data.status){
						$(".astep").val(data.step);
						$(".ajaxcontent").html(data.html);		
				}
				else{
						$(".loaddingbg").css("display","none");
						$(".loadmore").css("display","block");
						$(".astep").val(data.step);
						$(".ajaxcontent").html(data.html);
				}	
				}
	   });$(this).parents().parents().find("ol.phCho_item_list").stop().slideUp(300);return false;});
	   $(".dealarea a").on('touchstart',function(){
		  $(this).addClass("actives").parent().siblings().find("a").removeClass("actives"); 
		 var subarea2=this.text;
		 var subtags2=$(".dealtag a.actives").text();
		   
		 $.ajax({
				type:'post',
			 	dataType:'json',
				url:dealurl,
			 	data:{
					type:2,
					tags:subtags2,
					area:subarea2
				},
				success:function(data){
					if(data.status){
						$(".astep").val(data.step);
						$(".ajaxcontent").html(data.html);
					}
					else{
						$(".loaddingbg").css("display","none");
						$(".loadmore").css("display","block");
						$(".astep").val(data.step);
						$(".ajaxcontent").html(data.html);
					}
				}
			}); $(this).parents().parents().find("ol.phCho_item_list").stop().slideUp(300);return false;
	   });
		if(($(".astep").val())>1){
				$(window).bind("scroll", function(){
					ajax_load();
			})}
			else{
					$(".loaddingbg").css("display","none");
					$(".loadmore").css("display","block");
				}
		
	function ajax_load(){
			var scrolltop = $(this).scrollTop();
			var loadheight = $(document).height();
			var windheight = $(this).height();
		if(windheight+scrolltop>=loadheight-1)
    {
		pagenum++;
		if(pagenum<=$(".astep").val()){
		$(".loaddingbg").fadeIn(800);
		$.ajax({
			url:dealurl,
			type:"post",
			datatype:"JSON",
			data:{
				type:3,
				page:pagenum,
				tags:$(".dealtag a.actives").text(),
				area:$(".dealarea a.actives").text(),
				key:$("form[name='xsbsearch']").find("input[name='key']").val()
			},
			success:function(data){
				if(data.status){
					$(".ajaxcontent").append(data.html); 
					$(".astep").val(data.step);
				}
				else{
				$(".astep").val(data.step);	
				$(".loaddingbg").css("display","none");
				$(".loadmore").css("display","block"); 
				}
			}
			
		});	
		}
		else{
				$(".loaddingbg").css("display","none");
				$(".loadmore").css("display","block"); 	
		};
		
	}
	};
	$("form[name='xsbsearch']").submit(function(){
		if($(this).find("input[name='key']").val()==''){
			return false;
		}
		$.ajax({
			url:dealurl,
			type:'post',
			dataType:'json',
			data:{
				type:3,
				key:$(this).find("input[name='key']").val()
			},
			success:function(dataa){
				if(dataa.status){
					pagenum=1;
					$(".astep").val(dataa.step);
					$(".ajaxcontent").html(dataa.html);
				}
				else{
						$(".loaddingbg").css("display","none");
						$(".loadmore").css("display","block"); 
				}
			}
		});
		return false;
	});});