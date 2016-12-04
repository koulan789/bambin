<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if(session('?admin')){
            $menu=C('MENU');
            $this->assign('menu',$menu);
            $admin = session('admin');
            $power = M('power');
            $role = $power->where('id ='.$admin['power_id'])->field('role')->find();   //查询权限
            $admin['role'] = json_decode($role['role']);
            $this->assign('admin',$admin);
            $this->display();
        }else{
            $this->display('Login:index');
           // $this->error('你还没登录，请先登录',U('Login/index'),2);
        }
    }
    public function update(){
        if(session('?admin')){
            if(IS_POST){
                $myinfor = M('myinfor');
                if($myinfor->create()){
                    $id = I('post.id',0,'int');
                    if($myinfor->where('id='.$id)->save() !== false){
                        $this->success('修改成功');
                    }else{
                        $this->error('修改失败');
                    }
                }else{
                    $this->error('创建数据失败');
                }

            }else{
                $myinfor = M('myinfor');
                $data = $myinfor->find();
                $this->assign('data',$data);
                $this->display();
            }

        }else{
            $this->error('你还没登录，请先登录',U('Login/index'),2);
        }
    }
}