<?php

namespace Admin\Model;

use Think\Model\ViewModel;

class UserViewModel extends ViewModel{
    public $viewFields =  array(
        'user'=>array('id','name','pwd'),
        'user_detail'=>array('id'=>'detail_id','sex','birthday','district_id','tel','email','balance','integral','grade','head_img','_on'=>'user.id=user_detail.user_id'),
    );
}
