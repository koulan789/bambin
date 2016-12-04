<?php

namespace Admin\Model;

use Think\Model;

class PowerModel extends Model{
    /*
     * 自动验证数据
     */
    protected $_validate = array(
        array('powername','require','角色名不能重复',0,'unique'),
    );
}
