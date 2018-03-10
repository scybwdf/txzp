;$(function(){
	var $a=$(".buttons a");
	var $s=$(".buttons span");
	var cArr=["p1","p2","p3","p4"];
	var index=0;
	$(".boxnext").click(
		function(){
		nextimg();
		}
	);
	$(".boxprev").click(
		function(){
		previmg();
		}
	);
	function previmg(){
		cArr.unshift(cArr[3]);
		cArr.pop();
		$(".list li").each(function(i,e){
			$(e).removeClass().addClass(cArr[i]);
		});
		index--;
		if (index<0) {
			index=3;
		}
		show();
	};
	function nextimg(){
		cArr.push(cArr[0]);
		cArr.shift();
		$(".list li").each(function(i,e){
			$(e).removeClass().addClass(cArr[i]);
		});
		index++;
		if (index>3) {
			index=0;
		}
		show();
	};
	$a.each(function(){
		$(this).click(function(){
			var myindex=$(this).index();
			var b=myindex-index;
			if(b==0){
				return;
			}
			else if(b>0) {
				var newarr=cArr.splice(0,b);
				cArr=$.merge(cArr,newarr);
				$(".list li").each(function(i,e){
				$(e).removeClass().addClass(cArr[i]);
				});
				index=myindex;
				show();
			}
			else if(b<0){
				cArr.reverse();
				var oldarr=cArr.splice(0,-b);
				cArr=$.merge(cArr,oldarr);
				cArr.reverse();
				$(".list li").each(function(i,e){
				$(e).removeClass().addClass(cArr[i]);
				});
				index=myindex;
				show();
			}
		})
	});
	function show(){
			$($s).eq(index).addClass("blue").parent().siblings().children().removeClass("blue");
	};
	$(document).on("click",".p4",function(){
		previmg();
		return false;
	});
	$(document).on("click",".p2",function(){
		nextimg();
		return false;
	});
});