<?php


namespace Home\Model;


use Think\Model;

class GoodsModel extends Model{
    public function goods_list($perNum,$page =1){  //查询上架产品列表
        $goods = M('goods');
        $goods_list = $goods->where('is_show=1')->field('id,img_thumb,name,sale_price,standard,effect,info')->page($page.','.$perNum)->order('id desc')->select();
        return $goods_list;
    }
    public function goods_count(){  //查询上架产品数量
        $goods = M('goods');
        $num = $goods->where('is_show=1')->count();
        return $num;
    }
}