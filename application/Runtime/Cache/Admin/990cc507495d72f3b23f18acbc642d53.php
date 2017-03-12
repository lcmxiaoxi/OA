<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-reg.css" />
<script type="text/javascript" src="/Public/Admin/js/jquery-1.10.1.js"></script>
<script src="/Public/Common/Uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/Public/Common/Uploadify/uploadify.css">


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
		font-size:12px;
		font-family:'Microsoft YaHei';
	}
	textarea#description { width:472px; padding:10px; height:84px; resize:none; outline:none; border:1px solid #c5d6e0; background:url(../images/inputbg.png) repeat-x left top;overflow:auto; float:left;}
	#showPic {width:145px; height:120px; position:absolute; left:400px; top:65px; background:#f00;}
	#showPic img {width:145px; height:120px;}
</style>

</head>

<body>
<div class="title"><h2>信息登记</h2></div>
<form action="<?php echo U('addOk');?>" method="post" enctype='multipart/form-data'>
<div class="main">
	<div id='showPic'></div>
    <p class="short-input ue-clear">
    	<label>标题：</label>
        <input name="title" type="text" placeholder="标题" />
    </p>
	<p class="short-input ue-clear" style='float:left;'>
    	<label>缩略图：</label>
		<input type='hidden' id='thumb' name='thumb' />
    </p>
	<br />
	<div style='float:left;'><input type="file" name="file" id="file" multiple="true" /></div>
	<div style='clear:both;'></div>
	<p class="short-input ue-clear">
    	<label>作者：</label>
        <input name="author" type="text"  />
    </p>
	<p class="short-input ue-clear">
    	<label>描述：</label>
        <textarea name="description" id="description" placeholder='描述'></textarea>
    </p>
    <p class="short-input ue-clear" style="float:left;">
    	<label>内容：</label>
    </p>
	<p style='width:900px; padding-left:0; float:left;'>
		<textarea name="content" id="content"></textarea>
	</p>
	<div style='clear:both;'></div>
	<input type="hidden" name="k_pic" id="k_pic" value="">
	<input type="hidden" name="k_smallpic" id="k_smallpic" value="">
</div>

<div class="btn ue-clear">
	<a href="javascript:;" class="confirm" id='btnSubmit'>确定</a>
    <a href="javascript:;" class="clear" id='btnReset'>清空内容</a>
</div>
</form>
</body>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#file').uploadify({
		'swf':'/Public/Common/Uploadify/uploadify.swf',
		'uploader':"<?php echo U('upfile');?>",
		'buttonText' : '选择图片',
		'formData' : {'<?php echo session_name();?>': '<?php echo session_id();?>'},
		// 图片上传成功后的触发事件
		'onUploadSuccess' : function(file, data, response){
			//alert(data);
			//创建img标签
			var img = $('<img />');
			// 去掉data最前的 .
			data = data.substr(1);
			// 将接收到图片路径赋值给img的src属性
			img.attr({'src':data});
			// 将img标签写入 id=showPic的div中
			$('#showPic').html(img);

			$('#k_smallpic').val(data);
			var data=data.replace('thumb_','');
			$('#k_pic').val(data);
		}
	});
	$('#btnSubmit').click(function(){
		//submit()是jquery的方法
		$('form').submit();
	})
	$('#btnReset').click(function(){
		//reset()是js的方法
		//$('form')是jquery对象 $('form')[0] 转为html的form标签对象
		$('form')[0].reset();
	})
});

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