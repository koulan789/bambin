<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>bambin婴儿用品</title>
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/main.css" />
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/common.css" />
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/header.css" />
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/footer.css" />
    <script type="text/javascript" src="/bambin/Application/Home/Common/scripts/jquery.js"></script>
    <script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_scrollbar.js"></script>
</head>
<body>
<!-- __头部#header -->
<div id="header" class="type2 type4">
    <p class="link ff_simsun fs_12">
        <?php if($user): ?>欢迎您：<a><?php echo ($user["name"]); ?></a>
            |
            <a href="<?php echo U('User/loginout');?>">退出</a>
            <?php else: ?>
            <a href="<?php echo U('User/login');?>">会员登录</a>
            |
            <a href="<?php echo U('User/register');?>">免费注册</a><?php endif; ?>
        |
        <a href="<?php echo U('Member/index');?>">会员中心</a>
        |
        <a href="<?php echo U('Buy/cart');?>">我的购物车</a>

    </p>
    <a href="../index.html" class="logo">
        <img src="/bambin/Application/Home/Common/images/logo.png" />
    </a>
    <form  class="search" style="width: 240px">

    </form>
    <p class="nav ff_fz fs_18">
        <?php if(is_array($head_nav)): $k = 0; $__LIST__ = $head_nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><a href="<?php echo U($vo['url']);?>" class="nav<?php echo ($k); ?>"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
    </p>
    <!-- 清除浮动样式 -->
    <div class="clear"></div>
</div>
<!-- //头部#header -->

	<link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/change_password.css" />
	<script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_sidebar_toggle.js"></script>

	<!-- __主体#content -->
	<div id="content" class="type1">
		<div class="main">
			<ul class="sidebar type2 ff_yh fs_14">
    <li class="banner ff_fz">
        <p class="cn">会员中心</p>
        <p class="en fs_14">Member Center</p>
    </li>
    <?php if(is_array($userside)): $k = 0; $__LIST__ = $userside;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$side): $mod = ($k % 2 );++$k;?><li class="entry">
            <?php if($side['url']): ?><p class="header side<?php echo ($k); ?>">
                    <a href="<?php echo U($side['url']);?>"><?php echo ($side["name"]); ?></a>
                </p>
                <?php else: ?>
                <p class="header side<?php echo ($k); ?>"><?php echo ($side["name"]); ?></p><?php endif; ?>
            <ul class="sub_entry">
                <?php if(is_array($side["next"])): foreach($side["next"] as $key=>$next): ?><li><a href="<?php echo U($next['url']);?>"><?php echo ($next["name"]); ?></a></li><?php endforeach; endif; ?>
            </ul>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>

</ul>
			<form action="<?php echo U('Member/changePwd');?>" method="post" class="main_text ff_yh fs_14" onsubmit="return check_form1()">
				<p class="current_location ff_fz">
					当前位置：
					<a href="memeber.html">会员中心</a>
					&gt;&gt;
					<a href="change_password.html" class="current">修改密码</a>
				</p>
				<h1 class="headline type2 fs_18">修改密码</h1>

				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<input type="password" class="input text" name="oldPwd" placeholder="请输入原密码" />
                <span class="tip text fs_12" id="oldPwd_warning"></span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<input type="password" class="input text" name="pwd" placeholder="请输入新密码" />
				<span class="tip text fs_12" id="pwd_warning">6-16位，数字，字母或下划线组合</span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<input type="password" class="input text" name="rePwd" placeholder="确认新密码" />
				<span class="tip warning fs_12" id="rePwd_warning"></span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<input type="text" class="input verify" id="verify" name="verify" placeholder="请输入验证码" />
				<img src="<?php echo U('Member/verify');?>" class="box" onclick="change_verify()" id="verify_img" />
				<a href="javascript:change_verify()" class="refresh_verify">看不清？</a>
				<span class="tip warning fs_12" id="verify_warning">&#x25c0; 验证码不能为空</span>
                <input type="hidden" name="verify_check" value="0"/>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<input type="submit" value="保存修改" class="float_btn save ff_yh fs_14" />
				<input type="reset" value="返回" class="float_btn back ff_yh fs_14" />
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
                </form>
			<!-- 清除浮动样式 -->
			<div class="clear"></div>
		</div>
	</div>
	<!-- //主体#content -->
