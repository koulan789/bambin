<?php


namespace Home\Model;


use Think\Model\ViewModel;

class CartViewModel extends ViewModel{
    public $viewFields = array(  //购物车查询关联goods表
        'cart'=>array('id','goods_id','num','time'),
        'goods'=>array('img_thumb','name','standard','sale_price','inventory','_on'=>'cart.goods_id=goods.id'),
        'goods_detail'=>array('send_price','_on'=>'goods_detail.goods_id = cart.goods_id'),
    );
}