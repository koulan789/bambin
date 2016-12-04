<?php

namespace Home\Model;
use Think\Model;

class NavModel extends Model{
    public function nav_list($where='is_head=1'){
        $nav = M('nav');  //实例化导航表
        $nav_list = $nav->where($where)->field('name,url')->order('sort asc')->select(); //查询顶部导航
        return $nav_list;
    }
    public function foot_list(){
        $myinfor = M('myinfor');
        $infor_list = $myinfor->where('id=1')->field('copyright,address')->find(); //查询尾部信息
        return $infor_list;
    }
}