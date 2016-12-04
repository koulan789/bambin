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

	<link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/member.css" />
	<script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_sidebar_toggle.js"></script>
	<script type="text/javascript" src="/bambin/Application/Home/Common/scripts/page_member.js"></script>

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
			<div class="main_text ff_simsun fs_12">
				<p class="current_location ff_fz fs_14">
					当前位置：
					<a  class="current">会员中心</a>
				</p>
				<h1 class="headline type2 ff_yh fs_18">会员中心</h1>
				<h2 class="headline type3 user ff_fz fs_14">个人资料</h2>
				<div class="info_box">
					<img src="/bambin/Application/Home/Common/images/icons/login_avatar.jpg" class="img" />
					<p class="info username ff_fz fs_18">
						用户名：
						<span class="ff_yh"><?php echo ($user["name"]); ?></span>
					</p>
					<a href="<?php echo U('Member/my');?>" class="action">完善个人资料</a>
					<p class="info level ff_yh fs_12">
						会员等级：<span>SVIP7</span>
					</p>
					<a href="<?php echo U('Member/address');?>" class="action">管理收货地址</a>
					<a href="<?php echo U('Member/order');?>" class="info view_record">查看购物记录</a>
					<a href="<?php echo U('Member/changePwd');?>" class="action">修改密码</a>
					<!-- 清除浮动样式 -->
					<div class="clear"></div>
					<a href="#" class="change_avatar">更换头像</a>
					<p class="messages">
						您的信息不完整！[<a href="<?php echo U('Member/my');?>">请填写资料</a>]
						<a href="javascript:void(0);" class="hide_this">隐藏显示</a>
					</p>
					<!-- 清除浮动样式 -->
					<div class="clear"></div>
				</div>
                <?php if($trends): ?><ul class="list_box">
					<li class="headline type3 ff_fz fs_14">我的动态</li>
					<li class="entry">
						<a href="product_detail.html">Bambin婴儿舒眠沐浴露</a>
						<span class="date">2015-9-16</span>
						<span class="time">9:00</span>
						<!-- 清除浮动样式 -->
						<div class="clear"></div>
					</li>
					<li class="more">
						<a href="product.html">&gt;&gt;随便看看...</a>
					</li>
				</ul><?php endif; ?>
                <?php if($collect): ?><ul class="list_box">
					<li class="headline type3 ff_fz fs_14">我的收藏</li>
                    <?php if(is_array($collect)): $i = 0; $__LIST__ = $collect;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="entry">
						<a href="<?php echo U('Goods/detail',array('id'=>$vo['goods_id']));?>"><?php echo ($vo["name"]); ?></a>
						<span class="date"><?php echo (date('Y-m-d',$vo["time"])); ?></span>
						<span class="time"><?php echo (date('H:i:s',$vo["time"])); ?></span>
						<!-- 清除浮动样式 -->
						<div class="clear"></div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
					<li class="more">
						<a href="<?php echo U('Member/collect');?>">&gt;&gt;管理...</a>
					</li>
				</ul><?php endif; ?>
                <?php if($like): ?><h2 class="headline type3 ff_fz fs_14">我喜欢的</h2>
				<ul class="favorite_list plain">
					<li>
						<img src="../images/imgs/favorite_product_img.jpg" />
						<a href="product_detail.html" class="name">Bambin婴儿舒眠沐浴露</a>
						<p class="price">
							￥15.0
							<a href="product_detail.html">购买&gt;&gt;</a>
						</p>
					</li>
					<li>
						<img src="../images/imgs/favorite_product_img.jpg" />
						<a href="product_detail.html" class="name">Bambin婴儿舒眠沐浴露</a>
						<p class="price">
							￥15.0
							<a href="product_detail.html">购买&gt;&gt;</a>
						</p>
					</li>
					<li>
						<img src="../images/imgs/favorite_product_img.jpg" />
						<a href="product_detail.html" class="name">Bambin婴儿舒眠沐浴露</a>
						<p class="price">
							￥15.0
							<a href="product_detail.html">购买&gt;&gt;</a>
						</p>
					</li>
					<li>
						<img src="../images/imgs/favorite_product_img.jpg" />
						<a href="product_detail.html" class="name">Bambin婴儿舒眠沐浴露</a>
						<p class="price">
							￥15.0
							<a href="product_detail.html">购买&gt;&gt;</a>
						</p>
					</li>
				</ul><?php endif; ?>
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