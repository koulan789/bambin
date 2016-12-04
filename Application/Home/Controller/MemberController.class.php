<?php


namespace Home\Controller;


class MemberController extends BackloginControllor{
    public function index(){
        $userside = D('Userside');
        $userside_data = $userside->userside_nav(); //查询用户中心侧边栏顶级
        foreach($userside_data as $k=>$v){
            $next_data = $userside->userside_nav('pid='.$v['id']); //查询用户中心侧边栏下级导航
            $userside_data[$k]['next'] = $next_data;
        }
        $collect = M('goods_collect');
        $data = $collect->where('user_id='.session('user.id'))->order('time desc')->select();
        $goods = M('goods');
        foreach($data as $k=>$v){
            $goods_data = $goods->where('id='.$v['goods_id'])->field('name')->find();
            $data[$k]['name']=$goods_data['name'];
        }
        $this->assign('collect',$data);
        $this->assign('user',session('user'));
        $this->assign('userside',$userside_data);
        $this->display();
    }
    /*
     * 填写送货地址页
     */
    public function address(){
        if(!strstr($_SERVER['HTTP_REFERER'],'Member/address')){
            setcookie('pre_url',$_SERVER['HTTP_REFERER']);
        }
        if(IS_POST){
            $id = I('post.id',0,'int');
            $address = M('address');
            $data = $address->create();
            if($id){
                if($data){
                    if($address->where('id='.$id)->save()!==false){
                        if(strstr($_COOKIE['pre_url'],'Buy/confirm_order')){
                            $this->success('地址修改成功，请重新选择购买产品',U('Goods/index'));
                        }else{
                            $this->success('地址修改成功',U('Member/index'));
                        }
                    }else{
                        $this->error('修改失败');
                    }
                }else{
                    $this->error($address->getError());
                }
            }else{
                if($data){
                    $data['user_id'] = session('user.id');
                    $data['is_default'] = 1;
                    $edit = $address->where('is_default=1')->save(array('is_default'=>0));
                    if($edit !== false){
                        if($address->add($data)){
                            if(strstr($_COOKIE['pre_url'],'Buy/confirm_order')){
                                $this->success('地址添加成功，请重新选择购买产品',U('Goods/index'));
                            }else{
                                $this->success('地址添加成功',$_COOKIE['pre_url']);
                            }
                        }else{
                            $this->error('添加失败');
                        }
                    }else{
                        $this->error('编辑失败');
                    }
                }else{
                    $this->error($address->getError());
                }
            }
        }else{
            $userside = D('Userside');
            $userside_data = $userside->userside_nav(); //查询用户中心侧边栏顶级
            foreach($userside_data as $k=>$v){
                $next_data = $userside->userside_nav('pid='.$v['id']); //查询用户中心侧边栏下级导航
                $userside_data[$k]['next'] = $next_data;
            }
            $region = M('region');
            $region_data = $region->where('pid=1')->field('id,name')->select();

            $address = M('address');
            $address_list = $address->where('user_id='.session('user.id'))->order('is_default desc')->select();
            foreach($address_list as $k=>$v){
                $address1 = $region->where('id='.$v['district_id'])->find();
                $address2 = $region->where('id='.$address1['pid'])->find();
                $address_list[$k]['address_all'] = $address2['name'].' '.$address1['name'].' '.$v['address'];
                if($address2['pid'] !=1){
                    $address3 = $region->where('id='.$address2['pid'])->find();
                    $address_list[$k]['address_all'] = $address3['name'].' '.$address_list[$k]['address_all'];
                }
            }
            $this->assign('userside',$userside_data);
            $this->assign('region_data',$region_data);
            $this->assign('address_list',$address_list);
            $this->display();
        }
    }
    /*
     * ajax改变城市选择框内容
     */
    public function change_address(){
        if(IS_AJAX){
            $id = I('post.id',0,'int');
            $region = M('region');
            $region_data = $region->where('pid='.$id)->field('id,name')->select();
            //echo json_encode($region_data); die;
			 $this->ajaxReturn($region_data);
        }
    }
    /*
     * 更改默认地址
     */
    public function change_default(){
        if(IS_POST){
            $default = I('post.is_default',0,'int');
            $address = M('address');
            $new_data['is_default'] = 1;
            if($address->where('id='.$default)->save($new_data) !==false){
                 if(strstr($_COOKIE['pre_url'],'Buy/confirm_order')){
                        $this->success('默认地址修改成功，请重新选择购买产品',U('Goods/index'));
                    }else{
                        $this->success('默认地址修改成功',U('Member/index'));
                    }
                }else{
                    $this->error('默认地址修改失败');
                }
         }else{
             $this->error('非法请求');
        }
    }
    /*
     * 用户个人信息修改
     */
    public function my(){
        if(IS_POST){
            $detail = M('user_detail');
            if($detail->create()){
                if($detail->where('user_id='.session('user.id'))->save() !== false){
                    $this->success('修改成功',U('Member/index'));
                }else{
                    $this->error('修改失败');
                }
            }else{
                $this->error('修改失败1');
            }
        }else{
            $userside = D('Userside');
            $userside_data= $userside->userside_list();

            $detail = M('user_detail');
            $user_detail = $detail->where('user_id='.session('user.id'))->find();
            $user_detail['name'] = session('user.name');
            $region = M('region');
            $region_data = $region->where('pid=1')->field('id,name')->select();  //省级地址
            if($user_detail['district_id'] !=1){
                $address1 = $region->where('id='.$user_detail['district_id'])->find();
                $address2 = $region->where('id='.$address1['pid'])->find();
                if($address2['pid'] == 1){
                    $province_id = $address2['id'];
                    $city_id = $address1['id'];
                }else{
                    $address3 = $region->where('id='.$address2['pid'])->find();
                    $province_id = $address3['id'];
                    $city_id = $address2['id'];
                    $area_id = $address1['id'];
                    $area_data = $region->where('pid='.$city_id)->field('id,name')->select();

                    $this->assign('area_data',$area_data);
                    $this->assign('area_id',$area_id);
                }
                $city_data =$region->where('pid='.$province_id)->field('id,name')->select();

                $this->assign('city_data',$city_data);
                $this->assign('province_id',$province_id);
                $this->assign('city_id',$city_id);

            }

            $this->assign('user_detail',$user_detail);
            $this->assign('region_data',$region_data);
            $this->assign('userside',$userside_data);
            $this->display();
        }
    }
    /*
     * 修改密码页面的验证码
     */
    public function verify(){
        $config =    array(
            'fontSize'    =>    16,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
            'imageW'      =>    120,    //验证码宽度
            'imageH'      =>    40,    //验证码高度
            'useCurve'    =>    false,  //关闭混淆曲线
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
    /*
     * ajax验证修改密码页面的验证码
     */
    public function ajax_verify(){
        if(IS_AJAX){
            $verify = I('post.verify','','htmlspecialchars');
            $verify_code = new \Think\Verify();
            if($verify_code->check($verify)){
                echo 1; die; //验证码正确
            }else{
                echo -1; die;  //验证码错误
            }
        }else{
            echo 0; die; //非法请求
        }
    }
    /*
     * 修改密码
     */
    public function changePwd(){
        if(IS_POST){
            $verify_check = I('post.verify_check',0,'int');
            if($verify_check == 0){
                $verify = I('post.verify','','htmlspecialchars');
                $verify_code = new \Think\Verify();
                if($verify_code->check($verify)){
                    $verify_check =1;
                }
            }
            if($verify_check == 1){
                $oldPwd = I('post.oldPwd','','addslashes');
                $user =M('user');
                if($user->where("name='".session('user.name')."' and pwd='".md5($oldPwd.'red')."'")){
                    // 如果原密码输入正确
                    $pwd = I('post.pwd','','addslashes');
                    $rePwd = I('post.rePwd','','addslashes');
                    if($pwd == $rePwd){
                        //如果两次密码输入一致
                        $data['pwd'] = md5($pwd.'red');
                        if($user->where('id='.session('user.id'))->save($data) !== false){
                            $this->success('密码修改成功',U('Member/index'));
                        }else{
                            $this->error('密码修改失败');
                        }
                    }else{
                        $this->error('两次密码输入不一致');
                    }
                }else{
                    $this->error('原密码输入错误');
                }
            }else{
                $this->error('验证码输入错误');
            }
        }else{
            $userside = D('Userside');
            $userside_data= $userside->userside_list();
            $this->assign('userside',$userside_data);
            $this->display();
        }
    }
    public function order(){
        $order = M('order');
        $page = I('get.page',1,'int');   //接受当前页
        $perNum = 3; //每页显示商品数量
        $data = $order->where('user_id='.session('user.id'))->page($page.','.$perNum)->order('create_time desc')->select();
        $order_num = $order->where('user_id='.session('user.id'))->count();
        $pageNum = ceil($order_num/$perNum);
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
        $this->assign('page',$page);
        $this->assign('pageNum',$pageNum);
        $this->assign('pagelist',$pagelist);

        foreach($data as $key=>$val){
            $data[$key]['goods_list'] = json_decode($val['goods'],true);
            if($val['status'] == 0){
                $data[$key]['status_name'] = '未支付';
            }else if($val['status'] == 1){
                $data[$key]['status_name'] = '未发货';
            }else if($val['status'] == 2){
                $data[$key]['status_name'] = '未收货';
            }else{
                $data[$key]['status_name'] = '交易成功';
            }
        }
        $userside = D('Userside');
        $userside_data= $userside->userside_list();
        $this->assign('order_data',$data);
        $this->assign('userside',$userside_data);
        $this->display();
    }
}