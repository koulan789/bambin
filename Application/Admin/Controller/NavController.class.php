<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-1-25
 * Time: 上午9:30
 * To change this template use File | Settings | File Templates.
 */

namespace Admin\Controller;


class NavController extends BackController{
    /*
     * 列表，查询
     */
    public function index(){
        $nav=D('Nav');
        $list =$nav->nav_list();
        if(IS_POST){
            $name=I('post.name','','htmlspecialchars');
            if($name != ''){
                $list = $nav->nav_list("name like '%".$name."%'");
            }
        }
        $this->assign('list',$list);
        $this->display();
    }
    /*
     * 添加
     */
    public function add(){
        if(IS_POST){    //如果有post提交数据
            $nav = D('nav');   //实例化nav表
            if($nav->create()){    //如果创建数据成功
                if($nav->add()){
                    $this->success('添加成功',U('Nav/index'));
                    exit();
                }else{
                    $this->error('添加失败',U('Nav/index'));
                    exit();
                }
            }else{
                $this->error($nav->getError(),U('Nav/index'));  //创建数据失败
                exit();
            }
        }else{
            $this->display();   //加载视图
        }
    }
    /*
     * 修改
     */
    public function update(){
        if(IS_POST){
            $id=I('post.id',0,'int');   //接收需修改的数据的id
            $nav = D('nav');  //实例化表
            if($nav->create()){    //如果创建数据成功
                $result = $nav->where('id='.$id)->save();  //执行修改
                if($result !== false){
                    $this->success('修改成功',U('Nav/index'));
                }else{
                    $this->error('修改失败',U('Nav/index'));
                }
            }else{
                $this->error($nav->getError(),U('Nav/index'));
                exit;
            }
        }else  if(IS_GET){    //如果有get提交数据
            $id = I('get.id',0,'int');   //获取id数据并处理
            $nav=M('nav');   //实例化表
            $data=$nav->where('id='.$id)->find();   //查询要修改的数据
            $this->assign('data',$data);
            $this->display();
        }else{
            $this->error("非法请求");
        }
    }

    public function del(){
        if(IS_AJAX){
            $id=I('post.id',0,'int');  //获取传过来的id
            $nav=M('nav');     //实例化表
            if($nav->where('id='.$id)->delete()){
                echo 1;  //删除成功
                exit;
            }else{
                echo -1; exit;  //删除失败
            }
        }else{
            echo 0;exit;  //非法请求
        }
    }
}