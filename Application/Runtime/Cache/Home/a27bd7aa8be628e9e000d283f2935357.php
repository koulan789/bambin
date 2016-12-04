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

	<link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/confirm_order.css" />
	<script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_select_all.js"></script>
	<script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_item_calculator.js"></script>

	<!-- __主体#content -->
	<div id="content" class="type1">
		<form action="<?php echo U('Buy/confirm_order');?>" method="post" class="main ff_yh fs_14">
			<ul class="confirm_nav plain fs_16">
				<li class="first current">
					确认订单
					<span class="right_arrow"></span>
				</li>
				<li>
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
            <ul class="item_list" id="list">
            <?php if($num): ?><li class="header">
					<span class="float name">商品名称</span>
					<span class="float price">单价（元）</span>
					<span class="float amount">数量</span>
					<span class="float discount">运费(元)</span>
					<span class="float subtotal">小计</span>
					<!-- 清除浮动样式 -->
					<div class="clear"></div>
				</li>
				<li class="entry">
					<div class="float name ff_simsun fs_12">
						<img src="<?php echo ($data["img_thumb"]); ?>" />
						<p class="title"><?php echo ($data["name"]); ?></p>
						<p class="category">容量：<?php echo ($data["standard"]); ?></p>
					</div>
					<p class="float price">
						<?php echo ($data["sale_price"]); ?>元
					</p>
					<p class="float amount"><?php echo ($num); ?></p>
					<p class="float discount"><?php if($data['send_price'] != 0.00): echo ($data["send_price"]); ?>元<?php else: ?>免运费<?php endif; ?></p>
					<p class="float subtotal"><?php echo ($data["one_total"]); ?>元(不含运费)</p>
                    <input type="hidden" class="send_price" value="<?php echo ($data["send_price"]); ?>"/>
                    <input type="hidden" name="goods_id" value="<?php echo ($data["id"]); ?>"/>
                    <input type="hidden" name="num" value="<?php echo ($num); ?>"/>
					<!-- 清除浮动样式 -->
					<div class="clear"></div>
				</li>
             <?php else: ?>
                <?php if($order_list): if(is_array($order_list)): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><li class="header">
                        <span class="float name">商品名称</span>
                        <span class="float price">单价（元）</span>
                        <span class="float amount">数量</span>
                        <span class="float discount">运费(元)</span>
                        <span class="float subtotal">小计</span>
                        <!-- 清除浮动样式 -->
                        <div class="clear"></div>
                    </li>
                    <li class="entry">
                        <div class="float name ff_simsun fs_12">

                            <img src="<?php echo ($order["img_thumb"]); ?>" />
                            <p class="title"><?php echo ($order["name"]); ?></p>
                            <p class="category">容量：<?php echo ($order["standard"]); ?></p>
                        </div>
                        <p class="float price">
                            <?php echo ($order["sale_price"]); ?>元
                        </p>
                        <p class="float amount"><?php echo ($order["num"]); ?></p>
                        <p class="float discount"><?php if($order['send_price'] != 0.00): echo ($order["send_price"]); ?>元<?php else: ?>免运费<?php endif; ?></p>
                        <p class="float subtotal"><?php echo ($order["one_total"]); ?>元(不含运费)</p>
                        <input type="hidden" class="send_price" value="<?php echo ($order["send_price"]); ?>"/>
                        <input type="hidden" name="cart_id" value="<?php echo ($cart_id); ?>"/>
                        <!-- 清除浮动样式 -->
                        <div class="clear"></div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php else: ?>
                    你还没有选择任何商品；<?php endif; endif; ?>
            </ul>
			<p class="message">
				给卖家留言：
				<input type="text" name="message" placeholder="选填：对本次交易的说明（建议填写已经和卖家达成一致的说明）" />
			</p>
			<div class="checkout_box fs_12">
				<p>
					<span class="tag type1">运送方式：</span>
					<span class="tag type2">
						普通配送
					</span>
					<span class="tag type3 center">
						¥<span class="number red fs_14" id="send">0.00</span>
					</span>
				</p>
				<p>
					<span class="tag type1">运费险：</span>
					<span class="tag type2">购买退货运费险，退货可赔付10元 [<a href="#">?</a>]</span>
					<span class="tag type3 center">
						¥<span class="number fs_14">2.00</span>
					</span>
				</p>
				<p>
					<span class="tag type2 right">合计（含运费，服务费）：</span>
					<span class="tag type3">
						<span class="currency fs_14">¥</span>
						<!-- 必须要有itemtotalfield才能使总价实时更新有效 -->
						<span class="number red fs_18" itemtotalfield="true" id="total">0.00</span>
					</span>
				</p>
				<p>
					<span class="tag type2 right">实付款：</span>
					<span class="tag type3">
						<span class="currency">¥</span>
						<span class="number red fs_18" itemtotalfield="true" id="pay">0.00</span>
					</span> 
				</p>
			</div>
            <input type="hidden" name="total" value="<?php echo ($total); ?>" />
            <input type="hidden" name="send" />
            <input type="hidden" name="insure" value="2" />
			<input type="submit" value="提交订单" class="submit ff_yh fs_18" />
			<a href="<?php echo U('Buy/cart');?>" class="back_to_cart">返回购物车</a>
			<!-- 清除浮动样式 -->
			<div class="clear"></div>
			<p class="bottom_tip fs_12">若价格变动，请在提交订单后联系卖家改价，并查看已买到的宝贝</p>
		</form>
	</div>
	<!-- //主体#content -->
<!-- __底部#footer -->
<p id="footer" class="type2 ff_simsun fs_14"><?php echo ($infor_list["copyright"]); ?><br />联系地址：<?php echo ($infor_list["address"]); ?></p>
<!-- //底部#footer -->
</body>
</html>

<script>
    var send_price = 0;
    $('#list li').each(function(i,v){
        var send = $(v).find('.send_price').val();
        if(send>send_price){
            send_price = send;
        }
    });
    $('#send').text(parseFloat(send_price).toFixed(2));
    $('input[name="send"]').val(parseFloat(send_price).toFixed(2));
    var total = <?php echo ($total); ?>;
    total += parseFloat(send_price)+2;
    $('#total').text(total.toFixed(2));
    $('#pay').text(total.toFixed(2));

</script>