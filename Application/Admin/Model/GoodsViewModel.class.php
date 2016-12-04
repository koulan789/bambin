<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-1-26
 * Time: 下午5:02
 * To change this template use File | Settings | File Templates.
 */

namespace Admin\Model;


use Think\Model\ViewModel;

class GoodsViewModel extends ViewModel{
    public  $viewFields = array(
        'goods'=>array('id','name','img_thumb','sale_price','standard','effect','info','inventory','is_show'),//主表
         'goods_detail'=>array('name_all','content','dc','send_price','_on'=>'goods_detail.goods_id=goods.id'),//从表1  产品详情表
    );
}