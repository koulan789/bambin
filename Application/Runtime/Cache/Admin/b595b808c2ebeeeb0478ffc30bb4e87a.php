<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台模板管理系统</title>
<link type="text/css" rel="stylesheet" href="/bambin/Application/Admin/Common/css/index.css" />
<script type="text/javascript" src="/bambin/Application/Admin/Common/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/bambin/Application/Admin/Common/js/menu.js"></script>
</head>

<body>
<div class="top"></div>
<div id="header">
	<div class="logo">Bambin后台管理系统</div>
	<div class="navigation">
		<ul>
		 	<li>欢迎您！</li>
			<li><a href=""><?php echo ($admin["name"]); ?></a></li>
			<li><a href="<?php echo U('Login/exitLogin');?>">退出</a></li>
		</ul>
	</div>
</div>
<div id="content">
	<div class="left_menu">
				<ul id="nav_dot">
      <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li>
          <h4 id="list<?php echo ($val["id"]); ?>"><span></span><?php echo ($val["name"]); ?></h4>
          <?php if(is_array($val["son"])): $i = 0; $__LIST__ = $val["son"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(in_array($vo['id'],$admin['role'])): ?><div class="list-item none" id="list<?php echo ($vo["id"]); ?>" onclick="change_con('<?php echo U($vo['href']);?>',this);">
                    <a><?php echo ($vo["name"]); ?></a>
                  </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>

  </ul>
		</div>
		<div class="m-right">
				<iframe src="<?php echo U('Index/welcome');?>" scrolling="auto" frameborder="0" style="width:100%; height: 100%; background: #fff;" id="conR"></iframe>

		</div>
</div>
<div class="bottom"></div>
<div id="footer"><p>Copyright©  2015 版权所有 京ICP备05019125号-10  </p></div>
<script>navList(12);</script>
</body>
</html>
<script>
   function change_con(url,aa){
       $('#conR').attr('src',url);
   }
</script>