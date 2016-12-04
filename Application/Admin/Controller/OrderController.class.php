<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 02-1-13
 * Time: 上午8:47
 */

namespace Admin\Controller;


class OrderController extends BackController{
    public function index(){
        $order = M('order');
        $order_num = I('post.order_num',0,'int');
        if($order_num != 0){
            $data = $order->where('order_num='.$order_num)->select();
        }else{
            $data = $order->select();
        }
        foreach($data as $k =>$v){
            $goods = json_decode($v['goods'],true);
            $goods_list = '';
            foreach($goods as $key => $val){
                $goods_list .= $val['name'].' '.$val['num'].'件 单价：'.$val['sale_price'].'元/件; <br />';
            }
            $data[$k]['goods_list'] = $goods_list;
            $address = json_decode($v['address'],true);
                if($address['sex'] == 0){
                    $sex = '女士';
                }else{
                    $sex = '先生';
                }
                $region = M('region');
                $addr1 = $region->where('id='.$address['district_id'])->find();
                $addr2 = $region->where('id='.$addr1['pid'])->find();
                if( $addr2['pid'] > 1){
                    $addr3 = $region->where('id='.$addr2['pid'])->find();
                    $address_list = $address['name'].$sex.' 地址：'.$addr3['name'].' '.$addr2['name'].' '.$addr1['name'].' '.$address['address'].' 联系电话：'.$address['tel'];
                }else{

                    $address_list = $address['name'].$sex.' 地址：'.$addr2['name'].' '.$addr1['name'].' '.$address['address'].' 联系电话：'.$address['tel'];
                }
            $data[$k]['address_list'] = $address_list;
        }
        $this->assign('data',$data);
        $this->display();
    }
    public function update(){
        if(IS_POST){
            $order = M('order');
            $id = I('post.id',0,'int');
            if($order->create()){
                if($order->where('id='.$id)->save()!==false){
                    $this->success('订单修改成功',U('Order/index'));
                }else{
                    $this->error('订单修改失败',U('Order/index'));
                }
            }else{
                $this->error('数据创建失败',U('Order/index'));
            }
        }else{
            $order = M('order');
            $id = I('get.id',0,'int');
            $data = $order->where('id='.$id)->find();
            $goods = json_decode($data['goods'],true);
            $goods_list = '';
            foreach($goods as $key => $val){
                $goods_list .= $val['name'].' '.$val['num'].'件 单价：'.$val['sale_price'].'元/件; <br />';
            }
            $data['goods_list'] = $goods_list;
            $address = json_decode($data['address'],true);
            if($address['sex'] == 0){
                $sex = '女士';
            }else{
                $sex = '先生';
            }
            $region = M('region');
            $addr1 = $region->where('id='.$address['district_id'])->find();
            $addr2 = $region->where('id='.$addr1['pid'])->find();
            if( $addr2['pid'] > 1){
                $addr3 = $region->where('id='.$addr2['pid'])->find();
                $address_list = $address['name'].$sex.' 地址：'.$addr3['name'].' '.$addr2['name'].' '.$addr1['name'].' '.$address['address'].' 联系电话：'.$address['tel'];
            }else{

                $address_list = $address['name'].$sex.' 地址：'.$addr2['name'].' '.$addr1['name'].' '.$address['address'].' 联系电话：'.$address['tel'];
            }
            $data['address_list'] = $address_list;

            $this->assign('data',$data);
            $this->display();
        }
    }
    public function put_out(){
        $id_str = I('get.id_str','','addslashes');
        $id_str = rtrim($id_str,',');

        $data = M('order')->where('id in('.$id_str.')')->select();
        foreach($data as $k =>$v){
            $goods = json_decode($v['goods'],true);
            $goods_list = '';
            foreach($goods as $key => $val){
                $goods_list .= $val['name'].' '.$val['num'].'件 单价：'.$val['sale_price'].'元/件; \n';
            }
            $data[$k]['goods_list'] = $goods_list;
            $address = json_decode($v['address'],true);
            if($address['sex'] == 0){
                $sex = '女士';
            }else{
                $sex = '先生';
            }
            $region = M('region');
            $addr1 = $region->where('id='.$address['district_id'])->find();
            $addr2 = $region->where('id='.$addr1['pid'])->find();
            if( $addr2['pid'] > 1){
                $addr3 = $region->where('id='.$addr2['pid'])->find();
                $address_list = $address['name'].$sex.' 地址：'.$addr3['name'].' '.$addr2['name'].' '.$addr1['name'].' '.$address['address'].' 联系电话：'.$address['tel'];
            }else{

                $address_list = $address['name'].$sex.' 地址：'.$addr2['name'].' '.$addr1['name'].' '.$address['address'].' 联系电话：'.$address['tel'];
            }
            $data[$k]['address_list'] = $address_list;
            $data[$k]['time'] = date('Y-m-d H:i:s',$v['create_time']);
        }
        Vendor('Excel.PHPExcel');

        $objPHPExcel=new \PHPExcel();
        $objPHPExcel->getProperties()->setCreator('a')
            ->setLastModifiedBy('b')
            ->setTitle('订单')
            ->setSubject('导出')
            ->setDescription('订单信息')
            ->setKeywords('订单信息')
            ->setCategory('c');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','订单号')
            ->setCellValue('B1','订单商品')
            ->setCellValue('C1','收货人信息')
            ->setCellValue('D1','下单时间')
            ->setCellValue('E1','总价')
            ->setCellValue('F1','运费')
            ->setCellValue('G1','保险费');
        $i=2;
        foreach($data as $k2=>$v2){
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,$v2['order_num'])
                ->setCellValue('B'.$i,$v2['goods_list'])
                ->setCellValue('C'.$i,$v2['address_list'])
                ->setCellValue('D'.$i,$v2['time'])
                ->setCellValue('E'.$i,$v2['total_price'])
                ->setCellValue('F'.$i,$v2['send'])
                ->setCellValue('G'.$i,$v2['insure']);
            $i++;
        }
        $objPHPExcel->getActiveSheet()->setTitle('订单');
        $objPHPExcel->setActiveSheetIndex(0);
        $filename=urlencode('订单信息统计表').'_'.date('Y-m-dHis');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        $objWriter->save('php://output');
        exit;
    }
}