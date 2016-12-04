<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-1-27
 * Time: 上午11:50
 * To change this template use File | Settings | File Templates.
 */

namespace Admin\Model;


use Think\Model;

class GoodsModel extends Model{
    public $_validate = array(
        array('name','require','产品名必须存在并且不能重复',1,'unique',3),
    );

}