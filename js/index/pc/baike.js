;$(function(){
		$(".allbk").click(function(){
		$.ajax({
			url:getbkcont,
			data:{
			id:id	
			},
			type:'post',
			dataType:'json',
			success:function(data){
				if(data.status){
					$(".neeqWikiConRight").html(data.html);
				}
			}
		});
		});
        $(".neeqWikiFirst .neeqWikiSecond .neeqWikiSecondA").click(function(){
           
            var liSec = $(this).parent();
            $(this).css({'background':'#bb3333 url(../img/pc/wikitb.png) no-repeat 0px -149px','color':'#fff'});
            liSec.find(".neeqWikiThird").addClass("dis-blo").removeClass("dis-non");
            liSec.siblings(".neeqWikiSecond").find(".neeqWikiThird").addClass("dis-non").removeClass("dis-blo"); 
            liSec.siblings(".neeqWikiSecond").find(".neeqWikiSecondA").css({'background':'#fff url(../img/pc/wikitb.png) no-repeat 0px 0px','color':'#444'});
        });
        $(".neeqWikiBannerConRight li").hover(function(){
            $(this).find(".limeng").css("display","none");
        },function(){
            $(this).find(".limeng").css("display","block");
        });
        var ulFirH = $(".neeqWikiConRight").height();
        if(!!(ulFirH<1040)){
            $(".neeqWikiConRight").css("overflow","visible");
        }else{
            $(".neeqWikiConRight").css("overflow","scroll");
        };
		$.getlist=function (nowthis,id){
		$.ajax({
			url:getbklist,
			data:{
			id:id	
			},
			type:'post',
			dataType:'json',
			success:function(data){
				if(data.status){
					$(nowthis).next().html(data.html);
				}
			}
		});
	};
		$.getcont=function (cont,id){
		 $(cont).addClass("activeAAA");
        $(cont).parent().siblings(".neeqWikiThirdList").find(".neeqWikiThirdA").removeClass("activeAAA");
		$.ajax({
			url:getbkcont,
			data:{
			id:id	
			},
			type:'post',
			dataType:'json',
			success:function(data){
				if(data.status){
					$(".neeqWikiConRight").html(data.html);
				}
			}
		});
	};
    });
