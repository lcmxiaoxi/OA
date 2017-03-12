<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-reg.css" />
<title>移动办公自动化系统</title>
<style type='text/css'>
	select {
		background: rgba(0, 0, 0, 0) url("../images/inputbg.png") repeat-x scroll 0 0;
	    border: 1px solid #c5d6e0;
	    height: 28px;
	    outline: medium none;
	    padding: 0 10px;
	    width: 240px;
	}
	textarea {
		width:800px;
	}
	#tip {
		position:absolute;
		z-index:999;
		top:96px;
		left:114px;
		width:260px;
		height:auto;
		display:none;
		background:#fff;
		border:1px #C5D6E0 solid;
	}
	#tip div {
		padding:0 10px;
	}
</style>
</head>

<body>
<div class="title"><h2>信息登记</h2></div>
<form action="<?php echo U('addOk');?>" method="post" enctype='multipart/form-data'>
<div class="main">
	<p class="short-input ue-clear">
    	<label>收件人：</label>
        <input name="nickname" id='nickname' type="text" placeholder="收件人名称" autocomplete='off' />
		<div id='tip'></div>
    </p>
    <p class="short-input ue-clear">
    	<label>主题：</label>
        <input name="title" type="text" placeholder="邮件主题" />
    </p>
	<p class="short-input ue-clear">
    	<label>附件：</label>
        <input type="file" name="file" />
    </p>
    <p class="short-input ue-clear" style="float:left;">
    	<label>内容：</label>
    </p>
	<p style='width:900px; padding-left:0; float:left;'>
		<textarea name="content" id="content"></textarea>
	</p>
	<div style='clear:both;'></div>
</div>
<div class="btn ue-clear">
	<a href="javascript:;" class="confirm" id='btnSubmit'>确定</a>
    <a href="javascript:;" class="clear" id='btnReset'>清空内容</a>
</div>
</form>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript">
//1. 获取收件人文本框标签，注册键盘弹起事件
$('#nickname').keyup(function(){
	var name = $(this).val();
	$.ajax({
		// 指定ajax请求的后台PHP程序
		'url': "<?php echo U('getNames');?>",
		// 指定数据发送类型
		'type': 'post',
		// 指定同步(false)还是异步(true)
		'async' : true,
		// 向后台程序发送的数据
		'data' : {'name': name},
		// 返回值类型
		'dataType' : 'json',
		// 成功后的触发事件, 参数msg接收到的后台PHP的返回值
		'success' : function(msg){
			//alert(msg);
			// 获取tip标签对象
			var tip = $('#tip');
			// 清空tip标签中的原有的内容
			tip.empty();
			//循环取出每个用户名，拼接到一个字符串
			for(i = 0; i < msg.length; i++){
				// 创建div标签
				var div = $('<div>');
				// 将nickname的值写入div标签中
				div.html(msg[i].user_nickname);
				// 在div标签上绑定鼠标悬浮事件
				div.mouseover(function(){
					$(this).attr({'style':'background-color:blue'});
				})
				// 在div标签上绑定鼠标移出事件
				div.mouseout(function(){
					$(this).attr({'style':'background-color:white'});
				})
				// 在div标签上绑定点击事件
				div.click(function(){
					// 将当前选中的div中的内容写入收件人文本框
					$('#nickname').val($(this).html());
					// 选中之后将tip标签隐藏
					tip.hide();
				})
				// 将div追加到tip标签中
				tip.append(div);
			}
			// 显示tip标签
			tip.show();
		}
	});
})
		
$('#btnSubmit').click(function(){
	$('form').submit();
})	

$('#btnReset').click(function(){
	$('form')[0].reset();
})						
			
$(".select-title").on("click",function(){
	$(".select-list").toggle();
	return false;
});
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(".select-title").find("span").text(txt);
});

showRemind('input[type=text], textarea','placeholder');
</script>
</html>