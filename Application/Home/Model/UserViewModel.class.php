<?php

namespace Home\Model;


use Think\Model\ViewModel;

class UserViewModel extends ViewModel{
    public $viewFields = array(
        'user'=>array('id','name'),
        'user_detail'=>array('head_img','integral','_on'=>'user.id = user_detail.user_id'),
    );
}