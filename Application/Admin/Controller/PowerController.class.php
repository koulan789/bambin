<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-1-28
 * Time: 下午1:49
 * To change this template use File | Settings | File Templates.
 */

namespace Admin\Controller;


class PowerController extends BackController{
    /*
     * 角色 查询
     */
    public function index(){
        $menu = C('MENU');  //实例化配置文件中的菜单
        foreach($menu as $val){
            foreach($val['son'] as $vo){
                $menu_data[$vo['id']] =$vo['name'];
            }
        }
        $power = M('power'); //实例化角色
        $power_data = $power->select();
        foreach($power_data as $key=>$value){
            $role = json_decode($value['role']);
            $role_data = array();
            foreach($role as $k=>$v){
                $role_data[] =  $menu_data[$v];
            }
            $power_data[$key]['role_data'] = $role_data;
        }
        $this->assign('list',$power_data);
        $this->display();
    }
    /*
     * 角色 添加
     */
    public function add(){
        if(IS_POST){
            $power = D('power');
            $data =$power->create();
            if($data){
                $data['role'] = json_encode($data['role']);
                if($power->add($data)){
                    $this->success('添加成功',U('Power/index'));
                }else{
                    $this->error('添加失败');
                }
            }else{
                $this->error($power->getError());
            }
        }else{
            $menu =C('MENU');
            $this->assign('menu',$menu);
            $this->display();
        }
    }
    /*
     * 角色  修改
     */
    public function update(){
        if(IS_POST){
            $id = I('post.id',0,'int');
            $power = D('power');  //实例化表
            $role_data = $power->create();  //自动创建数据
            if($role_data){
                $role_data['role'] = json_encode( $role_data['role']);  //创建数据成功，将权限数组转化为Json
                if($power->where('id='.$id)->save($role_data) !== false){
                    $this->success('修改成功',U('Power/index'));
                }else{
                    $this->error('修改失败',U('Power/index'));
                }
            }else{
                $this->error($power->getError(),U('Power/index'));  //自动创建数据失败
            }
        }else{
            $menu = C('MENU'); //实例化菜单
            $power =M('power');  //实例化表
            $id = I('get.id',0,'int');  //获取id
            $data = $power->where('id='.$id)->find(); //查询需修改的数据
            $data['role']= json_decode($data['role']);  //将权限内容的格式转化为数组
            $this->assign('data',$data);
            $this->assign('menu',$menu);
            $this->display();
        }
    }
    /*
     * 角色  AJAX删除
     */
    public function del(){
        if(IS_AJAX){
            $id= I('post.id',0,'int');
            $admin = M('admin');
            if($admin->where('power_id='.$id)->find()){
                echo -2; exit; //不能删除，有管理员选择该权限
            }else{
                $power =M('power');
                if($power->where('id='.$id)->delete()){
                    echo 1; exit; //删除成功
                }else{
                    echo -1; exit;//删除失败
                }
            }
        }else{
            echo 0; exit; //非法操作
        }
    }
}