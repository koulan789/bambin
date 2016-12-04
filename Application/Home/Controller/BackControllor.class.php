<?php


namespace Home\Controller;


use Think\Controller;

class BackControllor extends Controller{
    public function __construct(){
        parent::__construct();
        header('content-type:text/html; charset=utf-8');
        $nav = D('Nav');  //实例化Nav模板
        $head_nav = $nav->nav_list(); //查询顶部导航
        $infor_list = $nav->foot_list(); //查询尾部信息
        if(session('?user')){
            $this->assign('user',session('user'));
        }
        $this->assign('myurl',$_SERVER['PHP_SELF']);
        $this->assign('head_nav',$head_nav);
        $this->assign('infor_list',$infor_list);
    }
}