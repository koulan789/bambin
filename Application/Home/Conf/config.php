<?php
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING'  =>array(
        '__COMMON__' => '/bambin/Application/Home/Common/', // 定义前台公共的路径
    ),
    'ALIPLAY'=>array(
        'partner'		=> '2088911848594940',

	//收款支付宝账号
			'seller_email'	=> '2355637280@qq.com',

	//安全检验码，以数字和字母组成的32位字符
			 'key'	=> '7uf7gh3mptulhzt3cvyc6e9hp452qpsi',


	//↑↑↑↑↑↑↑↑↑↑这里配置基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑


	//签名方式 不需修改
			   'sign_type'   =>strtoupper('MD5'),

	//字符编码格式 目前支持 gbk 或 utf-8
			  'input_charset'=> strtolower('utf-8'),

	//ca证书路径地址，用于curl中ssl校验
	//保证cacert.pem文件在当前文件夹目录中
			   'cacert'    => getcwd().'\\cacert.pem',

	//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
			   'transport'    => 'http'
		)
	);