<?php


namespace Home\Controller;


use Think\Model;

class BuyController extends BackloginControllor{
     public function buyNow(){
         if(IS_GET){
             $id=I('get.id',0,'int');
             $num = I('get.num',0,'int');
             $goods = D('Admin/GoodsView');
             $data = $goods->where('goods.id='.$id)->field('id,img_thumb,name,standard,sale_price,send_price')->find();
             $data['one_total'] = $data['sale_price']*$num;
             $this->assign('total',$data['one_total']);
             $this->assign('num',$num);
             $this->assign('data',$data);
             $this->display();
         }
     }
    public function cart(){
        $user = D('UserView');  //会员信息，需关联查询
        $user_data =$user->where('user.id='.session('user.id'))->find();  //查询会员相关信息
        $userside = D('Userside');
        $userside_data = $userside->userside_nav(); //查询用户中心侧边栏顶级
        foreach($userside_data as $k=>$v){
            $next_data = $userside->userside_nav('pid='.$v['id']); //查询用户中心侧边栏下级导航
            $userside_data[$k]['next'] = $next_data;
        }
        $cart = D('CartView');  //关联查询购物车商品信息
        $cart_list = $cart->where('user_id='.session('user.id'))->select();
        foreach($cart_list as $key=>$val){
            $cart_list[$key]['time'] = date('Y-m-d',$val['time']);
            $cart_list[$key]['one_total'] = $val['sale_price']*$val['num'];
        }
        $this->assign('cart_list',$cart_list);
        $this->assign('userside',$userside_data);
        $this->assign('user',$user_data);
        $this->display();
    }
    public function cart_change(){
        if(IS_AJAX){
            $id = I('post.id',0,'int');
            $data['num'] = I('post.num',0,'int');
            $cart = M('cart');
            if($cart->where('id='.$id)->save($data) !== false){   //修改商品数量
                echo 1; die; //修改数量成功
            }else{
                echo -1; die;  //修改数量失败
            }
        }else{
            echo 0; die; //非法请求
        }
    }
    public function del_cart(){
        $id = I('get.id',0,'int');
        $cart = M('cart');
        if($cart->where('id='.$id)->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
    public function collect(){
        if(IS_AJAX){
            $data['goods_id'] = I('post.id',0,'int');
            $data['user_id'] = session('user.id');
            $data['time'] = time();
            $collect = M('goods_collect');
            if($collect->add($data)){
                echo 2; die; //收藏成功
            }else{
                echo -2; die; //收藏失败
            }
        }else{
            echo 0; die; //非法请求
        }
    }
    /*
     * 从购物车提交订单
     */
    public function order(){
        $id = I('post.cart_id','');
        if($id){
            $order_list = array();
            $cart = D('CartView');
            $total = 0;
            foreach($id as $k=>$v){
                $data = $cart->where('cart.id='.$v)->find();
                $data['one_total'] = $data['sale_price']*$data['num'];  //单个商品总价
                $total += $data['one_total'];
                $order_list[] =$data;
            }
        }
        $this->assign('cart_id',implode(',',$id));
        $this->assign('total',$total);
        $this->assign('order_list',$order_list);
        $this->display('buyNow');
    }
    /*
     * 确认订单地址信息
     */
    public function confirm_order(){
        $address =M('address');
        $addr_data =$address->where('user_id='.session('user.id').' and is_default=1')->find();
        if($addr_data){
            $num = I('post.num',0,'int');
            $message = I('post.message','');
            $total = I('post.total',0,'float');
            $send = I('post.send',0,'float');
            $insure = I('post.insure',0,'float');
            if($num){
                //是立即购买提交过来的数据
                $id= I('post.goods_id',0,'int');
                $goods =D('Admin/GoodsView');
                $data = $goods->where('goods.id='.$id)->find();
                $data['one_total'] = $data['sale_price']*$num;
                $this->assign('data',$data);
                $this->assign('id',$id);
                $this->assign('num',$num);
            }else{
                $id = I('post.cart_id','','addslashes');
                $cart= D('CartView');
                $order_data = $cart->where('cart.id in('.$id.')')->select();
                foreach($order_data as $key=>$val){
                    $order_data[$key]['one_total'] = $val['sale_price']*$val['num'];
                }
                $this->assign('cart_id',$id);
                $this->assign('order_data',$order_data);
            }
            $region =M('region');
            $address1 = $region->where('id='.$addr_data['district_id'])->find();
            $address2 = $region->where('id='.$address1['pid'])->find();
            $addr_data['address_area'] = $address2['name'].' '.$address1['name'];
            if($address2['pid'] !=1){
                $address3 = $region->where('id='.$address2['pid'])->find();
                $addr_data['address_area'] = $address3['name'].' '.$addr_data['address_area'];
            }

            $this->assign('address',$addr_data);
            $this->assign('message',$message);
            $this->assign('total',$total);
            $this->assign('send',$send);
            $this->assign('insure',$insure);
            $this->assign('all_total',$total+$send+$insure);
            $this->display();
        }else{
            $this->error('您还没有填写送货地址，请先填写',U('Member/address'));
        }
    }
    /*
     *  ajax提交生成订单
     */
    public function add_order(){
        if(IS_AJAX){
            $num = I('post.num',0,'int');
            $address_id = I('post.address_id',0,'int');
            $data['total_price'] = I('post.total',0,'float');
            $data['send'] = I('post.send',0,'float');
            $data['insure'] = I('post.insure',0,'float');
            $address = M('address');
            $data['address'] = json_encode($address->where('id='.$address_id)->find());
            $data['user_id'] = session('user.id');
            $data['order_num'] = time().mt_rand(1000,9999);
            $data['create_time'] = time();
            $order = M('order');
            if($num){
                $goods_id = I('post.goods_id',0,'int');
                $goods = M('goods');
                $goods_data = $goods->where('id='.$goods_id)->find();
                $goods_data['num'] = $num;
                $goods_list = array();
                $goods_list[] = $goods_data;
                $data['goods'] = json_encode($goods_list);
                if($order->add($data)){
                    echo 1; die;  // 添加订单成功
                }else{
                    echo -1; die; //添加订单失败
                }
            }else{
                $cart_id = I('post.cart_id','','addslashes');
                $cartview = D('CartView');
                $goods_list = $cartview->where('cart.id in('.$cart_id.')')->select();
                $data['goods'] = json_encode($goods_list);
                $model = new Model();
                $model->startTrans();
                if($order->add($data)){
                    $cart = M('cart');
                    if($cart->where('id in('.$cart_id.')')->delete()){
                        $model->commit();
                        echo 1; die;// 添加订单成功
                    }else{
                        $model->rollback();
                        echo -1; die; //添加订单失败
                    }
                }else{
                    $model->rollback();
                    echo -1; die; //添加订单失败
                }
            }
        }else{
            echo 0; //非法请求
        }
    }
    public function createBuy(){
        $id=I('get.id',0,'int');
        //调用支付宝
       // import("Vendor.Api.aliplay",dirname(__FILE__),".config.php");//重新定义后缀
        $alipay_config=C('ALIPLAY');
        import("Vendor.Api.lib.alipay_submit");//调用支付页面
        //支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = "http://商户网关地址/create_direct_pay_by_user-PHP-UTF-8/notify_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $return_url = "http://商户网关地址/create_direct_pay_by_user-PHP-UTF-8/return_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //商户订单号
        $order=M('order');
        $data=$order->where('id='.$id)->find();
        $out_trade_no = $data['order_num'];
        //商户网站订单系统中唯一订单号，必填
        //订单名称
       $subject ='这是你'.date('Y年m月d日 H:m:s',$data['create_time']).'下的订单';
        //必填
        //付款金额
        $price=($data['total_price']+$data['send']+$data['insure']);
        $total_fee =$price;
        //必填
        //订单描述
        $body = "这是我的订单";
        //商品展示地址
        $show_url ="http://localhost/index.php/Home/Goods/index.html";
        //需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1


        /************************************************************/

//构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => trim($alipay_config['partner']),
            "seller_email" => trim($alipay_config['seller_email']),
            "payment_type"	=> $payment_type,
            "notify_url"	=> $notify_url,
            "return_url"	=> $return_url,
            "out_trade_no"	=> $out_trade_no,
            "subject"	=> $subject,
            "total_fee"	=> $total_fee,
            "body"	=> $body,
            "show_url"	=> $show_url,
            "anti_phishing_key"	=> $anti_phishing_key,
            "exter_invoke_ip"	=> $exter_invoke_ip,
            "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
        );

//建立请求
        $alipaySubmit = new \AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        echo $html_text;
    }
}