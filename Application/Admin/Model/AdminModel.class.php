<?php


namespace Admin\Model;


use Think\Model;

class AdminModel extends Model{
    /*
     * 自动验证数据
     */
    protected $_validate = array(
        array('name','require','管理员名不能重复',1,'unique'),
        array('repwd','pwd','两次密码输入要一致',0,'confirm'),
    );
    /*
     * 角色选择时查询角色
     */
    public function power_list(){
        $power = M('power');
        $list = $power->field('id,powername')->select();
        return $list;
    }
}
