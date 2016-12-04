<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-1-28
 * Time: 下午3:08
 * To change this template use File | Settings | File Templates.
 */

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