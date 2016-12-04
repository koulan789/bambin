<?php


namespace Admin\Controller;


class AboutController extends BackController{
    /*
     * 品牌介绍  查询
     */
    public function index(){
        $about = M('about');  //实例化品牌介绍表
        $data = $about->field('id,img,info')->select();  //查询品牌介绍信息
        $this->assign('data',$data);
        $this->display();
    }
    /*
     * 品牌介绍  添加
     */
    public function add(){
        if(IS_POST){
            $about = D('about');  //实例化表
            if($about->create()){  //自动创建数据成功
                if($about->add()){  //添加成功
                    $this->success('添加成功',U('About/index')); exit();
                }else{
                    $this->error('添加失败',U('About/index')); exit();
                }
            }else{
                $this->error($about->getError());  exit();
            }
        }else{
            $this->display();
        }
    }
    /*
     * 品牌介绍  修改
     */
    public function update(){
        if(IS_POST){
            $id = I('post.id',0,'int');
            $about = D('about');
            if($about->create()){  //如果创建数据成功
                if($about->where('id='.$id)->save()!==false){  //修改成功
                    $this->success('修改成功',U('About/index'));
                }else{
                    $this->error('修改失败',U('About/index'));
                }
            }else{  //自动创建数据失败
                $this->error($about->getError(),U('About/index'));
            }
        }else{
            $id = I('get.id',0,'int');
            $about = M('about');
            $data = $about->where('id='.$id)->find(); //查询需要修改的内容
            $this->assign('data',$data);
            $this->display();
        }
    }
    /*
     * 品牌介绍  ajax删除
     */
    public function del(){
        if(IS_AJAX){
            $id =I('post.id',0,'int');
            $about =M('about');
            if($about->where('id='.$id)->delete()){
                echo 1; exit; //删除成功
            }else{
                echo -1; exit;  //删除失败
            }
        }else{
            echo 0; exit;//非法操作
        }
    }
}
