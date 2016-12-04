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
        <li>系统管理</li>
        <li>></li>
        <li>导航管理</li>
    </ul>
</div>
<form class="form-inline definewidth m20" action="<?php echo U('Nav/index');?>" method="post">
    导航名称：
    <input type="text" name="name" id="rolename" class="abc input-default" placeholder="" value=""/>&nbsp;&nbsp;
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; <button type="button" class="btn btn-success" id="addnew">新增导航</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th width="10%">导航名</th>
        <th width="20%">链接地址</th>
        <th width="10%">头部导航</th>
        <th width="10%">顶部导航</th>
        <th width="10%">侧边导航</th>
        <th width="10%">排序</th>
        <th width="10%">管理操作</th>
    </tr>
    </thead>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr id="tr<?php echo ($val["id"]); ?>">
            <td><?php echo ($val["name"]); ?></td>
             <td><?php echo ($val["url"]); ?></td>
            <td><?php echo ($val["is_head"]); ?></td>
            <td><?php echo ($val["is_top"]); ?></td>
             <td><?php echo ($val["is_side"]); ?></td>
             <td><?php echo ($val["sort"]); ?></td>
            <td>
                  <a href="<?php echo U('Nav/update',array('id'=>$val['id']));?>">编辑</a>
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

				window.location.href="<?php echo U('Nav/add');?>";
		 });
	function del(id)
	{
		if(confirm("确定要删除吗？"))
		{
            $.post("<?php echo U('Nav/del');?>",{id:id},function(data){
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