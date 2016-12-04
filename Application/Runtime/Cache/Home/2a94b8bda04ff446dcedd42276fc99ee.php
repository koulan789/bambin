<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/main.css" />
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/common.css" />
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/header.css" />
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/footer.css" />
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/index.css" />
    <script type="text/javascript" src="/bambin/Application/Home/Common/scripts/jquery.js"></script>
    <script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_scrollbar.js"></script>
    <script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_slideshow.js"></script>
</head>
<body>
<!-- __头部#header -->
<div id="header" class="type2 type3">
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
    <a href="./" class="logo">
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
	<!-- __主体#content -->
	<div id="content" class="type2">
		<div class="box1 ff_simsun fs_12">
			<a href="<?php echo U('Index/about');?>"><h1 class="ff_fz fs_18">品牌介绍</h1></a>
			<img src="<?php echo ($about_list["img"]); ?>" />
			<p><?php echo ($about_list["info"]); ?></p>

			<!-- 清除浮动样式 -->
		</div>
		<div class="box2 ff_simsun fs_12">
			<h1 class="ff_fz fs_18">产品推荐</h1>
			<div class="slideshow">
				<div class="wrapper">
					<ul class="image plain">
						<?php if(is_array($reco_list)): $i = 0; $__LIST__ = $reco_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li>
							<a href="<?php echo U('Goods/detail',array('id'=>$val['id']));?>"> <img src="<?php echo ($val["img_thumb"]); ?>" /></a>
                            <a href="<?php echo U('Goods/detail',array('id'=>$val['id']));?>"><h2 class="fs_12"><?php echo ($val["name"]); ?></h2></a>
							<p><?php echo ($val["info"]); ?></p>
							<!-- 清除浮动样式 -->
							<div class="clear"></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<ul class="nav">
						<li class="prev"></li>
						<li class="next"></li>
					</ul>
					<!-- 清除浮动样式 -->
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="box3 ff_simsun fs_12">
			<h1 class="ff_fz fs_18">新闻动态</h1>
			<ul class="news_list">
				<li class="more">
					<a href="<?php echo U('Index/news');?>" class="more">More&gt;&gt;</a>
				</li>
				<?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
					<a href="<?php echo U('Index/newsDetail',array('id'=>$v['id']));?>" class="entry"><?php echo ($v["title"]); ?></a>
					<span class="date"><?php echo ($v["time"]); ?></span>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
	</div>
	<!-- //主体#content -->
	<!-- __底部#footer -->
<p id="footer" class="type2 ff_simsun fs_14"><?php echo ($infor_list["copyright"]); ?><br />联系地址：<?php echo ($infor_list["address"]); ?></p>
<!-- //底部#footer -->
</body>
</html>