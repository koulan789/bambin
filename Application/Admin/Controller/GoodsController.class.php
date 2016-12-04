<?php

namespace Admin\Controller;


use Think\Model;

class GoodsController extends BackController{
    /*
     * 产品 列表  查询
     */
    public function index(){  //涉及多表联查
        $goods = D('GoodsView');
        $data = $goods->field('id,name,name_all,img_thumb,sale_price,inventory,is_show')->select();
        if(IS_POST){
            $name = I('post.name','','htmlspecialchars');
            if($name != ''){
                $data = $goods->where("name like'%".$name."%'")->field('id,name,name_all,img_thumb,sale_price,inventory,is_show')->select();
            }
        }
        $this->assign('data',$data);
        $this->display();
    }
    /*
     * 产品  添加
     */
    public function add(){
        if(IS_POST){
            $goods = D('goods');
            if($goods->create()){  //数据自动创建成功
                $model = new Model();
                $model->startTrans(); //开启事物
                if($goods->add()){  //向goods表添加数据成功
                    $id = $goods->getLastInsID();
                    $data = array();  //定义一个空数组 存放 向goods_detail表添加的数据
                    $data['goods_id']= $id;
                    $data['content'] = I('post.content','','htmlspecialchars');
                    $data['name_all'] = I('post.name_all','','htmlspecialchars');
                    $data['send_price'] = I('post.send_price',0,'addslashes');
                    $data['dc'] = I('post.dc',1,'int');
                    $goods_detail = M('goods_detail');
                    if($goods_detail->add($data)){  //向goods_detail表添加数据成功
                        $img = I('post.img',array());
                        $sort =I('post.sort',array());
                        $goods_img =M('goods_img');
                        $rel = 0;
                        foreach($img as $key=>$val){
                             $img_data = array(); //定义一个空数组 存放向goods_img 表添加的数据
                             $img_data['img'] = $val;
                             $img_data['sort'] = $sort[$key];
                             $img_data['goods_id'] =$id;
                            if($goods_img->add($img_data)){//向goods_img表添加数据成功
                                $rel++;
                            }else{
                                $model->rollback();
                                $rel = 0;
                                $this->error('添加失败',U('Goods/index'));exit;
                            }
                        }
                        if($rel == count($img)){
                            $model->commit();
                            $this->success('添加成功',U('Goods/index'));exit;
                        }else{
                            $model->rollback();
                            $this->error('添加失败',U('Goods/index'));exit;
                        }
                    }else{  //向goods_detail表添加数据失败
                        $model->rollback();
                        $this->error('添加失败',U('Goods/index'));exit;
                    }
                }else{  //向goods表添加数据失败
                    $model->rollback();
                    $this->error('添加失败',U('Goods/index'));exit;
                }
            }else{
                $this->error($goods->getError()); exit;
            }
        }else{
            $region = M('region');
            $region_data = $region->where('pid=1')->select();
            $this->assign('region_data',$region_data);
            $this->display();
        }
    }
    /*
     * 产品  删除
     */
    public function del(){
        if(IS_AJAX){
            $id =I('post.id',0,'int');
            $goods = M('goods');
            if($goods->where('id='.$id)->delete()){
                echo 1; exit;  //删除成功
            }else{
                echo -1; exit;  //删除失败
            }
        }else{
         echo 0; exit;   //非法请求
        }
    }
    /*
     * 产品  修改
     */
    public function update(){
        if(IS_POST){
            $id = I('post.id',0,'int');
            $goods = D('goods');
            if($goods->create()){  //数据自动创建成功
                $model = new Model();
                $model->startTrans(); //开启事物
                if($goods->where('id='.$id)->save()!==false){  //向goods表修改数据成功
                    $data = array();  //定义一个空数组 存放 向goods_detail表修改的数据
                    $data['content'] = I('post.content','','htmlspecialchars');
                    $data['name_all'] = I('post.name_all','','htmlspecialchars');
                    $data['send_price'] = I('post.send_price',0,'addslashes');
                    $data['dc'] = I('post.dc',1,'int');
                    $goods_detail = M('goods_detail');
                    if($goods_detail->where('goods_id='.$id)->save($data)!==false){  //向goods_detail表修改数据成功
                        $img = I('post.img',array()); //提交的图片数据
                        $sort =I('post.sort',array());  //提交的图片排序
                        $img_id =I('post.img_id',array());  //提交的图片id
                        $goods_img =M('goods_img');  //实例化图集表
                        $rel = 0;
                        $img_id_old =$goods_img->where('goods_id='.$id)->field('id')->select();//查询以前存在的图片id
                        foreach($img_id_old as $k=>$v){
                            if(!in_array($v['id'],$img_id)){
                                if($goods_img->where('id='.$v['id'])->delete()==false){
                                    $model->rollback();
                                    $this->error('修改失败',U('Goods/index'));exit;
                                }
                            }
                        }
                        foreach($img as $key=>$val){
                            $img_data = array(); //定义一个空数组 存放向goods_img 表修改的数据
                            $img_data['img'] = $val;
                            $img_data['sort'] = $sort[$key];
                            $img_data['goods_id'] =$id;
                            if($img_id[$key]!=''){   //如果有传过来图集的id 就修改
                                if($goods_img->where('id='.$img_id[$key])->save($img_data)!==false){
                                    $rel++;
                                }else{
                                    $model->rollback();
                                    $this->error('修改单一图集失败',U('Goods/index'));exit;
                                }
                            }else{    //如果没有传过来图集的id 就添加
                                    if($goods_img->add($img_data)){//向goods_img表添加数据成功
                                        $rel++;
                                    }else{
                                        $model->rollback();
                                        $this->error('新增图集图片失败',U('Goods/index'));exit;
                                    }
                                }
                            }
                        if($rel == count($img)){
                            $model->commit();
                            $this->success('修改成功',U('Goods/index'));exit;
                        }else{
                            $model->rollback();
                            $this->error('修改所有图集失败',U('Goods/index'));exit;
                        }
                    }else{  //向goods_detail表修改数据失败
                        $model->rollback();
                        $this->error('修改产品详情失败',U('Goods/index'));exit;
                    }
                }else{  //向goods表修改数据失败
                    $model->rollback();
                    $this->error('修改产品表失败',U('Goods/index'));exit;
                }
            }else{
                $this->error($goods->getError()); exit;
            }
        }else{
            $id =I('get.id',0,'int');
            $goods = D('GoodsView');
            $data = $goods->where('goods.id ='.$id)->find();  //查询产品信息
            $data['content'] = htmlspecialchars_decode($data['content']);
            $goods_img = M('goods_img');
            $images = $goods_img->where('goods_id ='.$id)->order('sort asc')->select(); //查询产品图集
            $data['images'] = $images;
            $region = M('region');
            $region_data = $region->where('pid=1')->select();
            $this->assign('region_data',$region_data);
            $this->assign('data',$data);
            $this->display();
        }
    }
}
