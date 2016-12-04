<?php

namespace Home\Model;


use Think\Model;

class UsersideModel extends Model{
    public function userside_nav($where="pid=0"){
        $userside = M('userside');
        $data = $userside->field('id,name,url')->where($where)->order('sort asc')->select();
        return $data;
    }
    public function userside_list(){
        $userside = D('Userside');
        $userside_data = $userside->userside_nav(); //查询用户中心侧边栏顶级
        foreach($userside_data as $k=>$v){
            $next_data = $userside->userside_nav('pid='.$v['id']); //查询用户中心侧边栏下级导航
            $userside_data[$k]['next'] = $next_data;
        }
        return $userside_data;
    }
}