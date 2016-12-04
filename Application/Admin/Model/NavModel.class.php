<?php

namespace Admin\Model;
use Think\Model;
class NavModel extends Model{
    protected $_validate = array(
        array('name','','导航名已存在',1,'unique',3),
        array('is_head','0,1','只能是0或1',1,'in',3),
        array('is_top','0,1','只能是0或1',1,'in',3),
        array('is_side','0,1','只能是0或1',1,'in',3),
        array('sort','/^\d+$/','必须是数字',1,'regex',3),
    );

    public function nav_list($where =1){
        $nav = M('nav');
        $list = $nav->where($where)->select();
        foreach($list as $key=>$val){
            $list[$key]['is_top'] = ($val['is_top']==1)?'是':'否';
            $list[$key]['is_head'] = ($val['is_head']==1)?'是':'否';
            $list[$key]['is_side'] = ($val['is_side']==1)?'是':'否';
        }
        return $list;
    }
}
