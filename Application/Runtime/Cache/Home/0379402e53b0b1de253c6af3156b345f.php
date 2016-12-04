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

	<link rel="stylesheet" type="text/css" href="/bambin/Application/Home/Common/styles/cart.css" />
	<script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_sidebar_toggle.js"></script>
	<script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_select_all.js"></script>
	<script type="text/javascript" src="/bambin/Application/Home/Common/scripts/mod_item_calculator.js"></script>

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
					<a href="<?php echo U('Buy/cart');?>" class="current">我的购物车</a>
				</p>
				<div class="info_card">
                    <?php if($user['head_img']): ?><img src="<?php echo ($user["head_img"]); ?>" class="img" />
                    <?php else: ?>
                        <img src="/bambin/Application/Home/Common/images/icons/login_avatar.jpg" class="img" /><?php endif; ?>
					<p class="username ff_fz fs_18">
						用户名：
						<span class="ff_yh"><?php echo ($user["name"]); ?></span>
					</p>
					<p class="text">你目的是向：注册会员，积分：<?php echo ($user["integral"]); ?>分。</p>

				</div>
				<h1 class="headline type2 fs_18">我的购物车</h1>
				<form  method="post" action="<?php echo U('Buy/order');?>" onsubmit="return check_form()">
					<ul class="item_list">
						<li class="item header fs_14">
							<span class="float name">商品名称</span>
							<span class="float price">单价（元）</span>
							<span class="float amount">数量</span>
							<span class="float total">金额</span>
							<span class="float actions">交易操作</span>
							<!-- 清除浮动样式 -->
							<div class="clear"></div>
						</li>
						<li class="action">
							<!-- 全选按钮必须给定一个groupid -->
							<!-- 响应此全选按钮的复选框必须有和此groupid相同的selectid -->
							<input type="checkbox" groupid="g1" />
							<span class="fs_14">全选</span>
						</li>
                        <?php if(is_array($cart_list)): $i = 0; $__LIST__ = $cart_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cart): $mod = ($i % 2 );++$i;?><li class="entry">
                                <p class="item header fs_14">
                                    <input type="checkbox" selectid="g1" class="g1" name="cart_id[]" value="<?php echo ($cart["id"]); ?>" />
                                    <?php echo ($cart["time"]); ?>
                                    <a href="javascript:del(<?php echo ($cart["id"]); ?>);" class="delete_this"></a>
                                </p>
                                <div class="item float name ff_simsun">
                                    <img src="<?php echo ($cart["img_thumb"]); ?>" />
                                    <p class="title"><?php echo ($cart["name"]); ?></p>
                                    <p class="category">容量：<?php echo ($cart["standard"]); ?></p>
                                </div>
                                <p class="float price"><?php echo ($cart["sale_price"]); ?>元</p>
                                <p class="float amount fs_14"><input type="text" value="<?php echo ($cart["num"]); ?>" style="width:30px !important; background:#7dc9e2; margin-top: 37px " class="num" id="change<?php echo ($cart["id"]); ?>" alt="<?php echo ($cart["id"]); ?>" /></p>
                                <p class="float total" id="total<?php echo ($cart["id"]); ?>"><?php echo ($cart["one_total"]); ?>元</p>
                                <p class="float actions">
                                    <a href="javascript:del(<?php echo ($cart["id"]); ?>);" class="delete_this">删除</a>
                                    <a href="javascript:collect(<?php echo ($cart["goods_id"]); ?>);">移至收藏夹</a>
                                </p>
                                <!-- 清除浮动样式 -->
                                <div class="clear"></div>
                            </li>
                            <input type="hidden" class="invent<?php echo ($cart["id"]); ?>" value="<?php echo ($cart["inventory"]); ?>"/>
                            <input type="hidden" id="num<?php echo ($cart["id"]); ?>" value="<?php echo ($cart["num"]); ?>"/>
                            <input type="hidden" id="price<?php echo ($cart["id"]); ?>" value="<?php echo ($cart["sale_price"]); ?>"/><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<div class="checkout_box ff_yh">
						<!-- 必须要有itemnumberfield才能使数量实时更新有效 -->
						<!-- 必须要有itemtotalfield才能使总价实时更新有效 -->
						<!-- 这两个自定义属性值随意 -->
						<p class="text fs_12">
							已选
							<span class="number" itemnumberfield="true">0</span>
							件商品
						</p>
						<p class="text fs_14">
							合计（不含运费）￥
							<span class="number fs_18" itemtotalfield="true">0.00</span>
						</p>
						<input type="submit" value="结算" class="checkout ff_yh" />
					</div>
				</form>
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
            $('.num').bind('blur',function(){
                var num = $(this).val();
                var id = $(this).attr('alt');
                var invent = $('.invent'+id).val();
                var old_num = $('#num'+id).val();
                if(parseInt(num)>parseInt(invent)){
                    alert('库存不足,请重新选择数量');
                    return false;
                }else if(parseInt(num)>0 && parseInt(num)<=parseInt(invent)){
                    $.post("<?php echo U('Buy/cart_change');?>",{id:id,num:num},function(data){
                        if(data == 0){
                            alert('非法请求');
                            return false;
                        }else if(data == -1){
                            $('#change'+id).val(old_num);
                        }else if(data == 1){
                            var total = $('#price'+id).val()*num;
                            $("#total"+id).text(total+'元')
                        }
                    })
                }else{
                   alert('请输入正确的商品数量');
                    return false;
                }
            });
            function del(id){
                if(confirm('确定删除吗？')){
                    window.location.href="<?php echo U('Buy/del_cart');?>?id="+id;
                }
            }
            function collect(id){
                $.post("<?php echo U('Buy/collect');?>",{id:id},function(data){
                    if(data == 0){
                        alert('非法请求');
                    }else if(data == -2){
                        alert('收藏失败');
                    }else if(data == 2){
                        alert('收藏成功');
                    }
                })
            }
            function check_form(){
                var j = 0;
                $('.g1').each(function(i,v){
                    if($(v).is(':checked')){
                        j = 1;
                    }
                });
                if(j == 0){
                    alert('请选择结算商品');
                    return false;
                }
            }
        </script>