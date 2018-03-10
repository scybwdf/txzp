;$().ready(function(){
		$(".log_reg li").on('touchstart',function(){
			$(this).addClass("log_reg_active").siblings().removeClass("log_reg_active");
			var index = $(this).index();
			if(index == 0){
				$(".login_con").show();
				$(".reg_con").hide();
			}else{
				$(".login_con").hide();
				$(".reg_con").show();
			};
		});
		$('form[name=getpwd]').submit(function(){
			if($(".remobile").val().length==0){
				new $.flavr({
				content     : '请输入手机号',
    			autoclose   : true,
				timeout     : 1500
				});
				$(".remobile").focus();
				return false;
			}
			else if(!(/^1[34578]\d{9}$/.exec($(".remobile").val()))){
				new $.flavr({
				content     : '手机号填写错误',
    			autoclose   : true,
				timeout     : 1500
				});
				$(".remobile").focus();
				return false;
			}
			else if(($(this).find("input[name='code']").val().length!=6)){
				new $.flavr({
				content     : '验证码填写错误',
    			autoclose   : true,
				timeout     : 1500
				});
				$(this).find("input[name='code']").focus();
				return false;
			}
			else if(!(/^(\w){6,20}$/.exec($(this).find("input[name='password']").val()))){
				new $.flavr({
				content     : '密码只能是6-20个字母、数字、下划线',
    			autoclose   : true,
				timeout     : 1500
				});
				$(this).find("input[name='password']").focus();
				return false;
			}
			else{
				$.ajax({
					url:do_getpwd,
					data:{
						mobile:$(".remobile").val(),
						password:$(this).find("input[name='password']").val(),
						code:$(this).find("input[name='code']").val()
					},
					type:"POST",
					dataType:"json",
					success:function(hdata){
						if(hdata.status){
							new $.flavr({
								content     : hdata.info,
    							autoclose   : true,
								timeout     : 4500
								});	
							return false;
							
						}
						else{
							new $.flavr({
								content     : hdata.info,
    							autoclose   : true,
								timeout     : 4500
								});	
							return false;
						}
					}	
				})};return false;
		});
		$('form[name=sublog]').submit(function(){
			var wapuser=$(this).find("input[name='mobile']").val();
			var wappsw=$(this).find("input[name='password']").val();
			if(wapuser==''){
				 new $.flavr({
								content     :'手机号不能为空',
    							autoclose   : true,
								timeout     : 1500
								});	
				return false;
			}
			if(wappsw==''){
				  new $.flavr({
								content     :'密码不能为空',
    							autoclose   : true,
								timeout     : 1500
								});	
				return false;
			}
			$.ajax({
				url:do_logurl,
				type:"POST",
				data:{
				mobile:wapuser,
				password:wappsw
			},
				datatype:"JSON",
				success:function(sdata){
					if(sdata.status){
						new $.flavr({
								content     : sdata.info,
    							autoclose   : true,
								timeout     : 1500
								});	
						window.location.reload();
					}
					else{
						new $.flavr({
								content     : sdata.info,
    							autoclose   : true,
								timeout     : 1500
								});	
						return false;
					}
				}
			});return false;
			
		});
	
		$('form[name=getpwd]').find(".reg_code_right").on("click",{verifycode:pwdcodeurl},send_codemsg);
		$('form[name=subreg]').find(".reg_code_right").on("click",{verifycode:vercodeurl},send_codemsg);
			function send_codemsg(event){
			if($(".remobile").val().length==0){
				new $.flavr({
				content     : '请输入手机号',
    			autoclose   : true,
				timeout     : 4500
				});
				$(".remobile").focus();
				return false;
			}
			else if(!(/^1[34578]\d{9}$/.exec($(".remobile").val()))){
				new $.flavr({
				content     : '手机号填写错误',
    			autoclose   : true,
				timeout     : 4500
				});
				$(".remobile").focus();
				return false;
			}
			else{
				$.ajax({
					url:event.data.verifycode,
					data:{
						mobile:$(".remobile").val()
					},
					type:"POST",
					dataType:"json",
					success:function(hdata){
						if(hdata.status){
							new $.flavr({
								content     : hdata.info,
    							autoclose   : true,
								timeout     : 4500
								});	
							send_codetime=60;
							send_codereturntime(event.data.verifycode);
							return false;
						}
						else{
							new $.flavr({
								content     : hdata.info,
    							autoclose   : true,
								timeout     : 4500
								});	
							return false;
						}
					}	
				})
			}
		};
		function send_codereturntime(sendstart){	
			clearTimeout(codetimmer);
			$(".reg_code_right").val(send_codetime+"秒重新发送");
			send_codetime--;
			if(send_codetime>0){
				var	codetimmer=setTimeout(send_codereturntime,1000);
			}
			else{
				send_codetime=60;
				$(".reg_code_right").val("发送验证码");
				$(".reg_code_right").on("touchstart",{verifycode:sendstart},send_codemsg);
			}
		};
		
		$('form[name=subreg]').validate({	
		rules : {
            mobile:{
                required:true,
                phone:true,
               	remote : {
					url :checkmo,
					type : 'POST',
					dataType : 'json',
					data : {
						 mobile : function () {
							return $("form[name='subreg']").find("input[name='mobile']").val();
						}
					}
				}
            },
         password:{
             required:true,
             psw:true
          
         },
		  code:{
                required:true,
			  	 rangelength:[6,6],
			  		remote : {
					url :checkcode,
					type : 'post',
					dataType : 'json',
					data : {
						msgverify : function () {
							return $('form[name=subreg]').find('input[name=code]').val();
						},
						cmobile : function () {
							return $('form[name=subreg]').find('input[name=mobile]').val();
						}
					}
				}
                
            },
        },
          messages : {
			mobile : {
				required :'手机号不能为空',
                phone:"手机号填写错误！",
                remote:'手机号已注册！'
            },
           password:{
			required:'密码不能为空',
			  psw:'密码只能是6-20个字母、数字、下划线'
          },
			code: {
				required :'验证码不能为空',
				rangelength:'验证码错误！',
				remote:"验证码错误！"
             
            }},   
         showErrors : function(errorMap, errorList) {  
    			var msg = "";  
			  	$.each(errorList, function(i, v) {  
				msg += (v.message + "\r\n");  
				});  
			  if (msg!= "")  
				 new $.flavr({
								content     : msg,
    							autoclose   : true,
								timeout     : 4500
								});	 
		  	},  
			onfocusout :false,
			onkeyup:false,
			submitHandler: function(form) { //通过之后回调
				//进行ajax传值
			$.ajax({
					url : do_regurl,
					type : "post",
　　					dataType : "json",
　　					data: {
　　　　			mobile: $('form[name=subreg]').find('input[name=mobile]').val(),
　　　　			password:  $('form[name=subreg]').find('input[name=password]').val(),
					code: $('form[name=subreg]').find('input[name=code]').val(),		
　　					},
　　					success : function(mdata) {
　　　　				if(mdata.status){
						new $.flavr({
								content     : mdata.info,
    							autoclose   : true,
								timeout     : 1500
								});	
						window.location.reload();
					}
						else{
							new $.flavr({
								content     : mdata.info,
    							autoclose   : true,
								timeout     : 1500
								});	
						}
　　				}
				});
				},
			invalidHandler: function(form, validator) {return false;}
			});	
	});