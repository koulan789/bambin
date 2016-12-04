<?php

namespace Admin\Controller;


class UserController extends BackController{
    public function index(){
        $user = D('UserView');
        $this->display();
    }
}
