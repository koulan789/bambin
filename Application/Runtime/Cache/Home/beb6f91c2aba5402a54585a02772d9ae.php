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

	<link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/purchase_record.css" />
	<script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_sidebar_toggle.js"></script>
    <script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_select_all.js"></script>
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
			<div class="main_text ff_yh fs_12">
				<p class="current_location ff_fz fs_14">
					当前位置：
					<a href="<?php echo U('Member/index');?>">会员中心</a>
					&gt;&gt;
					<a class="current">我的订单</a>
				</p>
				<h1 class="headline type2 fs_18">我购买的</h1>
				<ul class="item_list">
					<li class="item header fs_14">
						<span class="float name">商品名称</span>
						<span class="float price">单价（元）</span>
						<span class="float amount">数量</span>
						<span class="float total">交易状态</span>
						<span class="float actions">交易操作</span>
						<!-- 清除浮动样式 -->
						<div class="clear"></div>
					</li>
					<li class="action">
						<input type="checkbox" groupid="g1" />
						<span class="fs_14">全选</span>
						<a href="#">批量确认收货</a>
					</li>
                    <?php if(is_array($order_data)): $i = 0; $__LIST__ = $order_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><li class="entry">
						<p class="item header fs_14">
							<input type="checkbox" selectid="g1" />
							<?php echo (date('Y-m-d H:i:s',$order["create_time"])); ?>
							<span class="fs_12">订单号： <?php echo ($order["order_num"]); ?></span>

						</p>
                        <?php if(is_array($order['goods_list'])): foreach($order['goods_list'] as $key=>$goods): ?><div class="item float name ff_simsun">
							<img src="<?php echo ($goods["img_thumb"]); ?>" />
							<p class="title"><?php echo ($goods["name"]); ?></p>
							<p class="category">容量：<?php echo ($goods["standard"]); ?></p>
						</div>
						<p class="float price"><?php echo ($goods["sale_price"]); ?>元</p>
						<p class="float amount fs_14"><?php echo ($goods["num"]); ?></p><?php endforeach; endif; ?>
						<p class="float status">
							<span style="margin-top: 20px"><?php echo ($order["status_name"]); ?></span>

                            <?php if($order['status'] == 4): ?><span>双方已评</span><?php endif; ?>
						</p>
						<p class="float actions">
                            <?php if($order['status'] == 0): ?><a href="<?php echo U('Buy/createBuy',array('id'=>$order['id']));?>">立即付款</a>

                            <?php elseif($order['status'] == 1): ?>

                                <a href="#">再次购买</a>
                            <?php elseif($order['status'] == 2): ?>
                                <a href="#">确认收货</a>
                                <a href="#">再次购买</a>
                            <?php elseif($order['status'] == 3): ?>
                                <a href="#">立即评论</a>
                                <a href="#">再次购买</a>
                            <?php else: ?>
                                <a href="#">追加评论</a>
                                <a href="#">再次购买</a><?php endif; ?>

						</p>
						<!-- 清除浮动样式 -->
						<div class="clear"></div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
                <p class="page_nav">
                    <a <?php if($page > 1): ?>href="<?php echo U('Member/order',array('page'=>$page-1));?>"<?php endif; ?>>上一页</a>
                    |
                    <?php if(is_array($pagelist)): $i = 0; $__LIST__ = $pagelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Member/order',array('page'=>$vol));?>" <?php if($vol == $page): ?>class="current"<?php endif; ?> > <?php echo ($vol); ?></a>
                        |<?php endforeach; endif; else: echo "" ;endif; ?>
                    <a <?php if($page < $pageNum): ?>href="<?php echo U('Member/order',array('page'=>$page+1));?>"<?php endif; ?>>下一页</a>
                </p>
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