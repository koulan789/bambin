<?php

namespace Admin\Model;
use Think\Model;
class AboutModel extends Model{
    protected $_validate = array(
        array('info','require','必须有简介'),
        array('img','require','必须有缩略图'),
        array('content','require','必须有内容'),
    );

}
