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
        function readys(){
            KindEditor.ready(function(K) {
                var editor = K.editor({
                    allowFileManager : true
                });
                $(".upload_img").each(function(k,v){ //循环上传按钮、
                    $(v).click(function(){ //每个上传按钮的点击事件
                        editor.loadPlugin('image', function() {
                            editor.plugin.imageDialog({
                                imageUrl:$(v).prev().val(),
                                clickFn : function(url, title, width, height, border, align) {
                                    $(v).prev().val(url); //为他之前的input赋值
                                    $(v).prev().prev().attr("src",url); //为他之前的之前的img赋值
                                    editor.hideDialog();
                                }
                            });
                        });
                    });
                })
            });
        }
        readys();
    </script>
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
        <li>产品管理</li>
        <li>></li>
        <li>添加产品</li>
    </ul>
</div>
<form action="<?php echo U('Goods/add');?>" method="post" class="definewidth m20" onsubmit="return check_form()">
<table class="table table-bordered table-hover m10">

    <tr>
        <td class="tableleft" width="20%">产品名</td>
        <td><input id="name" type="text" name="name"/></td>
    </tr>
    <tr>
        <td class="tableleft">产品全称</td>
        <td><input type="text" name="name_all" id="name_all" style="width: 300px !important;"/></td>
    </tr>
    <tr>
        <td class="tableleft">缩略图</td>
        <td>
            <img src="" style="max-width:60px;" />
            <input type="hidden" name="img_thumb" id="img_thumb" value="" />
            <input type="button" class="upload_img" value="选择图片" />
         </td>
    </tr>
    <tr>
        <td class="tableleft">售价</td>
        <td>
            ￥<input type="text" name="sale_price" id="sale_price" style="width:50px !important;" /> 元
        </td>
    </tr>
    <tr>
        <td class="tableleft">容量</td>
        <td><input type="text" name="standard" /></td>
    </tr>
    <tr>
        <td class="tableleft">功效</td>
        <td><input type="text" name="effect" id="effect" style="width: 300px !important;" /></td>
    </tr>
    <tr>
        <td class="tableleft">库存</td>
        <td><input type="text" name="inventory" id="inventory" style="width: 30px !important;"/> 件</td>
    </tr>
    <tr>
        <td class="tableleft">配送地址</td>
        <td>
            <select name="dc">
                <?php if(is_array($region_data)): $i = 0; $__LIST__ = $region_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$region): $mod = ($i % 2 );++$i;?><option value="<?php echo ($region["id"]); ?>"><?php echo ($region["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

            </select>配送
        </td>
    </tr>
    <tr>
        <td class="tableleft">运费</td>
        <td><input type="text" name="send_price" id="send_price" style="width: 50px !important;"/> 元</td>
    </tr>
    <tr>
        <td class="tableleft">是否上架</td>
        <td>
            <input type="radio" name="is_show" value="1" checked /> 是
            <input type="radio" name="is_show" value="0" /> 否
        </td>
    </tr>
    <tr>
        <td class="tableleft">图集</td>
        <td id="img">
            <div>
                <img src="" style="max-width:60px;"/>
                <input type="hidden" name="img[]" value=""/>
                <input type="button" class="upload_img" value="选择图片" />
                排序：<input type="text" name="sort[]" value="1" style="width: 30px !important;" />
            </div>
            <input type="button" value="继续添加" id="ToMore" />
        </td>
    </tr>
    <tr>
        <td class="tableleft">产品简介</td>
        <td>
            <textarea name="info" id="info" style="width: 400px; height: 80px; resize: none;"></textarea>
        </td>
    </tr>
    <tr>
        <td class="tableleft">产品详情</td>
        <td>
            <textarea name="content" style="width:800px;height:400px;visibility:hidden;"></textarea>
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
    function check_form(){
        var name=$('#name').val();
        if($.trim(name)==''){
            alert('请输入产品名');
            return false;
        }
        var name_all=$('#name_all').val();
        if($.trim(name_all)==''){
            alert('请输入产品全称');
            return false;
        }
        var img_thumb=$('#img_thumb').val();
        if($.trim(img_thumb)==''){
            alert('请选择缩略图');
            return false;
        }
        var effect=$('#effect').val();
        if($.trim(effect)==''){
            alert('请输入功效');
            return false;
        }
        var inventory=$('#inventory').val();
        if($.trim(inventory)==''){
            alert('请输入库存');
            return false;
        }
        var img=$('#img div').first().children('input[type="hidden"]').val();
        if($.trim(img)==''){
            alert('请选择图集图片');
            return false;
        }
        var info=$('#info').val();
        if($.trim(info)==''){
            alert('请输入产品简介');
            return false;
        }
        if(editor.isEmpty()){
            alert('请输入产品详情');
            return false;
        }
    }
</script>
<script>
   var img_str ='<div><img src="" style="max-width:60px;"/> <input type="hidden" name="img[]" value=""/> <input type="button" class="upload_img" value="选择图片" />    排序：<input type="text" value="1" name="sort[]" style="width: 30px !important;" /> <input type="button" value="删除" class="del" /></div>';
    $('#ToMore').click(function(){
        var img = $('#img div').last().children('img').attr('src');
        if($.trim(img) != ''){
            $(this).before(img_str);
            readys();
        }
    });
    $('.del').live('click',function(){
        $(this).parent().remove();
    });
</script>