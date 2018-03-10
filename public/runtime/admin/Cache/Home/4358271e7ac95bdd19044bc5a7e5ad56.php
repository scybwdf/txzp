<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登陆后台</title>
    <link rel="shortcut icon" href="favicon.ico"> 
	<link href="/css/admin/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/css/admin/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/css/admin/animate.min.css" rel="stylesheet">
    <link href="/css/admin/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/css/common/flavr.css" rel="stylesheet">
	<script>
	var do_login="<?php echo U('login');?>";
	var getverifycode="<?php echo U('verify', '', '');?>";	
	</script>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">WF</h1>

            </div>
            <h3>登陆后台</h3>

            <form name="login" class="m-t" role="form" action="<?php echo U('login');?>" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="用户名" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="密码" required="">
                </div>
				<div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <input type="text"  name="verify" class="form-control" id="exampleInputCode" placeholder="验证码" required="">
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <a href="javascript:void(0)"><img id="refresh" class="verify" src="<?php echo U('login/verify');?>" alt="点击刷新"/></a>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
            </form>
        </div>
    </div>
    <script src="/js/admin/jquery.min.js?v=2.1.4"></script>
    <script src="/js/admin/bootstrap.min.js?v=3.3.6"></script>
    <script src="/js/common/flavr.min.js"></script>
    <script src="/js/admin/login.js"></script>
</body>
</html>