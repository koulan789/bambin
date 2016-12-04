<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Admin/Common/css/bootstrap.css" />
    <script type="text/javascript" src="/bambin/Application/Admin/Common/js/jquery-1.8.3.min.js"></script>
    <style type="text/css">
        body {
            padding: 10px;
            padding-top:0px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }
        th,td{ text-align: center !important;}
        .right-nav{height:50px;border-bottom:1px solid #d1d1d1;background:#f6f6f6; margin: -10px -20px 10px -10px;}
        .right-nav li{float:left;margin-left:5px;line-height:50px;color:#464646;font-size: 14px; list-style: none; color:#464646;}
     </style>
</head>
<body>
<div class="right-nav">
    <ul>

        <li style="margin-left:25px;">您当前的位置：</li>
        <li>产品管理</li>
        <li>></li>
        <li>产品列表</li>
    </ul>
</div>
<form class="form-inline definewidth m20" action="<?php echo U('Goods/index');?>" method="post">
    产品名称：
    <input type="text" name="name" id="rolename" class="abc input-default" placeholder="输入产品名" />&nbsp;&nbsp;
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; <button type="button" class="btn btn-success" id="addnew">新增产品</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th width="10%">产品名</th>
        <th width="20%">产品全称</th>
        <th width="10%">缩略图</th>
        <th width="10%">价格</th>
        <th width="10%">库存</th>
        <th width="10%">是否上架</th>
        <th width="10%">管理操作</th>
    </tr>
    </thead>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr id="tr<?php echo ($val["id"]); ?>">
            <td><?php echo ($val["name"]); ?></td>
             <td><?php echo ($val["name_all"]); ?></td>
            <td><img src="<?php echo ($val["img_thumb"]); ?>" width="40"/></td>
            <td><?php echo ($val["sale_price"]); ?></td>
             <td><?php echo ($val["inventory"]); ?></td>
             <td><?php echo ($val["is_show"]); ?></td>
            <td>
                  <a href="<?php echo U('goods/update',array('id'=>$val['id']));?>">编辑</a>
                  <a href="javascript:del(<?php echo ($val["id"]); ?>);">删除</a>
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<div class="inline pull-right page">
         <!--10122 条记录 1/507 页  <a href='#'>下一页</a>     <span class='current'>1</span><a href='#'>2</a>  <a href='#' >下5页</a> <a href='#' >最后一页</a>-->    </div>
</body>
</html>
<script>
		$('#addnew').click(function(){

				window.location.href="<?php echo U('Goods/add');?>";
		 });
	function del(id)
	{
		if(confirm("确定要删除吗？"))
		{
            $.post("<?php echo U('goods/del');?>",{id:id},function(data){
                   if(data==0){
                       alert('非法请求');
                   }else if(data==-1){
                       alert('删除失败');
                   }else if(data ==1){
                       alert('删除成功');
                       $('#tr'+id).remove();
                   }
            });
		}
	}
</script>