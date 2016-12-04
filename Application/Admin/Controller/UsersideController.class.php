<?php

namespace Admin\Controller;


class UsersideController extends BackController{
    /*
     * 用户中心侧边栏 列表  查询
     */
    public function index(){
        $userside =  D('Userside');  //实例化模型
        $side_cate =  $userside->userside();  //先查询顶级的用户中心侧边导航
        foreach($side_cate as $k=>$v){
            $son =  $userside->userside($v['id']);  //在查询各个顶级下边的导航
            $side_cate[$k]['son'] = $son;
        }
        if(IS_POST){  //如果有查询数据
            $name = I('post.name','','htmlspecialchars');
            if($name != ''){
                $side_cate = $userside->where("name like '%".$name."%'")->select();
            }
        }
        $this->assign('side_cate',$side_cate);
        $this->display();
    }
    /*
     * 用户中心侧边栏 添加
     */
    public function add(){
        if(IS_POST){     //如果有post提交的添加数据
             $userside =  D('userside');
            if($userside->create()){  //自动创建数据成功
                if($userside->add()){  //添加成功
                    $this->success("添加成功",U('Userside/index')); exit;
                }else{
                    $this->error("添加失败",U('Userside/index'));exit;
                }
            }else{  //自动创建数据失败
                $this->error($userside->getError());
            }
        }else{
            $userside = D('Userside');  //实例化模型
            $list = $userside->userside();  //查询用户中心侧边栏的顶级导航
            $this->assign('list',$list);
            $this->display();
        }
    }
    /*
     * 用户中心侧边栏  修改
     */
    public function update(){
        if(IS_POST){
            $userside = D('userside'); //实例化表
            $id = I('post.id',0,'int');  // 需修改数据的id
            if($userside->create()){  //自动创建数据成功
                if($userside->where('id='.$id)->save() !== false){   //修改成功
                    $this->success('修改成功',U('Userside/index'));exit;
                }else{  //修改失败
                    $this->error('修改失败',U('Userside/index'));exit;
                }
            }else{   //自动创建数据失败
                $this->error($userside->getError());
            }
        }else{
            $id = I('get.id',0,'int');  //需修改数据的id
            $userside = D('Userside');
            $side = $userside->userside();  //查询用户中心侧边栏的顶级导航
            $data = $userside->where('id='.$id)->find();  //查询需修改的数据
            $this->assign('side',$side);
            $this->assign('data',$data);
            $this->display();
        }
    }
    /*
     * 用户中心侧边栏导航   删除
     */
    public function del(){
        if(IS_AJAX){
            $id=I('post.id',0,'int');  //获取传过来的id
            $nav=M('userside');     //实例化表
            if($nav->where('pid='.$id)->find()){
                echo -2; exit; //如果有下级导航,不能删除，先删除下级导航
            }else{
                if($nav->where('id='.$id)->delete()){
                    echo 1;  //删除成功
                    exit;
                }else{
                    echo -1; exit;  //删除失败
                }
            }
        }else{
            echo 0;exit;  //非法请求
        }
    }
}