<!-- __底部#footer -->
<p id="footer" class="type2 ff_simsun fs_14"><?php echo ($infor_list["copyright"]); ?><br />联系地址：<?php echo ($infor_list["address"]); ?></p>
<!-- //底部#footer -->
</body>
</html>

<script>
    function change_verify(){
        $('#verify_img').attr('src',"<?php echo U('Member/verify');?>?rand="+Math.random());
    }
    $('input[name="pwd"]').blur(function(){
        var pwd = $(this).val();
        var regex_pwd = /^\w{6,16}$/;
        if(regex_pwd.test(pwd)){
            $('#pwd_warning').removeClass('warning').addClass('text').html('').css('background',"url('/bambin/Application/Home/Common/images/dui.jpg') no-repeat left 22px");
        }else{
            $('#pwd_warning').removeClass('text').addClass('warning').html('&#x25c0; 密码格式输入不正确').css('background',"");
        }
    }).focus(function(){
            $('#pwd_warning').removeClass('warning').addClass('text').html('6-16位，数字，字母或下划线组合').css('background',"");
    });
    $('input[name="rePwd"]').blur(function(){
        var pwd = $('input[name="pwd"]').val();
        var rePwd = $('input[name="rePwd"]').val();
        if($.trim(rePwd) == ''){
            $('#rePwd_warning').html('&#x25c0; 确认新密码不能为空').css('background',"");
        }else if($.trim(pwd) != $.trim(rePwd)){
            $('#rePwd_warning').html('&#x25c0; 两次密码输入不一致').css('background',"");
        }else{
            $('#rePwd_warning').html('').css('background',"url('/bambin/Application/Home/Common/images/dui.jpg') no-repeat left 22px");
        }
    }).focus(function(){
        $('#rePwd_warning').html('');
    });
    $('#verify').blur(function(){
        var verify = $('#verify').val();
        if($.trim(verify)){
            $.post('<?php echo U("Member/ajax_verify");?>',{verify:verify},function(data){
                if(data == -1){
                    $('#verify_warning').html('&#x25c0; 验证码输入错误').css('background',"");
                    $('input[name="verify_check"]').val(0);
                }else if(data == 1){
                    $('#verify_warning').html('').css('background',"url('/bambin/Application/Home/Common/images/dui.jpg') no-repeat left 22px");
                    $('input[name="verify_check"]').val(1);
                }
            });
            return false;
        }else{
            $('#verify_warning').html('&#x25c0; 验证码不能为空').css('background',"");
            $('input[name="verify_check1"]').val(0);
        }
    }).focus(function(){
                $('#verify_warning').html('');
      });
    function check_form1(){
        var oldPwd = $('input[name="oldPwd"]').val();
        if($.trim(oldPwd) == ''){
            $('#oldPwd_warning').html('&#x25c0; 请输入原密码').css('background','');
            return false;
        }
        var pwd = $('input[name="pwd"]').val();
        if($.trim(pwd)==""){
            $('#pwd_warning').removeClass('text').addClass('warning').html('&#x25c0; 请输入新密码').css('background','');
            return false;
        }
        var rePwd = $('input[name="rePwd"]').val();
        if($.trim(pwd) != $.trim(rePwd)){
            $('#rePwd_warning').html('&#x25c0; 两次密码输入不一致').css('background',"");
            return false;
        }
        var verify_check = $('input[name="verify_check"]').val();
        if($.trim(verify_check) == 0){
            $('#verify_warning').html('&#x25c0; 验证码不能为空').css('background',"");
            return false;
        }
    }
</script>