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
        <li>订单管理</li>
    </ul>
</div>
<form class="form-inline definewidth m20" action="<?php echo U('Order/index');?>" method="post">
    订单号：
    <input type="text" name="order_num" id="rolename" class="abc input-default" placeholder="输入订单号" />&nbsp;&nbsp;
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; <button type="button" class="btn btn-success" id="put_out">订单导出</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th width="5%">全选<input id="choose" type="checkbox" /></th>
        <th width="20%">订单号</th>
        <th width="20%">产品清单</th>
        <th width="20%">收货人信息</th>
        <th width="10%">总价</th>
        <th width="10%">运费</th>
        <th width="5%">保险</th>
        <th width="10%">管理操作</th>
    </tr>
    </thead>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr id="tr<?php echo ($val["id"]); ?>">
             <th width="5%"><input class="choose" type="checkbox" value="<?php echo ($val["id"]); ?>" /></th>
             <td><?php echo ($val["order_num"]); ?></td>
             <td><?php echo ($val["goods_list"]); ?></td>
            <td><?php echo ($val["address_list"]); ?></td>
             <td><?php echo ($val["total_price"]); ?></td>
             <td><?php echo ($val["send"]); ?></td>
             <td><?php echo ($val["insure"]); ?></td>
            <td>
                  <a href="<?php echo U('Order/update',array('id'=>$val['id']));?>">编辑</a>
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<form method="get" action="<?php echo U('Order/put_out');?>" id="order">
    <input type="text" value="" name="id_str" id="putOut"/>
</form>

<div class="inline pull-right page">
         <!--10122 条记录 1/507 页  <a href='#'>下一页</a>     <span class='current'>1</span><a href='#'>2</a>  <a href='#' >下5页</a> <a href='#' >最后一页</a>-->    </div>
</body>
</html>
<script>
    $("#choose").click(function(){
        if($("#choose").is(':checked') == true){
            $('.choose').attr('checked','checked');
        }else{
            $('.choose').attr('checked',false);
        }
    });

    $('#put_out').click(function(){
        var all = $('.choose:checked');
        if(all.length != 0){
            var id_str = '';
            all.each(function(k,v){
                id_str+=$(v).val()+',';
            });
            $('#putOut').val(id_str);
            //$('#order').submit();
            window.location.href="<?php echo U('Order/put_out');?>&id_str="+id_str;
        }else{
            alert('请选择需要导出的订单');
        }
    });
</script>