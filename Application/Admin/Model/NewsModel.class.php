<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-1-29
 * Time: 下午3:56
 * To change this template use File | Settings | File Templates.
 */

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