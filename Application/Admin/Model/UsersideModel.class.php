<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-1-26
 * Time: 上午9:59
 * To change this template use File | Settings | File Templates.
 */

namespace Admin\Model;


use Think\Model;

class UsersideModel extends Model{
    protected $_validate = array(
       array('name','require','导航名已存在',1,'unique',3),
       array('pid','/^\d+$/','上级id为数字',0,'regex',3),
       array('sort','/^\d{1,3}$/','排序为数字',0,'regex',3),
    );
    /*
     * 查询用户中心侧边栏导航  默认pid为0 查询顶级
     */
    public function userside($pid = 0){
        $userside = M('userside');
        $list = $userside->where('pid='.$pid)->select();
        return $list;
    }
}