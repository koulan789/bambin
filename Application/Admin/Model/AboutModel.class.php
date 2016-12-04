<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-1-22
 * Time: 下午2:04
 * To change this template use File | Settings | File Templates.
 */
namespace Admin\Model;
use Think\Model;
class AboutModel extends Model{
    protected $_validate = array(
        array('info','require','必须有简介'),
        array('img','require','必须有缩略图'),
        array('content','require','必须有内容'),
    );

}