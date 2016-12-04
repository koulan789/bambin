<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-1-28
 * Time: 上午11:32
 * To change this template use File | Settings | File Templates.
 */

namespace Admin\Controller;


class RecommendController extends BackController{
    /*
     * 推荐产品 查询
     */
    public function index(){
        $recommend =D('RecommendView');
        $list = $recommend->order('sort asc')->select();
        if(IS_POST){
            $name = I('post.name','','htmlspecialchars');
            if($name != ''){
                $list = $recommend->where("name like '%".$name."%'")->order('sort asc')->select();
            }
        }
        $this->assign('list',$list);
        $this->display();
    }
    /*
     * 推荐产品 添加
     */
    public function add(){
        if(IS_POST){
            $recommend = D('recommend');  //实例化推荐表
            if($recommend->create()){
                if($recommend->add()){
                    $this->success('添加成功',U('Recommend/index'));
                }else{
                    $this->error('添加失败');
                }
            }else{
                $this->error($recommend->getError()); //数据创建失败
            }
        }else{
            $recommend = D('Recommend');  //实例化推荐模型
            $list = $recommend->goods_list();   //查询下拉框的产品数据
            $this->assign('list',$list);
            $this->display();
        }
    }
    /*
     * 推荐产品修改
     */
    public function update(){
        $recommend = D('recommend');
        $id = I('post.id',0,'int');
        if($recommend->create()){
            if($recommend->where('id='.$id)->save() !== false){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }else{
            $this->error($recommend->getError());
        }
    }
    /*
     * 推荐产品删除
     */
    public function del(){
        if(IS_AJAX){
            $id = I('post.id',0,'int');
            $recommend = M('recommend');
            if($recommend->where('id='.$id)->delete()){
                echo 1; exit; //删除成功
            }else{
                echo -1; exit; //删除失败
            }
        }else{
            echo 0; exit; //非法请求
        }
    }
}