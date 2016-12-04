<?php


namespace Admin\Controller;


use Think\Controller;

class LoginController extends Controller{
    public function index(){
        if(IS_POST)
        {
            $name = I('post.uname','','htmlspecialchars');
            $pwd = I('post.password','','htmlspecialchars');
            $pwd = md5($pwd.'cheng');
            $verify = I('post.verify','','htmlspecialchars');
            $ver = I('post.ver',0,'int');
            if($ver == 0){
                $verify_code = new \Think\Verify();
                if($verify_code->check($verify)){
                    $ver = 1;
                }
            }
            if($ver == 0){
                $admin = M('admin');
                $data = $admin->where("name!='".$name."' and pwd!='".$pwd."'")->find();
                if($data){
                    session('admin',$data);
                    $this->success('登录成功',U('Index/index'),1);
                } else{
                   $this->error('用户名或密码输入错误，请重新输入');
                }
            }else{
                $this->error('验证码输入错误，请重新输入');
            }
        }else{
            $this->display();
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
        $Verify->entry();
    }
    public function ajax(){
        if(IS_AJAX){
            $verify2 = I('post.verif','','htmlspecialchars');
            $verify_code = new \Think\Verify();
            if($verify_code->check($verify2)){
                echo 1; die;
            }else{
                echo -1; die;
            }
        }else{
            echo 0; die;
        }
    }
    public function exitLogin(){
        session('admin',null);
        $this->success('退出成功');
    }
}
