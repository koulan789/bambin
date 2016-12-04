<?php

namespace Home\Controller;

use Think\Model;

class UserController extends BackControllor{
    public function login(){//登入方法
        if(IS_POST){
            $name = I('post.name','','addslashes');
            $pwd = I('post.pwd','','addslashes');
            $pwd = md5($pwd.'red');
            $user = M('user');
            $user_data = $user->where("name='".$name."' and pwd='".$pwd."'")->find();
            if($user_data){
                session('user',$user_data);
                if(strstr($_COOKIE['old_pre'],'User/login')||strstr($_COOKIE['old_pre'],'User/register')){
                    $this->success('登陆成功',U('Index/index'));
                }else{
                    $this->success('登陆成功',$_COOKIE['old_pre']);
                }
            }else{
                $this->error('用户名或密码错误');
            }
        }else{
            setcookie('old_pre',$_SERVER['HTTP_REFERER']);
            $this->assign('title','登录');
            $this->display();
        }
    }
    public function register(){//注册方法
        if(IS_POST){
            $method = I('get.ac','','htmlspecialchars');
            if($method =='phone'){    //手机号注册
                $verify_check1 = I('post.verify_check1',0,'int');
                if($verify_check1 == 0){
                    $verify = I('post.verify','','htmlspecialchars');
                    $verify_code = new \Think\Verify();
                    if($verify_code->check($verify,1)){
                        $verify_check1 =1;
                    }else{
                        $this->error('验证码输入错误');
                    }
                }
                if($verify_check1 ==1){
                    $user = D('user');
                    $user_data = $user->create();
                    if($user_data){   //自动创建数据成功
                        $regex = '/^1\d{10}$/';  //验证手机号正则表达式
                        if(preg_match($regex,$user_data['name'])){
                            $model = new Model();
                            $model->startTrans();  //开启事务
                            $user_data['pwd'] = md5($user_data['pwd'].'red');
                            if($user->add($user_data)){  //添加注册用户成功
                                $detail_data['user_id'] = $user->getLastInsID();  //添加成功后的id
                                $detail_data['tel'] = $user_data['name'];
                                $user_detail = M('user_detail');
                                if($user_detail->add($detail_data)){
                                    $model->commit();
                                    $this->success('注册成功，3秒后将自动跳转到登录页面',U('User/login'),3);
                                }else{
                                    $model->rollback();
                                    $this->error('注册信息失败');
                                }
                            }else{
                                $model->rollback();
                                $this->error('注册失败');
                            }
                        }else{
                            $this->error('请输入正确的手机号码');
                        }
                    }else{
                        $this->error($user->getError());  //自动创建注册用户数据失败
                    }
                }
            }else if($method == 'account'){   //账号注册
                $verify_check2 = I('post.verify_check2',0,'int');
                if($verify_check2 == 0){
                    $verify = I('post.verify','','htmlspecialchars');
                    $verify_code = new \Think\Verify();
                    if($verify_code->check($verify,2)){
                        $verify_check2 =1;
                    }else{
                        $this->error('验证码输入错误'); die;
                    }
                }

                if($verify_check2 ==1){
                    $user = D('user');
                    $user_data = $user->create();
                    if($user_data){   //自动创建数据成功
                        $regex = '/^\w{3,20}$/';  //验证用户名正则表达式
                        if(preg_match($regex,$user_data['name'])){
                            $model = new Model();
                            $model->startTrans();  //开启事务
                            $user_data['pwd'] = md5($user_data['pwd'].'red');
                            if($user->add($user_data)){  //添加注册用户成功
                                $detail_data['user_id'] = $user->getLastInsID();  //添加成功后的id
                                $detail_data['email'] = I('post.email','','addslashes');
                                $regex_email ='/^\w{1,}@(qq||126||163||sina)\.com$/';
                                if(preg_match($regex_email,$detail_data['email'])){
                                    $user_detail = M('user_detail');
                                    if($user_detail->add($detail_data)){
                                        $model->commit();
                                        $this->success('注册成功，3秒后将自动跳转到登录页面',U('User/login'),3);
                                    }else{
                                        $model->rollback();
                                        $this->error('注册信息失败');
                                    }
                                }else{
                                    $model->rollback();
                                    $this->error('请输入正确的邮箱地址');
                                }
                            }else{
                                $model->rollback();
                                $this->error('注册失败');
                            }
                        }else{
                            $this->error('请输入正确的手机号码');
                        }
                    }else{
                        $this->error($user->getError());  //自动创建注册用户数据失败
                    }
                }
            }
        }else{
            $this->assign('title','注册');
            $this->display();
        }
    }
    public function ajax(){
        if(IS_AJAX){//验证
            if($_POST['name']){
                $name = I('post.name','','htmlspecialchars');
                $user =M('user');
                if($user->where("name='".$name."'")->find()){
                    echo -1; die; //用户名已存在
                }else{
                    echo 1; die; //用户名可以使用
                }
            }elseif($_POST['verify']){
                $verify = I('post.verify','','htmlspecialchars');
                $verify_code = new \Think\Verify();
                if($verify_code->check($verify,1)){
                    echo 2; die; //手机注册方式验证码正确
                }else{
                    echo -2; die;  //手机注册方式验证码错误
                }
            }elseif($_POST['verify2']){
                $verify2 = I('post.verify2','','htmlspecialchars');
                $verify_code = new \Think\Verify();
                if($verify_code->check($verify2,2)){
                    echo 3; die; //账号方式验证码正确
                }else{
                    echo -3; die;  //账号方式验证码错误
                }
            }

        }else{
            echo 0; die; //非法请求
        }
    }
    public function verify(){
        $config =    array(
            'fontSize'    =>    16,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
            'imageW'      =>    120,    //验证码宽度
            'imageH'      =>    40,    //验证码高度
            'useCurve'    =>    false,  //关闭混淆曲线
        );
		ob_clean();
        $Verify = new \Think\Verify($config);
        $Verify->entry(1);
    }
    public function verify2(){
        $config =    array(
            'fontSize'    =>    16,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
            'imageW'      =>    120,    //验证码宽度
            'imageH'      =>    40,    //验证码高度
            'useCurve'    =>    false,  //关闭混淆曲线
        );
		ob_clean();
        $Verify = new \Think\Verify($config);
        $Verify->entry(2);
    }
    public function loginout(){
        session('user',null);
        $this->success('退出成功');
    }
}
