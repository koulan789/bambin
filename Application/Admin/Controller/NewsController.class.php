<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-1-29
 * Time: 下午3:31
 * To change this template use File | Settings | File Templates.
 */

namespace Admin\Controller;


use Think\Model;

class NewsController extends BackController{
    /*
     * 新闻  查询
     */
    public function index(){
        $news =M('news');
        $list = $news->select();
        if(IS_POST){
            $title = I('post.name','','htmlspecialchars');
            if($title !=''){
                $list = $news->where("title like '%".$title."%'")->select();
            }
        }
        foreach($list as $key=>$val){
            $list[$key]['time'] = date('Y-m-d H:i:s',$val['time']);
            $list[$key]['is_top'] = ($val['is_top']==1)?'是':'否';
        }
        $this->assign('list',$list);
        $this->display();
    }
    /*
     * 新闻  添加
     */
    public function add(){
        if(IS_POST){
            $news = D('news');
            $news_data = $news->create(); //自动创建数据
            if($news_data){
                $news_data['time']=time();
                $model = new Model();
                $model->startTrans(); //开启事务
                if($news->add($news_data)){  //添加成功
                    $detail_data['news_id'] =$news->getLastInsID();  //获取添加成功后的id
                    $detail_data['content'] =I('post.content','','htmlspecialchars');
                    $news_detail = M('news_detail');
                    if($news_detail->add($detail_data)){
                        $model->commit();
                        $this->success('添加成功',U('News/index'));
                    }else{
                        $model->rollback();
                        $this->error('添加新闻详情失败');
                    }
                }else{
                    $model->rollback();
                    $this->error('添加新闻失败');
                }
            }else{
                $this->error($news->getError());
            }
        }else{
            $this->display();
        }
    }
    /*
     *新闻  修改
     */
    public function update(){
        if(IS_POST){
            $id = I('post.id',0,'int');
            $news = D('news');
            if($news->create()){
                $model = new Model();
                $model->startTrans(); //开启事务
                if($news->where('id='.$id)->save() !== false){
                    $detail_data['content'] = I('post.content','','htmlspecialchars');
                    $detail = M('news_detail');
                    if($detail->where('news_id ='.$id)->save($detail_data) !== false){
                        $model->commit();
                        $this->success('修改成功',U('News/index'));
                    }else{
                        $model->rollback();
                        $this->error('修改新闻详情失败',U('News/index'));
                    }
                }else{
                    $model->rollback();
                    $this->error('修改新闻表失败',U('News/index'));
                }
            }else{
                $this->error($news->getError(),U('News/index'));
            }
        }else{
            $id = I('get.id',0,'int');
            $news =D('NewsView');
            $data = $news->where('news.id ='.$id)->find();
            $this->assign('data',$data);
            $this->display();
        }
    }
    /*
     * 新闻 ajax删除
     */
    public function del(){
        if(IS_AJAX){
            $id = I('post.id',0,'int');
            $news=M('news');
            if($news->where('id='.$id)->delete()){
                echo 1; exit; //删除成功
            }else{
                echo -1; exit; //删除失败
            }
        }else{
            echo 0; exit; //非法请求
        }
    }
}