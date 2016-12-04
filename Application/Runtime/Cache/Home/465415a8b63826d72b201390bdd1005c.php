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

	<link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/member_info.css" />
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
			<div  class="main_text ff_simsun fs_12">

				<p class="current_location ff_fz fs_14">
					当前位置：
					<a href="<?php echo U('Member/index');?>">会员中心</a>
					&gt;&gt;
					<a  class="current">收获地址</a>
				</p>
                <form action="<?php echo U('Member/address');?>" method="post"  onsubmit="return check_form1()">
                    <input type="hidden" name="id" id="id" />
                    <h1 class="headline type2 ff_yh fs_18">收货人信息</h1>
                    <span class="tag label">姓　　名：</span>
                    <input type="text" name="name" id="name" class="input long" />
                    <!-- 清除浮动样式 -->
                    <div class="clear"></div>
                    <span class="tag label">性　　别：</span>
                    <input type="radio" name="sex" value="1" class="radio sex"  />
                    <label class="tag tip">男</label>
                    <input type="radio" name="sex" value="0" class="radio sex" checked="checked" />
                    <label class="tag tip">女</label>
                    <!-- 清除浮动样式 -->
                    <div class="clear"></div>
                    <div id="region">
                    <span class="tag label">所 在 地：</span>
                    <select id="province">
                        <option selected="selected" value="0">请选择省（直辖市、自治区）</option>
                        <?php if(is_array($region_data)): $i = 0; $__LIST__ = $region_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$region): $mod = ($i % 2 );++$i;?><option value="<?php echo ($region["id"]); ?>"><?php echo ($region["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                    </select>
                    <select id="city">
                        <option selected="selected" value="0">请选择市（地区）</option>
                    </select>
                    <select name="district_id" id="area">
                        <option selected="selected" value="0">请选择县（地区）</option>
                    </select>
                    <!-- 清除浮动样式 -->
                    <div class="clear"></div>
                    </div>
                    <span class="tag label">详细地址：</span>
                    <input type="text" name="address" class="input long" />
                    <!-- 清除浮动样式 -->
                    <div class="clear"></div>
                    <span class="tag label">手机号码：</span>
                    <input type="text" name="tel" class="input long" />
                    <span class="tag tip">请真实填写，用于系统通知和收获联系</span>
                    <!-- 清除浮动样式 -->
                    <div class="clear"></div>
                    <input type="hidden" value="<?php echo ($url); ?>" name="pre" />
                    <br/>
                    <input type="submit" value="保存并使用" class="float_btn save ff_yh fs_14" />
                    <input type="reset" value="重置" class="float_btn back ff_yh fs_14" />
                </form>
                <form method="post" action="<?php echo U('Member/change_default');?>">
				<div class="current_addr">
					<p class="title fs_14">当前收货地址</p>
					<input type="radio" checked="checked" name="is_default" value="<?php echo ($address_list["0"]["id"]); ?>" class="ca_radio" />
					<p class="text"><?php echo ($address_list["0"]["address_all"]); ?>(电话：<?php echo ($address_list["0"]["tel"]); ?>)（<?php echo ($address_list["0"]["name"]); ?>
                        <?php if($address_list[0]['sex'] == 1): ?>先生<?php else: ?>女士<?php endif; ?>收）</p>
					<!-- 清除浮动样式 -->
					<div class="clear"></div>
					<a href="javascript:edit('<?php echo ($address_list["0"]["id"]); ?>')" class="edit_addr">修改地址</a>
				</div>
				<ul class="addr_list">
                    <?php if(is_array($address_list)): $i = 0; $__LIST__ = $address_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$addr): $mod = ($i % 2 );++$i; if($addr['is_default'] == 0): ?><li>
                                <input type="radio" name="is_default" value="<?php echo ($addr["id"]); ?>" />
                                <?php echo ($addr["address_all"]); ?>(电话：<?php echo ($addr["tel"]); ?>)（<?php echo ($addr["name"]); if($addr['sex'] == 1): ?>先生<?php else: ?>女士<?php endif; ?>收）
                            </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<input type="submit" value="设为默认" class="float_btn save ff_yh fs_14" />
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
                </form>
                </div>
			</div>
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
    $('#province').change(function(){
        var id = $('#province').val();
        $.post("<?php echo U('Member/change_address');?>",{id:id},function(data){
            var str = '<option selected="selected" value="0">请选择市（地区）</option>';
            if(data.length>0){
               for(var i=0; i<data.length; i++){
                    str += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
               }
           }
          $('#city').html(str);
        },'json');
    });
    $('#city').change(function(){
        var id = $('#city').val();
        $.post("<?php echo U('Member/change_address');?>",{id:id},function(data){
            var str = '<option selected="selected" value="0">请选择县（地区）</option>';
            if(data.length>0){
                for(var i=0; i<data.length; i++){
                    str += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                }
            }else{
                $('#area').removeAttr('name');
                $('#city').attr('name','district_id');
            }
            $('#area').html(str);
        },'json');
    });
    function check_form1(){
        var name = $('input[name="name"]').val();
        if($.trim(name) == ''){
            alert('请输入姓名');
            return false;
        }
        var address = $('input[name="address"]').val();
        if($.trim(address) == ''){
            alert('请输入详细地址');
            return false;
        }
        var tel = $('input[name="tel"]').val();
        if($.trim(tel) == ''){
            alert('请输入手机号码');
            return false;
        }
        var district_id = $('select[name="district_id"]').val();
        if($.trim(district_id) == 0){
            alert('请选择所在地');
            return false;
        }
    }
    function edit(){
        $('#id').val('<?php echo ($address_list["0"]["id"]); ?>');
        var sex = '<?php echo ($address_list["0"]["sex"]); ?>';
        if(sex == 1){
            $('.sex[value="1"]').attr('checked','checked');
        }else{
            $('.sex[value="0"]').attr('checked','checked');
        }
        $('input[name="name"]').val('<?php echo ($address_list["0"]["name"]); ?>');
        $('input[name="address"]').val('<?php echo ($address_list["0"]["address"]); ?>');
        $('input[name="tel"]').val('<?php echo ($address_list["0"]["tel"]); ?>');
    }
</script>