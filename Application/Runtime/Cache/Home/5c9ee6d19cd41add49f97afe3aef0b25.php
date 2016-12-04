<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/main.css" />
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/common.css" />
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/header.css" />
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/footer.css" />
    <script type="text/javascript" src="/bambin/Application/Home/Common/scripts/jquery.js"></script>
    <script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_scrollbar.js"></script>
    <script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_tabs.js"></script>
</head>
<body>
<!-- __头部#header -->
<div id="header" class="type1">
    <a href="<?php echo U('Index/index');?>" class="logo">
        <img src="/bambin/Application/Home/Common/images/logo.png" />
    </a>
    <p class="link ff_simsun fs_12">
        <a href="<?php echo U('User/login');?>" <?php if($title == '登录'): ?>class="current"<?php endif; ?> >会员登录</a>
        |
        <a href="<?php echo U('User/register');?>" <?php if($title == '注册'): ?>class="current"<?php endif; ?>>免费注册</a>
    </p>
</div>
<!-- //头部#header -->
<link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/login.css" />
	<!-- __主体#content -->
	<form action="<?php echo U('User/login');?>" method="post" id="content" class="ff_yh fs_14" onsubmit="return check_form()">
		<p class="picture"></p>
		<img src="/bambin/Application/Home/Common/images/icons/login_avatar.jpg" class="avatar" />
		<div class="tab_box">
			<p class="tabs fs_20">
				<a href="#" class="tab first">手机登录</a>
				|
				<a href="#" class="tab last">电脑登录</a>
			</p>
			<div class="tab_content">
                <p>
				    <img src="" width="160" height="160"/>
                </p>
				<p class="remember_login">
					用手机扫描二维码，可通过手机客户端登陆网站
				</p>
			</div>
			<div class="tab_content">
				<span class="input icon account"></span>
				<span class="input arrow"></span>
				<input type="text" class="input text" name="name" id="name" placeholder="帐户名/手机号" />
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="input icon password"></span>
				<span class="input arrow"></span>
				<input type="password" class="input text" placeholder="密码" name="pwd" id="pwd" />
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<p class="remember_login">
					<input type="checkbox" />
					记住登录状态
					<a href="#" class="forget_password">忘记密码？</a>
					<span class="other_login">
						<a href="#" class="weibo_login"></a>
						<a href="#" class="qq_login"></a>
						<a href="#" class="weixin_login"></a>
					</span>
				</p>
				<input type="submit" value="登录" class="submit block_button fs_18" />
			</div>
		</div>

	</form>
	<!-- //主体#content -->
	<!-- __底部#footer -->
<p id="footer" class="type2 ff_simsun fs_14"><?php echo ($infor_list["copyright"]); ?><br />联系地址：<?php echo ($infor_list["address"]); ?></p>
<!-- //底部#footer -->
</body>
</html>
<script>
	function check_form(){
		var name = $('#name').val();
		if($.trim(name)==""){
			alert('请输入用户名');
			return false;
		}
		var pwd = $('#pwd').val();
		if($.trim('pwd')==''){
			alert('请输入密码');
			return false;
		}
	}
</script>