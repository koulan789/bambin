<?php


namespace Admin\Controller;


use Think\Controller;

class BackController extends Controller{
    public function __construct(){
        parent::__construct();
        header('content-type:text/html; charset=utf-8');
        if(!session('?admin')){
            $this->error('你还没有登录，请先登录',U('Index/index'));
            exit;
        }
    }
}
