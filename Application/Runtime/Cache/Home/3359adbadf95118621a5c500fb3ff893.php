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
	<link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/register.css" />
	<script type="text/javascript" src="/bambin/Application/Home/Common/scripts/page_register.js"></script>

	<!-- __主体#content -->
	<div  id="content" class="ff_yh fs_14">
		<p class="picture"></p>
		<div class="tab_box">
			<p class="tabs fs_20">
				<a href="###" class="tab first">手机号码注册</a>
				|
				<a href="###" class="tab last">账户名注册</a>
			</p>

			<div class="tab_content">
                <form method="post" action="<?php echo U('User/register',array('ac'=>'phone'));?>" onsubmit="return check_form1()">
				<span class="tag">手机号</span>
				<input type="text" class="input text" name="name" id="phone" />
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">密　码</span>
				<input type="password" class="input password" name="pwd" placeholder="6-16位，数字，字母或下划线组合" id="pwd1" />
                <input type="hidden" value="0" class="pwd_check" />
				<a href="#" class="input show_password"></a>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">验证码</span>
				<input type="text" class="input verify" placeholder="输入验证码" name="verify" id="verify1" />
                <input type="hidden" value="0" name="verify_check1" />
				<a  class="input box verify_code">
					<img src="<?php echo U('User/verify');?>" onclick="change_verify1()" id="verify_img1" />
				</a>
				<a href="javascript:change_verify1()" class="change_verify">看不清？</a>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">激活码</span>
				<input type="text" class="input activation" placeholder="短信验证码" name="code" />
				<a href="#" class="input box get_activation">获取验证码</a>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
                <p class="agreement fs_12">
                    <input type="checkbox" id="flyme"  />
                    我已立即并接受
                    <a href="#">《Flyme 服务条款》</a>
                </p>
                <input type="submit" value="注册" class="submit block_button fs_18" id="button1" />
            </form>
			</div>



			<div class="tab_content">
                <form method="post" action="<?php echo U('User/register',array('ac'=>'account'));?>" onsubmit="return check_form2()">
				<span class="tag">用户名</span>
				<input type="text" class="input text" name="name" id="account" placeholder="3-20位，数字，字母或下划线组合" />
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">密　码</span>
				<input type="password" class="input password" name="pwd" id="pwd2" placeholder="6-16位，数字，字母或下划线组合" />
				<a href="#" class="input show_password"></a>

				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">邮　箱</span>
				<input type="text" class="input text" placeholder="输入电子邮箱地址" name="email" id="email" />
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">验证码</span>
				<input type="text" class="input verify" placeholder="输入验证码" name="verify" id="verify2" />
                    <input type="hidden" name="verify_check2" value="0" id="verify_check2" />
				<a href="#" class="input box verify_code">
					<img src="<?php echo U('User/verify2');?>" onclick="change_verify2()" id="verify_img2" />
				</a>
				<a href="javascript:change_verify2()" class="change_verify">看不清？</a>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
                <p class="agreement fs_12">
                    <input type="checkbox" id="flyme2"  />
                    我已立即并接受
                    <a href="#">《Flyme 服务条款》</a>
                </p>
                <input type="submit" value="注册" class="submit block_button fs_18" />
                </form>
			</div>

		</div>

	</div>
	<!-- //主体#content -->
<!-- __底部#footer -->
<p id="footer" class="type2 ff_simsun fs_14"><?php echo ($infor_list["copyright"]); ?><br />联系地址：<?php echo ($infor_list["address"]); ?></p>
<!-- //底部#footer -->
</body>
</html>

