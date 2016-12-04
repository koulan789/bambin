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

	<link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/confirm_address.css" />
	<script type="text/javascript" src="/bambin/Application/Home/Common/scripts/page_confirm_address.js"></script>
	<!-- __主体#content -->
	<div id="content" class="type1">
		<div  class="main ff_yh fs_14">
			<ul class="confirm_nav plain fs_16">
				<li class="first">
					确认订单
					<span class="right_arrow"></span>
				</li>
				<li class="current">
					<span class="left_arrow"></span>
					填写核对订单
					<span class="right_arrow"></span>
				</li>
				<li class="last">
					<span class="left_arrow"></span>
					订单提交
				</li>
				<!-- 清除浮动样式 -->
				<li class="clear"></li>
			</ul>
			<h1 class="fs_16">
				确认收货地址
			</h1>
			<div class="info_box">
				<span class="tag">收货人：</span>
				<span class="text name"><?php echo ($address["name"]); if($address['sex'] == 1): ?>先生<?php else: ?>女士<?php endif; ?></span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">手机：</span>
				<span class="text ff_simsun"><?php echo ($address["tel"]); ?></span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">收货区域：</span>
				<span class="text ff_simsun fs_12"><?php echo ($address["address_area"]); ?></span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<span class="tag">详细地址：</span>
				<span class="text ff_simsun fs_12"><?php echo ($address["address"]); ?></span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
				<a href="<?php echo U('Member/address');?>" class="change_addr ff_simsun fs_12">使用其他地址</a>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
			</div>
			<h1 class="fs_16">购物清单</h1>
			<ul class="item_list">
                <li class="header">
                    <span class="float name">商品名称</span>
                    <span class="float price">单价（元）</span>
                    <span class="float amount">数量</span>
                    <span class="float subtotal">小计</span>
                    <!-- 清除浮动样式 -->
                    <div class="clear"></div>
                </li>
                <?php if($data): ?><li class="entry">
                        <div class="float name ff_simsun fs_12">
                            <img src="<?php echo ($data["img_thumb"]); ?>" />
                            <p class="title"><?php echo ($data["name"]); ?></p>
                            <p class="category">容量：<?php echo ($data["standard"]); ?></p>
                        </div>
                        <p class="float price"><?php echo ($data["sale_price"]); ?>元</p>
                        <p class="float amount"><?php echo ($num); ?></p>
                        <p class="float subtotal"><?php echo ($data["one_total"]); ?>元</p>
                        <input type="hidden" name ="goods_id" value="<?php echo ($id); ?>" />
                        <input type="hidden" name ="num" value="<?php echo ($num); ?>" />
                        <!-- 清除浮动样式 -->
                        <div class="clear"></div>
                    </li>
                <?php elseif($order_data): ?>
                    <?php if(is_array($order_data)): $i = 0; $__LIST__ = $order_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><li class="entry">
                        <div class="float name ff_simsun fs_12">
                            <img src="<?php echo ($order["img_thumb"]); ?>" />
                            <p class="title"><?php echo ($order["name"]); ?></p>
                            <p class="category">容量：<?php echo ($order["standard"]); ?></p>
                        </div>
                        <p class="float price"><?php echo ($order["sale_price"]); ?>元</p>
                        <p class="float amount"><?php echo ($order["num"]); ?></p>
                        <p class="float subtotal"><?php echo ($order["one_total"]); ?>元</p>
                        <input type="hidden" name ="cart_id" value="<?php echo ($id); ?>" />
                        <!-- 清除浮动样式 -->
                        <div class="clear"></div>
                    </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			</ul>
			<div class="submit_order">
				<span class="check fs_12">
					<span class="fs_14">支付宝支付</span>
				</span>
                <input type="hidden" name ="total" value="<?php echo ($total); ?>" />
                <input type="hidden" name ="send" value="<?php echo ($send); ?>" />
                <input type="hidden" name ="insure" value="<?php echo ($insure); ?>" />
                <input type="hidden" name ="message" value="<?php echo ($message); ?>" />
				<input type="button" onclick="add_order()" value="提交订单" class="submit ff_yh" />
				<span class="total">
					应付总额:<span class="number"><?php echo ($all_total); ?>元</span>
				</span>
				<!-- 清除浮动样式 -->
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<!-- //主体#content -->
	<!-- __提交订单成功框#popUpSuccess -->
	<div id="popUpSuccess" class="popup_box">
		<a href="<?php echo U('Member/order');?>" onclick=" popUpApp.close(this);" class="close"></a>
	</div>
	<!-- //提交订单成功框#popUpSuccess -->
	<!-- __提交订单失败框#popUpFail -->
	<div id="popUpFail" class="popup_box">
		<a href="<?php echo U('Index/index');?>" onclick=" popUpApp.close(this);" class="close"></a>
	</div>
	<!-- //提交订单失败框#popUpFail -->
<!-- __底部#footer -->
<p id="footer" class="type2 ff_simsun fs_14"><?php echo ($infor_list["copyright"]); ?><br />联系地址：<?php echo ($infor_list["address"]); ?></p>
<!-- //底部#footer -->
</body>
</html>

<script>
    function add_order(){
        var address_id='<?php echo ($address["id"]); ?>';
        var goods_id ='<?php echo ($id); ?>';
        var num ='<?php echo ($num); ?>';
        var cart_id ='<?php echo ($cart_id); ?>';
        var total ='<?php echo ($total); ?>';
        var send ='<?php echo ($send); ?>';
        var insure ='<?php echo ($insure); ?>';
        $.post("<?php echo U('Buy/add_order');?>",{address_id:address_id,goods_id:goods_id,num:num,cart_id:cart_id,total:total,send:send,insure:insure},function(data){
           if(data == 0){
               alert('非法请求');
           }else if(data == -1){
               popUpApp.fail();
           }else if(data ==1){
               popUpApp.success();
           }
        });
    }
</script>