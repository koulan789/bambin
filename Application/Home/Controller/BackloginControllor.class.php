<?php

namespace Home\Controller;


use Think\Controller;

class BackloginControllor extends Controller{
    public function __construct(){
        parent::__construct();
        if(session('?user')){
            header('content-type:text/html; charset=utf-8');
            $nav = D('Nav');  //实例化Nav模板
            $head_nav = $nav->nav_list(); //查询顶部导航
            $infor_list = $nav->foot_list(); //查询尾部信息
            $this->assign('user',session('user'));
            $this->assign('head_nav',$head_nav);
            $this->assign('infor_list',$infor_list);
        }else{
            $this->error('您还没有登录，请先登录',U('User/login'));
        }
    }
}