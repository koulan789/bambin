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

	<link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/product_detail.css" />
	<script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_slideshow.js"></script>
	<script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_number.js"></script>

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
					<a href="<?php echo U('Index/index');?>">首页</a>
					&gt;&gt;
					<a href="<?php echo U('Goods/index');?>" class="current">产品中心</a>
				</p>
				<div class="detail">
					<span class="border_top"></span>
					<div class="detail_text">
						<div class="slideshow">
							<div class="wrapper">
								<ul class="image plain">
									<?php if(is_array($img_data)): $i = 0; $__LIST__ = $img_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><li>
											<img src="<?php echo ($img["img"]); ?>" />
										</li><?php endforeach; endif; else: echo "" ;endif; ?>

								</ul>
							</div>
							<ul class="nav">
								<li class="prev"></li>
								<li class="next"></li>
							</ul>
						</div>
						<p class="name ff_yh fs_14"><?php if($goods_data['name_all']): echo ($goods_data["name_all"]); else: echo ($goods_data["name"]); endif; ?></p>
						<p class="tags">限时特价销售 保证正品 支持鉴定</p>
						<p class="price">
							价格
							<span class="ff_yh">￥<?php echo ($goods_data["sale_price"]); ?></span>
						</p>
						<p class="purchase_text">
							配送:
							<span class="customize_select" style="background: none !important">
								<?php echo ($goods_data["dc"]); ?>配送
							</span>
							快递：<?php if($goods_data['send_price'] != 0.00 ): echo ($goods_data["send_price"]); ?>元<?php else: ?>免运费<?php endif; ?>
						</p>
						<div class="purchase_text">
							数量：
							<span class="num_box">
								<ul class="buttons" id="num_button">
									<li class="minus"></li>
									<li class="add"></li>
								</ul>
								<input type="text" id="num" />
							</span>
                            库存：（<?php echo ($goods_data["inventory"]); ?>）
						</div>
						<input type="button" value="立即购买" class="buy button ff_fz fs_20" id="buy_now" />
						<input type="button" value="加入购物车" id="cart" class="add_to_cart button ff_fz fs_20" />
						<!-- 清除浮动样式 -->
						<div class="clear"></div>
					</div>
					<span class="border_bottom"></span>
				</div>
				<p class="description"><?php echo ($goods_data["content"]); ?></p>
				<h1 class="recommend headline type1 ff_yh fs_18">
					<span>产品推荐</span>
				</h1>
				<ul class="recommend_list plain">
                    <?php if(is_array($recommend_data)): $i = 0; $__LIST__ = $recommend_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$recommend): $mod = ($i % 2 );++$i;?><li>
                            <img src="<?php echo ($recommend["img_thumb"]); ?>" />
                            <p class="bubble_top"></p>
                            <a href="<?php echo U('Goods/detail',array('id'=>$recommend['goods_id']));?>" class="text"><?php echo ($recommend["name"]); ?></a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>

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
            $max_num = <?php echo ($goods_data["inventory"]); ?>;
            $id = <?php echo ($goods_data["id"]); ?>;
            $('#num').change(function(){
                $num= $('#num').val();
                if($num>$max_num){
                    alert('库存不足');
                }
            });
            $('#buy_now').click(function(){   //点击立即购买
                $num= $('#num').val();
                if($num>$max_num){
                    alert('库存不足');
                }else{
                        $.post("<?php echo U('Goods/buyNow');?>",function(data){
                        if(data == 0){
                            alert('非法请求');
                        }else if(data == -1){
                            alert('您还没有登录，请先登录');
                            window.location.href="<?php echo U('User/login');?>";
                        }else if(data ==1){
                            window.location.href="<?php echo U('Buy/buyNow');?>&id="+$id+"&num="+$num;
                        }
                    })
                }
            });
            $('#cart').click(function(){
               var num= $('#num').val();
                if(num>$max_num){
                    alert('库存不足');
                }else{
                    $.post("<?php echo U('Goods/cart');?>",{id:$id,num:num},function(data){
                        if(data == 0){
                            alert('非法请求');
                        }else if(data == -3){
                            alert('您还没有登录，请先登录');
                            window.location.href="<?php echo U('User/login');?>";
                        }else if(data == -2){
                            alert('添加购物车失败');
                        }else if(data == 2){
                            alert('添加购物车成功');
                        }
                    })
                }
            });
        </script>