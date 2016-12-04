<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-1-28
 * Time: 下午1:04
 * To change this template use File | Settings | File Templates.
 */

namespace Admin\Model;


use Think\Model\ViewModel;

class RecommendViewModel extends ViewModel{
    public $viewFields = array(
        'recommend'=>array('id','goods_id','sort'),//主表
        'goods'=>array('name','img_thumb','is_show','_on'=>'recommend.goods_id = goods.id'),  //从表
    );
}