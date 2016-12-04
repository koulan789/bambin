<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Bambin后台登录系统</title>
  <link rel="stylesheet" href="/bambin/Application/Admin/Common/css/login.css">
  <script src="/bambin/Application/Admin/Common/js/jquery-1.8.3.min.js"></script>

</head>
<body>

  <section class="container">
    <div class="login">
      <h1>用户登录</h1>
      <form method="post" action="<?php echo U('Login/index');?>" onsubmit="return check_form()">
        <input type="hidden" value="0" name="ver" id="ver" />
        <p><input type="text" name="uname" placeholder="管理员名"></p>
        <p><input type="password" name="password"  placeholder="密码"></p>
        <p><input type="text" name="verify"  placeholder="验证码" id="verify"/></p>
        <p><img  id="verify_img" src="<?php echo U('Login/verify');;?>" /></p>
        <p class="remember_me">
          <label>
            <input type="checkbox" name="remember_me" id="remember_me" value="1" />
            记住密码
          </label>
        </p>
        <p class="submit"><input type="submit" value="登录"></p>
      </form>
    </div>

    <div class="login-help">

    </div>
  </section>
<div style="text-align:center;">
</div>
</body>
</html>
<script>
    $('#verify_img').click(function(){
        $(this).attr('src','<?php echo U("Login/verify");?>&rand='+Math.random());
    });
    function check_form(){
        var uname = $('input[name="uname"]').val();
        if($.trim(uname)==''){
            alert("请输入用户名");
            return false;
        }
        var password = $('input[name="password"]').val();
        if($.trim(password)==''){
            alert("请输入密码");
            return false;
        }
    }
    $('#verify').blur(function(){
        var verify=$('#verify').val();
        if(verify != ''){
            $.post("<?php echo U('Login/ajax');?>",{verif:verify},function(data){
                if(data==1){
                   $('#ver').val(1);
               }else if(data==-1){
                    alert('验证码输入错误');
                }else if(data==0){
                    alert("ajax请求错误");
                }
            });
            return false;
        }
        else{
            alert("请输入验证码");
            return false;
        }
     });
</script>