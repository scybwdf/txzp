;$(function(){
    if(document.body.clientWidth>=1200){
        $(window).scroll(function(){
            var a = $(document).scrollTop();
            var b = $(".artInConLeftBeatch").offset().top;
            var c =b-a;
            if(c<400 && c>150){
                $(".artInConLeftEWMcon img").css("margin-top","0px");
            }else if(c<100 && c>0){
                $(".artInConLeftEWMcon img").css("margin-top","93px");
            }else if(c>600){
                $(".artInConLeftEWMcon img").css("margin-top","93px");
            }
        
        })
        
    }
    var artasideL = $(".artInConRightList li").length;
    for(var i=0;i<artasideL;i++){
        var artasideLl = i+1;
        $(".artInConRightList li").eq(i).find("span").text(artasideLl);
        if(i<3){
            $(".artInConRightList li").eq(i).find("span").css("background","#bb3333");
        }else{
            $(".artInConRightList li").eq(i).find("span").css("background","#555");
        }
    }
});