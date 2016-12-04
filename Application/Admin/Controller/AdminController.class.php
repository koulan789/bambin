<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-1-29
 * Time: 上午10:04
 * To change this template use File | Settings | File Templates.
 */

namespace Admin\Controller;


class AdminController extends BackController{
    /*
     * 管理员  查询    需要角色表的角色名  所有需联表查询
     */
    public function index(){
        $admin = D('AdminView');
        $list = $admin->select();
        $this->assign('list',$list);
        $this->display();
    }
    /*
     * 管理员  添加
     */
    public function add(){
        if(IS_POST){
            $admin = D('admin');
            $admin_data = $admin->create();//自动创建数据
            if($admin_data){
                $admin_data['pwd'] = md5($admin_data['pwd'].'cheng');  //密码加密
                if($admin->add($admin_data)){
                    $this->success('添加成功',U('Admin/index'));
                }else{
                    $this->error('添加失败');
                }
            }else{
                $this->error($admin->getError());
            }
        }else{
            $admin= D('Admin');  //实例化模型
            $power_data =$admin-> power_list();
            $this->assign('power_data',$power_data);
            $this->display();
        }
    }
    /*
     * 管理员 修改
     */
    public function update(){
        if(IS_POST){
            $admin = D('admin');  //实例化管理员表及模型
            $id = I('post.id',0,'int');
            $admin_data =$admin->create(); //自动创建数据
            if($admin_data){
                if($admin_data['pwd']){
                    $admin_data['pwd'] =md5($admin_data['pwd'].'cheng');
                }
                if($admin->where('id='.$id)->save($admin_data) !== false){
                    $this->success('修改成功',U('Admin/index'));
                }else{
                    $this->error('修改失败',U('Admin/index'));
                }
            }else{
                $this->error($admin->getError(),U('Admin/index'));
            }
        }else{
            $id = I('get.id',0,'int');
            $admin = D('admin');  //实例化管理员表及模型
            $data = $admin->where('id='.$id)->find(); //查询需修改的数据
            $power_data =$admin->power_list(); //调用模型中查询角色的函数
            $this->assign('power_data',$power_data);
            $this->assign('data',$data);
            $this->display();
        }
    }
    /*
     * 管理员 ajax删除
     */
    public function del(){
        if(IS_AJAX){
            $id = I('post.id',0,'int');
            if(session('admin')['id'] == $id){
                echo -2; exit; //不能删除自己
            }else{
                $admin = M('admin');
                if($admin->where('id='.$id)->delete()){
                    echo 1; exit; //删除成功
                }else{
                    echo -1; exit; //删除失败
                }
            }
        }else{
            echo 0; exit; //非法请求
        }
    }
}