<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-3-1
 * Time: 上午11:57
 * To change this template use File | Settings | File Templates.
 */

namespace Admin\Model;


use Think\Model\ViewModel;

class UserViewModel extends ViewModel{
    public $viewFields =  array(
        'user'=>array('id','name','pwd'),
        'user_detail'=>array('id'=>'detail_id','sex','birthday','district_id','tel','email','balance','integral','grade','head_img','_on'=>'user.id=user_detail.user_id'),
    );
}