<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-1-29
 * Time: 下午4:38
 * To change this template use File | Settings | File Templates.
 */

namespace Admin\Model;


use Think\Model\ViewModel;

class NewsViewModel extends ViewModel{
    /*
     * 新闻关联查询
     */
    public $viewFields = array(
        'news'=>array('id','title','writer','time','is_top','info'), //主表
        'news_detail'=>array('content','_on'=>'news_detail.news_id = news.id'), //从表  新闻详情表
    );
}