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

	<link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/news.css" />

	<!-- __主体#content -->
	<div id="content" class="type1">
		<div class="main">
			<ul class="sidebar type1 ff_fz fs_18">
    <?php if(is_array($side_nav)): $i = 0; $__LIST__ = $side_nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vi): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U($vi['url']);?>" <?php if(strstr($myurl,$vi['url'])): ?>class="current"<?php endif; ?>><?php echo ($vi["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    <!--<li><a href="introduction.html" class="current">品牌介绍</a></li>
    <li><a href="#">新鲜情报</a></li>
    <li><a href="#">客户服务</a></li>
    <li><a href="#">加入我们</a></li>-->

</ul>
			<div class="main_text ff_simsun fs_12">
				<p class="current_location ff_fz fs_14">
					当前位置：
					<a href="./">首页</a>
					&gt;&gt;
					<a href="<?php echo U('Index/news');?>" class="current">新闻中心</a>
				</p>
				<ul class="news_list">
                    <?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$va): $mod = ($i % 2 );++$i;?><li>
						<div class="title">
							<a href="<?php echo U('Index/newsDetail',array('id'=>$va['id']));?>" class="fs_14"><?php echo ($va["title"]); ?></a>
							<span class="date fs_10">[<?php echo ($va["time"]); ?>]</span>
							<!-- 清除浮动样式 -->
							<div class="clear"></div>
						</div>
						<p class="summary"><?php echo ($va["info"]); ?></p>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>

				</ul>
				<p class="page_nav">
					<a <?php if($page > 1): ?>href="<?php echo U('Index/news',array('page'=>$page-1));?>"<?php endif; ?>>上一页</a>
					|
                    <?php if(is_array($pagelist)): $i = 0; $__LIST__ = $pagelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Index/news',array('page'=>$vol));?>" <?php if($vol == $page): ?>class="current"<?php endif; ?> > <?php echo ($vol); ?></a>
                        |<?php endforeach; endif; else: echo "" ;endif; ?>
                    <a <?php if($page < $pageNum): ?>href="<?php echo U('Index/news',array('page'=>$page+1));?>"<?php endif; ?>>下一页</a>
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