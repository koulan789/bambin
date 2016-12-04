<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-2-29
 * Time: 下午12:52
 * To change this template use File | Settings | File Templates.
 */

namespace Admin\Controller;


class UserController extends BackController{
    public function index(){
        $user = D('UserView');
        $this->display();
    }
}