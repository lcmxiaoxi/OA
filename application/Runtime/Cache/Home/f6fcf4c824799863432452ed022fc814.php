<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="<?php echo U('upfile');?>" method="post" enctype="multipart/form-data">
选择文件：<input type="file" name="f" />
<input type="submit" value="上传" />
</form>
</body>
</html>