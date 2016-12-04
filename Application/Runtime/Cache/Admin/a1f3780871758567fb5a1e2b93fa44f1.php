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
        <li>用户中心导航管理</li>
        <li>></li>
        <li>修改导航</li>
    </ul>
</div>
<form action="<?php echo U('Userside/update');?>" method="post" class="definewidth m20" onsubmit="return check_form()">
    <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>"/>
<table class="table table-bordered table-hover m10">
    <tr>
        <td class="tableleft">上级导航</td>
        <td>
            <select name="pid">
                <option value=0>本身作为顶级</option>
                <?php if(is_array($side)): $i = 0; $__LIST__ = $side;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['id'] == $data['pid']): ?><option value=<?php echo ($vo["id"]); ?> selected><?php echo ($vo["name"]); ?></option>
                    <?php else: ?>
                    <option value=<?php echo ($vo["id"]); ?>><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="tableleft" width="20%">导航名</td>
        <td><input type="text" name="name" id="name" value="<?php echo ($data["name"]); ?>"/></td>
    </tr>
    <tr>
        <td class="tableleft">链接地址</td>
        <td>
            <input type="text" name="url" id="url" value="<?php echo ($data["url"]); ?>" />
    </tr>
    <tr>
        <td class="tableleft">排序</td>
        <td>
            <input type="text" name="sort" value="<?php echo ($data["sort"]); ?>" id="sort"  />  输入1-100的数字
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
    function check_form(){
        var name=$('#name').val();
        if($.trim(name)==''){
          alert('请输入导航名');
            return false;
        }
        var sort=$('#sort').val();
        var check1 =/^\d{1,3}$/;   //正则
        if(check1.test($.trim(sort))==false || parseInt(sort)>100||parseInt(sort)<1){
           alert("请输入1-100的数字");
            return false;
        }
    }

</script>