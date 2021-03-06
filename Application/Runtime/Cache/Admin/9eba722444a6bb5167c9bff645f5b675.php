<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/bambin/Application/Admin/Common/css/bootstrap.css" />
    <link rel="stylesheet" href="/bambin/Application/Admin/Common/kindeditor/themes/default/default.css" />
    <script type="text/javascript" src="/bambin/Application/Admin/Common/js/jquery-1.8.3.min.js"></script>
    <script src="/bambin/Application/Admin/Common/kindeditor/kindeditor.js"></script>
    <script src="/bambin/Application/Admin/Common/kindeditor/lang/zh_CN.js"></script>
    <!--
    必须引入jquery,后面的循环和赋值需要用到
    1.循环上传按钮、
    2.每个上传按钮的点击事件
    建议点击按钮的class有upload_img
    注意：点击按钮之前要用一个input来存放文件的路径
        input之前需要一个img来显示图片
    -->

    <script>
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="content"]', {
                allowFileManager : true
            });
        });
    </script>
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

        .right-nav{height:50px;border-bottom:1px solid #d1d1d1;background:#f6f6f6; margin: -10px -20px 10px -10px;}
        .right-nav li{float:left;margin-left:5px;line-height:50px;color:#464646;font-size: 14px; list-style: none; color:#464646;}
        #img div{margin-bottom: 5px;}
    </style>

</head>
<body>
<div class="right-nav">
    <ul>

        <li style="margin-left:25px;">您当前的位置：</li>
        <li>订单管理</li>
        <li>></li>
        <li>修改订单</li>
    </ul>
</div>
<form action="<?php echo U('Order/update');?>" method="post" class="definewidth m20" >
    <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />
<table class="table table-bordered table-hover m10">
    <tr>
        <td class="tableleft" width="20%">订单编号</td>
        <td><input id="title" type="text" name="order_num" value="<?php echo ($data["order_num"]); ?>" readonly /></td>
    </tr>
    <tr>
        <td class="tableleft">产品清单</td>
        <td>
            <textarea style="width: 300px; height: 80px;"  readonly><?php echo ($data["goods_list"]); ?></textarea>
         </td>
    </tr>
    <tr>
        <td class="tableleft">收货人信息</td>
        <td>
            <textarea style="width: 300px; height: 80px;"  readonly><?php echo ($data["address_list"]); ?></textarea>
        </td>
    </tr>
    <tr>
        <td class="tableleft">总价</td>
        <td>
            <input  type="text" name="total_price"  value="<?php echo ($data["total_price"]); ?>" />
        </td>
    </tr>
    <tr>
        <td class="tableleft">运费</td>
        <td>
            <input  type="text" name="send" value="<?php echo ($data["send"]); ?>" />
        </td>
    </tr>
    <tr>
        <td class="tableleft">保险费</td>
        <td>
            <input  type="text" name="insure" value="<?php echo ($data["insure"]); ?>" />
        </td>
    </tr>

    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid" onclick="window.history.back(-1);">返回列表</button>
        </td>
    </tr>
</table>
</form>
</body>
</html>
<script>

</script>