	$(function () {
		$('#refresh').click(getverify);
		$("form[name='login']").submit(function(){
			
			$.ajax({
				url:do_login,
				data:{
					username:$(this).find("input[name='username']").val(),
					password:$(this).find("input[name='password']").val(),
					verify:$(this).find("input[name='verify']").val()
				},
				type:'post',
				dataType:"json",
				success:function(data){
					if(data.status){
						window.location=data.url;
					}
					else{
						new $.flavr({
								content     : data.info,
    							autoclose   : true,
								timeout     : 1500
								});
						getverify();
					}
				}
				
			});
			return false;
		});
		function getverify() {
			getverifyurl=getverifycode;
			getverifyurl +='/'+Math.random();
			$('#refresh').attr('src', getverifyurl);
		}	
	})