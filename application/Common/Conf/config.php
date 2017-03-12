<?php
return array(
	'LOAD_EXT_FILE'=>'myfunc',
	'UPLOAD_EXTS'=>array('jpg','png','gif','doc','docx','ppt','pptx','xls'),
	//'配置项'=>'配置值'
	 'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'test',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  123,          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'tp_',    // 数据库表前缀

	'TMPL_PARSE_STRING'=>array(
		'__ADMIN__'=>'/Public/Admin',
		'__ADMINCSS__'=>'/Public/Admin/css',
		'__ADMINJS__'=>'/Public/Admin/js',
		'__ADMINIMG__'=>'/Public/Admin/images',
		'__COMMON__'=>'/Public/Common',
		),
	//设置重写模式为默认访问模式
	'URL_MODEL'=>2,
	//设置禁止访问的模块
	'MODULE_DENY_LIST'=>array('Common','Runtime'),
	//设置允许访问的模块
	'MODULE_ALLOW_LIST'=>array('Admin','Home'),
	//设置默认访问的模块
	'DEFAULT_MODULE'=>'Admin',
	//设置默认的访问方法
	'DEFAULT_ACTION'=>'login',
	//打卡页面Trace
	'SHOW_PAGE_TRACE'=>false,
	//每页显示数量
	'PAGESIZE'=>1
);