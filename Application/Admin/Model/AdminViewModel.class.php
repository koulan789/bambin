<?php

namespace Admin\Model;

use Think\Model\ViewModel;

class AdminViewModel extends ViewModel{
    public $viewFields = array(
        'admin'=>array('id','name'), //主表
        'power'=>array('powername','_on'=>'power.id = admin.power_id'), //从表
    );
}
