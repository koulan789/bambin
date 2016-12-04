<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-1-29
 * Time: 上午10:38
 * To change this template use File | Settings | File Templates.
 */

namespace Admin\Model;


use Think\Model\ViewModel;

class AdminViewModel extends ViewModel{
    public $viewFields = array(
        'admin'=>array('id','name'), //主表
        'power'=>array('powername','_on'=>'power.id = admin.power_id'), //从表
    );
}