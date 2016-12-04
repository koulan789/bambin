<?php

namespace Home\Controller;

class GoodsController extends BackControllor{
    public function index(){
        $nav = D('Nav');
        $side_nav = $nav->nav_list('is_side=1');  //查询侧边导航

        $page = I('get.page',1,'int');   //接受当前页
        $goods = D('Goods');
        $perNum = 4; //每页显示商品数量
        $goods_list = $goods->goods_list($perNum,$page);   //查询上架产品列表
        $goods_count = $goods->goods_count(); //查询产品总数量
        $pageNum = ceil($goods_count/$perNum);
        $perPage = 5;  //显示页码数量
        $per = floor($perPage/2);  //显示页码偏移量
        //确定页码的首尾
        if($pageNum<$perPage){
            $firstPage=1;
            $lastPage=$pageNum;
        }else if($page<$per+1){
            $firstPage = 1;
            $lastPage = $perPage;
        }else if($page>$pageNum-$per){
            $firstPage = $pageNum-$perPage+1;
            $lastPage = $pageNum;
        }else{
            $firstPage = $page-$per;
            $lastPage = $page+$per;
        }
        $pagelist= array();
        for($i=$firstPage;$i<=$lastPage;$i++){
            $pagelist[] = $i;
        }

        $this->assign('side_nav',$side_nav);
        $this->assign('goods_list',$goods_list);
        $this->assign('page',$page);
        $this->assign('pageNum',$pageNum);
        $this->assign('pagelist',$pagelist);
        $this->display('product');
    }
    public function detail(){
        if(IS_GET){
            $id = I('get.id',0,'int');
            $goods = D('Admin/GoodsView');
            $goods_data = $goods->where('goods.id='.$id)->find(); //查询产品信息
            $goods_data['content'] = htmlspecialchars_decode($goods_data['content']);
            $region =M('region');
            $region_data = $region->where('id='.$goods_data['dc'])->field('name')->find();
            $goods_data['dc']=$region_data['name'];
            $goods_img = M('goods_img');
            $img_data =$goods_img->where('goods_id='.$id)->order('sort asc')->select(); //查询产品图集
            $nav = D('Nav');
            $side_nav = $nav->nav_list('is_side=1');  //查询侧边导航
            $recommend = D('Admin/RecommendView');
            $recommend_data = $recommend->field('goods_id,img_thumb,name')->where('is_show=1')->order('sort asc')->limit('4')->select();
            $this->assign('side_nav',$side_nav);
            $this->assign('goods_data',$goods_data);
            $this->assign('img_data',$img_data);
            $this->assign('recommend_data',$recommend_data);
            $this->display();
        }
    }
    public function buyNow(){
        if(IS_AJAX){
            if(session('?user')){
                echo 1; //登录了
            }else{
                echo -1; //没有登录
            }
        }else{
            echo 0; //非法请求
        }
    }
    public function cart(){
        if(IS_AJAX){
            if(session('?user')){
                $id = I('post.id',0,'int');
                $data['num'] = I('post.num',0,'int');
                $data['time'] = time();
                $cart = M('cart');
                $old_cart = $cart->where('goods_id='.$id.' and user_id='.session('user.id'))->find();
                if($old_cart){
                    $data['num'] += $old_cart['num'];
                    $rel = $cart->where('id='.$old_cart['id'])->save($data);
                    if($rel !== false){
                        echo 2;  //添加购物车成功
                    }else{
                        echo -2; //添加购物车失败
                    }
                }else{
                    $data['goods_id'] = $id;
                    $data['user_id'] = session('user.id');
                    if($cart->add($data)){
                        echo 2;  //添加购物车成功
                    }else{
                        echo -2; //添加购物车失败
                    }
                }
            }else{
                echo -3; //没有登录
            }
        }else{
            echo 0; //非法请求
        }
    }
}