<?php


namespace Home\Model;
use Think\Model;

class UserModel extends Model{
    /*
     * 注册用户表数据自动验证
     */
    protected $_validate = array(
        array('name','require','用户名或手机号已存在，不能重复',1,'unique',3),
        array('pwd','/^\w{6,16}$/','密码格式不符合要求',1,'regex'),
    );
}