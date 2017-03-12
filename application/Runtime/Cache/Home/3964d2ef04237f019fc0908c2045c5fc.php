<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<link href="/Public/Common/Ueditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/Public/Common/Ueditor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/Common/Ueditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/Common/Ueditor/umeditor.min.js"></script>
<script type="text/javascript" src="/Public/Common/Ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<body>
<textarea id="content">
默认填充内容
</textarea>
<script type="text/javascript">
	var um=UM.getEditor('content',{
		//配置富文本编辑器的宽高
		initialFrameWidth:800,
		initialFrameHeight:300,
		//配置工具栏
		toolbar:[
	            'source | undo redo | bold italic underline strikethrough | superscript subscript | forecolor backcolor | removeformat |',
	            'insertorderedlist insertunorderedlist | selectall cleardoc paragraph | fontfamily fontsize' ,
	            '| justifyleft justifycenter justifyright justifyjustify |',
	            'link unlink | emotion image video  | map',
	            '| horizontal print preview fullscreen', 'drafts', 'formula'
	        ],
	        readonly:false
	});
</script>
</body>
</html>