<script>
    $('#phone').blur(function(){
        var phone = $('#phone').val();
        var regex = /^1\d{10}$/;
        if(regex.test(phone)){
            $.post("<?php echo U('User/ajax');?>",{name:phone},function(data){
                if(data == 0){
                    alert('非法请求');
                }else if(data == -1){
                    $('#phone').css('background',"url('/bambin/Application/Home/Common/images/cuo.jpg') no-repeat right 13px");
                    alert('该手机号已被注册，请直接登录,若忘记密码可通过找回密码方式找回');
                }else if(data == 1){
                    $('#phone').css('background',"url('/bambin/Application/Home/Common/images/dui.jpg') no-repeat right 13px");
                }
            });
            return false;
        }else{
            $('#phone').css('background',"url('/bambin/Application/Home/Common/images/cuo.jpg') no-repeat right 13px");
            alert('请输入正确的手机号码格式');
        }
    });
    $('input[name="pwd"]').bind('blur',function(){
        var pwd = $(this).val();
        var regex_pwd = /^\w{6,16}$/;
        if(regex_pwd.test(pwd)){
            $(this).css('background',"url('/bambin/Application/Home/Common/images/dui.jpg') no-repeat right 13px");
        }else{
            alert('请输入正确的密码格式');
            $(this).css('background',"url('/bambin/Application/Home/Common/images/cuo.jpg') no-repeat right 13px");
        }
    });
    $('#verify1').blur(function(){
        var verify1 = $('#verify1').val();
        if(verify1){
            $.post('<?php echo U("User/ajax");?>',{verify:verify1},function(data){
                if(data == -2){
                    $('#verify1').css('background',"url('/bambin/Application/Home/Common/images/cuo.jpg') no-repeat right 13px");
                    alert('验证码输入错误');
                    $('input[name="verify_check1"]').val(0);
                }else if(data == 2){
                    $('#verify1').css('background',"url('/bambin/Application/Home/Common/images/dui.jpg') no-repeat right 13px");
                    $('input[name="verify_check1"]').val(1);
                }
            });
            return false;
        }else{
            alert('请输入验证码');
            $('#verify1').css('background',"");
            $('input[name="verify_check1"]').val(0);
        }
    });
    function change_verify1(){
        $('#verify_img1').attr('src',"<?php echo U('User/verify');?>");
    }


    function check_form1(){
        var phone = $('#phone').val();
        if($.trim(phone) == ''){
            alert('请输入手机号');
            return false;
        }
        var pwd1 = $('#pwd1').val();
        if($.trim(pwd1)==""){
            alert('请输入密码');
            return false;
        }
        var verify_check1 = $('input[name="verify_check1"]').val();
        if($.trim(verify_check1) == 0){
            alert('请输入正确的验证码');
            return false;
        }
        var flyme = $('#flyme').is(':checked');
        if(flyme == false){
            return false;
        }
    }
</script>
<script>
    $('#account').blur(function(){
        var account = $('#account').val();
        var regex = /^\w{3,20}$/;
        if(regex.test(account)){
            $.post("<?php echo U('User/ajax');?>",{name:account},function(data){
                if(data == 0){
                    alert('非法请求');
                }else if(data == -1){
                    $('#account').css('background',"url('/bambin/Application/Home/Common/images/cuo.jpg') no-repeat right 13px");
                    alert('该用户名已被注册');
                }else if(data == 1){
                    $('#account').css('background',"url('/bambin/Application/Home/Common/images/dui.jpg') no-repeat right 13px");
                }
            });
            return false;
        }else{
            $('#account').css('background',"url('/bambin/Application/Home/Common/images/cuo.jpg') no-repeat right 13px");
            alert('请输入正确的用户名格式');
        }
    });
    $('#email').blur(function(){
        var email = $('#email').val();
        if(email){
            var regex_email = /^\w{1,}@(qq||sina||163||126)\.com$/;
            if(regex_email.test(email)==false){
                alert('请输入正确的邮箱');
                $('#email').css('background',"url('/bambin/Application/Home/Common/images/cuo.jpg') no-repeat right 13px");
            }else {
                $('#email').css('background',"url('/bambin/Application/Home/Common/images/dui.jpg') no-repeat right 13px");
            }
        }else{
            alert('请输入邮箱地址');
        }
    });
    $('#verify2').blur(function(){
        var verify2 = $('#verify2').val();
        if(verify2){
            $.post('<?php echo U("User/ajax");?>',{verify2:verify2},function(data){
                if(data == -3){
                    $('#verify2').css('background',"url('/bambin/Application/Home/Common/images/cuo.jpg') no-repeat right 13px");
                    alert('验证码输入错误');
                    $('input[name="verify_check2"]').val(0);
                }else if(data == 3){
                    $('#verify2').css('background',"url('/bambin/Application/Home/Common/images/dui.jpg') no-repeat right 13px");
                    $('input[name="verify_check2"]').val(1);
                }
            });
            return false;
        }else{
            alert('请输入验证码');
            $('#verify2').css('background',"");
            $('input[name="verify_check2"]').val(0);
            return false;
        }
    });
    function change_verify2(){
        $('#verify_img2').attr('src',"<?php echo U('User/verify');?>");
    }

    function check_form2(){
        var account = $('#account').val();
        if($.trim(account) == ''){
            alert('请输入用户名');
            return false;
        }
        var pwd2 = $('#pwd2').val();
        if($.trim(pwd2)==""){
            alert('请输入密码');
            return false;
        }
        var verify_check2 = $('input[name="verify_check2"]').val();
        if($.trim(verify_check2) == 0){
            alert('请输入正确的验证码');
            return false;
        }
        var email = $('#email').val();
        if($.trim(email)==''){
            alert('请输入Email地址');
            return false;
        }
        var flyme2 = $('#flyme2').is(':checked');
        if(flyme2 == false){
            return false;
        }
    }
</script>