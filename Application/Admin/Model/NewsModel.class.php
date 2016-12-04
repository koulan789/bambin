<?php

namespace Admin\Model;


use Think\Model;

class NewsModel extends Model{
    /*
     * 自动验证数据
     */
    protected $_validate = array(
        array('title','require','新闻标题不能重复',1,'unique'),
    );

}
