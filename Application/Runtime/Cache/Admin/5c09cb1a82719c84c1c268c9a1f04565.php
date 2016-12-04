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

        .right-nav{height:50px;border-bottom:1px solid #d1d1d1;background:#f6f6f6; margin: -10px -20px 10px -10px;}
        .right-nav li{float:left;margin-left:5px;line-height:50px;color:#464646;font-size: 14px; list-style: none; color:#464646;}
    </style>

</head>
<body>
<div class="right-nav">
    <ul>

        <li style="margin-left:25px;">您当前的位置：</li>
        <li>基本设置</li>
        <li>></li>
        <li>基本设置</li>
    </ul>
</div>
<form action="<?php echo U('index/update');?>" method="post" class="definewidth m20" onsubmit="return check_form()">
    <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />
<table class="table table-bordered table-hover m10">

    <tr>
        <td class="tableleft" width="20%">公司地址</td>
        <td>
            <textarea  name="address" id="address" style="width:600px; height:30px; resize:none"><?php echo ($data["address"]); ?></textarea>
        </td>
    </tr>
    <tr>
        <td class="tableleft">邮政编码</td>
        <td><input type="text" name="postcode" id="postcode" value="<?php echo ($data["postcode"]); ?>"/></td>
    </tr>
    <tr>
        <td class="tableleft">全国免费热线</td>
        <td><input type="text" name="hotline" id="hotline" value="<?php echo ($data["hotline"]); ?>"/></td>
    </tr>
    <tr>
        <td class="tableleft">电话</td>
        <td><input type="text" name="tel" id="tel" value="<?php echo ($data["tel"]); ?>"/></td>
    </tr>
    <tr>
        <td class="tableleft">传真</td>
        <td><input type="text" name="fax" id="fax" value="<?php echo ($data["fax"]); ?>"/></td>
    </tr>
    <tr>
        <td class="tableleft">邮箱</td>
        <td>
            <input type="text" name="email"  id="email" value="<?php echo ($data["email"]); ?>"  />  </td>
    </tr>
    <tr>
        <td class="tableleft">公司官网</td>
        <td>
            <input type="text" name="url"  id="url" value="<?php echo ($data["url"]); ?>"  />  </td>
    </tr>
    <tr>
        <td class="tableleft">版权</td>
        <td><textarea  name="copyright" id="copyright" style="width:600px; height:30px; resize:none"><?php echo ($data["copyright"]); ?></textarea></td>
    </tr>

    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary">保存</button> &nbsp;&nbsp;</td>
    </tr>
</table>
</form>
</body>
</html>