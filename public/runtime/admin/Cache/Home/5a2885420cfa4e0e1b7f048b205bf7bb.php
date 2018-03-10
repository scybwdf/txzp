<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>后台管理</title>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/css/admin/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/css/admin/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/css/admin/animate.min.css" rel="stylesheet">
    <link href="/css/admin/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/css/common/flavr.css" rel="stylesheet">
    <script type="text/javascript" src="/js/common/jquery-1.12.2.js"></script>
    <script type="text/javascript" src="/js/common/flavr.min.js"></script>
    <script>
        var ROOT="";
		var pccacheurl="<?php echo U('Cache/pcdelcache');?>";
		var wapcacheurl="<?php echo U('Cache/wapdelcache');?>";
		var allcacheurl="<?php echo U('Cache/alldelcache');?>";
		var houcacheurl="<?php echo U('Cache/houdelcache');?>";
    </script>
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
<!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span><img alt="image" class="img-circle" src="<?php echo ($avatar); ?>" /></span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"><?php echo session('auth')['username'];?></strong></span>
                                <span class="text-muted text-xs block"><?php echo ($grouptitle); ?><b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="J_menuItem" href="<?php echo U('User/avatar');?>">修改头像</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="<?php echo U('Login/loginout');?>">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">wf
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">主页</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                             <li>
                                <a class="J_menuItem" href="<?php echo U('Yuyue/index');?>" data-index="0">预约列表</a>
                            </li>
                           <!-- <li>
                                <a class="J_menuItem" href="<?php echo U('User/index');?>" data-index="0">注册用户列表</a>
                            </li>-->
                            
                        </ul>

                    </li>
                       <li>
                        <a href="#">
                            <i class="fa fa-bars"></i>
                            <span class="nav-label">导航栏目</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Nav/index');?>" data-index="0">导航栏目列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Nav/add');?>">新增导航栏目</a>
                            </li>
                        </ul>
                    </li>
                       <li>
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span class="nav-label">文章分类管理</span>
                            <span class="fa arrow"></span>
                        </a>
                           <ul class="nav nav-second-level">
                               <li>
                                   <a class="J_menuItem" href="<?php echo U('ArticleCate/add');?>" data-index="0">新增文章分类</a>
                               </li>
                               <li>
                                   <a class="J_menuItem" href="<?php echo U('ArticleCate/index');?>" data-index="0">文章分类列表</a>
                               </li>
                               <li>
                                   <a class="J_menuItem" href="<?php echo U('ArticleCate/trash');?>" data-index="0">文章分类回收站</a>
                               </li>
                           </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span class="nav-label">文章管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">


                            <li>
                                <a class="J_menuItem" href="<?php echo U('Article/add');?>" data-index="0">新增文章</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Article/index');?>" data-index="0">文章列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Article/trash');?>" data-index="0">文章回收站</a>
                            </li>
                        </ul>

                    </li>
                   <!--    <li>
                        <a href="#">
                            <i class="fa fa-star"></i>
                            <span class="nav-label">项目管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Deal/index');?>" data-index="0">新三板项目列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Deal/add');?>">新增新三板项目</a>
                            </li>
                        </ul>
                    </li>-->
                       <!--  <li>
                        <a href="#">
                            <i class="fa fa-video-camera"></i>
                            <span class="nav-label">视频管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Video/index');?>" data-index="0">视频列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Video/add');?>">新增视频</a>
                            </li>
                        </ul>
                    </li>-->
                    <!--     <li>
                        <a href="#">
                            <i class="fa fa-user-secret"></i>
                            <span class="nav-label">路演管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Luyan/index');?>" data-index="0">路演列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Luyan/add');?>">新增路演</a>
                            </li>
                        </ul>
                    </li>-->
                          <li>
                        <a href="#">
                            <i class="fa fa-image"></i>
                            <span class="nav-label">banner图管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Banner/index');?>" data-index="0">banner图管理列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Banner/add');?>">新增banner图</a>
                            </li>
                        </ul>
                    </li>
                      <li>
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span class="nav-label">管理员权限设置</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Admin/index');?>" data-index="0">管理员列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Group/index');?>">管理员分组</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('AuthRule/index');?>">权限规则列表</a>
                            </li>
                        </ul>

                    </li>
                     <li>
                        <a href="#">
                            <i class="fa fa-cogs"></i>
                            <span class="nav-label">系统设置</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                              <li>
                                <a class="J_menuItem" href="<?php echo U('System/index');?>" data-index="0">网站设置</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Databak/index');?>" data-index="0">数据库备份</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Group/index');?>">管理员分组</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Msgtemp/index');?>">信息模板设置</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Sms/index');?>">短信配置</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" method="post" action="">
                            <div class="form-group">
                                <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        
                         <li class="dropdown">
                            <a class="count-info" href="/" target="_blank" >
                               <span>查看首页</span>
                            </a>
                        </li>
                          <li class="dropdown">
                              <a class="dropdown-toggle count-info" data-toggle="dropdown" >
                               <span>清除缓存</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a class="pcdelcache" >
                                        <div>
                                            <i class="fa fa-desktop fa-lg"></i>&nbsp;&nbsp;清除前端PC缓存
                                        </div>
                                    </a>
                                    <a  class="wapdelcache" >
                                        <div>
                                            <i class="fa  fa-mobile fa-2x"></i>&nbsp;&nbsp;&nbsp;清除前端手机端缓存
                                        </div>
                                    </a>
                                    <a  class="alldelcache" >
                                        <div>
                                            <i class="fa fa-exclamation-triangle fa-lg"></i>&nbsp;&nbsp;清除前端所有缓存
                                        </div>
                                    </a>
                                    <a  class="houdelcache" >
                                        <div>
                                            <i class="fa fa-exclamation-triangle fa-lg"></i>&nbsp;&nbsp;清除后台所有缓存
                                        </div>
                                    </a>
                                </li>
								<li class="divider"></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li class="m-t-xs">
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="img/a7.jpg">
                                        </a>
                                        <div class="media-body">
                                            <small class="pull-right">OLD</small>
                                            <strong>小黑</strong> 这个在日本投降书上签字的军官，建国后一定是个不小的干部吧？
                                            <br>
                                            <small class="text-muted"><?php echo date("Y-m-d H:s:i") ?></small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                              
                                <li>
                                    <div class="text-center link-block">
                                        <a class="J_menuItem" href="">
                                            <i class="fa fa-envelope"></i> <strong> 查看所有消息</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> 您有16条未读消息
                                            <span class="pull-right text-muted small">4分钟前</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                              
                                <li>
                                    <div class="text-center link-block">
                                        <a class="J_menuItem" href="notifications.html">
                                            <strong>查看所有 </strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                       
                        <li class="dropdown hidden-xs">
                            <a class="right-sidebar-toggle" aria-expanded="false">
                                <i class="fa fa-tasks"></i> 主题
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="active J_menuTab" data-id="index.html">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="J_tabShowActive"><a>定位当前选项卡</a>
                        </li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                        </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                        </li>
                    </ul>
                </div>
                <a href="<?php echo U('Login/loginout');?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="" frameborder="0" data-id="<?php echo U('User/index');?>" seamless></iframe>
            </div>
            <div class="footer">
                <div class="pull-right">2017 <a href="" target="_blank">txzp design</a>
                </div>
            </div>
        </div>
        <!--右侧部分结束-->
      <!--右侧边栏开始-->
        <div id="right-sidebar">
            <div class="sidebar-container">
                <ul class="nav nav-tabs navs-3">

                    <li class="active">
                        <a data-toggle="tab" href="#tab-1">
                            <i class="fa fa-gear"></i> 主题
                        </a>
                    </li>
                    <li class=""><a data-toggle="tab" href="#tab-2">
                        通知
                    </a>
                    </li>
                    <li><a data-toggle="tab" href="#tab-3">
                        功能开发
                    </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> 主题设置</h3>
                            <small><i class="fa fa-tim"></i> 你可以从这里选择和预览主题的布局和样式，这些设置会被保存在本地，下次打开的时候会直接应用这些设置。</small>
                        </div>
                        <div class="skin-setttings">
                            <div class="title">主题设置</div>
                            <div class="setings-item">
                                <span>收起左侧菜单</span>
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                                        <label class="onoffswitch-label" for="collapsemenu">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>固定顶部</span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                                        <label class="onoffswitch-label" for="fixednavbar">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>
                        固定宽度
                    </span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                                        <label class="onoffswitch-label" for="boxedlayout">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="title">皮肤选择</div>
                            <div class="setings-item default-skin nb">
                                <span class="skin-name ">
                         <a href="#" class="s-skin-0">
                             默认皮肤
                         </a>
                    </span>
                            </div>
                            <div class="setings-item blue-skin nb">
                                <span class="skin-name ">
                        <a href="#" class="s-skin-1">
                            蓝色主题
                        </a>
                    </span>
                            </div>
                            <div class="setings-item yellow-skin nb">
                                <span class="skin-name ">
                        <a href="#" class="s-skin-3">
                            黄色/紫色主题
                        </a>
                    </span>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> 最新通知</h3>
                            <small><i class="fa fa-tim"></i> 正在开发中。。。</small>
                        </div>

                        <div>

                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="img/a1.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">

                                        正在开发中。。。
                                        <br>
                                        <small class="text-muted">2017</small>
                                    </div>
                                </a>
                            </div>
                            </div>

                    </div>
                    <div id="tab-3" class="tab-pane">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-cube"></i> 项目开发中。。。</h3>
                            <small><i class="fa fa-tim"></i> 项目开发中。。。</small>
                        </div>
                        <ul class="sidebar-list">
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">项目开发中。。。</div>
                                    <h4>项目开发中。。。</h4> 项目开发中。。。

                                    <div class="small">项目开发中。。。</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <div class="small text-muted m-t-xs">2017</div>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
        <!--右侧边栏结束-->
       <!--mini聊天窗口开始-->
        <div class="small-chat-box fadeInRight animated">

            <div class="heading" draggable="true">
                <small class="chat-date pull-right">
                   <?php echo date('Y-m-d');?>
                </small> 与WF聊天中
            </div>

            <div class="content">

                <div class="left">
                    <div class="author-name">
                       <?php echo session('auth')['username'];?><small class="chat-date">
                        <?php echo date('Y-m-d H:i:s');?>
                    </small>
                    </div>
                    <div class="chat-message active">
                        你好
                    </div>

                </div>
                <div class="right">
                    <div class="author-name">
                        游客
                        <small class="chat-date">
                            11:24
                        </small>
                    </div>
                    <div class="chat-message">
                       我是wf
                    </div>

            </div>
            <div class="form-chat">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control"> <span class="input-group-btn"> <button
                        class="btn btn-primary" type="button">发送
                </button> </span>
                </div>
            </div>
        </div>
        <div id="small-chat">
            <span class="badge badge-warning pull-right">2</span>
            <a class="open-small-chat">
                <i class="fa fa-comments"></i>

            </a>
        </div>
    </div>
    <script src="/js/admin/bootstrap.min.js?v=3.3.6"></script>
      <script src="/js/admin/ajaxcache.js"></script>
    <script src="/js/admin/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/admin/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/js/admin/plugins/layer/layer.min.js"></script>
    <script src="/js/admin/hplus.min.js?v=4.1.0"></script>
    <script type="text/javascript" src="/js/admin/contabs.min.js"></script>
    <script src="/js/admin/plugins/pace/pace.min.js"></script>
</body>

</html>