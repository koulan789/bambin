<?php
namespace Home\Controller;
class IndexController extends BackControllor{
    public function index(){
        $about = M('about');
        $about_list = $about->field('img,info')->order('id desc')->find();  //查询品牌介绍

        $recommend = M('recommend');
        $reco_data = $recommend->field('goods_id')->order('sort asc')->select(); //查询推荐产品
        $goods = M('goods');
        $reco_list = array();
        foreach($reco_data as $key=>$val){
            $goods_data = $goods->where('id='.$val['goods_id'])->field('id,name,info,img_thumb')->find();//查询推荐产品基本信息
            $reco_list[]= $goods_data;
        }

        $news = M('news');
        $news_list = $news->where('is_top=1')->field('id,title,time')->order('time desc')->select();
        foreach($news_list as $k=>$v){
            $news_list[$k]['time'] = date('Y/m/d',$v['time']);
        }

        $this->assign('about_list',$about_list);
        $this->assign('reco_list',$reco_list);
        $this->assign('news_list',$news_list);
        $this->display();
    }
    public function about(){
        $nav = D('Nav');  //实例化Nav模板
        $side_nav = $nav->nav_list('is_side=1');

        $about = M('about');
        $about_list = $about->field('img,content')->order('id desc')->find();  //查询品牌介绍
        $about_list['content'] = htmlspecialchars_decode($about_list['content']);

        $this->assign('side_nav',$side_nav);
        $this->assign('about_list',$about_list);
        $this->display('introduction');
    }
    public function news(){
        $nav = D('Nav');  //实例化Nav模板
        $side_nav = $nav->nav_list('is_side=1');
        if(IS_GET){    //接收页码
            $page = I('get.page',1,'int');
        }else{
            $page = 1;
        }
        $perNum = 7;
        $news_data = M('news');
        //查询新闻列表
        $news_list = $news_data->field('id,title,time,info')->page($page.','.$perNum)->order('time desc')->select();
        foreach($news_list as $key=>$val){
            $news_list[$key]['time'] = date('Y/m/d',$val['time']);  //时间格式转化
        }
        $news_count = $news_data->count();  //查询新闻总条数
        $pageNum = ceil($news_count/$perNum);  //新闻总页数
        $perPage = 5;  //显示的页码个数
        $per = floor($perPage/2);  //显示页码偏移量
        //确定页码的首尾
        if($pageNum<$perPage){
            $firstPage=1;
            $lastPage=$pageNum;
        }else if($page<$per+1){
            $firstPage = 1;
            $lastPage = $perPage;
        }else if($page>$pageNum-$per){
            $firstPage = $pageNum-$perPage+1;
            $lastPage = $pageNum;
        }else{
            $firstPage = $page-$per;
            $lastPage = $page+$per;
        }
        $pagelist= array();
        for($i=$firstPage;$i<=$lastPage;$i++){
            $pagelist[] = $i;
        }
        $this->assign('side_nav',$side_nav);
        $this->assign('news_list',$news_list);
        $this->assign('page',$page);
        $this->assign('pageNum',$pageNum);
        $this->assign('pagelist',$pagelist);
        $this->display();
    }
    public function newsDetail(){
        if(IS_GET){
            $id = I('get.id',0,'int');  //接收新闻id
            $newsview = D('Admin/NewsView');
            $news_data = $newsview->where('news.id ='.$id)->field('title,time,writer,content')->find(); //新闻详情
            $news = M('news');
            $news_pre = $news->where('id <'.$id)->field('id')->find();  //上一条的id
            $news_next = $news->where('id >'.$id)->field('id')->find();  //下一条的id
            $news_top = $news->where('is_top = 1')->field('id,title')->select();
            $news_data['time'] = date('Y-m-d H:i:s', $news_data['time']);  //时间格式转化
            $news_data['content'] = htmlspecialchars_decode($news_data['content']);
            $nav = D('Nav');  //实例化Nav模板
            $side_nav = $nav->nav_list('is_side=1');  //查询侧边栏导航


            $this->assign('news_data',$news_data);
            $this->assign('news_pre',$news_pre);
            $this->assign('news_next',$news_next);
            $this->assign('news_top',$news_top);
            $this->assign('side_nav',$side_nav);
            $this->display('news_detail');
        }
    }
    public function contact(){
        $myinfor = M('myinfor');
        $myinfor_data = $myinfor->field('address,postcode,hotline,tel,fax,email,url')->find();
        $this->assign('infor',$myinfor_data);
        $this->display();
    }
}