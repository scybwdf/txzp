;$(function(){
		var loginReg = '<section class="w100 login"><div class="login_con"><div class="login_header"><span class="span"></span></div><div class="login_form"><div class="login_form_tit"><div class="login_cho border_bot fl" onClick="$.login()">登录</div><div class="register_cho fl" onClick="$.reg()">注册</div></div><div class="kong30"></div><div class="login_form_con"><form action="" name="sublog"><input name="mobile" class="login_name" type="text" placeholder="请输入手机号"><div class="logindiv1 kong25"></div><input class="login_pwd" name="password" type="password" placeholder="请输入密码"><div class="logindiv2 kong25"></div><input class="login_sub" type="submit" value="登录"></form><a style="color:#3d9fe1;" class="dis-blo w100 f16 ralign" onClick="$.lose()"  href="##">忘记密码？</a></div><div class="reg_form_con dis-non"><form name="subreg" action=""><input name="mobile" class="remobile  reg_name" type="text" placeholder="请输入手机号"><div class="regdiv1 kong25"></div><div class="w100 clearfix reg_code"><input name="code" class="reg_code_left fl" type="text" placeholder="请输入验证码"><input class="reg_code_right fr" type="button" value="发送验证码"></div><div class="regdiv2 kong25"></div><input class="reg_pwd" name="password" type="password" placeholder="请输入密码"><div class="regdiv3 kong25"></div><input class="reg_sub" type="submit" value="注册"></form><div class="f12 col222 ralign">点击注册表示您已阅读并同意<a style="color:#3d9fe1;" href="/about/xieyi">《投资达客用户协议》</a></div></div></div></div></section>';
		$.lose=function(){
		new $.flavr({
								content     :'请拨打400-780-9118找回密码',
    							autoclose   : true,
								timeout     : 9500
								});		
		};
		$.logout=function(){
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
		};
		$.login=function(){	
			$(".login").remove();
			$(loginReg).appendTo("body");
			$(".login_form_con").show();
			$(".reg_form_con").hide();
			$(".login_cho").addClass("border_bot").siblings().removeClass("border_bot");
			$(".span").click(function(){
				$(".login").remove();
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
			
		};

		$.reg=function(){
			$(".login").remove();
			$(loginReg).appendTo("body");
			$(".login_form_con").hide();
			$(".reg_form_con").show();
			$(".register_cho").addClass("border_bot").siblings().removeClass("border_bot");
			$(".span").click(function(){
				$(".login").remove();
			});
			$('form[name=subreg]').find(".reg_code_right").on("click",{verifycode:vercodeurl},send_codemsg);
			function send_codemsg(event){
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
								timeout     : 1500
								});	
							send_codetime=60;
							send_codereturntime(event.data.verifycode);
							return false;
						}
						else{
							new $.flavr({
								content     : hdata.info,
    							autoclose   : true,
								timeout     : 1500
								});	
							return false;
						}
					}	
				})
			}
		};
		function send_codereturntime(sendstart){	
			clearTimeout(codetimmer);
			$(".reg_code_right").val(send_codetime+"秒后重新发送");
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
             
            },
          },
				
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
				
		};

});
	