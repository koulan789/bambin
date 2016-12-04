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
class RecommendModel extends Model{
    /*
     * 自动验证
     */
    protected $_validate = array(
        array('goods_id','require','该产品已添加','1','unique','3'),
        array('sort','/^\d+$/','排序必须为数字','0','regex','3'),
    );
    /*
     * 查询推荐产品下拉框数据
     */
    public function goods_list(){
        $goods =M('goods');
        $list =$goods->field('id,name')->where('is_show=1')->select();
        return $list;
    }
}