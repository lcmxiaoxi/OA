<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-mgt.css" />
<link rel="stylesheet" href="/Public/Admin/css/WdatePicker.css" />
<script src="/Public/Common/iDialog/jquery-1.8.3.min.js"></script>
<script src="/Public/Common/iDialog/jquery.iDialog.js" dialog-theme="default"></script>
<title>移动办公自动化系统</title>
<style type='text/css'>
	table tr .num {width:50px;}
	table tr .name {width:320px;}
	table tr .process {width:80px;}
	table tr .file {width:80px; padding-left:13px;}
	table tr .node {width:80px;}
	table tr .addtime {width:80px;}
	.i-content {height:400px; overflow:auto;}
</style>
</head>

<body>
<div class="title"><h2>信息管理</h2></div>
<div class="table-operate ue-clear">
	<a href="/thinkoa/index.php/admin/doc/add" class="add">添加</a>
    <a href="javascript:;" class="del" id='btnDel'>删除</a>
    <a href="javascript:;" class="edit" id='btnEdit'>编辑</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
            	<th class="num">序号</th>
                <th class="name">标题</th>
                <th class="process">内容</th>
				<th class="file">附件下载</th>
                <th class="node">作者</th>
                <th class="time">添加时间</th>
                <th class="operate">操作</th>
            </tr>
        </thead>
        <tbody>
        	<?php if(is_array($doc_list)): $i = 0; $__LIST__ = $doc_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            	<td class="num"><?php echo ($vo["doc_id"]); ?></td>
                <td class="name"><?php echo ($vo["doc_title"]); ?></td>
                <td class="process">
                	<a class='show' onclick="show(<?php echo ($vo["doc_id"]); ?>)">查看全文</a>
                </td>
				<td class="file">
					<?php if($vo["doc_file"] == 'null' ): ?>无附件
					<?php else: ?>
					<a href="<?php echo U('download','id='.$vo[doc_id]);?>">附件下载</a><?php endif; ?>
				</td>
                <td class="node"><?php echo ($vo["user_name"]); ?></td>
                <td class="time"><?php echo ($vo["doc_ctime"]); ?></td>
                <td class="operate">
                	<input type='checkbox' name='checkbox' value='2' />
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/core.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.pagination.js"></script>
<script type="text/javascript">
//定义页面载入事件
/*$(document).ready(function(){
	iDialog({
    title:'Hello World',
    id:'DemoDialog  ',
    content:'<p>大家好：<br> 我是minDialog</p>',
    lock: true,
    width:500,
    fixed: true,
    height:300
  }); 
});*/
/*function show($title,$content){
	iDialog({
    title:$title,
    //id:'DemoDialog  ',
    content:$content,
    lock: true,
    width:500,
    fixed: true,
    height:300
  }); 
}*/

function show(id){
	//参数1: url 请求的后台PHP程序的地址
	//参数2: 传参， get方式会产生缓存，需要增加随机数
	//参数3: 请求完成后的触发事件，参数就是后台PHP的返回值
	//参数4: 返回数据类型 text json xml
	$.get("<?php echo U('show');?>",{'id':id,'_':Math.random()},function(msg){
		//alert(msg.doc_title);die;
		iDialog({
		    title: msg.doc_title,
		    //id:'DemoDialog  ',
		    content: msg.doc_content,
		    lock: true,
		    width:800,
		    fixed: true,
		    height:500
		});
	},'json');
}
$(".select-title").on("click",function(){
	$(".select-list").hide();
	$(this).siblings($(".select-list")).show();
	return false;
})
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
})

$('.pagination').pagination(100,{
	callback: function(page){
		alert(page);	
	},
	display_msg: true,
	setPageNo: true
});

$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

showRemind('input[type=text], textarea','placeholder');
</script>
</html>