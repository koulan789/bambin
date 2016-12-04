<?php

namespace Admin\Model;

use Think\Model;

class GoodsModel extends Model{
    public $_validate = array(
        array('name','require','产品名必须存在并且不能重复',1,'unique',3),
    );

}
