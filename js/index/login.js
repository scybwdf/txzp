;$('#refresh').click(function () {
			url=URL+'/verify/'+Math.random();
			$('#refresh').attr('src',url);
		});
    $('form[name=login]').validate({
		rules : {
            account:{
                required:true
                
            },
			
         password:{
             required:true,
          
         },
         
        },
          messages : {
			account : {
				required :icon+ '账号不能为空',
              
            },
        
           password:{
			required:icon+'密码不能为空',
			 
          },
			},
		submitHandler: function(form) { //通过之后回调
				//进行ajax传值
				alert(URL);
				},
			invalidHandler: function(form, validator) {return false;}
});
 